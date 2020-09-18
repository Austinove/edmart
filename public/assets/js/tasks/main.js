
//post function request
const postRequest = (requestUrl, requestData) => {
    return $.ajax({
        url: requestUrl,
        type: "POST",
        data: JSON.stringify(requestData),
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        contentType: "application/json",
        cache: false,
        processData: false,
    })
}

//get request function
const getRequest = url => {
    return $.ajax({
        url: url,
        type: "get",
        dataType: 'json'
    });
}

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
}

//notification function
const notification = (description, notifType, delayTime = 2000) => {
    $.notify(description, notifType, {
        autoHide: true,
        autoHideDelay: delayTime
    });
}

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
}

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
}