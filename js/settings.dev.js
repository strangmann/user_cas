$(document).ready(function () {

    $('#user_cas #casSettings').tabs();


    $("#user_cas #cas_force_login").on('change', function (event) {

        if ($(this).is(':checked')) {

            $("#user_cas #cas_disable_logout").attr("disabled", true);
            $("#user_cas #cas_disable_logout").prop('checked', false);

            $("#user_cas #cas_force_login_exceptions").attr("disabled", false);
        }
        else {

            $("#user_cas #cas_disable_logout").attr("disabled", false);
            $("#user_cas #cas_force_login_exceptions").attr("disabled", true);
        }
    });

    $("#user_cas #cas_disable_logout").on('change', function (event) {

        if ($(this).is(':checked')) {

            $("#user_cas #cas_handlelogout_servers").attr("disabled", true);
        }
        else {

            $("#user_cas #cas_handlelogout_servers").attr("disabled", false);
        }
    });

    $("#user_cas #casSettingsSubmit").on('click', function (event) {

        event.preventDefault();

        //console.log("Submit button clicked.");

        var postData = $('#user_cas').serialize();
        var method = $('#user_cas').attr('method');
        var url = OC.generateUrl('/apps/user_cas/settings/save');

        $.ajax({
            method: method,
            url: url,
            data: postData,
            success: function (data) {

                var notification = OC.Notification.show(data.message);

                setTimeout(function () {
                    OC.Notification.hide(notification);
                }, 5000);

            },
            error: function (data) {

                var notification = OC.Notification.show(data.message);

                setTimeout(function () {
                    OC.Notification.hide(notification);
                }, 5000);
            }
        });
    });
});
