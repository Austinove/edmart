//signed in user type
let initialUser = $(".user-span").text();

//post function request
const postRequest = (requestUrl, requestData) => {
    console.log(requestData);
    return $.ajax({
        url: requestUrl,
        type: "post",
        data: requestData,
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        contentType: false,
        cache: false,
        processData: false
    });
};

//get request function
const getRequest = url => {
    return $.ajax({
        url: url,
        type: "get",
        dataType: 'json'
    });
};

//delete request function
const deleteRequest = (url, id) => {
    return $.ajax({
        url: url,
        type: 'delete',
        data: JSON.stringify(id),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json'
    });
};

//notification function
const notification = (description, notifType, delayTime = 2000) => {
    $.notify(description, notifType, {
        autoHide: true,
        autoHideDelay: delayTime
    });
};

// function to send viewed
const viewed = (viewedUrl, expenses) => {
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
};

//Empting inputs function
const clearInputs = () => {
    //projects inputs
    $(".projectContract").val("");
    $(".projectClient").val("");
    $(".projectStart").val("");
    $(".projectEnd").val("");
    $(".projectFee").val("");
    $(".projectDesc").val("");
    $(".projectTitle").val("");
    $(".emp-checkbox").prop("checked", false);
    //projects expenses inputs
    $(".desc").val("");
    $(".rate").val("");
    $(".units").val("");
    $(".quantity").val("");
    $(".title").val("");
    $(".Assmanager").val("");
};

//setting up commas in budget
const numberWithCommas = (number) => {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
};

// Action function
const btnActions = (actionType, actionUrl, actionData) => {
    $.when(deleteRequest(actionUrl, actionData))
        .done(response => {
            console.log(response);
            handleResponse("success", actionType, "Request successfull", response);
        })
        .fail(error => {
            console.log(error);
            handleResponse("warning", actionType, "Error occuired...")
        });
};

//handle responses from actions
const handleResponse = (respType, actionType, actionSMS, resp = "error") => {
    notification(actionSMS, respType);
    switch (actionType) {
        case "withdraw":
            $(".withdraw-btn")
                .prop("disabled", false)
                .html('<i class="fa fa-times"></i>');
            break;

        case "decline":
            $(".decline-btn")
                .prop("disabled", false)
                .html('<i class="fa fa-thumbs-down"></i>');
            break;

        case "accept":
            $(".accept-btn")
                .prop("disabled", false)
                .html('<i class="fa fa-check"></i>');
            break;

        case "recommend":
            $(".recommend-btn")
                .prop("disabled", false)
                .html('<i class="fa fa-thumbs-up"></i>');
            break;

        case "revised":
            $(".revised-btn")
                .prop("disabled", false)
                .html('<i class="fa fa-check-square-o"></i>');
            break;

        default:
            break;
    }
};
