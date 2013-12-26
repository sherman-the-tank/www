<html>
<head>
  <title>Load all business units for a given category...</title>
</head>

<?php
  $category = $_REQUEST['category'];
  if (!$category) {
    echo 'No category specified';
    return;
  }

  $stmt = 'SELECT * FROM business_unit WHERE category="' . $category . '"';
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
      echo 'Failed to load all business units: ' . $mysql_client->error;
      $mysql_client->close();
      return;
    }
  }
?>
