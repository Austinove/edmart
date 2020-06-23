<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/assets/img/favicon.png')}}" type="image/png">
    <title>EDMART SYSTEM</title>
    {{-- <link rel="stylesheet" href="{{ asset('/css/app.css') }}"  type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/argon.css?v=1.2.0') }}"  type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}"  type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="{{ asset('/assets/font-awesome4.7.0/css/font-awesome.min.css')}}">
    
</head>
<body>
    <div id="app">
        <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
            <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <a class="navbar-brand" href="javascript:void(0)">
                <img src="../assets/img/favicon.png" class="navbar-brand-img" alt="EDMART Logo">
                    <span class="small-text">MART SYSTEMS</span>
                </a>
            </div>
            <div class="navbar-inner">
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Dashboard Nav item -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">
                        <i class="fa fa-align-center" aria-hidden="true"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                    </li>
                    
                </ul>
                {{-- Company tasts Nav items --}}
                @if (Auth::user())
                    @if((Auth()->user()->userType==="admin")||(Auth()->user()->userType==="hr"))
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Company Tasks</span>
                    </h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link" href="profile.html">
                                <i class="fa fa-product-hunt" aria-hidden="true"></i>
                                <span class="nav-link-text">Projects</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tables.html">
                                <i class="fa fa-edit"></i>
                                <span class="nav-link-text">Contracts</span>
                            </a>
                        </li>
                    </ul>
                    @endif
                @endif
                {{-- Company Finances Nav items --}}
                <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Finance</span>
                    </h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('expences') }}">
                            <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                            <span class="nav-link-text">Expences</span>
                        </a>
                        </li>
                        @if (Auth::user())
                            @if((Auth()->user()->userType==="admin")||(Auth()->user()->userType==="hr"))
                                <li class="nav-item">
                                    <a class="nav-link" href="tables.html">
                                        <i class="fa fa-book" aria-hidden="true"></i>
                                        <span class="nav-link-text">Quatation</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="profile.html">
                                        <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                        <span class="nav-link-text">Payments</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="tables.html">
                                        <i class="fa fa-tasks" aria-hidden="true"></i>
                                        <span class="nav-link-text">LPO</span>
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>
                {{-- Managmenting Accounts --}}
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Managment Accounts</span>
                </h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile') }}">
                        <i class="fa fa-user-md" aria-hidden="true"></i>
                        <span class="nav-link-text">Profile</span>
                    </a>
                    </li>
                    @if (Auth::user())
                        @if(Auth()->user()->userType==="hr")
                            <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                <span class="nav-link-text">Accounts Settings</span>
                            </a>
                            </li>
                        @endif
                    @endif
                </ul>

                <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Others</span>
                    </h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                    <a class="nav-link" href="icons.html">
                        <i class="fa fa-sliders" aria-hidden="true"></i>
                        <span class="nav-link-text">Attendance</span>
                    </a>
                    </li>
                    </ul>
                </div>
            </div>
            </div>
        </nav>
    <div class="main-content" id="panel">
        @include('layouts.navBar')
        <main class="py-2">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    </div>

  <script src="{{ asset('/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script>
    $(document).ready(function(){

        // toggling expences forms
        $(".add-expence").click(function(e){
            e.preventDefault()
            var toggleText = $('.togglexpe').text();
            if(toggleText === "Add Expence") {
                $('.form-expences').removeClass('toggleForms');
                $(this).html(`
                    <i class="fa fa-arrow-circle-o-left"></i>
                    <span class="togglexpe">Return</span>
                    `);
            }else {
                $(this).html(`
                    <i class="fa fa-plus"></i>
                    <span class="togglexpe">Add Expence</span>
                    `);
                $('.form-expences').addClass('toggleForms');
            }
        });

        // User profile toggling
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

        //get request function
        function getRequest(url) {
            return $.ajax({
                url: url,
                type: "get",
                dataType: 'json'
            });
        }

        //delete request function
        function deleteRequest(url) {
            return $.ajax({
                url: url,
                type: 'delete',
                data: { _token: "{{ csrf_token() }}" },
                dataType: 'json'
            });
        }

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
            $('.desc').val('');
            $('.amount').val('');
        }


//-----------------Registration submition forms---------------------------------
        $('#registration-form').submit(function (e) {
            e.preventDefault();
            var actionUrl = "register";
            $('#register-btn').text('Submiting...');
            $("#register-btn").prop('disabled', true);
            $.ajax({
                url: actionUrl,
                type: "post",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
            })
                .done(response => {
                    if (response.msg === "User Registered Successfully") {
                        clearInputs();
                        $('#register-btn').text('Register User');
                        $("#register-btn").prop('disabled', true);
                        Notification("User Registered Successfully", "success");
                    } else {
                        Notification("An Error occuired !!!", "warning");
                    }
                })
                .fail(error => {
                    Notification("An Error occuired !!!", "warning");
                });
            });


//---------------------------Expences--------------------------------

        //Submitting Expences
        $('.form-expences').submit(function (e) {
            e.preventDefault();
            var actionUrl = "expences/create";
            let id = $("#exp-btn").attr("data");
            if (id !== "request") {
                actionUrl = `expences/edit/${id}`;
            }
            $('#exp-btn').html('Submiting...');
            $("#exp-btn").prop('disabled', true);
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
                    if (response.msg === "Expence Saved Successfull") {
                        clearInputs();
                        pendingExpences(response.expences);
                        $('#exp-btn').html('<i class="fa fa-arrow-right"></i>Request');
                        $("#exp-btn").prop('disabled', false);
                        $("#exp-btn").attr("data", "request");
                        Notification("Expence Saved Successfull", "success");
                    } else {
                        Notification("An Error occuired !!!", "warning");
                    }
                })
                .fail(error => {
                    Notification("An Error occuired !!!", "warning");
                });
        });

        //Editing expense
        $(document).on("click", ".editExp", function(e) {
            e.preventDefault();
            let id = $(this).attr("data");
            $("#exp-btn").attr("data", id);
            $(".desc").val($(this).attr("desc-data"));
            $(".amount").val($(this).attr("amount-data"));
            $('#exp-btn').html('<i class="fa fa-arrow-right"></i>Save Changes');
            $('.form-expences').removeClass('toggleForms');
            $(".add-expence").html(`
                <i class="fa fa-arrow-circle-o-left"></i>
                <span class="togglexpe">Return</span>
                `);
        });

        // Withdrawing expense
        $(document).on("click", ".widthdrawExp", function(e){
            e.preventDefault();
            let id = $(this).attr("data");
            $(this).html('Widthdrawing....',"warning")
            Notification("Withdrawing, Please wait.....", "warning", 5000);
            $.when(deleteRequest(`expences/delete/${id}`).done(response => {
                pendingExpences(response.expences);
                if (response.msg === "Expence Widrawn Successfully"){
                    Notification(response.msg, "success");
                }
            })
            .fail(error => {
                console.log(error);
                Notification("An Error occuired !!!", "warning");
            }));
        })

        //get user pending Expences
        getPendingExpences();
        function getPendingExpences() {
            $.when(getRequest('expences/fetch').done(response => {
                pendingExpences(response);
            }).fail(error => {
                console.log(error);
                Notification("An Error occuired !!!", "warning");
            }));
        }

        //Rendering user pending expences
        function pendingExpences(expence_data) {
            $(".pending-expence").html("");
            expence_data.forEach(expence => {
                $(".pending-expence").append(`
                    <tr>
                        <td>
                            ${expence.desc}
                        </td>
                        <td class="budget">${expence.amount}</td>
                        <td>
                            <span class="badge badge-dot mr-4">
                                <span class="status">${expence.status}</span>
                            </span>
                        </td>
                        <td>${
                            expence.created_at.includes("T") ? 
                            expence.created_at.split('T')[0] :
                            expence.created_at.split(' ')[0]
                            }</td>
                        <td class="text-left">
                            <div class="dropdown-lg">
                                <a style="font-size: 18px" class="btn btn-sm btn-icon-only text-black" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item editExp" 
                                    data="${expence.id}" 
                                    desc-data="${expence.desc}"
                                    amount-data="${expence.amount}" 
                                    href="#" >Edit</a>
                                <a class="dropdown-item widthdrawExp"
                                    data="${expence.id}"
                                    desc-data="${expence.desc}"
                                    amount-data="${expence.amount}" 
                                    href="#">Withdraw</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `)
            })
        }

        
        //get Cancelled Expences
        getCancelledExpences();
        function getCancelledExpences() {
            $.when(getRequest('expences/cancelled').done(response => {
                cancelledExpences(response);
            }).fail(error => {
                console.log(error);
                Notification("An Error occuired !!!", "warning");
            }));
        }
        //Rendering Cancelled expences
        function cancelledExpences(expence_data) {
            $(".cancelled-expence").html("");
            expence_data.forEach(expence => {
                $(".cancelled-expence").append(`
                    <tr>
                        <td>
                            ${expence.desc}
                        </td>
                        <td class="budget">${expence.amount}</td>
                        <td>
                            <span class="badge badge-dot mr-4">
                                <span class="status">${
                                    expence.created_at.includes("T") ? 
                                    expence.created_at.split(' ')[0] :
                                    expence.created_at.split(' ')[0]
                                    }</span>
                            </span>
                        </td>
                    </tr>
                `)
            })
        }


        
        //get pending Expences for hr
        getExpencesRequests();
        function getExpencesRequests() {
            $.when(getRequest('expences/pending').done(response => {
                expencesRequests(response);
            }).fail(error => {
                console.log(error);
                Notification("An Error occuired !!!", "warning");
            }));
        }

        //Rendering pending expences for hr
        function expencesRequests(expence_data) {
            $(".hr-pending-requests").html("");
            expence_data.forEach(expence => {
                $(".hr-pending-requests").append(`
                    <tr>
                        <td>
                            ${expence.desc}
                        </td>
                        <td class="budget">${expence.amount}</td>
                        <td>
                            <span class="status">${expence.name}</span>
                        </td>
                        <td>
                            ${
                                expence.created_at.includes("T") ? 
                                expence.created_at.split('T')[0] :
                                expence.created_at.split(' ')[0]
                            }
                        </td>
                        <td class="text-left">
                            <div class="dropdown-lg">
                                <a style="font-size: 18px" class="btn btn-sm btn-icon-only text-black" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item recommend" data="${expence.id}" href="#">Recommend</a>
                                <a class="dropdown-item decline" data="${expence.id}" href="#">Decline</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `)
            })
        }

        // Function for actions in the table
        function Actions(actionUrl, actionData, sender) {
            let Data = new FormData();
            Data.append("id", actionData);
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
                    
                    if(sender === "hr" || sender === "hr-decline"){ 
                        expencesRequests(response);
                        sender === "hr" ? 
                            Notification("Expence Recommended", "success") : 
                            Notification("Expence Declined", "success");
                        
                    } else{
                        recommendedExpRequests(response);
                        sender === "admin" ?
                            Notification("Expense Accepted", "success") :
                            Notification("Expense Declined", "success");
                    }
                    getPendingExpences();
                    getCancelledExpences();
                })
                .fail(error => {
                    Notification("An Error occuired !!!", "danger");
                })
        }

        // Recommendation action
        $(document).on("click", ".recommend", function(e) {
            e.preventDefault();
            const id = $(this).attr("data");
            Actions("expences/recommended", id, "hr");
        });

        // Decline action
        $(document).on("click", ".decline", function(e) {
            e.preventDefault();
            const id = $(this).attr("data");
            Actions("expences/decline", id, "hr-decline");
        });

        //get hr Recommended Expences
        getRecommendedExpences();
        function getRecommendedExpences() {
            $.when(getRequest('fetch/recommended/expenses').done(response => {
                recommendedExpRequests(response);
            }).fail(error => {
                console.log(error);
                Notification("An Error occuired !!!", "warning");
            }));
        }

        //Admin accept action
        $(document).on("click", ".accept", function(e){
            e.preventDefault();
            const id = $(this).attr("data");
            Actions("expences/accept", id, "admin");
        });

        //Admin decline action
        $(document).on("click", ".admin-decline", function(e){
            e.preventDefault();
            const id = $(this).attr("data");
            Actions("expences/admin/decline", id, "admin-decline");
        });

        //Rendering Recommended Expences for Admin
        function recommendedExpRequests(expence_data) {
            $(".admin-recommended").html("");
            expence_data.forEach(expence => {
                $(".admin-recommended").append(`
                    <tr>
                        <td>
                            ${expence.desc}
                        </td>
                        <td class="budget">${expence.amount}</td>
                        <td>
                            <span class="status">${expence.name}</span>
                        </td>
                        <td>
                            ${
                                expence.created_at.includes("T") ? 
                                expence.created_at.split('T')[0] :
                                expence.created_at.split(' ')[0]
                            }
                        </td>
                        <td class="text-left">
                            <div class="dropdown-lg">
                                <a style="font-size: 18px" class="btn btn-sm btn-icon-only text-black" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item accept" data="${expence.id}" href="#">Accept</a>
                                <a class="dropdown-item admin-decline" data="${expence.id}" href="#">Decline</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `)
            })
        }

        //set current month
        setMonth();
        function setMonth(){
            var d = new Date()
            var currentMonth
            (d.getMonth()+1) >= 10 ? 
            currentMonth = (d.getMonth()+1) : 
            currentMonth = "0" + (d.getMonth()+1);
            $(".month").val(d.getFullYear()+"-"+currentMonth);
        }

        // request function for approved expences per month
        function approvedRequest(){
            var month = $(".month").val().split("-")[1];
            let Data = new FormData();
            Data.append("month", "-"+month+"-");
            $.ajax({
                url: "expenses/approved/month",
                type: "post",
                data: Data,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                cache: false,
                processData: false,
            });
        }

        //get Approved Expences
        getApprovedExpences();
        function getApprovedExpences() {
            $.when(approvedRequest().done(response => {
                approvedExpRequests(response);
                $(this).html(`Retrieve <i class="fa fa-check" aria-hidden="true"></i>`);
                $("#retrieve").prop('disabled', false);
            }).fail(error => {
                console.log(error);
                Notification("An Error occuired !!!", "warning");
            }));
        }

        // //Rendering Approved Expenses
        function approvedExpRequests(expence_data) {
            $(".approved-expenses").html("");
            expence_data.forEach(expence => {
                $(".approved-expenses").append(`
                    <tr>
                        <td>
                            ${expence.desc}
                        </td>
                        <td class="budget">${expence.amount}</td>
                        <td>
                            <span class="status">${expence.name}</span>
                        </td>
                        <td> 
                            ${
                                expence.created_at.includes("T") ? 
                                expence.created_at.split('T')[0] :
                                expence.created_at.split(' ')[0]
                            }
                        </td>
                    </tr>
                `)
            })
        }

        // fetch approved expences by month on click
        $(document).on("click", ".retrieve", function(e){
            $("#retrieve").prop('disabled', true);
            $(this).html("Retriving....");
            getApprovedExpences();
        })

    });
  </script>
  {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> --}}
  <script src="{{ asset('/assets/js/notify.js') }}"></script>
  <script src="{{ asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  {{-- <script src="{{ asset('/assets/js/bootstrap-notify.js') }}"></script> --}}
  <script src="{{ asset('/assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Optional JS -->
  <script src="{{ asset('/assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('/assets/js/argon.js?v=1.2.0') }}"></script>
</body>
</html>
