$(document).ready(function () {
    //fetching users
    const fetchUsers = (userTypes) => {
        $.when(getRequest("fetch/users"))
            .done(response => {
                console.log(response);
                userTypes === "Assmanager"
                    ? renderManagerSelect(response)
                    : renderAssignCheckbox(response);
                console.log(response);
            })
            .fail(error => {
                console.log(error);
            });
    }
    const renderManagerSelect = (userData) => {
        $(".Assmanager").html('<option disabled value="" selected>Select Manager</option>');
        userData.forEach(user => {
            $('.Assmanager').append(`<option value="${user.id}">${user.name}</option>`);
        });
    };
    const renderAssignCheckbox = (userData) => {
        $(".checkbox-holder").html('');
        userData.forEach(user => {
            $(".checkbox-holder").append(`
                <div class="bg-secondary custom-control custom-checkbox mx-2 mt-2 mb-2">
                    <input type="checkbox" name="customCheck${user.id}" class="custom-control-input emp-checkbox" value="${user.id}" id="customCheck1">
                    <label class="custom-control-label" name="customCheck${user.id}" for="customCheck${user.id}">${user.name}</label>
                </div>
            `);
        })
    };
    //Closing the modals
    $(document).on("click", ".closer", function () {
        clearInputs();
    });
    //opening Assigning Modal 
    $(document).on("click", ".employees", function () {
        fetchUsers("Assign");
    });
    //toggling project
    $(".project-add-btn").click(function (e) {
        //fetch users.
        fetchUsers("Assmanager");
        var toggleText = $('.toggleproject').text();
        if (toggleText === "Create Project") {
            $('.project-inputs').removeClass('d-none');
            $('.project-contents').addClass('d-none');
            $("#submit-project-btn").attr("data-edit") !== "no" ?
                $("#submit-project-btn").attr("data-edit", "no").html(`<i class="fa fa-arrow-right"></i> Submit Project`) : null;
            $(this).html(`
                    <i class="fa fa-arrow-circle-o-left"></i>
                    <span class="toggleproject">Return</span>
                    `);
        } else {
            $(this).html(`
                    <i class="fa fa-plus"></i>
                    <span class="toggleproject">Create Project</span>
                    `);
            $('.project-inputs').addClass('d-none');
            $('.project-contents').removeClass('d-none');
        }
    });

    //toggling between pending and closed projects
    $(".pending-proj-btn").click(function () {
        $(this).addClass("active");
        $(".closed-proj-btn").removeClass("active");
        $(".pending-proj-container").removeClass("d-none");
        $(".closed-proj-container").addClass("d-none");
    });
    $(".closed-proj-btn").click(function () {
        $(this).addClass("active");
        $(".pending-proj-btn").removeClass("active");
        $(".pending-proj-container").addClass("d-none");
        $(".closed-proj-container").removeClass("d-none");
    });

    //-----------------CRUD Projetcs-----------------------
    //Create Project and Updating Project
    $("#projectForm").submit(function (e) {
        e.preventDefault();
        $("#submit-project-btn").prop("disabled", true).html("Submiting...");
        var actionURL;
        $("#submit-project-btn").attr("data-edit") === "no" ?
            actionURL = "project/create" :
            actionURL = "project/update";
        var projectData = new FormData();
        $.each(this, function(i, v){
            var input = $(v);
            projectData.append(input.attr("name"), input.val());
            // delete projectData["undefined"];
        });
        console.log(projectData);
        $.when(postRequest(actionURL, projectData)).done(response => {
            renderProjects(response);
            if ($("#submit-project-btn").attr("data-edit") === "no") {
                notification("Project created successfully", "success");
                $("#submit-project-btn")
                    .prop("disabled", false)
                    .html(`<i class="fa fa-arrow-right"></i> Submit Project`);
            } else {
                notification("Updated successfully", "success");
                $("#submit-project-btn")
                    .attr("data-edit", "no")
                    .prop("disabled", false)
                    .html(`<i class="fa fa-arrow-right"></i> Submit Project`);
            }
            // clearInputs();
        }).fail(error => {
            notification("An error occuired", "warning");
            $("#submit-project-btn")
                .prop("disabled", false)
                .html(`<i class="fa fa-arrow-right"></i> Submit Project`);
            console.log(error);
        });
    });

    //Editing project
    $(document).on("click", ".edit-project", function () {
        $('.project-inputs').removeClass('d-none');
        $('.project-contents').addClass('d-none');
        $("#submit-project-btn").attr("data-edit", "yes").html(`<i class="fa fa-save"></i> Save Project`);
        $(".project-add-btn").html(`
                <i class="fa fa-arrow-circle-o-left"></i>
                <span class="toggleproject">Return</span>
            `);
    });



    //Fetching Projects
    const fetchProjects = () => {
        $.when(getRequest("projects/fetch")).done(response => {
            renderProjects(response);
        }).fail(error => {
            notification("Couldn't fetch data", "warning")
            console.log(error);
        });
    };
    fetchProjects();

    //Rendering Projects
    const renderProjects = (projectData) => {
        console.log(projectData);
    }

    //Delete Project
    $(document).on("click", ".delete-project", function () {
        var projectId = $(this).attr("data-id");
        $(this).prop("disabled", true).html("wait...");
        notification("Deleting....", "info", 3000);
        $.when(deleteRequest("projects/delete", projectId)).done(response => {
            renderProjects(response);
            notification("Deleted Successfully", "success");
            $(this).prop("disabled", false).html('<i class="fa fa-times"></i>');
        }).fail(error => {
            notification("Not deleted", "warning");
            console.log(error);
            $(this).prop("disabled", false).html('<i class="fa fa-times"></i>');
        });
    });

    //assign Employee to project
    $("#assign-emp").submit(function (e) {
        e.preventDefault();
        var empData = $(this).serialize();
        console.log(empData);
        $.when(postRequest("project/assign", empData)).done(response => {
            console.log(response);
            clearInputs();
        }).fail(error => {
            clearInputs();
            notification("An error occuired", "warning");
            console.log(error);
        });
    });

    //Close Project
    $(document).on("click", ".close-project", function () {
        var projectId = $(this).attr("data-id");
        $(this).prop("disable", true).html("wait...");
        $.when(postRequest("project/close", projectId)).done(response => {
            renderProjects(response);
            notification("Project closed successfully", "success");
            $(this).prop("disabled", false).html('<i class="fa fa-check"></i>');
        }).fail(error => {
            console.log(error);
            $(this).prop("disabled", false).html('<i class="fa fa-check"></i>');
            notification("Error occuired", "warning");
        });
    });
})