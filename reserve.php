<html>
<head>
</head>

<?php
  $party_size = $_REQUEST['party_size'];
  $buid = $_REQUEST['business_unit'];

  $mysqli = mysqli_connect('koodemo.cwmhshxpuljc.us-west-2.rds.amazonaws.com',
                           'koomaster',
                           'koopassword',
                           'koodb');
  if ($mysqli->connect_errno) {
    echo 'Failed to connect to Mysql: ' . $mysqli->error
         . ' (' . $mysqli->connect_errno . ')';
    return;
  }
  
  $stmt = 'SELECT id FROM bu_tables WHERE bu_id=' . $buid . ' AND NOT reserved AND capacity>='
          . $party_size . ' ORDER BY capacity LIMIT 1';
  $result = $mysqli->query($stmt);
  if ($result && $result->num_rows == 1) {
    // Found one table
    $row = $result->fetch_array();
    $table_id = $row['id'];
    $result->close();
    // Mark the table is reserved
    $stmt = 'UPDATE bu_tables SET reserved=1 WHERE id=' . $table_id
            . ' AND bu_id=' . $buid;
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

