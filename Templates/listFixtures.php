<?php
$str = file_get_contents($fixtures[0]['fixtures']);
$json = json_decode($str, true);
echo '<table>';
echo '<tr>';
echo '<th>Home team</th>';
echo '<th>Score</th>';
echo '<th>Away team</th>';
echo '<th>Date</th>';
echo '<th>Status</th>';
echo '</tr>';
for($i = 0; $i < $json['count']; $i++){
    echo '<tr>';
    echo '<td>';
        echo $json['fixtures'][$i]['homeTeamName'];
        $idH = split('/', $json['fixtures'][$i]['_links']['homeTeam']['href'])[count(split('/', $json['fixtures'][$i]['_links']['homeTeam']['href'])) - 1];
        foreach ($teams as $t):
            if($t['idT'] == $idH){
                echo '<img class="imgHome" src="'. $t['logo'] .'" width="50" height="50" onerror="errorImg(this)">';
                break;
            }
        endforeach;
    echo '</td>';
    echo '<td class="score">'. $json['fixtures'][$i]['result']['goalsHomeTeam'] .' - '. $json['fixtures'][$i]['result']['goalsAwayTeam'] .'</td>';
    echo '<td>';
    $idA = split('/', $json['fixtures'][$i]['_links']['awayTeam']['href'])[count(split('/', $json['fixtures'][$i]['_links']['awayTeam']['href'])) - 1];
        foreach ($teams as $t):
            if($t['idT'] == $idA){
                echo '<img class="imgAway" src="'. $t['logo'] .'" width="50" height="50" onerror="errorImg(this)">';
                break;
            }
        endforeach;
        echo $json['fixtures'][$i]['awayTeamName'];
    echo '</td>';
    echo '<td style="text-align: center">'. date('d-m-Y', strtotime($json['fixtures'][$i]['date'])) .'</td>';
    echo '<td style="text-align: center">'. $json['fixtures'][$i]['status'] .'</td>';
    echo '</tr>';
}
echo '</table>';
?>