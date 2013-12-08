<html>
<head>
  <title>Please enter required information to sign up to Koo...</title>
</head>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Location: http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/index.php');
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
