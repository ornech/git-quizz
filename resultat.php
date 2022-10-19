<?php
require('header.php');
require('menu.php');
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
