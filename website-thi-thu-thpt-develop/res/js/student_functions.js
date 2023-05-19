$(document).ready(function () {
    $('.modal').modal();
    $('#trigger-sidebar').on('click', function () {
        $('#sidebar-left').toggleClass('sidebar-show');
        $('#menu-icon').toggleClass('rot');
        $('#logout').toggleClass('sidebar-show');
        $('#box-content').toggleClass('box-content-mini');
        $('#footer').toggleClass('footer-mini');
    });
    $('#btn-logout').on('click', function () {
        logout();
    });
    $("form").on('submit', function (event) {
        event.preventDefault();
    });
    $("form.form_test").on('submit', function (event) {
        event.preventDefault();
        submit_test(this.id);
        this.reset();
    });
});

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

function logout() {
    var url = "index.php?action=logout";
    var data = {
        confirm: true
    };
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            setTimeout(function () {
                window.location.replace("index.php");
            }, 1500);
        }
    };
    $.post(url, data, success);
}

/**
 * Hàm validate email
 * @param {object} data 
 * CreatedBy: PQ Huy (13.11.2021)
 */
function valid_email_on_profiles(data) {
    var new_email = $('#profiles-new-email').val();
    var current_email = $('#profiles-current-email').val();
    var url = "index.php?action=valid_email_on_profiles";
    var data1 = {
        new_email: new_email,
        current_email: current_email
    };
    var success = function (result) {
        var json_data = $.parseJSON(result);
        if (json_data.status) {
            $('#valid-email-true').removeClass('hidden');
            $('#valid-email-false').addClass('hidden');
        } else {
            $('#valid-email-false').removeClass('hidden');
            $('#valid-email-true').addClass('hidden');
        }
    };
    $.post(url, data1, success);
}

/**
 * Hàm gửi thông tin submit bài thi
 * @param {*} id 
 * CreatedBy: PQ Huy (12.11.2021)
 */
function submit_test(id) {
    $('#preload').removeClass('hidden');
    var data = $('#' + id).serialize();
    var url = "index.php?action=approval_start_test";
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            setTimeout(function () {
                location.reload();
            }, 1500);
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}