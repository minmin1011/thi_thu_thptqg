$(document).ready(function () {
    $("form").on('submit', function (event) {
        event.preventDefault();
    });
});

/**
 * Hàm xử lý login
 * CreatedBy: PQ Huy (10.10.2021)
 */
function submit_login() {
    $('#loading').css('display', 'inline');
    var url = "index.php?action=submit_login";
    var data = {
        username: $("#username").val()
    };
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#field_username').css('display', 'none');
            $('#lbl_pw').removeClass('hidden');
            $('#password').removeClass('hidden');
            $('#hi').css('display', 'inline');
            $('#hi-text').text("" + json_data.name + "");
            $('#btn-login').html("Tiếp Tục").css('width', '100%').attr('onclick', 'submit_password()');
            $('#btn-fotgot').css('display', 'none');
            $('#reload').css('display', 'inline');
        }
        $('#loading').css('display', 'none');
    };
    $.post(url, data, success);
}

/**
 * Hàm xử lý đăng ký
 * CreatedBy: PQ Huy (30.11.2021)
 */
function submit_register() {
    $('#loading').css('display', 'inline');
    var url = "index.php?action=submit_register";
    var data = {
        username: $("#username").val(),
        password: $("#password").val(),
        password2: $("#password2").val(),
        fullname: $("#fullname").val(),
        phonenumber: $("#phonenumber").val(),
        address: $("#address").val()
    };
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#loading').css('display', 'inline');
            setTimeout(function () {
                location.replace('index.php');
            }, 1500);
            $('#loading').css('display', 'none');
        }
    };
    $.post(url, data, success);
}

function reload() {
    $('#reload').css('display', 'none');
    $('#field_username').css('display', 'inline');
    $('#hi').css('display', 'none');
    $('#lbl_pw').addClass('hidden');
    $('#password').addClass('hidden');
    $('#btn-login').html("Tiếp Tục").css('width', '100%').attr('onclick', 'submit_login()');
}
function submit_password() {
    $('#loading').css('display', 'inline');
    var url = "index.php?action=submit_password";
    var data = {
        password: $("#password").val()
    };
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            setTimeout(function () {
                location.reload('index.php');
            }, 1500);
        }
        $('#loading').css('display', 'none');
    };
    $.post(url, data, success);
}

function submit_forgot_password() {
    $('#loading').css('display', 'inline');
    var url = "index.php?action=submit_forgot_password";
    var data = {
        username: $("#username").val()
    };
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        $('#loading').css('display', 'none');
    };
    $.post(url, data, success);
}

function show_status(json_data) {
    if (json_data.status) {
        $('#status').addClass('success');
        $('#status').removeClass('failed');
    } else {
        $('#status').addClass('failed');
        $('#status').removeClass('success');
    }
    $('#status').html(json_data.status_value);
    $('#status').animate({
        'height': '65',
        'line-height': '65px',
        'opacity': '1'
    }, 500);
    $('#status').delay(1000).animate({
        'opacity': '0',
        'height': '0',
        'line-height': '0px'
    }, 500);
}