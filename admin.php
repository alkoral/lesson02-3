<?php
$footer = file_get_contents(__DIR__ . '/footer.php');
$title = "Загрузка нового теста"; require(__DIR__ . '/header.php');
$new_file = "Загрузить новый тест в формате .JSON";
$path = 'tests';

/*echo "<pre>";
var_dump($_FILES);
var_dump($_POST);
echo "</pre>";*/
?>

<section>
<?php
  echo "<h1>Загрузка нового теста</h1>";

if (isset($_FILES['myfile']['name']) && !empty($_FILES['myfile']['name'])) {
    $temp_file = $_FILES['myfile']['tmp_name'];
    $go_test = file_get_contents($temp_file);
    $test_res = json_decode($go_test, true);
      if (!is_array($test_res)) {
        echo "<font color='red'>Ошибка: это не JSON-файл. Тест на сервер не загружен!</font><br><br>";
      }
      else {
        if (!array_key_exists('quest', $test_res) && !array_key_exists('answ', $test_res)  &&  !array_key_exists('right', $test_res)) {
          echo "<font color='red'>Ошибка: это JSON-файл, но не тест. Файл на сервер не загружен!</font><br><br>";
        }
        else {
          if ($_FILES['myfile']['error'] == UPLOAD_ERR_OK &&
          move_uploaded_file($_FILES['myfile']['tmp_name'], "tests/".$_FILES['myfile']['name'])) {
            echo "<font color='blue'>О чудо! Файл <b>".$_FILES['myfile']['name']. "</b> с тестом загружен</font><br>";
            $new_file = "<br>Через 5 секунд вы будете перенаправлены к списку тестов";
//            $path = 'tests';
            $dir = opendir ("$path");
            $i = 0;
            while (false !== ($file = readdir($dir))) {
                if (strpos($file, '.json') ) {
                $i++; {
                }
                  if ($i<10) {
                   $test="test-0$i.json";
                  }
                  else {
                $test="test-$i.json";
                  }
            }
              }
                rename ("tests/test.json", "tests/$test");
                header('Refresh: 5; list.php');
              }
        }
    }
}

?>

  <form method="post" action="" enctype="multipart/form-data">
    <?php echo $new_file; ?><br><br>
    <input type="file" name="myfile"><br><br>
    <input type="submit" value="ОТПРАВИТЬ">
  </form>
</section>
<?php echo $footer; ?>