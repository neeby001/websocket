<?
require('def.php');
$post = $_POST;
$username_space = $post['name'];
$username = preg_replace('/\s+/', '',$username_space);
$password_space = $post['secondname'];
$secondname = preg_replace('/\s+/', '',$password_space);
$color_space = $post['color'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];
$_SESSION['secondname'] = $secondname;
$find = mysqli_query($connect, "SELECT secondname FROM users WHERE secondname = '$secondname'");
  $nal = mysqli_num_rows($find);
  if ($connect == false) {
    echo 'Не удалось подключиться';
    exit();
  }

  if ($username == "" or $secondname == "") {
    echo "Введите хоть что-нибудь";
  }
  elseif ($nal>0 ) {
    echo "Это имя уже занято!";
  }
  else {
    mysqli_query($connect, "UPDATE users SET name = '$username' WHERE email = '$email'");
    mysqli_query($connect, "UPDATE users SET secondname = '$secondname' WHERE email = '$email'");
    $ide = mysqli_query($connect, "SELECT id FROM users WHERE email = '$email'");
    $id = mysqli_fetch_assoc($ide);
    header("Location: chat.php?id={$id['id']}");

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
    <form class="login__form" action="form.php" method="post">
      <p class="input__line">Имя:<input class="input__form" type="text" name="name" value=""></p>
      <p class="input__line">Уникальное имя:<input class="input__form" type="text" name="secondname" value=""></p>
      <input class="submit" type="submit" name="" value="Зарегистрироваться">

    </form>
  </div>

</body>
</html>
