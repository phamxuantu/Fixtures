<?php
echo '<h2>List Teams</h2>';
echo '<table>';
echo '<tr>';
echo '<th>Logo</th>';
echo '<th>Name</th>';
echo '<th>Short Name</th>';
echo '</tr>';
foreach ($teams as $t):
    echo '<tr>';
    echo '<td><img src="' . $t -> crestUrl . '" width="40" height="40" onerror="errorImg(this)"></td>';
    echo '<td>' . $t -> name . '</td>';
    echo '<td>' . $t -> shortName . '</td>';
    echo '</tr>';
endforeach;
echo '</table>';
?>