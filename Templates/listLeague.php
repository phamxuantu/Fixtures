<?php
echo '<h1>Select League</h1>';
    echo '<form method="post">';
            foreach ($result as $rs) {
                echo '<div class="league">';
                echo '<div class="name">';
                echo '<p>' . $rs->caption . '</p>';
                echo '</div>';
                echo '<div class="function name">';
                $sttAdd = '';
                $checkAdd = false;
                foreach ($league as $lg):
                    if (($rs->id == $lg['idL']) && ($lg['public'] == 1)) {
                        $checkAdd = true;
                        break;
                    } else {
                        $checkAdd = false;
                    }
                endforeach;
                if ($checkAdd) {
                    $sttAdd = 'disable';
                } else {
                    $sttAdd = 'add';
                }
                echo '<a href="#" idl="' . $rs->id . '" namel="' . $rs->caption . '" class="' . $sttAdd . '">Add</a>';
                $sttDelete = '';
                $checkDelete = false;
                foreach ($league as $lg):
                    if (($rs->id == $lg['idL']) && ($lg['public'] == 1)) {
                        $checkDelete = true;
                        break;
                    } else {
                        $checkDelete = false;
                    }
                endforeach;
                if ($checkDelete) {
                    $sttDelete = 'delete';
                } else {
                    $sttDelete = 'disable';
                }
                echo '<a href="#" idl="' . $rs->id . '" class="' . $sttDelete . '">Delete</a>';
                echo '</div>';
                echo '</div>';
            }
echo '<input class="submit" type="button" value="Done">';
echo '</form>';
echo '<div id="loader" style="display: none">';
    echo '<img id="imgLoader" src="images/loader.gif" width="8%"/>';
echo '</div>';
echo '<div id="notify" style="display: none">';
    echo '<p id="txtNotify"></p>';
echo '</div>';
?>