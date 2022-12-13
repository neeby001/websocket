<?
require('def.php');
if ($connect == false) {
  echo 'Не удалось подключиться';
  exit();
}
if (isset($_SESSION['email'])){
  $post = $_POST;
  $id = $_GET['id'];
  $password_space = $post['secondname'];
  $secondname = preg_replace('/\s+/', '',$password_space);
  $email = $_SESSION['email'];
  $find = mysqli_query($connect, "SELECT secondname FROM users WHERE email = '$email'");
  $secname = mysqli_fetch_assoc($find);
  $secname1 = $secname['secondname'];
  if ($secondname == "") {
    echo "Введите хоть что-нибудь";
  }
  else {
      mysqli_query($connect, "INSERT INTO chats (part1,part2) VALUES ('$secname1','$secondname')");
      $id_chat2 = mysqli_query($connect, "SELECT id FROM chats WHERE part1 = '$secname1' AND part2 = '$secondname'");
      $id_chat1 = mysqli_fetch_assoc($id_chat2);
      $id_chat = $id_chat1['id'];
      header("Location: talk.php?id={$id_chat}");
    }


$part1 =
<<<HTML
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="css/first.css">
      <title>Document</title>
    </head>
    <body>
      <div class="wrapper">
HTML;
$part2 = "<form class='login__form' action='friends.php' method='post'>";
$part3 =
<<<HTML
        <form class="login__form" action="friends.php" method="post">
          <p class="input__line">Имя собеседника:<input class="input__form" type="text" name="secondname" value=""></p>
          <input class="submit" type="submit" name="" value="Создать чат">
        </form>
      </div>
    </body>
    </html>
HTML;
echo $part1.$part2.$part3;
}
else{
  echo "Не атворизован";
}
