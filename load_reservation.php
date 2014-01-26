<html>
<head>
  <title>Load service reservations on a specific day for a given business unit...</title>
</head>

<?php
  $buid = $_REQUEST['bu_id'];
  if (!$buid) {
    echo 'No business unit specified';
    return;
  }

  // Start date. If not specified, will be the current time
  $start = $_REQUEST['start_time'];
  if (!$start) {
    // Not specified, use the current time
    $start = date('Y-m-d H:i:s');
  }

  // End time. If not specified, will retrieve all reservations starting from start time
  $end = $_REQUEST['end_time'];
  if (!$end) {
    $end = '9999-12-31 23:59:59';
  }

  $stmt = 'SELECT * FROM reservation WHERE bu_id=' . $buid
          . ' AND reserved_time>="' . $start . '" AND reserved_time<"' . $end .'"';
  $mysql_client = mysqli_connect('koodemo.cwmhshxpuljc.us-west-2.rds.amazonaws.com',
                                 'koomaster',
                                 'koopassword',
                                 'koodb');
  if ($mysql_client->connect_errno) {
    echo 'Failed to connect to Mysql: ' . $mysql_client->error
         . ' (' . $mysql_client->connect_errno . ')';
    return;
  } else {
    $result = $mysql_client->query($stmt);
    if ($result) {
      $rows = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode($rows);
      $result->free();
      $mysql_client->close();
    } else {
      echo 'Failed to load reservations: ' . $mysql_client->error;
      $mysql_client->close();
      return;
    }
  }
?>
