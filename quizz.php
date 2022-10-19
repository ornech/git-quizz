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

// -------------------------
// Préparation des questions
// -------------------------

// récupère le nombre de questions dans le fichier Json
$nbr_questions = count($json_data["quizz"]) -1 ;
echo $nbr_questions;

$questionnaire = array();

for ($i = 1; $i <= 10; $i++) {
  // nombre aléatoire de 0 au nombre d'entrée du tableau list_questions
   $q = rand(0,$nbr_questions);
   if (in_array($q, $questionnaire))
   {
    // Vérifie si cette valeur est déja présente dans le tableau
    // si oui refait un tour de boucle supplémentaire sans ajouter l'id de la question au tableau $questionnaire
    //echo $q. " est PRESENT dans le tableau";
    $i--;
   }
   else
   {
    //echo $q. " NON présent dans le tableau";
    array_push($questionnaire, $q);
    }
  }
 //var_dump($questionnaire);

// Génération du questionnaire
echo "<form action='resultat.php' method='post'>";
 foreach ($questionnaire as $key => $value) {
   // Question...
   echo "<p>".$json_data['quizz'][$value]['qcm_question']."";
   echo "<fieldset >";
   echo "<input type=radio name=$value value=r1 required>";
   echo "<label for=r1>".$json_data['quizz'][$value]['qcm_r1_proposition']."</label><br>";
   echo "<input type=radio name=$value value=r2 required>";
   echo "<label for=r2>".$json_data['quizz'][$value]['qcm_r2_proposition']."</label><br>";
   echo "<input type=radio name=$value value=r3 required>";
   echo "<label for=r3>".$json_data['quizz'][$value]['qcm_r3_proposition']."</label><br>";
   echo "<input type=radio name=$value value=r4 required>";
   echo "<label for=r4>".$json_data['quizz'][$value]['qcm_r4_proposition']."</label><br>";
   echo "</fieldset></p>";
  }
echo "<input type='submit' value='Submit'>";
echo "</form>";
