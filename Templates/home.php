<html>
<header>
    <link rel="stylesheet" type="text/css" href="Styles/homeStyle.css">
    <link rel="stylesheet" href="Styles/sidebar-menu.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
</header>
<body style="position: relative">
<?php require_once 'Templates/sidebar.php' ?>
<div id="content">
    <div class="welcome">
        <h3>WELCOME TO SYSTEM</h3>
    </div>
</div>
<div id="loaderBig"  style="display: none">
    <img id="imgLoaderBig" src="images/loader.gif" width="10%"/>
</div>
<div id="popupAdd" class="popup"
     style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -200px; top: 50px;">
    <h1>Select League</h1>
    <form method="post">
            <?php
            $str = file_get_contents('http://api.football-data.org/v1/soccerseasons');
            $json = json_decode($str, true);
            for ($i = 0; $i < count($json); $i++) { ?>
                <div class="league">
                   <div class="name">
                       <p><?php echo $json[$i]['caption'] ?></p>
                   </div>
                    <div class="function name">
                        <a href="#" idl="<?php echo $json[$i]['id'] ?>" namel="<?php echo $json[$i]['caption'] ?>" class="<?php
                        $check = false;
                        foreach ($league as $lg):
                            if(($json[$i]['id'] == $lg['idL']) && ($lg['public'] == 1)){
                                $check = true;
                                break;
                            }
                            else{
                                $check = false;
                            }
                        endforeach;
                        if($check){
                            echo 'disable';
                        }
                        else{
                            echo 'add';
                        }
                        ?>">Add</a>
                        <a href="#" idl="<?php echo $json[$i]['id'] ?>" class="<?php
                        $check = false;
                        foreach ($league as $lg):
                            if(($json[$i]['id'] == $lg['idL']) && ($lg['public'] == 1)){
                                $check = true;
                                break;
                            }
                            else{
                                $check = false;
                            }
                        endforeach;
                        if($check){
                            echo 'delete';
                        }
                        else{
                            echo 'disable';
                        }
                        ?>">Delete</a>
                    </div>
                </div>
            <?php } ?>
        <input class="submit" type="button" value="Done">
    </form>
    <div id="loader" style="display: none">
        <img id="imgLoader" src="images/loader.gif" width="8%"/>
    </div>
    <div id="notify" style="display: none">
        <p id="txtNotify"></p>
    </div>
</div>
<div id="popupAddUser" class="popup"
     style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -200px; top: 10px;">
    <h1>Add User</h1><br>
    <form method="post" style="margin: 0;">
        <p class="showError" style="display: none; color: red"></p>
        <input type="text" id="name" placeholder="Full name(*)">
        <p class="showError" style="display: none; color: red"></p>
        <input type="text" id="username" placeholder="Username(*)">
        <p class="showError" style="display: none; color: red"></p>
        <input type="password" id="password" placeholder="Password(*)">
        <p class="showError" style="display: none; color: red"></p>
        <input type="password" id="re-password" placeholder="Re-Password(*)">
        <p class="showError" style="display: none; color: red"></p>
        <input type="text" id="email" placeholder="Email(*)">
        <p class="showError" style="display: none; color: red"></p>
        <input type="text" id="phone" placeholder="Phone(*)">
        <p class="showError" style="display: none; color: red"></p>
        <div id="role">
            <input type="radio" name="role" id="role-admin" value="Admin">
            <label for="role-admin">Admin</label>
            <input type="radio" name="role" id="role-user" value="User">
            <label for="role-user">User</label>
        </div>
        <input type="button" class="submit" value="Add">
    </form>
    <div id="pswd_info">
        <h4>Password must meet the following requirements:</h4>
        <ul>
            <li id="letter" class="invalid">At least <strong>one letter</strong></li>
            <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
            <li id="number" class="invalid">At least <strong>one number</strong></li>
            <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
        </ul>
    </div>
</div>

<div id="popupDetail" class="popup"
     style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -200px; top: 150px;">
    <h1>Detail User</h1><br>
    <table id="detailUser">
        <tr>
            <td>Full name: </td>
            <td></td>
        </tr>
        <tr>
            <td>Username: </td>
            <td></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td></td>
        </tr>
        <tr>
            <td>Phone: </td>
            <td></td>
        </tr>
        <tr>
            <td>Role: </td>
            <td></td>
        </tr>
    </table>
    <input type="button" class="submit" value="Close">
</div>

<div id="popupEdit" class="popup"
     style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -200px; top: 50px;">
    <h1>Edit User</h1>
    <form method="post">
        <input type="text" id="idE" placeholder="id" hidden>
        <input type="text" id="nameE" placeholder="Full name">
        <input type="text" id="emailE" placeholder="Email">
        <input type="text" id="phoneE" placeholder="Phone">
        <div id="role">
            <input type="radio" name="roleE" id="role-admin" value="Admin">
            <label for="role-admin">Admin</label>
            <input type="radio" name="roleE" id="role-user" value="User">
            <label for="role-user">User</label>
        </div>
        <input type="button" class="submit" value="Done Edit">
    </form>
</div>

<div id="popupDelete" class="popup"
     style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -200px; top: 70px;">
    <h1>Delete User</h1>
    <table id="deleteUser">
        <input type="text" id="idD" hidden>
        <tr>
            <td>Full name: </td>
            <td></td>
        </tr>
        <tr>
            <td>Username: </td>
            <td></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td></td>
        </tr>
        <tr>
            <td>Phone: </td>
            <td></td>
        </tr>
        <tr>
            <td>Role: </td>
            <td></td>
        </tr>
    </table>
    <div class="button-delete">
        <form>
            <input type="button" name="confirm" class="submit" value="Yes">
            <input type="button" name="confirm" class="submit" value="No">
        </form>
    </div>
    </form>
</div>

<div id="background"
     style="opacity: 0.6; display: none; position: fixed; z-index: 100; top: 0px; left: 0px; height: 100%; width: 100%; background: #000;"></div>

<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script src="Js/sidebar-menu.js"></script>
<script src="Js/loadData.js"></script>
<script src="Js/validate.js"></script>

<script>
    $.sidebarMenu($('.sidebar-menu'))
</script>
</body>
</html>