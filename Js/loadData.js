var ajax_sendding = false;
//LEAGUE (get Team)
$('#league').on('click', '.team', function () {
    var id = $(this).attr('idparent');
    $.ajax({
        url : 'index.php?action=getTeams&id=' + id,
        type : 'get',
        dataType : 'text',
        success : function (result){
            $('#content').html(result);
        }
    });
});
//LEAGUE (get fixtures)
$('#league').on('click', '.fixtures', function () {
    if (ajax_sendding == true){
        alert('System processing, please wait ...');
        return false;
    }
    ajax_sendding = true;
    $('#loaderBig').show();
    $('#content').hide();
    var id = $(this).attr('idparent');
    $.ajax({
        url : 'index.php?action=getFixtures&id=' + id,
        type : 'get',
        dataType : 'text',
        success : function (result){
            $('#content').html(result);
        }
    }).always(function () {
        ajax_sendding = false;
        $('#loaderBig').hide();
        $('#content').show();
    });
});
//pop-up process
$('#addLeague').click(function () {
    $('#popupAdd').show();
    $('#background').show();
    $('#notify').hide();
});

$('#background').click(function () {
    $('#popupAdd').hide();
    $('#background').hide();
    $('#popupAddUser').hide();
    $('#popupDetail').hide();
    $('#popupEdit').hide();
    $('[checkedit = "check"]').removeAttr('checkedit');
    $('[value="Admin"]').prop('checked', false);
    $('[value="User"]').prop('checked', false);
    $('#popupDelete').hide();
    $('[checkdelete = "check"]').removeAttr('checkdelete');
    $('#length').removeClass('valid').addClass('invalid');
    $('#letter').removeClass('valid').addClass('invalid');
    $('#capital').removeClass('valid').addClass('invalid');
    $('#number').removeClass('valid').addClass('invalid');
    $('.showError').hide();
});

$(':button').click(function () {
    $('#popupAdd').hide();
    $('#background').hide();
    $('#popupDetail').hide();
    $('#popupDelete').hide();
});
//process add league
$('.function').on('click', '.add', function () {
    if (ajax_sendding == true){
        alert('System processing, please wait ...');
        return false;
    }
    ajax_sendding = true;
    $('#loader').show();
    $('#notify').hide();
    var id = $(this).attr('idl');
    var name = $(this).attr('namel');
    $.ajax({
        url : 'index.php?action=addData&id=' + id,
        type : 'get',
        dataType : 'text',
        success : function (result){
            $('#txtNotify').html(result);
            var html = '';
            if(result == 'success'){
                html += '<li>';
                html += '<a href="#"><i class="fa fa-circle-o"></i>' + name + '</a>';
                html += '<ul class="sidebar-submenu">';
                html += '<li idparent="' + id + '" class="fixtures"><a href="#"><i class="fa fa-calendar"></i> Lịch thi đấu</a></li>';
                html += '<li><a href="#"><i class="fa fa-table"></i> Bảng xếp hạng</a></li>';
                html += '<li idparent="' + id + '" class="team"><a href="#"><i class="fa fa-laptop"></i> Teams</a></li>';
                html += '</ul>';
                html += '</li>';
                $('#league').append(html);
            }
        }
    }).always(function () {
        ajax_sendding = false;
        $('#loader').hide();
        $('#notify').show();
    });
    $(this).next().removeClass('disable').addClass('delete');
    $(this).removeClass('add');
    $(this).addClass('disable');
});
//process delete league
$('.function').on('click', '.delete', function () {
    if (ajax_sendding == true){
        alert('System processing, please wait ...');
        return false;
    }
    ajax_sendding = true;
    $('#loader').show();
    $('#notify').hide();
    var id = $(this).attr('idl');
    $.ajax({
        url : 'index.php?action=deleteData&id=' + id,
        type : 'get',
        dataType : 'text',
        success : function (result) {
            $('#txtNotify').html(result);
            if(result == 'success') {
                $('[idparent ='+ id + ']').parent().parent().remove();
            }
        }
    }).always(function () {
        ajax_sendding = false;
        $('#loader').hide();
        $('#notify').show();
    });
    $(this).prev().removeClass('disable').addClass('add');
    $(this).removeClass('delete');
    $(this).addClass('disable');
});

function errorImg(img) {
    img.src = 'images/default.png';
}
//process users
$('#users').click(function () {
   $.ajax({
       url : 'index.php?action=getUser',
       type : 'get',
       dataType : 'text',
       success : function (result) {
           $('#content').html(result);
       }
   });
});

$('#content').on('click', '#addUser', function () {
    $('#popupAddUser').show();
    $('#background').show();
    $('#name').replaceWith('<input type="text" id="name" placeholder="Full name(*)">');
    $('#username').replaceWith('<input type="text" id="username" placeholder="Username(*)">');
    $('#password').replaceWith('<input type="password" id="password" placeholder="Password(*)">');
    $('#re-password').replaceWith('<input type="password" id="re-password" placeholder="Re-Password(*)">');
    $('#email').replaceWith('<input type="text" id="email" placeholder="Email(*)">');
    $('#phone').replaceWith('<input type="text" id="phone" placeholder="Phone(*)">');
});

$('#content').on('click', '.detailUser', function () {
    $('#popupDetail').show();
    $('#background').show();
    $($(this).parent().parent()).attr('checkdetail', 'check');
    $('#detailUser tr:nth-child(1) td:nth-child(2)').html($('[checkdetail="check"] td:nth-child(1)').html());
    $('#detailUser tr:nth-child(2) td:nth-child(2)').html($('[checkdetail="check"] td:nth-child(2)').html());
    $('#detailUser tr:nth-child(3) td:nth-child(2)').html($('[checkdetail="check"] td:nth-child(3)').html());
    $('#detailUser tr:nth-child(4) td:nth-child(2)').html($('[checkdetail="check"] td:nth-child(4)').html());
    $('#detailUser tr:nth-child(5) td:nth-child(2)').html($('[checkdetail="check"] td:nth-child(5)').html());
    $('[checkdetail = "check"]').removeAttr('checkdetail');
});

$('#content').on('click', '.editUser', function () {
    $('#popupEdit').show();
    $('#background').show();
    $($(this).parent().parent()).attr('checkedit', 'check');
    $('#idE').attr('value', $(this).attr('idUser'));
    $('#nameE').replaceWith('<input type="text" id="nameE" placeholder="Full name" value="'+ $('[checkedit="check"] td:nth-child(1)').html() +'">');
    $('#emailE').replaceWith('<input type="text" id="emailE" placeholder="Email" value="'+ $('[checkedit="check"] td:nth-child(3)').html() +'">');
    $('#phoneE').replaceWith('<input type="text" id="phoneE" placeholder="Phone" value="'+ $('[checkedit="check"] td:nth-child(4)').html() +'">');
    if($('[checkedit="check"] td:nth-child(5)').html() == "Admin"){
        $('[value="Admin"]').prop('checked', true);
        //alert('admin');
    }
    else {
        $('[value="User"]').prop('checked', true);
        //alert('user');
    }
});

$('#popupEdit').on('click', '.submit[value="Done Edit"]', function () {
    $.ajax({
        url : 'index.php?action=editUser',
        type : 'post',
        data: {id: $('#idE').attr('value'),
            name: $('#nameE').val(),
            email: $('#emailE').val(),
            phone: $('#phoneE').val(),
            role: $('input[name="roleE"]:checked').val()
        },
        dataType : 'text',
        success : function (result) {
            if(result == 'success'){
                $('[checkedit="check"] td:nth-child(1)').html($('#nameE').val());
                $('[checkedit="check"] td:nth-child(3)').html($('#emailE').val());
                $('[checkedit="check"] td:nth-child(4)').html($('#phoneE').val());
                $('[checkedit="check"] td:nth-child(5)').html($('input[name="roleE"]:checked').val());
                $('#nameE').replaceWith('<input type="text" id="nameE" placeholder="Full name" value="'+ $('[checkedit="check"] td:nth-child(1)').html() +'">');
                $('#emailE').replaceWith('<input type="text" id="emailE" placeholder="Email" value="'+ $('[checkedit="check"] td:nth-child(3)').html() +'">');
                $('#phoneE').replaceWith('<input type="text" id="phoneE" placeholder="Phone" value="'+ $('[checkedit="check"] td:nth-child(4)').html() +'">');
                $('[checkedit = "check"]').removeAttr('checkedit');
                $('[value="Admin"]').prop('checked', false);
                $('[value="User"]').prop('checked', false);
            }
        }
    });
    $('#popupEdit').hide();
    $('#background').hide();
});

$('#content').on('click', '.deleteUser', function () {
    $('#popupDelete').show();
    $('#background').show();
    $($(this).parent().parent()).attr('checkdelete', 'check');
    $('#idD').attr('value', $(this).attr('idUser'))
    $('#deleteUser tr:nth-child(1) td:nth-child(2)').html($('[checkdelete="check"] td:nth-child(1)').html());
    $('#deleteUser tr:nth-child(2) td:nth-child(2)').html($('[checkdelete="check"] td:nth-child(2)').html());
    $('#deleteUser tr:nth-child(3) td:nth-child(2)').html($('[checkdelete="check"] td:nth-child(3)').html());
    $('#deleteUser tr:nth-child(4) td:nth-child(2)').html($('[checkdelete="check"] td:nth-child(4)').html());
    $('#deleteUser tr:nth-child(5) td:nth-child(2)').html($('[checkdelete="check"] td:nth-child(5)').html());
});

$('.button-delete').on('click', '.submit[value="Yes"]', function () {
    var id = $('#idD').attr('value');
    $.ajax({
        url : 'index.php?action=deleteUser&id=' + id,
        type : 'get',
        dataType : 'text',
        success : function (result) {
            if(result == 'success'){
                $('[checkdelete="check"]').remove();
                $('[checkdelete = "check"]').removeAttr('checkdelete');
            }
        }
    });
});

$('.button-delete').on('click', '.submit[value="No"]', function () {
    $('[checkdelete = "check"]').removeAttr('checkdelete');
});
//process news
$('#news').click(function () {
    $.ajax({
        url : 'index.php?action=getNews',
        type : 'get',
        dataType : 'text',
        success : function (result) {
            $('#content').html(result);
        }
    });
});

$('#content').on('click', '#addNews', function () {
    var html = '';
    html += '<div id="formPost" style="width: 50%; margin: 0 auto; background-color: #F7F7F7; border-radius: 2px">';
    html += '<h2>Add News</h2>';
    html += '<form method="post">';
    html += '<div>';
    html += '<label for="txtTitle">Title:</label>';
    html += '<textarea id="txtTitle" style="width: 100%"></textarea><br>';
    html += '<label for="txtContent">Content:</label>';
    html += '<textarea id="txtContent"></textarea>';
    html += '</div>';
    html += '<div style="width: 100%; display: inline-block">';
    html += '<p style="float: left">Choose image:</p>';
    html += '<label for="imgNews-upload" class="custom-file-upload">';
    html += '<img id="output" width="200px" height="100px"/>';
    html += '</label>';
    html += '<input type="file" id="imgNews-upload" name="imgNews" onchange="loadFile(event)"/>';
    html += '</div>';
    html += '<input type="button" value="Post" class="submit" style="width: 50%;margin: 15px auto;">';
    html += '</form>';
    html += '</div>';
    html += '<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>';
    html += '<script>tinymce.init({ selector:"textarea#txtContent", height: 200, width: 579 });</script>';
    $('#content').html(html);
});

$('#content').on('click', '.submit[value="Post"]', function () {
    var file_data = $('#imgNews-upload').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    $.ajax({
        url : 'index.php?action=addNews',
        type : 'post',
        data: {title: $('#txtTitle').val(),
            content: $('#txtContent').val(),
            form_data
        },
        dataType : 'text',
        success : function (result) {
            $('#content').html(result);
        }
    });
});

function loadFile(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('output');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}