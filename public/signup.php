<?
require('def.php');
$post = $_POST;
$username_space = $post['email'];
$username = preg_replace('/\s+/', '',$username_space);
$password_space = $post['pass'];
$password = preg_replace('/\s+/', '',$password_space);
$_SESSION['email'] = $username;
$find = mysqli_query($connect, "SELECT email FROM users WHERE email = '$username'");
  $nal = mysqli_num_rows($find);
  if ($connect == false) {
    echo 'Не удалось подключиться';
    exit();
  }

  if ($username == "" or $password == "") {
    echo "Введите хоть что-нибудь";
  }
  elseif ($nal>0 ) {
    echo "Это имя уже занято!";
  }
  else {
    mysqli_query($connect, "INSERT INTO users (name, email, secondname, password, color) VALUES ('', '$username','','$password',000000)");
    $ide = mysqli_query($connect, "SELECT id FROM users WHERE email = '$username'");
    $id = mysqli_fetch_assoc($ide);
    header("Location: form.php?id={$id['id']}");

  }
//header("Location: /chat.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/signup.css">
  <title>Document</title>
</head>
<body>
  <div class="wrapper">
    <form class="login__form" action="signup.php" method="post">
      <p class="input__line">Логин:<input class="input__form" type="text" name="email" value=""></p>
      <p class="input__line">Пароль:<input class="input__form" type="text" name="pass" value=""></p>
      <input class="submit" type="submit" name="" value="Зарегистрироваться">

    </form>
  </div>

</body>
</html>
