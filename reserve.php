<html>
<head>
</head>

<?php
  $party_size = $_REQUEST['party_size'];
  $buid = $_REQUEST['business_unit'];
  $reserved_time = $_REQUEST['reserved_time'];

  $mysqli = mysqli_connect('koodemo.cwmhshxpuljc.us-west-2.rds.amazonaws.com',
                           'koomaster',
                           'koopassword',
                           'koodb');
  if ($mysqli->connect_errno) {
    echo 'Failed to connect to Mysql: ' . $mysqli->error
         . ' (' . $mysqli->connect_errno . ')';
    return;
  }
  
  $stmt = 'SELECT id FROM bu_tables t WHERE t.bu_id=' . $buid
          . ' AND t.capacity>=' . $party_size
          . ' AND t.id NOT IN'
          . ' (SELECT table_id FROM reservation r WHERE r.bu_id=' . $buid
          . ' AND ADDTIME(r.reserved_time, "1:00:00")>="' . $reserved_time . '"'
          . ' AND ADDTIME("' . $reserved_time . '", "1:00:00")>=r.reserved_time)'
          . ' ORDER BY t.capacity LIMIT 1';
  $result = $mysqli->query($stmt);
  if ($result && $result->num_rows == 1) {
    // Found one table
    $row = $result->fetch_array();
    $table_id = $row['id'];
    $result->close();
    // Mark the table is reserved
    $stmt = 'INSERT INTO reservation SET bu_id=' . $buid
            . ', table_id=' . $table_id
            . ', reserved_time="' . $reserved_time . '"';
    if ($mysqli->query($stmt) === TRUE) {
      echo $table_id;
    } else {
      echo 'fail-to-reserve';
    }
    $mysqli->close();
    return;
  }

  // Did not find a table, clean up
  if ($result) {
    $result->close();
  }
  $mysqli->close();

  echo 'no-table';
?>

