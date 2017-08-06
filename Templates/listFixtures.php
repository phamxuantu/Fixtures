<?php
echo '<h2>Fixtures</h2>';
echo '<select id="selectMatchDay">';
$options = array();
for($j = 1; $j <= $numberOfMatchdays; $j++){
    $options[] = $j;
}
$output = '';
for( $i=0; $i<count($options); $i++ ) {
    $output .= '<option '
        . ( $mathchDay == $options[$i] ? 'selected="selected"' : '' ) . '>'
        . $options[$i]
        . ' matchday</option>';
}
echo $output;
echo '</select>';
echo '<table>';
echo '<tr>';
echo '<th>Home team</th>';
echo '<th>Score</th>';
echo '<th>Away team</th>';
echo '<th>Date</th>';
echo '<th>Status</th>';
echo '</tr>';
foreach ($fixtures as $fx){
    echo '<tr>';
    echo '<td>';
        echo $fx -> homeTeamName;
        $idH = split('/', $fx -> _links -> homeTeam -> href)[count(split('/', $fx -> _links -> homeTeam -> href)) - 1];
        foreach ($teams as $t) {
            $idT = split('/', $t -> _links -> self -> href)[count(split('/', $t -> _links -> self -> href)) - 1];
            if ($idT == $idH) {
                echo '<img class="imgHome" src="' . $t -> crestUrl . '" width="40" height="40" onerror="errorImg(this)">';
                break;
            }
        }
    echo '</td>';
    echo '<td class="score">'. $fx -> result -> goalsHomeTeam .' - '. $fx -> result -> goalsAwayTeam.'</td>';
    echo '<td>';
    $idA = split('/', $fx -> _links -> awayTeam -> href)[count(split('/', $fx -> _links -> awayTeam -> href)) - 1];
        foreach ($teams as $t) {
            $idT = split('/', $t -> _links -> self -> href)[count(split('/', $t -> _links -> self -> href)) - 1];
            if ($idT == $idA) {
                echo '<img class="imgAway" src="' . $t -> crestUrl . '" width="40" height="40" onerror="errorImg(this)">';
                break;
            }
        }
        echo $fx -> awayTeamName;
    echo '</td>';
    echo '<td style="text-align: center">'. date('d-m-Y', strtotime($fx -> date)) .'</td>';
    echo '<td style="text-align: center">'. $fx -> status .'</td>';
    echo '</tr>';
}
echo '</table>';
echo '<input type="text" id="idLeague" value="'. $id .'" hidden/>';
?>