<?php
echo '<h2>List Users</h2>';
echo '<h4><a href="#" id="addUser">Add user</a></h4>';
echo '<table id="listUser">';
echo '<tr>';
echo '<th>Avatar</th>';
echo '<th>Full name</th>';
echo '<th>Username</th>';
echo '<th>Email</th>';
echo '<th>Phone</th>';
echo '<th>Role</th>';
echo '<th>Status</th>';
echo '<th>Function</th>';
echo '</tr>';
foreach ($users as $u):
    echo '<tr>';
    echo '<td><img src="'. $u["avatar"] .'" width="30" height="30"/></td>';
    echo '<td>'. $u["fullname"]. '</td>';
    echo '<td>'. $u["username"]. '</td>';
    echo '<td>'. $u["email"]. '</td>';
    echo '<td>'. $u["phone"]. '</td>';
    echo '<td>'. $u["nameR"]. '</td>';
    if($u["block"] == 0){
        echo '<td>-</td>';
    }else{
        echo '<td>blocked</td>';
    }
    if($username == $u['username']){
        $class = 'disable';
        $checkUser = 0;
    }else{
        $class = '';
        $checkUser = 1;
    }
    echo '<td>
            <a href="#" class="detailUser" idUser="'. $u['id'] .'">Detail</a> |
            <a href="#" class="editUser" checkUser="'. $checkUser .'" idUser="'. $u['id'] .'">Edit</a> |
            <a href="#" class="deleteUser '. $class .'" style="margin:0;" idUser="'. $u['id'] .'">Delete</a>
        </td>';
    echo '</tr>';
endforeach;
echo '</table>';
echo '<div id="pagingUsers">';
echo $page;
echo '</div>';
?>