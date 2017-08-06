var ajax_sendding = false;
//LEAGUE (get Team)
$('#league').on('click', '.team', function () {
    if (ajax_sendding == true){
        alert('System processing, please wait ...');
        return false;
    }
    ajax_sendding = true;
    $('#loaderBig').show();
    $('#content').hide();
    var id = $(this).attr('idparent');
    $.ajax({
        url : 'index.php?action=getTeams&id=' + id,
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

$('#content').on('change', '#selectMatchDay', function () {
    var txtmatchDay = $(':selected').parent().val();
    var matchDay = txtmatchDay.split(" ")[0];
    if (ajax_sendding == true){
        alert('System processing, please wait ...');
        return false;
    }
    ajax_sendding = true;
    $('#loaderBig').show();
    $('#content').hide();
    var id = $('#idLeague').attr('value');
    $.ajax({
        url : 'index.php?action=getFixtures&id=' + id + '&matchDay=' + matchDay,
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

$('#league').on('click', '.table', function () {
    if (ajax_sendding == true){
        alert('System processing, please wait ...');
        return false;
    }
    ajax_sendding = true;
    $('#loaderBig').show();
    $('#content').hide();
    var id = $(this).attr('idparent');
    $.ajax({
        url : 'index.php?action=getTable&id=' + id,
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
    if (ajax_sendding == true){
        alert('System processing, please wait ...');
        return false;
    }
    ajax_sendding = true;
    $('#content').hide();
    $('#loaderBig').show();
    $.ajax({
        url: 'index.php?action=getSoccerseason',
        type: 'get',
        dataType: 'text',
        success: function (result) {
            $('#popupAdd').html(result);
            $('#popupAdd').show();
            $('#background').show();
            $('#notify').hide();
        }
    }).always(function () {
        ajax_sendding = false;
        $('#loaderBig').hide();
        $('#content').show();
    });
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
    $('#popupDeleteNews').hide();
});

$(':button').click(function () {
    // $('#popupAdd').hide();
    $('#background').hide();
    $('#popupDetail').hide();
    $('#popupDelete').hide();
    $('#popupDeleteNews').hide();
    $('#popupEdit').hide();
});

$('#popupAdd').on('click', '.submit[value="Done"]', function () {
    $('#popupAdd').hide();
    $('#background').hide();
});
//process add league
$('#popupAdd').on('click', '.add', function () {
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
$('#popupAdd').on('click', '.delete', function () {
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

$('#content').on('click', '#pagingUsers a', function () {
    var url = $(this).attr('href');
    $.ajax({
        url : url,
        type : 'get',
        dataType : 'text',
        success : function (result){
            $('#content').html(result);
        }
    });
    return false;
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
    $('#detailUser tr:nth-child(1) td:nth-child(2)').html($('[checkdetail="check"] td:nth-child(1)').html());//get avt
    $('#detailUser tr:nth-child(2) td:nth-child(2)').html($('[checkdetail="check"] td:nth-child(2)').html());//get full name
    $('#detailUser tr:nth-child(3) td:nth-child(2)').html($('[checkdetail="check"] td:nth-child(3)').html());//get username
    $('#detailUser tr:nth-child(4) td:nth-child(2)').html($('[checkdetail="check"] td:nth-child(4)').html());//get email
    $('#detailUser tr:nth-child(5) td:nth-child(2)').html($('[checkdetail="check"] td:nth-child(5)').html());//get phone
    $('#detailUser tr:nth-child(6) td:nth-child(2)').html($('[checkdetail="check"] td:nth-child(6)').html());//get role
    $('#detailUser tr:nth-child(7) td:nth-child(2)').html($('[checkdetail="check"] td:nth-child(7)').html());//get status
    $('[checkdetail = "check"]').removeAttr('checkdetail');
});

$('#content').on('click', '.editUser', function () {
    $('#popupEdit').show();
    $('#background').show();
    $($(this).parent().parent()).attr('checkedit', 'check');
    $('#idE').attr('value', $(this).attr('idUser'));
    $('#nameE').replaceWith('<input type="text" id="nameE" name="nameE" placeholder="Full name" value="'+ $('[checkedit="check"] td:nth-child(2)').html() +'">');
    $('#emailE').replaceWith('<input type="text" id="emailE" name="emailE" placeholder="Email" value="'+ $('[checkedit="check"] td:nth-child(4)').html() +'">');
    $('#phoneE').replaceWith('<input type="text" id="phoneE" name="phoneE" placeholder="Phone" value="'+ $('[checkedit="check"] td:nth-child(5)').html() +'">');
    if($(this).attr('checkUser') == 0){
        $('#role').hide();
        $('#checkBlock').hide();
    }else {
        $('#role').show();
        $('#checkBlock').show();
        if($('[checkedit="check"] td:nth-child(6)').html() == "Admin"){
            $('[value="Admin"]').prop('checked', true);
        }
        else {
            $('[value="User"]').prop('checked', true);
        }
        if($('[checkedit="check"] td:nth-child(7)').html() == "-"){
            $('#block').prop('checked', false);
        }else {
            $('#block').prop('checked', true);
        }
    }
    $('#output').attr('src', $('[checkedit="check"] td:nth-child(1) img:nth-child(1)').attr('src'));
});

$('#changePass').click(function () {
   $('#popupEdit').css('opacity', '0.6');
   $('#background').show();

});

$('form#theForm').submit(function () {
    var formData = new FormData(this);
    $.ajax({
        url : 'index.php?action=editUser',
        type : 'post',
        data: formData,
        async: false,
        success : function (result) {
            if(result == 'success'){
                if($('input[name="block"]').is(':checked')){
                    $('[checkedit="check"] td:nth-child(7)').html('blocked');
                }else {
                    $('[checkedit="check"] td:nth-child(7)').html('-');
                }
                $('[checkedit="check"] td:nth-child(1) img:nth-child(1)').attr('src', $('#output').attr('src'));
                $('[checkedit="check"] td:nth-child(2)').html($('#nameE').val());
                $('[checkedit="check"] td:nth-child(4)').html($('#emailE').val());
                $('[checkedit="check"] td:nth-child(5)').html($('#phoneE').val());
                $('[checkedit="check"] td:nth-child(6)').html($('input[name="roleE"]:checked').val());
                $('#nameE').replaceWith('<input type="text" id="nameE" name="nameE" placeholder="Full name" value="'+ $('[checkedit="check"] td:nth-child(2)').html() +'">');
                $('#emailE').replaceWith('<input type="text" id="emailE" name="emailE" placeholder="Email" value="'+ $('[checkedit="check"] td:nth-child(4)').html() +'">');
                $('#phoneE').replaceWith('<input type="text" id="phoneE" name="phoneE" placeholder="Phone" value="'+ $('[checkedit="check"] td:nth-child(5)').html() +'">');
                $('[checkedit = "check"]').removeAttr('checkedit');
                $('[value="Admin"]').prop('checked', false);
                $('[value="User"]').prop('checked', false);
                //$('#block').prop('checked', false);
            }
            else {
                alert('failure');
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
    $('#popupEdit').hide();
    $('#background').hide();
    return false;
});

$('#content').on('click', '.deleteUser', function () {
    $('#popupDelete').show();
    $('#background').show();
    $($(this).parent().parent()).attr('checkdelete', 'check');
    $('#idD').attr('value', $(this).attr('idUser'));
    $('#deleteUser tr:nth-child(1) td:nth-child(2)').html($('[checkdelete="check"] td:nth-child(1)').html());
    $('#deleteUser tr:nth-child(2) td:nth-child(2)').html($('[checkdelete="check"] td:nth-child(2)').html());
    $('#deleteUser tr:nth-child(3) td:nth-child(2)').html($('[checkdelete="check"] td:nth-child(3)').html());
    $('#deleteUser tr:nth-child(4) td:nth-child(2)').html($('[checkdelete="check"] td:nth-child(4)').html());
    $('#deleteUser tr:nth-child(5) td:nth-child(2)').html($('[checkdelete="check"] td:nth-child(5)').html());
    $('#deleteUser tr:nth-child(6) td:nth-child(2)').html($('[checkdelete="check"] td:nth-child(6)').html());
    $('#deleteUser tr:nth-child(7) td:nth-child(2)').html($('[checkdelete="check"] td:nth-child(7)').html());
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

$('#content').on('click', '#pagingNews a', function () {
    var url = $(this).attr('href');
    $.ajax({
        url : url,
        type : 'get',
        dataType : 'text',
        success : function (result){
            $('#content').html(result);
        }
    });
    return false;
});

// $('#content').on('click', '.submit[value="Post"]', function () {
//     var file_data = $('#imgNews-upload').prop('files')[0];
//     var form_data = new FormData();
//     form_data.append('file', file_data);
//     $.ajax({
//         url : 'index.php?action=addNews',
//         type : 'post',
//         data: {title: $('#txtTitle').val(),
//             content: $('#txtContent').val(),
//             form_data
//         },
//         dataType : 'text',
//         success : function (result) {
//             $('#content').html(result);
//         }
//     });
// });

function loadFile(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('output');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

function addUser() {
    $.ajax({
        url : 'index.php?action=addUser',
        type : 'post',
        data: {name: $('#name').val(),
            username: $('#username').val(),
            password: $('#password').val(),
            email: $('#email').val(),
            phone: $('#phone').val()
        },
        dataType : 'text',
        success : function (result) {
            // var html = '';
            // if(result != 0){
            //     html += '<tr>';
            //     html += '<td><img src="images/default.jpg" width="30" height="30"/></td>';
            //     html += '<td>' + $('#name').val() + '</td>';
            //     html += '<td>' + $('#username').val() + '</td>';
            //     html += '<td>' + $('#email').val() + '</td>';
            //     html += '<td>' + $('#phone').val() + '</td>';
            //     html += '<td>' + $('input[name="role"]:checked').val() + '</td>';
            //     html += '<td>-</td>';
            //     html += '<td>';
            //     html += '<a href="#" class="detailUser">Detail</a> |';
            //     html += '<a href="#" class="editUser" idUser="'+ result +'">Edit</a> |';
            //     html += '<a href="#" class="deleteUser" idUser="'+ result +'">Delete</a>';
            //     html += '</td>';
            //     html += '</tr>';
            //     $('#listUser').append(html);
            //     $('[value="Admin"]').prop('checked', false);
            //     $('[value="User"]').prop('checked', false);
            //     $('#popupAddUser').hide();
            //     $('#length').removeClass('valid').addClass('invalid');
            //     $('#letter').removeClass('valid').addClass('invalid');
            //     $('#capital').removeClass('valid').addClass('invalid');
            //     $('#number').removeClass('valid').addClass('invalid');
            // }
            $('#content').html(result);
            $('#length').removeClass('valid').addClass('invalid');
            $('#letter').removeClass('valid').addClass('invalid');
            $('#capital').removeClass('valid').addClass('invalid');
            $('#number').removeClass('valid').addClass('invalid');
            $('#popupAddUser').hide();
        }
    });
}

$('#content').on('click', '.detailNews', function () {
    var id = $(this).attr('idNews');
    $.ajax({
        url : 'index.php?action=detailNews&id=' + id,
        type : 'get',
        dataType : 'text',
        success : function (result) {
            $('#content').html(result);
        }
    });
});

$('#content').on('click', '.deleteNews', function () {
    $('#popupDeleteNews').show();
    $('#background').show();
    $($(this).parent().parent()).attr('checkdelete', 'check');
    $('#titleNews').html($('[checkdelete="check"] td:nth-child(2)').html());
    $('#idN').attr('value', $(this).attr('idNews'));
});

$('.button-delete-news').on('click', '[name="confirm-news"][value="Yes"]', function () {
    var id = $('#idN').attr('value');
    $.ajax({
        url : 'index.php?action=deleteNews&id=' + id,
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

$('.button-delete-news').on('click', '[name="confirm-news"][value="No"]', function () {
    $('[checkdelete = "check"]').removeAttr('checkdelete');
});

$('#content').on('click', '#previousNews', function () {
    var id = parseInt($('#currentNews').attr('value')) + 1;
    $.ajax({
        url : 'index.php?action=detailNews&button=previous&id=' + id ,
        type : 'get',
        dataType : 'text',
        success : function (result) {
            $('#content').html(result);
        }
    });
});

$('#content').on('click', '#nextNews', function () {
    var id = parseInt($('#currentNews').attr('value')) - 1;
    $.ajax({
        url : 'index.php?action=detailNews&button=next&id=' + id,
        type : 'get',
        dataType : 'text',
        success : function (result) {
            $('#content').html(result);
        }
    });
});