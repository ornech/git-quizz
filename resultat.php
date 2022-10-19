<?php
require('header.php');
require('menu.php');
?>
<?php
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<html>
<body>

  <?php
  if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
  } else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
  }
  ?>

  <?PHP
  // Lis le fichier JSON
  $json = file_get_contents('json/quizz4.json');

  // Decode le contenue du fichier JSON
  $json_data = json_decode($json,true);
  $note=0;

  echo "<table style='width:75%'>";
  echo "  <tr>
  <th>Question</th>
  <th>Points</th>
  </tr>";
  if (isset($_POST))
  foreach ($_POST as $key => $value) {

    $reponse_OK = $json_data['quizz'][$key]['qcm_reponse'];
    $question = $json_data['quizz'][$key]['qcm_question'];

    echo "<tr>";
    echo "<td> $question </td>";

    //echo "$key | $value | $reponse_OK <BR>";
    if($value == $reponse_OK)
    {
      // Si réponse bonne
      echo "<td> 1 pt</td>";

      // ajout d'un point à la note globale
      $note = $note + 1;
    }
    else {
      // Si réponse fausse...
      echo "<td> 0 pt</td>";
    }
    echo "</tr>";
  }
  echo "<tr>";
  echo "<td></td><td>$note/10</td>";
  echo "</tr>";
  echo "</table>";
  ?>
