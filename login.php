<html>
<head>
  <title>Please login to Koo...</title>
</head>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
      $_REQUEST['password'] == '12345') {
    header('Location: http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/index.php');
  }
?>

<body>
  <form action='login.php' method='post'>
    <table>
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
