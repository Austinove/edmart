$(document).ready(function(){
    //notification function
    function Notification(description, notifType, delayTime = 2000) {
        $.notify(description, notifType, {
            autoHide: true,
            autoHideDelay: delayTime
        });
    }

    //Empting inputs function
    function clearInputs() {
        $('.name').val('');
        $('.email').val('');
        $('.image').val('');
        $(".userType").val("");
    }

    // $('#changePassword').addClass('toggleForms');
    $('.btn-togleForm').click(function(e){
        e.preventDefault()
        var toggleText = $('.togleForm').text();
        if(toggleText === "Change password") {
            $('.togleForm').text('User Info')
            $('#userInfo').addClass('toggleForms');
            $('#changePassword').removeClass('toggleForms');
        }else {
            $('.togleForm').text('Change password');
            $('#changePassword').addClass('toggleForms');
            $('#userInfo').removeClass('toggleForms');
        }
    });

    //Toggling for user position
    $(document).on("change", ".userType", function(){
        if($(this).children("option:selected").val() === "worker") {
            $(".positionInput").removeClass("d-none").find("input.position").focus();
            $(".return-selection").removeClass("d-none");
            $(".selectInput").addClass("d-none");
        }
    })

    $(document).on("click", ".return-selection", function(e){
        e.preventDefault();
        $(".userType").val("");
        $(this).addClass("d-none");
        $(".selectInput").removeClass("d-none").find("input.userType").focus();
        $(".positionInput").addClass("d-none");
        $(".position").val("");
    })

    //Submitting Registration
    $('#registration-form').submit(function (e) {
        e.preventDefault();
        var actionUrl = "register";
        console.log($(".userType").val());
        console.log($(".position").val());
        //checking for position specification input
        if (($(".userType").val() !== "worker")||(($(".userType").val() === "worker") && ($(".position").val() != null))) {
        $('#register-btn').html('Submiting...');
        $("#register-btn").prop('disabled', true);
        $.ajax({
            url: actionUrl,
            type: "post",
            data: new FormData(this),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            cache: false,
            processData: false,
        })
        .done(response => {
            $('#register-btn').html('Register User');
            $("#register-btn").prop('disabled', false);
            clearInputs();
            Notification(response.msg, "success");
        })
        .fail(error => {
            $('#register-btn').html('Register User');
            $("#register-btn").prop('disabled', false);
            if (error.responseJSON.errors.email[0] === "The email has already been taken."){
                Notification(error.responseJSON.errors.email[0], "warning");
            }else{
                Notification("An Error occuired !!!", "warning");
            }
        });
        } else { $(".error-user").text("Required please *") }
    });

    //Editing User information
    $('#userInfo').submit(function (e) {
        e.preventDefault();
        var actionUrl = "edit/user/info";
        $('.info-btn').html('Saving...');
        $(".info-btn").prop('disabled', true);
        $.ajax({
            url: actionUrl,
            type: "post",
            data: new FormData(this),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            cache: false,
            processData: false,
        })
            .done(response => {
                $('.info-btn').html(`<i class="fa fa-save"></i> Save Changes`);
                $(".info-btn").prop('disabled', false);
                Notification(response.msg, "success");
                location.reload();
            })
            .fail(error => {
                Notification("An Error occuired !!!", "warning");
                $('.info-btn').html(`<i class="fa fa-save"></i> Save Changes`);
                $(".info-btn").prop('disabled', false);
            });
    });

    //Editing User Password
    $('#changePassword').submit(function (e) {
        console.log("clicked");
        e.preventDefault();
        var actionUrl = "edit/user/password";
        $('#password-btn').html('Saving...');
        $("#password-btn").prop('disabled', true);
        $.ajax({
            url: actionUrl,
            type: "post",
            data: new FormData(this),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            cache: false,
            processData: false,
        })
            .done(response => {
                $('#password-btn').html(`<i class="fa fa-save"></i> Save Password`);
                $("#password-btn").prop('disabled', false);
                Notification(response.msg, "success");
                location.reload();
            })
            .fail(error => {
                Notification("An Error occuired !!!", "warning");
                $('#password-btn').html(`<i class="fa fa-save"></i> Save Password`);
                $("#password-btn").prop('disabled', false);
            });
    });
});