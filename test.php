<?php
/*echo "<pre>";
var_dump($_POST);
echo "</pre>";
*/
$num = $_GET['num'];
$url = "tests/test-".$num.".json";

if (!file_exists($url)) {
  header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
  echo "<br><center><h1>Ошибка 404 - файл не найден</h1>\n
        <h3>Сейчас вы будете перенаправлены на список со всеми тестами</h3></center>";
  header('Refresh: 8; list.php');
  exit;
}

/*if (!file_exists($url)) {
  echo "<center><h1>Такого теста нет</h1>";
  echo "<h3>(<a href='list.php'>вернуться к списку тестов</a>)</h3></center>";
  exit;
}
*/

$text = file_get_contents($url);
$data = json_decode($text, true);

if (!array_key_exists('quest', $data))
{
  echo "<center><h1>Такого теста нет</h1>";
  echo "<h3>(<a href='list.php'>вернуться к списку тестов</a>)</h3></center>";
  exit;
}

$question = $data['quest'];
$answ = $data['answ'];
$right = $data['right'];
$check = "radio";
$ans = "ans";
$nname = "name";
$res = "";

if (is_array($right)) {
  $right = implode(", ", ($data['right']));
  $check = "checkbox";
  $ans="ans[]";
}

if (empty($_POST['ans']) || empty($_POST['name'])) {
  $result = "Перед нажатием кнопки представьтесь и выберите правильный вариант ответа";
}
  elseif (!is_array($_POST['ans'])) {
    $nname = ($_POST['name']);
    $res = ($_POST['ans']);
    if ($res == $right) {
      $result = "Ваш выбор: <b>&laquo;".$res."&raquo;</b>. <font color=green>Это правильный ответ</font>. Поздравляю!";
      $diploma = "";
    } else {
      $result = "Ваш выбор: <b>&laquo;".$res."&raquo;</b>. <font color=red>Это неверный ответ</font>. Попробуйте снова";
    }
}
  else {
    $nname = ($_POST['name']);
    $res = ($_POST['ans']); 
    $res = implode(", ", ($res));     
    if ($res == $right) {
      $result = "Ваш выбор: <b>&laquo;".$res."&raquo;</b>. <font color=green>Это правильный ответ</font>. Поздравляю!";
      $diploma = "";
    } else {
      $result = "Ваш выбор: <b>&laquo;".$res."&raquo;</b>. <font color=red>Это неверный ответ</font>. Попробуйте снова";
  }
}

$footer = file_get_contents(__DIR__ . '/footer.php');
$title = "Тест №".$num; require(__DIR__ . '/header.php');
?>

<section>
  <h1>Тест №<?php echo $num; ?> </h1>
  <form action="" method="POST">
    <?php 
      echo "<fieldset>\n";
      echo "<legend> <b>".$question."</b> </legend>\n";
        for ($i=0; $i<count($answ); $i++)
      echo "<label><input type='$check' name='$ans' value='$answ[$i]'>$answ[$i]</label>\n<br>";
    ?>

    </fieldset><br>
          <?php echo "<label><input type='text' name='name' size='25' maxlength='23' placeholder='Введите свое имя'> 
          <b><font color=red>*</font>Введите сюда свои имя и фамилию</b></label>\n<br><br>"; ?>
    <input type="submit" value="ПРОВЕРИТЬ">
  </form>
<br>
<?php echo $result; ?>
</section>

<br>
<center>

<?php
session_start(); 
$_SESSION['user'] = $nname;
$_SESSION['quest'] = $question;

//$user = $nname; 
//  setcookie("user", $user, time() + 600);
//  setcookie("quest", $question, time() + 600);


if ($res == $right) {
  echo "<img src='diploma.php'>";
}
?>

</center>
<?php echo $footer; ?>