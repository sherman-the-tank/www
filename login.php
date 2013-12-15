<html>
<head>
  <title>Please login to Koo...</title>
</head>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_REQUEST['username'];
    $pswd = $_REQUEST['password'];

    $mysqli = mysqli_connect('koodemo.cwmhshxpuljc.us-west-2.rds.amazonaws.com',
                             'koomaster',
                             'koopassword',
                             'koodb');
    if ($mysqli->connect_errno) {
      echo 'Failed to connect to Mysql: ' . $mysqli->error
           . ' (' . $mysqli->connect_errno . ')';
      return;
    } else {
      $stmt = 'SELECT password FROM business_unit WHERE login="' . $user . '"';
      $result = $mysqli->query($stmt);
      if ($result && $result->num_rows == 1) {
        $row = $result->fetch_array();
        if ($row['password'] === $pswd) {
          // Authentication succeeded
          $result->close();
          $mysqli->close();
          header('Location: http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/index.php');
        }
      }

      // Authentication failed, clean up
      if ($result) {
        $result->close();
      }
      $mysqli->close();
      $msg = 'Failed to authenticate user "' . $user . '"';
    }
  }
?>

<body>
  <form action='login.php' method='post'>
    <table>
<?php
  if ($msg) {
?>
      <tr>
        <td colspan='2' style='color: red'><?php echo $msg; ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td colspan='2'>Please enter the username and password...</td>
      </tr>
      <tr>
        <td>Username:</td>
        <td><input name='username' /></td>
      </tr>
      <tr>
        <td>Password:</td>
        <td><input name='password' type='password' /></td>
      </tr>
      <tr>
        <td colspan='2'>
          <table width='100%'>
            <tr>
              <td width='50%' align='center'><button type='submit'>Login</button></td>
              <td align='center'><a href='signup.php'>Sign Up</a></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </form>
</body>
</html>
