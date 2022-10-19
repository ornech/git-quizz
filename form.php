<?php
require('header.php');
?>

<?php
// Lis le fichier JSON
$json = file_get_contents('json/quizz4.json');

// Decode le contenue du fichier JSON
$json_data = json_decode($json,true);

// Gestion des requêtes GET et post
// $q est l'id transmis par le GET
// $qcm_id est l'id transmis par le POST
if (isset($_GET["q"])) {
  // si un GET
  $id = $_GET["q"];
}
elseif (isset($_POST["qcm_id"])) {
  // si un POST
  $id = $_POST["qcm_id"];
}
else {
  // Si rien du tout
  $id = 0;
}

// Récuparation de la bonne réponse (r1, r2, r3 ou r4)
$checked = $json_data['quizz'][$id]['qcm_reponse'];
?>



<?php
if (isset($_POST["qcm_id"]))
{
 echo "Données reçues <BR>" ;

 $qcm_id = $_POST["qcm_id"];
 $qcm_question	= $_POST["qcm_question"];
 $qcm_r1_proposition	= $_POST["qcm_r1_proposition"];
 $qcm_r2_proposition	= $_POST["qcm_r2_proposition"];
 $qcm_r3_proposition	= $_POST["qcm_r3_proposition"];
 $qcm_r4_proposition	= $_POST["qcm_r4_proposition"];

 $json_data['quizz'][$qcm_id]['qcm_question'] = $qcm_question ;
 $json_data['quizz'][$qcm_id]['qcm_r1_proposition'] = $qcm_r1_proposition ;
 $json_data['quizz'][$qcm_id]['qcm_r2_proposition'] = $qcm_r2_proposition ;
 $json_data['quizz'][$qcm_id]['qcm_r3_proposition'] = $qcm_r3_proposition ;
 $json_data['quizz'][$qcm_id]['qcm_r4_proposition'] = $qcm_r4_proposition ;

 //file_put_contents('quizz-'.time().'.json', json_encode($json_data));
 file_put_contents('json/quizz4.json', json_encode($json_data));
}
?>



<form action="form.php" method="POST">
<div id="question">
<p>
  <textarea rows="2" cols="60" id="Question" name="qcm_question"><?php echo($json_data['quizz'][$id]['qcm_question'] );?></textarea>
</p>
<p>
  <label for="reponse1">Réponse 1</label><BR>
  <textarea rows="1" cols="60" id="<?php if ($checked == "r1"){echo 'bonne_reponse';}else{echo "mauvaise_reponse";}?>" name="qcm_r1_proposition"><?php echo($json_data['quizz'][$id]['qcm_r1_proposition'] );?></textarea><BR>
  <input type="checkbox" name="qcm_reponse" value="r1" <?php if ($checked == "r1"){echo 'checked ';}else{ echo 'disable';}?>> Bonne réponse<BR>
  </p>
  <p>
  <label for="reponse2">Réponse 2</label><BR>
  <textarea rows="1" cols="60" id="<?php if ($checked == "r2"){echo 'bonne_reponse';}else{echo "mauvaise_reponse";}?>" name="qcm_r2_proposition"><?php echo($json_data['quizz'][$id]['qcm_r2_proposition'] );?></textarea><BR>
  <input type="checkbox" name="qcm_reponse" value="r2" <?php if ($checked == "r2"){echo "checked ";}?>> Bonne réponse<BR>
  </p>
  <p>
  <label for="reponse3">Réponse 3</label><BR>
  <textarea rows="1" cols="60" id="<?php if ($checked == "r3"){echo 'bonne_reponse';}else{echo "mauvaise_reponse";}?>" name="qcm_r3_proposition"><?php echo($json_data['quizz'][$id]['qcm_r3_proposition'] );?></textarea><BR>
  <input type="checkbox" name="qcm_reponse" value="r3" <?php if ($checked == "r3"){echo 'checked ';}?>> Bonne réponse<BR>
  </p>
  <p>
  <label for="reponse4">Réponse 4</label><BR>
  <textarea rows="1" cols="60" id="<?php if ($checked == "r4"){echo 'bonne_reponse';}else{echo "mauvaise_reponse";}?>" name="qcm_r4_proposition"><?php echo($json_data['quizz'][$id]['qcm_r4_proposition'] );?></textarea><BR>
  <input type="checkbox" name="qcm_reponse" value="r4" <?php if ($checked == "r4"){echo 'checked ';}?>> Bonne réponse<BR>
  <input type=hidden name="qcm_id" value="<?php echo $id; ?>">
  </p>
<table>
  <TR>
    <TD>
  <input type="submit" value="Mettre à jour la question"></form>

</td>
<TD>
  <div id="choix">
  <FORM action="form.php" methode="GET">
  <label for="q">Choisir une question:</label>
  <select name="q" id="q">
  <?php
  foreach($json_data['quizz'] as $keys => $val){
    $nom = $json_data['quizz'][$keys]["qcm_question"];
    $q = substr($nom , 0, 50);
    if($_GET!="")
    {echo "<option value='$keys' selected>$q</option> ";}
    else{echo "<option value='$keys'>$q</option> ";}

  }
  ?>

  </div>
</TD>
<TD>
</select>
  <input type="submit" value="Changer de question">
</FORM>
</TD>

</tr>
</table>
</div>
</body>
</html>
