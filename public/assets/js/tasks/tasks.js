$(document).ready(function() {
    // toggling expences forms
    $(".project-expense").click(function(e) {
        var toggleText = $(".togglexpe").text();
        if (toggleText === "Add Expense") {
            $(".expense-inputs").removeClass("d-none");
            $(".expenses-contents").addClass("toggleForms");
            $(this).html(`
                    <i class="fa fa-arrow-circle-o-left"></i>
                    <span class="togglexpe">Return</span>
                    `);
        } else {
            $(this).html(`
                    <i class="fa fa-plus"></i>
                    <span class="togglexpe">Add Expense</span>
                    `);
            $(".expense-inputs").addClass("d-none");
            $(".expenses-contents").removeClass("toggleForms");
        }
    });

    // variable for listing
    // scrolling list table
    var $th = $(".tableFixHead").find("thead th");
    $(".tableFixHead").on("scroll", function() {
        $th.css("transform", "translateY(" + this.scrollTo + "px)");
    });

    //List functionality
    var expenseDesc = [];
    var count = 1;
    $("#exp-formList").validate({
        submitHandler: function(form) {
            //assiginig units
            var requiredUnits = "others";
            $(".selectInput").hasClass("d-none")
                ? (requiredUnits = $(".specify").val())
                : (requiredUnits = $(".units").val());
            // form.submit()
            var editCheck = $("#add-list").attr("data-edit");
            switch (editCheck) {
                case "edit":
                    let saveEdited = expenseDesc.find(exp => {
                        return (
                            exp.id === parseInt($("#add-list").attr("data-id"))
                        );
                    });
                    saveEdited.desc =
                        $(".desc").val() +
                        "<>" +
                        $(".quantity").val() +
                        "<>" +
                        requiredUnits +
                        "<>" +
                        $(".rate").val();
                    saveEdited.amount = $(".rate").val() * $(".quantity").val();
                    $("#add-list")
                        .attr("data-edit", "no")
                        .html(`<i class="fa fa-plus"></i> Add to List`);
                    break;

                case "no":
                    expenseDesc.length < 6
                        ? expenseDesc.push({
                              id: count,
                              desc:
                                  $(".desc").val() +
                                  "<>" +
                                  $(".quantity").val() +
                                  "<>" +
                                  requiredUnits +
                                  "<>" +
                                  $(".rate").val(),
                              amount: $(".rate").val() * $(".quantity").val()
                          })
                        : $(".checker-list").text(
                              "Atlease 5 items please, Request that and make a continuation request"
                          );
                    count++;
                    break;
                default:
                    break;
            }
            $(".title-text").text($(".title").val() + " ");
            const arrSum = expenseDesc.reduce(function(prev, cur) {
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
            $(".return-selection").addClass("d-none");
        }
    });

    // toggling units inputs
    $(document).on("change", ".units", function() {
        if (
            $(this)
                .children("option:selected")
                .val() === "specify"
        ) {
            $(".return-selection").removeClass("d-none");
            $(".specifyInput")
                .removeClass("d-none")
                .find("input.specify")
                .focus();
            $(".selectInput").addClass("d-none");
        }
    });

    $(document).on("click", ".return-selection", function(e) {
        e.preventDefault();
        $(".units").val("pc");
        $(this).addClass("d-none");
        $(".selectInput")
            .removeClass("d-none")
            .find("input.units")
            .focus();
        $(".specifyInput").addClass("d-none");
    });

    // Editing an element in the list
    $(document).on("click", ".icon-edit", function(e) {
        var units = ["pc", "roll", "doz", "pkt", "kg", "rims"];
        let toEdit = expenseDesc.find(exp => {
            return exp.id === parseInt($(this).attr("data"));
        });
        var descValue = toEdit.desc.split("<>");
        $(".desc").val(descValue[0]);
        $(".quantity").val(descValue[1]);
        if (units.indexOf(descValue[2]) < 0) {
            $(".specifyInput").removeClass("d-none");
            $(".selectInput").addClass("d-none");
            $(".specify").val(descValue[2]);
        } else {
            $(".selectInput").removeClass("d-none");
            $(".specifyInput").addClass("d-none");
            $(".units").val(descValue[2]);
        }
        $(".rate").val(descValue[3]);
        $("#add-list")
            .attr("data-id", $(this).attr("data"))
            .html(`<i class="fa fa-save"></i> Save`)
            .attr("data-edit", "edit");
    });

    // Deleting element in the list
    $(document).on("click", ".icon-delete", function(e) {
        const newExpenseDesc = expenseDesc.filter(
            item => item.id !== parseInt($(this).attr("data"))
        );
        expenseDesc = newExpenseDesc;
        const arrSum = expenseDesc.reduce(function(prev, cur) {
            return prev + cur.amount;
        }, 0);
        $(".total").text(numberWithCommas(arrSum));
        renderList(expenseDesc);
    });

    //list rendering function
    function renderList(expDetails) {
        $(".expences-list").html("");
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
                            <i class="fa fa-edit custom-icon icon-edit" data="${
                                expense.id
                            }"></i> | 
                            <i class="fa fa-trash custom-icon icon-delete" data="${
                                expense.id
                            }"></i>
                        </span>
                    </td>
                </tr>
            `);
        });
    }

    //Submitting Expences
    $(document).on("click", "#exp-btn", function(e) {
        e.preventDefault();
        const descData =
            $(".title-text").text() +
            " >|<" +
            expenseDesc.map(item => item.desc).join("||");
        if ($(".title-text").text() === "") {
            notification("Add some items to the list", "warning");
        } else {
            var expenseData = new FormData();
            expenseData.append("desc", descData);
            expenseData.append("amount", $(".total").text());
            expenseData.append("userType", $(this).attr("user-type"));
            var actionUrl = "project/expenses/create";
            let id = $("#exp-btn").attr("data");

            // handling house keeping (disabling button and clearing inputs with title&total)
            $("#exp-btn")
                .prop("disabled", true)
                .html("Submiting...");
            expenseDesc = [];
            renderList(expenseDesc);
            $(".total").text("0");
            $(".title-text").text("");
            clearInputs();
            $.when(postRequest(actionUrl, expenseData))
                .done(response => {
                    if (response.msg === "Expence Saved Successfull") {
                        clearInputs();
                        pendingExpences(response.expences);
                        $("#exp-btn")
                            .html('<i class="fa fa-arrow-right"></i>Request')
                            .prop("disabled", false)
                            .attr("data", "request");
                        notification("Expence Saved Successfull", "success");
                    } else {
                        notification("An Error occuired !!!", "warning");
                        $("#exp-btn")
                            .html('<i class="fa fa-arrow-right"></i>Request')
                            .prop("disabled", false)
                            .attr("data", "request");
                    }
                })
                .fail(error => {
                    console.log(error);
                    notification("An Error occuired...", "warning");
                    $("#exp-btn")
                        .html('<i class="fa fa-arrow-right"></i>Request')
                        .prop("disabled", false)
                        .attr("data", "request");
                });
        }
    });

    //withdaw button
    $(document).on("click", ".withdraw-btn", function() {
        $(this)
            .prop("disabled", true)
            .html("wait..");
        const id = new FormData();
        id.append("id", $(this).attr("data-id"));
        const actionUrl = "project/expense/delete";
        btnActions("withdraw", actionUrl, id);
    });

    //declining button
    $(document).on("click", ".decline-btn", function() {
        $(this)
            .prop("disabled", true)
            .html("wait..");
        const id = new FormData();
        id.append("id", $(this).attr("data-id"));
        const actionUrl = "project/expense/decline";
        btnActions("decline", actionUrl, id);
    });

    //accepting button
    $(document).on("click", ".accept-btn", function() {
        $(this)
            .prop("disabled", true)
            .html("wait..");
        const id = new FormData();
        id.append("id", $(this).attr("data-id"));
        const actionUrl = "project/expense/accept";
        btnActions("accept", actionUrl, id);
    });

    //recommend button
    $(document).on("click", ".recommend-btn", function() {
        $(this)
            .prop("disabled", true)
            .html("wait..");
        const id = new FormData();
        id.append("id", $(this).attr("data-id"));
        const actionUrl = "project/expense/recommend";
        btnActions("recommend", actionUrl, id);
    });

    //revised button
    $(document).on("click", ".revised-btn", function() {
        $(this)
            .prop("disabled", true)
            .html("wait..");
        const id = new FormData();
        id.append("id", $(this).attr("data-id"));
        const actionUrl = "project/expense/revised";
        btnActions("revised", actionUrl, id);
    });

    //Fetch my requests
    fetchMyRequests();
    fetchMyRequests = () => {
        const requestUrl = "project/expense/myRequests";
        $.when(getRequest(requestUrl))
            .done(response => {
                renderMyRequests(response);
            })
            .fail(error => {
                console.log(error);
                notification("Couldn't fetch data", "warning");
            });
    };
    //rendering my requests
    const renderMyRequests = expenseData => {
        expenseData.forEach(expense => {
            // card iteration
        });
    };

    //Fetch Declined requests
    fetchDeclinedRequests();
    fetchDeclinedRequests = () => {
        const requestUrl = "project/expense/myRequests";
        $.when(getRequest(requestUrl))
            .done(response => {
                renderDeclinedRequests(response);
            })
            .fail(error => {
                console.log(error);
                notification("Couldn't fetch data", "warning");
            });
    };
    //rendering Declined requests
    const renderDeclinedRequests = expenseData => {
        expenseData.forEach(expense => {
            // card iteration
        });
    };

    //Fetch Approved requests
    fetchApprovedRequests();
    fetchApprovedRequests = () => {
        const requestUrl = "project/expense/myRequests";
        $.when(getRequest(requestUrl))
            .done(response => {
                renderApprovedRequests(response);
            })
            .fail(error => {
                console.log(error);
                notification("Couldn't fetch data", "warning");
            });
    };
    //rendering Approved requests
    const renderApprovedRequests = expenseData => {
        expenseData.forEach(expense => {
            // card iteration
        });
    };

    //Fetch Submitted requests
    fetchSubmittedRequests();
    fetchSubmittedRequests = () => {
        const requestUrl = "project/expense/myRequests";
        $.when(getRequest(requestUrl))
            .done(response => {
                renderSubmittedRequests(response);
            })
            .fail(error => {
                console.log(error);
                notification("Couldn't fetch data", "warning");
            });
    };
    //rendering Submitted requests
    const renderSubmittedRequests = expenseData => {
        expenseData.forEach(expense => {
            // card iteration
        });
    };

    //Fetch Revised requests
    fetchRevisedRequests();
    fetchRevisedRequests = () => {
        const requestUrl = "project/expense/myRequests";
        $.when(getRequest(requestUrl))
            .done(response => {
                renderRevisedRequests(response);
            })
            .fail(error => {
                console.log(error);
                notification("Couldn't fetch data", "warning");
            });
    };
    //rendering Revised requests
    const renderRevisedRequests = expenseData => {
        expenseData.forEach(expense => {
            // card iteration
        });
    };

    //Fetch Clarify requests
    fetchClarifyRequests();
    fetchClarifyRequests = () => {
        const requestUrl = "project/expense/myRequests";
        $.when(getRequest(requestUrl))
            .done(response => {
                renderClarifyRequests(response);
            })
            .fail(error => {
                console.log(error);
                notification("Couldn't fetch data", "warning");
            });
    };
    //rendering Clarify requests
    const renderClarifyRequests = expenseData => {
        expenseData.forEach(expense => {
            // card iteration
        });
    };

    //Fetch Accepted requests
    fetchAcceptedRequests();
    fetchAcceptedRequests = () => {
        const requestUrl = "project/expense/myRequests";
        $.when(getRequest(requestUrl))
            .done(response => {
                renderAcceptedRequests(response);
            })
            .fail(error => {
                console.log(error);
                notification("Couldn't fetch data", "warning");
            });
    };
    //rendering Accepted requests
    const renderAcceptedRequests = expenseData => {
        expenseData.forEach(expense => {
            // card iteration
        });
    };

    //Fetch CashedOut requests
    fetchCashedOutRequests();
    fetchCashedOutRequests = () => {
        const requestUrl = "project/expense/myRequests";
        $.when(getRequest(requestUrl))
            .done(response => {
                renderCashedOutRequests(response);
            })
            .fail(error => {
                console.log(error);
                notification("Couldn't fetch data", "warning");
            });
    };
    //rendering CashedOut requests
    const renderCashedOutRequests = expenseData => {
        expenseData.forEach(expense => {
            // card iteration
        });
    };

    //Refreshing the System's Information
    setInterval(() => {
        $.when(getRequest('projects/expences/fetch').done(response => {
            $(".checker").text('');
            // retrieve other information after check
            if(initialUser === "hr"){
                
            } else if(initialUser === "admin"){
                
            }else{
                
            }
            
        }).fail(error => {
            $(".checker").text("No internet access, please check your connection");
            console.log(error);
            // Notification("An Error occuired OR No internet access", "warning");
        }));
        
    },30000);
});
