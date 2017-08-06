<html>
<header>
    <link rel="stylesheet" type="text/css" href="Styles/homeStyle.css">
    <link rel="stylesheet" href="Styles/sidebar-menu.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <title>Fixtures</title>
</header>
<body style="position: relative">
<?php require_once 'Templates/sidebar.php' ?>
<div id="content">
    <?php if($news == ''){?>
        <div class="welcome">
            <h3>WELCOME TO SYSTEM</h3>
        </div>
    <?php }else{
        echo '<h2>List News</h2>';
        echo '<h4><a href="?action=formAddNews" id="addNews">Add news</a></h4>';
        echo '<table id="listNews">';
        echo '<tr>';
        echo '<th style="text-align: start">Thumbnail</th>';
        echo '<th style="text-align: start">Title</th>';
        echo '<th style="text-align: start">Content</th>';
        echo '<th style="text-align: start">Function</th>';
        echo '</tr>';
        foreach ($news as $n):
            echo '<tr>';
            $title = limit_text($n["title"], 10);
            $content = limit_text(strip_tags($n["content"]), 15);
            echo '<td style="text-align: start"><img src="'. $n['imgPost'] .'?'. uniqid() .'" width="30" height="30" onerror="errorImg(this)"/></td>';
            echo '<td style="text-align: start">'. $title . '</td>';
            echo '<td style="text-align: start">'. $content . '</td>';
            echo '<td style="text-align: start">
            <a href="#" class="detailNews" idNews="'. $n['id'] .'">Detail</a> |
            <a href="?action=editNews&id='. $n['id'] .'" class="editNews" idNews="'. $n['id'] .'">Edit</a> |
            <a href="#" class="deleteNews" idNews="'. $n['id'] .'">Delete</a>
        </td>';
            echo '</tr>';
        endforeach;
        echo '</table>';
        echo '<div id="pagingNews">';
        echo $page;
        echo '</div>';
    }?>
    <?php
    function limit_text($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }
    ?>
</div>
<div id="loaderBig"  style="display: none">
    <img id="imgLoaderBig" src="images/loader.gif" width="10%"/>
</div>
<div id="popupAdd" class="popup"
     style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -200px; top: 50px;">
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
            <td>Avatar: </td>
            <td></td>
        </tr>
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
        <tr>
            <td>Status: </td>
            <td></td>
        </tr>
    </table>
    <input type="button" class="submit" value="Close">
</div>

<div id="popupEdit" class="popup"
     style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -200px; top: 50px;">
    <h1>Edit User</h1>
    <form method="post" id="theForm" enctype="multipart/form-data">
        <input type="text" id="idE" name="idE" placeholder="id" hidden>
        <label style="float: left;" for="nameE">Full name</label>
        <input type="text" id="nameE" name="nameE" placeholder="Full name">
        <label style="float: left;" for="emailE">Email</label>
        <input type="text" id="emailE" name="emailE" placeholder="Email">
        <label style="float: left;" for="phoneE">Phone Number</label>
        <input type="text" id="phoneE" name="phoneE" placeholder="Phone">
        <input type="submit" id="changePass" class="submit" value="Change password">
        <div id="role">
            <input type="radio" name="roleE" id="role-admin" value="Admin">
            <label for="role-admin">Admin</label>
            <input type="radio" name="roleE" id="role-user" value="User">
            <label for="role-user">User</label>
        </div>
        <div id="checkBlock">
            <label for="block">Block</label>
            <input type="checkbox" name="block" id="block">
        </div>
        <div style="width: 100%; display: inline-block">
            <p style="float: left">Choose avatar:</p>
            <label for="avatar" class="custom-file-upload">
                <img id="output" width="50px" height="50px"/>
            </label>
            <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png"
                   onchange="loadFile(event)"/>
        </div>
        <input type="submit" class="submit" value="Done Edit">
    </form>
</div>

<div id="popupDelete" class="popup"
     style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -200px; top: 70px;">
    <h1>Delete User</h1>
    <table id="deleteUser">
        <input type="text" id="idD" hidden>
        <tr>
            <td>Avatar: </td>
            <td></td>
        </tr>
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
        <tr>
            <td>Status: </td>
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

<div id="popupDeleteNews" class="popup"
     style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -200px; top: 70px;">
    <h1>Delete News</h1>
    <input type="text" id="idN" hidden>
    <h2>Do you want to delete this news?</h2>
    <h4 id="titleNews"></h4>
    <div class="button-delete-news">
        <form>
            <input type="button" name="confirm-news" class="submit" value="Yes">
            <input type="button" name="confirm-news" class="submit" value="No">
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