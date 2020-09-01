$(document).ready(function(){
    let initialUser = $(".user-span").text();
    console.log(initialUser);
    //notification function
    function Notification(description, notifType, delayTime = 2000) {
        $.notify(description, notifType, {
            autoHide: true,
            autoHideDelay: delayTime
        });
    }

    //get request function
    function getRequest(url) {
        return $.ajax({
            url: url,
            type: "get",
            dataType: 'json'
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
    
    //Administrator routes only
    if ((initialUser === "admin")|| (initialUser === "hr")){
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
                getAllUsers();
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
        
        //get All Users
        getAllUsers();
        function getAllUsers() {
            $.when(getRequest('fetch/users').done(response => {
                AllUsers(response);
            }).fail(error => {
                console.log(error);
                Notification("Can't fetch users", "warning");
            }));
        }

        //Rendering All Users
        function AllUsers(users) {
            $(".users-container").html("");
            $(".badge-users").text(users.length);
            users.forEach(user => {
                var image = '/profiles/'+user.image;
                $(".users-container").append(`
                <div class="col-md-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">${user.name}</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="text-center">
                                        <img src=${image} height="50px" class="rounded" alt="...">
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-nowrap">${user.position}</span>
                            </p>
                            <div class="row mt-4">
                                ${user.status === "0" ? 
                                    '<a data-id="' + user.id + '" class="btn btn-success btn-sm float-left activate" href="#" role="button"><i class="fa fa-check" aria-hidden="true"></i> Activate</a>' :
                                    '<a data-id="' + user.id + '" class="btn btn-danger btn-sm float-left deactivate" href="#" role="button"><i class="fa fa-times" aria-hidden="true"></i> Deactivate</a>' }
                                    <a data-id="${user.id}" class="btn btn-info btn-sm ml-auto resetUser" href="#" role="button"><i class="fa fa-cog" aria-hidden="true"></i> Reset</a>
                            </div>
                        </div>
                    </div>
                </div>
                `)
            })
        }


        // Function for actions for users
        function Actions(Data, actionUrl, sender) {
            $.ajax({
                url: actionUrl,
                type: "post",
                data: Data,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                cache: false,
                processData: false,
            })
                .done(response => {
                    switch (sender) {
                        case "reset":
                            Notification(response.msg, "success");
                            break;
                        case "userActions":
                            AllUsers(response)
                            Notification("Action successful", "success");
                            break;
                        default:
                            break;
                    }
                })
                .fail(error => {
                    Notification("Action unsuccessful", "danger");
                })
        }
        //user Activation
        $(document).on("click", ".activate", function(e) {
            e.preventDefault();
            let Data = new FormData();
            Data.append("id", $(this).attr("data-id"));
            Data.append("action", 1);
            Actions(Data,'user/action', "userActions");
        });
        // User Deactivation
        $(document).on("click", ".deactivate", function (e) {
            e.preventDefault();
            let Data = new FormData();
            Data.append("id", $(this).attr("data-id"));
            Data.append("action", 0);
            Actions(Data, 'user/action', "userActions");
        });
        //Reset Password
        $(document).on("click", ".resetUser", function (e) {
            e.preventDefault();
            let Data = new FormData();
            Data.append("id", $(this).attr("data-id"));
            Data.append("action", "password");
            Actions(Data, 'user/action', "reset");
        });
    }
});