<html>
<head>
  <title>Load all service items for a given business unit...</title>
</head>

<?php
  $buid = $_REQUEST['bu_id'];
  if (!$buid) {
    echo 'No business unit specified';
    return;
  }

  $stmt = 'SELECT * FROM bu_tables WHERE bu_id=' . $buid;
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
      echo 'Failed to load all service items: ' . $mysql_client->error;
      $mysql_client->close();
      return;
    }
  }
?>
