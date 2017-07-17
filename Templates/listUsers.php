<?php
echo '<h2>List Users</h2>';
echo '<h4><a href="#" id="addUser">Add user</a></h4>';
echo '<table id="listUser">';
echo '<tr>';
echo '<th>Full name</th>';
echo '<th>Username</th>';
echo '<th>Email</th>';
echo '<th>Phone</th>';
echo '<th>Role</th>';
echo '<th>Function</th>';
echo '</tr>';
foreach ($users as $u):
    echo '<tr>';
    echo '<td>'. $u["fullname"]. '</td>';
    echo '<td>'. $u["username"]. '</td>';
    echo '<td>'. $u["email"]. '</td>';
    echo '<td>'. $u["phone"]. '</td>';
    echo '<td>'. $u["nameR"]. '</td>';
    echo '<td>
            <a href="#" class="detailUser" idUser="'. $u['id'] .'">Detail</a> |
            <a href="#" class="editUser" idUser="'. $u['id'] .'">Edit</a> |
            <a href="#" class="deleteUser" idUser="'. $u['id'] .'">Delete</a>
        </td>';
    echo '</tr>';
endforeach;
echo '</table>';
?>