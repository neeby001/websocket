<?
require('def.php');
if ($connect == false) {
  echo 'Не удалось подключиться';
  exit();
}
$post = $_POST;
$username_space = $post['email'];
$username = preg_replace('/\s+/', '',$username_space);
$password_space = $post['pass'];
$password = preg_replace('/\s+/', '',$password_space);
$_SESSION['email'] = $username;
$passe = mysqli_query($connect, "SELECT password FROM users WHERE email = '$username'");
$pass = mysqli_fetch_assoc($passe);
$secname = mysqli_query($connect, "SELECT secondname FROM users WHERE email = '$username'");
$secnam = mysqli_fetch_assoc($secname);
$_SESSION['secondname'] = $secnam['secondname'];


  if ($username == "" or $password == "") {
    echo "Введите хоть что-нибудь";
  }
  else {
    if ($password == $pass['password']){
      $ide = mysqli_query($connect, "SELECT id FROM users WHERE email = '$username'");
      $id = mysqli_fetch_assoc($ide);
      header("Location: chat.php?id={$id['id']}");
    }
  }
//header("Location: /chat.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/login.css">
  <title>Document</title>
</head>
<body>
  <div class="wrapper">
    <form class="login__form" action="login.php" method="post">
      <p class="input__line">Логин:<input class="input__form" type="text" name="email" value=""></p>
      <p class="input__line">Пароль:<input class="input__form" type="text" name="pass" value=""></p>
      <input class="submit" type="submit" name="" value="Войти">

    </form>
  </div>

</body>
</html>
