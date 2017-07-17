function validateEmail(sEmail) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}

$('#popupAddUser').on('focusin', '#name', function () {
    $($('.showError')[0]).hide();
    $('#name').css('border-color', '');
});
$('#popupAddUser').on('focusout', '#name', function () {
    if ($('#name').val() == '') {
        $($('.showError')[0]).html('Full name is not allowed to empty');
        $($('.showError')[0]).show();
        $('#name').css('border-color', 'red');
    }
});

$('#popupAddUser').on('focusin', '#username', function () {
    $($('.showError')[1]).hide();
    $('#username').css('border-color', '');
});
$('#popupAddUser').on('focusout', '#username', function () {
    if ($('#username').val() == '') {
        $($('.showError')[1]).html('Username is not allowed to empty');
        $($('.showError')[1]).show();
        $('#username').css('border-color', 'red');
    }
});

$('#popupAddUser').on('focusin', '#password', function () {
    $($('.showError')[2]).hide();
    $('#pswd_info').show();
    $('#password').css('border-color', '');
});
$('#popupAddUser').on('focusout', '#password', function () {
    if ($('#password').val() == '') {
        $($('.showError')[2]).html('Password is not allowed to empty');
        $($('.showError')[2]).show();
        $('#password').css('border-color', 'red');
    }
    $('#pswd_info').hide();
});

$('#popupAddUser').on('keyup', '#password', function () {
    var pswd = $('#password').val();
    if (pswd.length < 8) {
        $('#length').removeClass('valid').addClass('invalid');
    } else {
        $('#length').removeClass('invalid').addClass('valid');
    }
    //validate letter
    if (pswd.match(/[A-z]/)) {
        $('#letter').removeClass('invalid').addClass('valid');
    } else {
        $('#letter').removeClass('valid').addClass('invalid');
    }

    //validate capital letter
    if (pswd.match(/[A-Z]/)) {
        $('#capital').removeClass('invalid').addClass('valid');
    } else {
        $('#capital').removeClass('valid').addClass('invalid');
    }

    //validate number
    if (pswd.match(/\d/)) {
        $('#number').removeClass('invalid').addClass('valid');
    } else {
        $('#number').removeClass('valid').addClass('invalid');
    }
});

$('#popupAddUser').on('focusin', '#re-password', function () {
    $($('.showError')[3]).hide();
    $('#re-password').css('border-color', '');
});
$('#popupAddUser').on('focusout', '#re-password', function () {
    if ($('#re-password').val() == '') {
        $($('.showError')[3]).html('Re-Password is not allowed to empty');
        $($('.showError')[3]).show();
        $('#re-password').css('border-color', 'red');
    } else {
        if ($('#re-password').val() != $('#password').val()) {
            $($('.showError')[3]).html('Please enter the correct password');
            $($('.showError')[3]).show();
            $('#re-password').css('border-color', 'red');
        }
    }
});

$('#popupAddUser').on('focusin', '#email', function () {
    $($('.showError')[4]).hide();
    $('#email').css('border-color', '');
});
$('#popupAddUser').on('focusout', '#email', function () {
    if ($('#email').val() == '') {
        $($('.showError')[4]).html('Email is not allowed to empty');
        $($('.showError')[4]).show();
        $('#email').css('border-color', 'red');
    } else {
        var sEmail = $('#email').val();
        if (!validateEmail(sEmail)) {
            $($('.showError')[4]).html('Invalid Email Address');
            $($('.showError')[4]).show();
        }
    }
});

$('#popupAddUser').on('focusin', '#phone', function () {
    $($('.showError')[5]).hide();
    $('#phone').css('border-color', '');
});
$('#popupAddUser').on('focusout', '#phone', function () {
    if ($('#phone').val() == '') {
        $($('.showError')[5]).html('Phone is not allowed to empty');
        $($('.showError')[5]).show();
        $('#phone').css('border-color', 'red');
    }
});

$('.submit[value="Add"]').click(function () {
    if ($('#name').val() == '') {
        $($('.showError')[0]).html('Full name is not allowed to empty');
        $($('.showError')[0]).show();
        $('#name').css('border-color', 'red');
        $('#background').show();
    }else {
        if ($('#username').val() == '') {
            $($('.showError')[1]).html('Username is not allowed to empty');
            $($('.showError')[1]).show();
            $('#username').css('border-color', 'red');
            $('#background').show();
        }else {
            if ($('#password').val() == '') {
                $($('.showError')[2]).html('Password is not allowed to empty');
                $($('.showError')[2]).show();
                $('#password').css('border-color', 'red');
                $('#background').show();
            }else {
                if ($('.invalid').length > 0)  {
                    $('#pswd_info').show();
                    $('#background').show();
                }else {
                    if ($('#re-password').val() == '') {
                        $($('.showError')[3]).html('Re-Password is not allowed to empty');
                        $($('.showError')[3]).show();
                        $('#re-password').css('border-color', 'red');
                        $('#background').show();
                    }else {
                        if ($('#re-password').val() != $('#password').val()) {
                            $($('.showError')[3]).html('Please enter the correct password');
                            $($('.showError')[3]).show();
                            $('#re-password').css('border-color', 'red');
                            $('#background').show();
                        }else {
                            if ($('#email').val() == '') {
                                $($('.showError')[4]).html('Email is not allowed to empty');
                                $($('.showError')[4]).show();
                                $('#email').css('border-color', 'red');
                                $('#background').show();
                            }else {
                                var sEmail = $('#email').val();
                                if (!validateEmail(sEmail)) {
                                    $($('.showError')[4]).html('Invalid Email Address');
                                    $($('.showError')[4]).show();
                                    $('#background').show();
                                }else {
                                    if ($('#phone').val() == '') {
                                        $($('.showError')[5]).html('Phone is not allowed to empty');
                                        $($('.showError')[5]).show();
                                        $('#phone').css('border-color', 'red');
                                        $('#background').show();
                                    }else {
                                        $.ajax({
                                            url : 'index.php?action=addUser',
                                            type : 'post',
                                            data: {name: $('#name').val(),
                                                username: $('#username').val(),
                                                password: $('#password').val(),
                                                email: $('#email').val(),
                                                phone: $('#phone').val(),
                                                role: $('input[name="role"]:checked').val()
                                            },
                                            dataType : 'text',
                                            success : function (result) {
                                                var html = '';
                                                if(result != 0){
                                                    html += '<tr>';
                                                    html += '<td>' + $('#name').val() + '</td>';
                                                    html += '<td>' + $('#username').val() + '</td>';
                                                    html += '<td>' + $('#email').val() + '</td>';
                                                    html += '<td>' + $('#phone').val() + '</td>';
                                                    html += '<td>' + $('input[name="role"]:checked').val() + '</td>';
                                                    html += '<td>';
                                                    html += '<a href="#" class="detailUser">Detail</a> |';
                                                    html += '<a href="#" class="editUser" idUser="'+ result +'">Edit</a> |';
                                                    html += '<a href="#" class="deleteUser" idUser="'+ result +'">Delete</a>';
                                                    html += '</td>';
                                                    html += '</tr>';
                                                    $('#listUser').append(html);
                                                    $('[value="Admin"]').prop('checked', false);
                                                    $('[value="User"]').prop('checked', false);
                                                    $('#popupAddUser').hide();
                                                }
                                            }
                                        });
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
});