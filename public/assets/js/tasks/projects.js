$(document).ready(function () {
    //toggling project
    $(".project-add-btn").click(function (e) {
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
            console.log($("#submit-project-btn").attr("data-edit"));
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
            actionURL = "projects/create" :
            actionURL = "projects/update";
        var projectData = $(this).serialize();
        $.when(postRequest(actionURL, projectData)).done(response => {
            renderProjects(response);
            if($("#submit-project-btn").attr("data-edit") === "no"){
                notification("Project created successfully", "success");
                $("#submit-project-btn")
                    .prop("disabled", false)
                    .html(`<i class="fa fa-arrow-right"></i> Submit Project`);
            }else{
                notification("Updated successfully", "success");
                $("#submit-project-btn")
                    .attr("data-edit", "no")
                    .prop("disabled", false)
                    .html(`<i class="fa fa-arrow-right"></i> Submit Project`);
            }
            
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
        console.log($("#submit-project-btn").attr("data-edit"));
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
    // fetchProjects();

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