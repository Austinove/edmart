$(document).ready(function(){
    //---------------------------Expences--------------------------------
    // variable for listing
    // var expenseDesc = [];
    // scrolling list table
    var $th = $('.tableFixHead').find('thead th')
    $('.tableFixHead').on('scroll', function(){
        $th.css('transform', 'translateY('+ this.scrollTo + 'px)');
    });

    //setting up commas in budget
    const numberWithCommas = (number) => {
        var parts = number.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }

    // toggling expences forms
    $(".add-expence").click(function (e) {
        // expenseDesc = [];
        var toggleText = $('.togglexpe').text();
        if (toggleText === "Add Expense") {
            $('.expense-inputs').removeClass('toggleForms');
            $('.expenses-contents').addClass('toggleForms');
            $(this).html(`
                    <i class="fa fa-arrow-circle-o-left"></i>
                    <span class="togglexpe">Return</span>
                    `);
        } else {
            $(this).html(`
                    <i class="fa fa-plus"></i>
                    <span class="togglexpe">Add Expense</span>
                    `);
            $('.expense-inputs').addClass('toggleForms');
            $('.expenses-contents').removeClass('toggleForms');
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

    // function to send viewed
    function viewed(viewedUrl, expenses) {
        return $.ajax({
            url: viewedUrl,
            type: "post",
            data: JSON.stringify(expenses),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: "application/json",
            cache: false,
            processData: false,
        });
    }

    //Empting inputs function
    function clearInputs() {
        $('.desc').val('');
        $('.rate').val('');
        $('.units').val('');
        $('.quantity').val('');
        $('.title').val('');
    }

    //close reasoning modal
    $(document).on("click", ".modal-close", function(){
        $(".reason").val("");
    })

    //Function for more in modal
    $(document).on("click", ".more", function () {
        $(".reason-content").html("");
        var expenceType = $(this).attr("exp-type");
        var reason = $(this).attr("data-reason");
        switch (expenceType) {
            case "cancelled":
                $.when(viewed("approved/cancelled", $(this).attr("data-id")).done(response => {
                    cancelledExpences(response)
                }).fail(error => {
                    console.log(error)
                    Notification("View not registered!", "warning")
                }))
                break;
            case "approved":
                $.when(approvedRequest($(this).attr("data-id")).done(response => {
                    approvedExpRequests(response)
                }).fail(error => {
                    console.log(error)
                    Notification("View not registered!", "warning")
                }))
                break;
            default:
                break;
        }

        $(".expenses-body").html("");
        $(".modal-total").text(numberWithCommas($(this).attr('data-amount'))+" sh");
        $(".expModal-title").text($(this).attr('data-desc').split(">|<")[0]);
        (($(this).attr('data-desc').split(">|<")[1]).split("||")).forEach((item, index) => {
            $(".expenses-body").append(`
            <tr>
                <th scope="row">${index+1}</th>
                <td class="td-text custom-td">${item.split("<>")[0]}</td>
                <td class="td-text">${item.split("<>")[1]}</td>
                <td class="td-text">${item.split("<>")[2]}</td>
                <td class="td-text">${item.split("<>")[3]}</td>
                <td class="td-text">${(item.split("<>")[1]) * (item.split("<>")[3])}</td>
            </tr>
        `)
        });
        if(reason != null){
            $(".reason-content").html(`
                <strong class="small-text">Reson for cancellation</strong>
                <br>
                <span class="small-text td-text"><strong>By:</strong> ${reason.split(":")[0]}</span>
                <p class="small-text" style="font-size: 12px!important;">${reason.split(":")[1]}</p>
            `)
        }
    })

    //List functionality
    var expenseDesc = [];
    var count = 1;
    $("#exp-formList").validate({
        submitHandler: function(form) {
            //assiginig units
            var requiredUnits = "others";
            $(".selectInput").hasClass("d-none") ? requiredUnits = $(".specify").val() : requiredUnits = $(".units").val();
            console.log(requiredUnits);
            // form.submit()
            var editCheck = $("#add-list").attr("data-edit");
            switch (editCheck) {
                case "edit":
                    let saveEdited = expenseDesc.find((exp) => {
                        return exp.id === parseInt($("#add-list").attr("data-id"));
                    })
                    saveEdited.desc = ($(".desc").val() +
                                        "<>" +
                                        $(".quantity").val() +
                                        "<>" +
                                        requiredUnits +
                                        "<>" +
                                        $(".rate").val());
                    saveEdited.amount = ($(".rate").val() * $(".quantity").val())
                    $("#add-list").attr("data-edit", "no")
                                    .html(`<i class="fa fa-plus"></i> Add to List`);
                    break;

                case "no":
                    expenseDesc.push(
                        {               
                            "id": count,
                            "desc": $(".desc").val() +
                                    "<>" +
                                    $(".quantity").val() +
                                    "<>" +
                                    requiredUnits +
                                    "<>" +
                                    $(".rate").val(),
                            "amount": ($(".rate").val() * $(".quantity").val())
                        }
                    );
                    count++;
                    break;

                default:
                    break;
            }
            $(".title-text").text($(".title").val()+" ");
            const arrSum = expenseDesc.reduce(function (prev, cur) {
                return prev + cur.amount;
            }, 0);
            $(".total").text(arrSum);
            renderList(expenseDesc);
            $(".desc").val("");
            $(".rate").val("");
            $(".units").val("");
            $(".quantity").val("");
            $(".specify").val("");
            $(".specifyInput").addClass("d-none");
            $(".selectInput").removeClass("d-none");
        }
    });

    // toggling units inputs
    $(document).on("change", ".units", function(){
        if($(this).children("option:selected").val() === "specify") {
            $(".specifyInput").removeClass("d-none").find("input.units").focus();
            $(".selectInput").addClass("d-none");
        }
    });

    // Editing an element in the list
    $(document).on("click", ".icon-edit", function(e) {
        var units = ["pc", "roll", "doz", "pkt", "kg", "rims"];
        let toEdit = expenseDesc.find((exp) => {
            return exp.id === parseInt($(this).attr("data"));
        })
        var descValue = toEdit.desc.split("<>");
        console.log(descValue);
        $(".desc").val(descValue[0]);
        $(".quantity").val(descValue[1]);
        if (units.indexOf(descValue[2]) < 0) {
            $(".specifyInput").removeClass("d-none");
            $(".selectInput").addClass("d-none");
            $(".specify").val(descValue[2]);
        }else{
            $(".selectInput").removeClass("d-none");
            $(".specifyInput").addClass("d-none");
            $(".units").val(descValue[2]);
        }
        $(".rate").val(descValue[3]);
        $("#add-list").attr("data-id", $(this).attr("data"))
                        .html(`<i class="fa fa-save"></i> Save`)
                        .attr("data-edit", "edit");
    });
    // Deleting element in the list
    $(document).on("click", ".icon-delete", function(e) {
        const newExpenseDesc = expenseDesc.filter((item) => item.id !== parseInt($(this).attr("data")));
        expenseDesc = newExpenseDesc;
        const arrSum = expenseDesc.reduce(function (prev, cur) {
            return prev + cur.amount;
        }, 0);
        $(".total").text(numberWithCommas(arrSum));
        renderList(expenseDesc);
    })
    //list rendering function
    function renderList(expDetails){
        $(".expences-list").html('');
        expDetails.forEach(expense => {
            var descValue = expense.desc.split("<>");
            return $(".expences-list").append(`
                <tr>
                    <th scope="row">${expense.id}</th>
                    <td class="td-text custom-td">${descValue[0]}</td>
                    <td class="td-text">${descValue[1]}</td>
                    <td class="td-text">${descValue[2]}</td>
                    <td class="td-text">${descValue[3]}</td>
                    <td class="td-text">
                        ${numberWithCommas(expense.amount)}
                    </td>
                    <td class="td-text">
                        <span >
                            <i class="fa fa-edit custom-icon icon-edit" data="${expense.id}"></i> | 
                            <i class="fa fa-trash custom-icon icon-delete" data="${expense.id}"></i>
                        </span>
                    </td>
                </tr>
            `);
        });
    }
    //Submitting Expences
    $(document).on("click", "#exp-btn",function (e) {
        e.preventDefault();
        const descData = $(".title-text").text()+" >|<"+expenseDesc.map(item => item.desc).join("||");
        if (descData === ">|<") {
            Notification("Add some items to the list", "warning");
        } else {
            var expenseData = new FormData;
            expenseData.append("desc", descData);
            expenseData.append("amount", $(".total").text());
            expenseData.append("userType", $(this).attr('user-type'))
            var actionUrl = "expences/create";
            let id = $("#exp-btn").attr("data");
            
            // handling house keeping (disabling button and clearing inputs with title&total)
            $("#exp-btn").prop('disabled', true).html('Submiting...');
            expenseDesc = [];
            renderList(expenseDesc);
            $(".total").text("0");
            $(".title-text").text("");
            clearInputs();

            // Ajax request
            $.ajax({
                url: actionUrl,
                type: "post",
                data: expenseData,
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
                        getExpencesRequests();
                        $('#exp-btn').html('<i class="fa fa-arrow-right"></i>Request')
                            .prop('disabled', false)
                            .attr("data", "request");
                        Notification("Expence Saved Successfull", "success");
                    } else {
                        Notification("An Error occuired !!!", "warning");
                        $('#exp-btn').html('<i class="fa fa-arrow-right"></i>Request')
                            .prop('disabled', false)
                            .attr("data", "request");
                    }
                })
                .fail(error => {
                    Notification("An Error occuired !!!", "warning");
                    $('#exp-btn').html('<i class="fa fa-arrow-right"></i>Request')
                        .prop('disabled', false)
                        .attr("data", "request");
                });
        }
    });

    // Withdrawing expense
    $(document).on("click", ".widthdrawExp", function (e) {
        e.preventDefault();
        let id = $(this).attr("data");
        $(this).html('Widthdrawing....', "warning")
        Notification("Withdrawing, Please wait.....", "warning", 5000);
        $.when(deleteRequest(`expences/delete/${id}`).done(response => {
            pendingExpences(response.expences);
            if (response.msg === "Expence Widrawn Successfully") {
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
            var descValue = expence.desc.split(" ");
            $(".pending-expence").append(`
                <tr >
                    <td>
                        ${descValue[0]}  .....
                        <a href="#" data-toggle="modal" 
                            data-desc="${expence.desc}"
                            data-amount="${expence.amount}"
                            exp-type="pending"
                            data-target="#expenseDetails"
                            class="more"
                        >more details</a>
                    </td>
                    <td class="budget">${numberWithCommas(expence.amount)}</td>
                    <td>
                        <span class="badge badge-dot mr-4">
                            <span class="status">${expence.status}</span>
                        </span>
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
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" class="disabled">
                            ${expence.status === "pending" ? `<div>
                                <a class="dropdown-item widthdrawExp"
                                    data="${expence.id}"
                                    desc-data="${expence.desc}"
                                    amount-data="${expence.amount}" 
                                    href="#">Withdraw</a>
                            </div>` : '<span class="ml-4 text-muted small-text">Not pending</span>'}
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
        var counter = 0;
        var newfeeds;
        expence_data.forEach(expence => {
            if (expence.viewed === "0") {
                counter++;
            }
        });
        (counter != 0) ? ($(".badge-cancelled").text(counter)) : ($(".badge-cancelled").text(""))
        $(".cancelled-expence").html("");
        expence_data.forEach(expence => {
            (expence.viewed === "0") ? (newfeeds = "new-feeds") : (newfeeds = " ")
            var descValue = expence.desc.split(" ");
            $(".cancelled-expence").append(`
                <tr class=${newfeeds}>
                    <td>
                        ${descValue[0]}  ..... 
                        <a href="#" data-toggle="modal" 
                            data-desc="${expence.desc}"
                            data-amount="${expence.amount}"
                            exp-type="cancelled"
                            data-id = "${expence.id}"
                            data-reason = "${expence.reason}"
                            data-target="#expenseDetails"
                            class="more"
                        >more details</a>
                    </td>
                    <td class="budget">${expence.amount}</td>
                    <td>
                        <span class="badge badge-dot mr-4">
                            <span class="status">
                            ${
                                expence.created_at.includes("T") ?
                                expence.created_at.split(' ')[0] :
                                expence.created_at.split(' ')[0]
                            }
                            </span>
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
        var counter = expence_data.length;
        (counter === 0) ? $(".badge-hr").text("") : $(".badge-hr").text(counter)
        var newfeeds = "nothing";
        $(".hr-pending-requests").html("");
        expence_data.forEach(expence => {
            newfeeds = "new-feeds"
            var descValue = expence.desc.split(" ");
            $(".hr-pending-requests").append(`
            <tr class="${newfeeds}">
                <td>
                ${descValue[0]}  ..... 
                <a href="#" data-toggle="modal"
                    data-desc="${expence.desc}"
                    data-amount="${expence.amount}"
                    exp-type="pending"
                    data-id = ${expence.id}
                    data-target="#expenseDetails"
                    class="more"
                >more details</a>
                </td>
                <td class="budget">${numberWithCommas(expence.amount)}</td>
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

    //get hr Accepted Expences from Admin
    getAcceptedExpences();
    function getAcceptedExpences() {
        $.when(getRequest('fetch/expenses/accepted').done(response => {
            acceptedExpRequests(response);
        }).fail(error => {
            console.log(error);
            Notification("An Error occuired !!!", "warning");
        }));
    }

    //Rendering Accepted Expences from Admin
    function acceptedExpRequests(expence_data) {
        var counter = expence_data.length;
        (counter === 0) ? $(".badge-accepted").text("") : $(".badge-accepted").text(counter)
        var newfeeds = "nothing";
        $(".admin-accepted").html("");
        expence_data.forEach(expence => {
            newfeeds = "new-feeds"
            var descValue = expence.desc.split(" ");
            $(".admin-accepted").append(`
                    <tr class="${newfeeds}">
                        <td>
                            ${descValue[0]}  ..... 
                            <a href="#" data-toggle="modal" 
                                data-desc="${expence.desc}"
                                data-amount="${expence.amount}"
                                exp-type="approved"
                                data-id = ${expence.id}
                                data-target="#expenseDetails"
                                class="more"
                            >more details</a>
                        </td>
                        <td class="budget">${numberWithCommas(expence.amount)}</td>
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
                                <a class="dropdown-item cashOut" data="${expence.id}" href="#">Cash Out</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `)
        })
    }

    //Hr Cash out action
    $(document).on("click", ".cashOut", function (e) {
        e.preventDefault();
        const id = $(this).attr("data");
        Actions("expenses/cashOut", id, "hr-cashout");
    });

    // Function for actions in the table
    function Actions(actionUrl, actionData, sender, others=" ") {
        let Data = new FormData();
        Data.append("id", actionData);
        others ? Data.append("others", others) : null;
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
                    case "hr":
                        expencesRequests(response);
                        Notification("Expence Recommended", "success");
                        break;
                    case "hr-cashout":
                        expencesRequests(response);
                        acceptedExpRequests(response);
                        Notification("Expence Cashed out", "success");
                        break;
                    case "decline":
                        expencesRequests(response);
                        $("#expenseCancel").modal("hide");
                        $(".cancel-btn").prop("disabled", false)
                            .html('<i class="fa fa-arrow-circle-up" aria-hidden="true"></i> Submit')
                            .attr("id-data", " ");
                        $(".reason").val(" ");
                        Notification("Expense Declined Successfully", "success");
                        break;
                    case "admin":
                        getApprovedExpences();
                        recommendedExpRequests(response);
                        Notification("Expense Accepted", "success");
                        break;
                    case "admin-decline":
                        recommendedExpRequests(response);
                        getApprovedExpences();
                        $("#expenseCancel").modal("hide");
                        $(".cancel-btn").prop("disabled", false)
                            .html('<i class="fa fa-arrow-circle-up" aria-hidden="true"></i> Submit')
                            .attr("id-data", " ");
                        $(".reason").val(" ");
                        Notification("Expense Declined", "success");
                        break;
                    default:
                        break;
                }
                getPendingExpences();
                getCancelledExpences();
            })
            .fail(error => {
                Notification("An Error occuired !!!", "danger");
            })
    }

    // Recommendation action
    $(document).on("click", ".recommend", function (e) {
        e.preventDefault();
        const id = $(this).attr("data");
        Actions("expences/recommended", id, "hr");
    });

    //hr decline action
    $(document).on("click", ".decline", function (e) {
        e.preventDefault();
        $(".cancel-btn").attr("id-data", $(this).attr("data")).attr("user-data", "hr");
        $("#expenseCancel").modal("show");
    });

    $("#cancel-reason").submit(function(e) {
        e.preventDefault();
        $(".cancel-btn").html("Submiting...").prop("disabled", true);
        const id = $(".cancel-btn").attr("id-data");
        if($(".cancel-btn").attr("user-data") === "admin") {
            Actions("expences/admin/decline", id, "admin-decline", ("Manager:" + $(".reason").val().trim()));
        }else if($(".cancel-btn").attr("user-data") === "hr"){
            Actions("expences/decline", id, "decline", ("Human Resource:" + $(".reason").val().trim()));
        }
    });

    //get hr Recommended Expences for Admin
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
    $(document).on("click", ".accept", function (e) {
        e.preventDefault();
        const id = $(this).attr("data");
        Actions("expences/accept", id, "admin");
    });

    //Admin decline action
    $(document).on("click", ".admin-decline", function (e) {
        e.preventDefault();
        $(".cancel-btn").attr("id-data", $(this).attr("data")).attr("user-data", "admin");
        $("#expenseCancel").modal("show");
    });

    //Rendering Recommended Expences for Admin
    function recommendedExpRequests(expence_data) {
        var counter = expence_data.length;
        (counter === 0) ? $(".badge-recommend").text("") : $(".badge-recommend").text(counter)
        var newfeeds = "nothing";
        $(".admin-recommended").html("");
        expence_data.forEach(expence => {
            newfeeds = "new-feeds"
            var descValue = expence.desc.split(" ");
            $(".admin-recommended").append(`
                    <tr class="${newfeeds}">
                        <td>
                            ${descValue[0]}  ..... 
                            <a href="#" data-toggle="modal" 
                                data-desc="${expence.desc}"
                                data-amount="${expence.amount}"
                                exp-type="approved"
                                data-id = ${expence.id}
                                data-target="#expenseDetails"
                                class="more"
                            >more details</a>
                        </td>
                        <td class="budget">${numberWithCommas(expence.amount)}</td>
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
    // Setting up print url to print button
    setMonth();
    function setMonth() {
        var d = new Date()
        var currentMonth
        (d.getMonth() + 1) >= 10 ?
            currentMonth = (d.getMonth() + 1) :
            currentMonth = "0" + (d.getMonth() + 1);
        $(".month").val(d.getFullYear() + "-" + currentMonth);
        $(".month-all").val(d.getFullYear() + "-" + currentMonth);
    }

    // request function for user approved expenses per month
    function approvedRequest(viewId = 0) {
        var month = $(".month").val().split("-")[1];
        let Data = new FormData();
        Data.append("month", "-" + month + "-");
        Data.append("id", viewId);
        return $.ajax({
            url: "user/approved",
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

    //get User Approved Expences
    getApprovedExpences();
    function getApprovedExpences() {
        $.when(approvedRequest().done(response => {
            approvedExpRequests(response);
        }).fail(error => {
            console.log(error);
            Notification("An Error occuired !!!", "warning");
        }));
    }

    //Rendering Approved Expenses
    function approvedExpRequests(expence_data) {
        $(".retrieve").html(`Retrieve <i class="fa fa-check" aria-hidden="true"></i>`);
        $(".retrieve").prop('disabled', false);
        $(".approved-expenses").html("");
        var counter = 0;
        var newfeeds;
        expence_data.forEach(expence => {
            if (expence.viewed === "0") {
                counter++;
            }
        });
        (counter != 0) ? ($(".badge-approved").text(counter)) : ($(".badge-approved").text(""))
        expence_data.forEach(expence => {
            (expence.viewed === "0") ? (newfeeds = "new-feeds") : (newfeeds = " ")
            var descValue = expence.desc.split(" ");
            $(".approved-expenses").append(`
                    <tr class=${newfeeds}>
                        <td>
                            ${descValue[0]}  ..... 
                            <a href="#" data-toggle="modal" 
                                data-desc="${expence.desc}"
                                data-amount="${expence.amount}"
                                exp-type="approved"
                                data-id = ${expence.id}
                                data-target="#expenseDetails"
                                class="more"
                            >more details</a>
                        </td>
                        <td class="budget">${numberWithCommas(expence.amount)}</td>
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

    // fetch user approved expences by month on click
    $(document).on("click", ".retrieve", function (e) {
        $(".retrieve").prop('disabled', true);
        $(this).html("Retriving....");
        getApprovedExpences();
    })

    // fetch All approved Expenses per month on click
    $(document).on("click", ".retrieve-all", function (e) {
        $(this).prop('disabled', true);
        $(this).html("Retriving....");
        getAllExpences();
    })

    // function to retrieve all the Expenses for both hr and Admin
    function allAprovedRequest(expUrl) {
        var month = $(".month-all").val().split("-")[1];
        let Data = new FormData();
        Data.append("month", "-" + month + "-");
        return $.ajax({
            url: expUrl,
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

    //get all approved expenses per month
    getAllExpences();
    function getAllExpences() {
        if ($(".month-all").val() != undefined) {
            $.when(allAprovedRequest("expenses/approved/month").done(response => {
                allApprovedExp(response);
            }).fail(error => {
                console.log(error);
                Notification("An Error occuired !!!", "warning");
            }));
         }
    }

    //rendering all expences
    function allApprovedExp(expence_data) {
        // first set the url of print button
        $(".print-btn").attr("href", `/expense/printPdf/${"-" + $(".month-all").val().split("-")[1] + "-"}`)
        $(".retrieve-all").html(`Retrieve <i class="fa fa-check" aria-hidden="true"></i>`);
        $(".retrieve-all").prop('disabled', false);
        $(".all-expenses").html("");
        var amount = 0;
        expence_data.forEach(expence => {
            $(".total-amount").text(amount = amount + parseInt(expence.amount));
            var descValue = expence.desc.split(" ");
            $(".all-expenses").append(`
                    <tr>
                        <td>
                            ${descValue[0]}  .....
                            <a href="#" data-toggle="modal"
                                data-desc="${expence.desc}"
                                data-amount="${expence.amount}"
                                data-target="#expenseDetails"
                                class="more"
                            >more details</a>
                        </td>
                        <td class="budget">${numberWithCommas(expence.amount)}</td>
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

    //Refreshing the System's Information
    setInterval(() => {
        $.when(getRequest('expences/pending').done(response => {
            expencesRequests(response);
            $(".checker").text('');
            // retrieve other information after check
            getApprovedExpences();
            getRecommendedExpences();
            getAcceptedExpences();
            getCancelledExpences();
            getPendingExpences();
            getAllExpences();
        }).fail(error => {
            $(".checker").text("No internet access, please check your connection");
            console.log(error);
            Notification("An Error occuired OR No internet access", "warning");
        }));
        
    },30000);

}); 
