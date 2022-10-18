<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<?php
// Lis le fichier JSON
$json = file_get_contents('json/quizz4.json');

// Decode le contenue du fichier JSON
$json_data = json_decode($json,true);

$questionnaire = array();

for ($i = 1; $i <= 10; $i++) {
   $question = rand(10,100);
   array_push($questionnaire, $question);
  }
 //var_dump($questionnaire);
echo "<form action='resultat.php' method='post'>";
 foreach ($questionnaire as $key => $value) {
   // Question...
   echo "<p>".$json_data['quizz'][$value]['qcm_question']."";
   echo "<fieldset>";
   echo "<input type=radio name=$value value=r1>";
   echo "<label for=r1>".$json_data['quizz'][$value]['qcm_r1_proposition']."</label><br>";
   echo "<input type=radio name=$value value=r2>";
   echo "<label for=r2>".$json_data['quizz'][$value]['qcm_r2_proposition']."</label><br>";
   echo "<input type=radio name=$value value=r3>";
   echo "<label for=r3>".$json_data['quizz'][$value]['qcm_r3_proposition']."</label><br>";
   echo "<input type=radio name=$value value=r4>";
   echo "<label for=r4>".$json_data['quizz'][$value]['qcm_r4_proposition']."</label><br>";
   echo "</fieldset></p>";
  }
echo "<input type='submit' value='Submit'>";
echo "</form>";
