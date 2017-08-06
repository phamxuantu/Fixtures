<?php
echo '<h2>League Table</h2>';
echo '<table>';
echo '<tr>';
echo '<th>Position</th>';
echo '<th>Team</th>';
echo '<th>Played Games</th>';
echo '<th>Wins</th>';
echo '<th>Draws</th>';
echo '<th>Losses</th>';
echo '<th>Goals</th>';
echo '<th>Goals Against</th>';
echo '<th>Goal Difference</th>';
echo '<th>Points</th>';
echo '</tr>';
foreach ($table as $t):
    echo '<tr>';
    echo '<td>'. $t -> position .'</td>';
    echo '<td style="text-align: start"><img src="'. $t -> crestURI .'" width="30" height="30" style="margin-right: 15px" onerror="errorImg(this)"/>' . $t -> teamName . '</td>';
    echo '<td>' . $t -> playedGames . '</td>';
    echo '<td>' . $t -> wins . '</td>';
    echo '<td>' . $t -> draws . '</td>';
    echo '<td>' . $t -> losses . '</td>';
    echo '<td>' . $t -> goals . '</td>';
    echo '<td>' . $t -> goalsAgainst . '</td>';
    echo '<td>' . $t -> goalDifference . '</td>';
    echo '<td>' . $t -> points . '</td>';
    echo '</tr>';
endforeach;
echo '</table>';
?>