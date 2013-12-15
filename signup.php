<html>
<head>
  <title>Please enter required information to sign up to Koo...</title>
</head>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update the DB with the new data
    $bu_name = $_POST['name'];
    $bu_category = $_POST['category'];
    $bu_sub_category = $_POST['sub_category'];
    $bu_login = $_POST['username'];
    $bu_password = $_POST['password'];
    $bu_intro = $_POST['intro'];

    $stmt = 'INSERT INTO business_unit (name, login, password, category, sub_category, intro)'
            . ' VALUES ("' . $bu_name . '", "' . $bu_login . '", "' . $bu_password
            . '", "' . $bu_category . '", "' . $bu_sub_category . '", "' . $bu_intro . '")';

    $mysql_client = mysqli_connect('koodemo.cwmhshxpuljc.us-west-2.rds.amazonaws.com',
                                   'koomaster',
                                   'koopassword',
                                   'koodb');
    if ($mysql_client->connect_errno) {
      echo 'Failed to connect to Mysql: ' . $mysql_client->error
           . ' (' . $mysql_client->connect_errno . ')';
      return;
    } else {
      if ($mysql_client->query($stmt) === TRUE) {
        $mysql_client->close();
        header('Location: http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/index.php');
      } else {
        echo 'Failed to insert new business to Mysql: ' . $mysql_client->error;
        $mysql_client->close();
        return;
      }
    }
  }
?>

<body>
  <form action='signup.php' method='post'>
    <table>
      <tr>
        <td colspan='2'>Please enter the information for the new business entity...</td>
      </tr>
      <tr>
        <td>Business name:</td>
        <td><input name='name' /></td>
      </tr>
      <tr>
        <td>Category:</td>
        <td>
          <select name='category'>
            <option>Restaurant</option>
            <option>Barber</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Sub category:</td>
        <td><input name='sub_category' /></td>
      </tr>
      <tr>
        <td>Username:</td>
        <td><input name='username' /></td>
      <tr>
        <td>Password:</td>
        <td><input name='password' type='password' /></td>
      </tr>
      <tr>
        <td>Introduction:</td>
        <td><input name='intro' /></td>
      </tr>
      <tr>
        <td>Cover image:</td>
        <td><input name='cover_image' /></td>
      </tr>
      <tr>
        <td colspan='2'>
          <table width='100%'>
            <tr>
              <td width='50%' align='center'><button type='submit'>Sign up</button></td>
              <td align='center'><button type='button' onclick='javascript:window.location="login.php"'>Cancel</button></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </form>
</body>
</html>
