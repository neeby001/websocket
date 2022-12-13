<?
require('def.php');
$id = $_GET['id'];
if (isset($_SESSION['email'])){
  echo $_SESSION['email'];
  //$secondname2 = mysqli_query($connect, "SELECT secondname FROM users WHERE id = '$id'");
  ///$secondname1 = mysqli_fetch_assoc($secondname2);
  $secondname = $_SESSION['secondname'];
  echo $secondname;
  $id_friend2 = mysqli_query($connect, "SELECT id FROM users WHERE secondname = '$secondname'");
  $find = mysqli_query($connect, "SELECT part2 FROM chats WHERE part1 = '$secondname'");
  $find2 = mysqli_query($connect, "SELECT part1 FROM chats WHERE part2 = '$secondname'");
  $id_friend = mysqli_fetch_assoc($id_friend2);
  print_r($id_friend);

$one_part =
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
      <div class="shapka">
        <h1 class="heading">Чат</h1>
        <a href="logout.php" class="out">Выход</a>
HTML;
$two_part = "<a href='friends.php?id={$id_friend['id']}' class='out'>Добавить чат</a></div>";
echo $one_part.$two_part;
while (($r1 = mysqli_fetch_assoc($find))){
  $r3 = $r1['part2'];
  $find1 = mysqli_query($connect, "SELECT id FROM chats WHERE part2 = '$r3' AND part1 = '$secondname'");
  $r2 = mysqli_fetch_assoc($find1);
  echo "<a class='chat__cell' href='talk.php?id={$r2['id']}'>{$r3}</a>";
}
while (($r1 = mysqli_fetch_assoc($find2))){
  $r3 = $r1['part1'];
  $find1 = mysqli_query($connect, "SELECT id FROM chats WHERE part1 = '$r3' AND part2 = '$secondname'");
  $r2 = mysqli_fetch_assoc($find1);
  echo "<a class='chat__cell' href='talk.php?id={$r2['id']}'>{$r3}</a>";
}
  //  </div>
  //</body>
  //</html>

//print_r($secname);

}
else{
  echo "Не атворизован";
}

?>
