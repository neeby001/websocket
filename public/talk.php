<?
require('def.php');
if (isset($_SESSION['email'])){
$email = $_SESSION['email'];

$sender2 = mysqli_query($connect, "SELECT secondname FROM users WHERE email = '$email'");
$sender1 = mysqli_fetch_assoc($sender2);
$sender = $sender1['secondname'];
$id_chat = $_GET['id'];
$post = $_POST;
$mes = $post['mes'];

$find1 = mysqli_query($connect, "SELECT part1,part2 FROM chats WHERE id = '$id_chat'");
$r2 = mysqli_fetch_assoc($find1);
$part1 = $r2['part1'];//Участники данного чата
$part2 = $r2['part2'];

$g =
<<<HTML
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="css/talk.css">
      <title>Document</title>
    </head>
    <body>
      <div class="wrapper" id="messages">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script type="text/javascript">

        </script>

        <div class="shapka">
          <p class="heading" id="status">OFFLINE</p>
          <h1 class="heading">Чат</h1>
          <a href="logout.php" class="out">Выход</a>
HTML;

$you = "<p  class='heading' id='you'>{$sender}</p>";
$p1 = "<p  class='heading' id='sec'>{$part1}</p></div>";
$p2 = "<p  class='heading' id='sec'>{$part2}</p></div>";
if($sender == $part1){
  echo $g.$you.$p2;//Вывод шапки
}
else{
  echo $g.$you.$p1;//Вывод шапки
}



if($mes == ""){

}

$date_time = date('m/d/Y h:i:s', time());

if ($sender == $part1 && $mes != ''){
  mysqli_query($connect, "INSERT INTO messages (sender, recipient, mes, id_chat) VALUES ('$sender', '$part2','$mes','$id_chat')");
}
else if($sender == $part2 && $mes != ''){
  mysqli_query($connect, "INSERT INTO messages (sender, recipient, mes, id_chat) VALUES ('$part2', '$part1','$mes','$id_chat')");
}
$form1 = "<form action='talk.php?id={$id_chat}' method='post' id='form'>";
//$form1 = "<form action='test.php' method='post' id='form'>";
$t =
<<<HTML
    <input class="mes__input" type="text" name="mes" value="" id="input" required autofocus autocomplete="off" placeholder="Ваше сообщение">
    <!--<input type="submit" name="" value="Отправить">-->
  </form>
  <div class="all__mes">
  <script type="text/javascript" src="app.js"></script>
  <script type="text/javascript" src="../server.js"></script>
HTML;
echo $form1.$t;//Форма, чтобы не исчезал get параметр

$all_mes = mysqli_query($connect, "SELECT mes,sender FROM messages WHERE id_chat = '$id_chat'");

while($r2 = mysqli_fetch_assoc($all_mes)){
  if ($r2['sender'] == $sender){
    echo "<div class='cell__message-right'><p style='display:inline;' class='message'>{$r2['mes']}</p><span>{$r2['sender']}</span></div>";
  }
  else{
    echo "<div class='cell__message-left'><p style='display:inline;' class='message'>{$r2['mes']}</p><span>{$r2['sender']}</span></div>";
  }
}
echo '</div>';

}
else{
  echo "Не атворизован";
}
?>
