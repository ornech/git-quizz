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
  if (isset($_POST)) {
      foreach ($_POST as $key => $value) {
          $cookie_name = "";
          $cookie_value = "";
          $reponse_OK = $json_data['quizz'][$key]['qcm_reponse'];
          $question = $json_data['quizz'][$key]['qcm_question'];

          echo "<tr>";
          echo "<td> $question </td>";

          //echo "$key | $value | $reponse_OK <BR>";
          if ($value == $reponse_OK) {
              // Si réponse bonne
              echo "<td> 1 pt</td>";

              // ajout d'un point à la note globale
              $note = $note + 1;
          } else {
              // Si réponse fausse...
              echo "<td> 0 pt</td>";
          }
          echo "</tr>";
      }
      echo "<tr>";
      echo "<td></td><td>$note/10</td>";
      echo "</tr>";
      echo "</table>";
      $date = date_create();
      $id = date_timestamp_get($date);
      $json1 = file_get_contents('json/resultat.json');
      $json1_data = json_decode($json1,true);
      $json1_data["score"][$id]["note"] = $note;
      file_put_contents('json/resultat.json', json_encode($json1_data));
  }
  ?>
<div class="chart-container">
    <canvas id="myChart"></canvas>
</div>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?PHP
                // Affiche la date
                $i = 1;
                foreach ($json1_data["score"] as $key => $value)
                {
                    //var_dump ($json1_data["score"][$key]);
                    //echo $json1_data["score"][$key]["note"];

                    //echo count($json1_data["score"]);
                    $timeStamp = $json1_data["score"][$key]["date"];
                    $date = date( "m M Y h:m", $timeStamp);
                    if ($i == count($json1_data["score"]))
                    {
                        echo "'".$date."'";
                        //$i = 0;
                    }
                    else
                    {

                        $i++;
                        echo "'".$date."',";
                    }

                }

                ?>],
            datasets: [{
                label: 'Note',
                data: [<?PHP
                    $i = 1;
                    foreach ($json1_data["score"] as $key => $value)
                    {
                        //var_dump ($json1_data["score"][$key]);
                        //echo $json1_data["score"][$key]["note"];

                        //echo count($json1_data["score"]);

                        if ($i == count($json1_data["score"]))
                        {
                            echo $json1_data["score"][$key]["note"];
                            //$i = 0;
                        }
                        else
                        {

                            $i++;
                            echo $json1_data["score"][$key]["note"] . ",";
                        }

                    }

                ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max : 20,
                }
            }
        }
    });
</script>




