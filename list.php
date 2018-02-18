<?php
$footer = file_get_contents(__DIR__ . '/footer.php');
$title = "Все тесты для задания"; require(__DIR__ . '/header.php');

$i=0;
$directory = "tests/";

?>

<article>
<section>
  <h1>Все тесты</h1>
  <ul>
<?php
  foreach (glob($directory."test-*.json") as $jsonname) {
    $get_test = file_get_contents($jsonname);
    $i = ++$i;
    if ($i<10) {
      $i="0$i";
    }
    $tests_arr = json_decode($get_test, true);
// проверяем, чтобы в список тестов не попали никакие другие файлы, кроме тех, что были подготовлены по единому шаблону тестов
    if (array_key_exists('quest', $tests_arr)) {
      $jsonname = $tests_arr['quest'];
          echo "<li><a href='test.php?num=".$i."'>".$jsonname."</a></li>\n";
        
    }
  }
?>
  </ul>
</section>
<?php echo $footer; ?>