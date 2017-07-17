<?php
    echo '<table>';
        echo '<tr>';
            echo '<th>Logo</th>';
            echo '<th>Name</th>';
            echo '<th>Short Name</th>';
        echo '</tr>';
        foreach ($teams as $t):
            echo '<tr>';
                if($t["logo"] == ''){
                    echo '<td><img src="images/default.png" width="50" height="50"></td>';
                }else{
                    echo '<td><img src="'. $t["logo"] .'" width="50" height="50" onerror="errorImg(this)"></td>';
                }
                echo '<td>'. $t["name"]. '</td>';
                echo '<td>'. $t["sname"]. '</td>';
            echo '</tr>';
        endforeach;
    echo '</table>';
?>