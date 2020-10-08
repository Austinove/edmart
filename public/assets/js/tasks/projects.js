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
                    <input type="checkbox" name="customCheck${user.id}" class="custom-control-input emp-checkbox" value="${user.id}" id="customCheck${user.id}">
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
    //toggling project inputs
    $(".project-add-btn").click(function (e) {
        var toggleText = $('.toggleproject').text();
        if (toggleText === "Create Project") {
            //fetch users.
            fetchUsers("Assmanager");
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
        });
        $.when(postRequest(actionURL, projectData)).done(response => {
            console.log('done response->', response)
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
            clearInputs();
        }).fail(error => {
            notification("An error occuired", "warning");
            $("#submit-project-btn")
                .prop("disabled", false)
                .html(`<i class="fa fa-arrow-right"></i> Submit Project`);
            console.log("error response->",error);
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
            console.log(response);
            renderProjects(response);
        }).fail(error => {
            notification("Couldn't fetch data", "warning")
            console.log(error);
        });
    };
    fetchProjects();

    //Rendering Projects
    const renderProjects = (projectData) => {
        console.log("render called",projectData);
        $(".project-card-content").html(`
            <div class="col-md-12 col-sm-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="mb-2 text-center">
                            <h5 class="card-title mb-0 text-info">No project founds</h5>
                        </div>
                    </div>
                </div>
            </div>
        `);
        response.forEach(project => {
            $(".project-card-content").html(`
                    <div class="col-md-6 col-sm-6">
                        <div class="card custom-card ">
                            <div class="mt-2 pr-2 pl-2">
                                <button class="btn btn-sm btn-outline-warning data-id="${project.id}" btn-sm mr-0 delete-project" data-id="1" data-toggle="tooltip" data-placement="top" title="Delete Project"><i class="fa fa-times"></i></button>
                                <button class="btn btn-sm btn-outline-primary data-id="${project.id}" btn-sm mr-0 edit-project" data-id="1" data-toggle="tooltip" data-placement="top" title="Edit Project"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-outline-success data-id="${project.id}" btn-sm close-project" data-toggle="tooltip" data-placement="top" title="Close Project"><i class="fa fa-check"></i></button>
                                <a href="{{route('project-expenses')}}" class="browse-add-exp btn-neutral btn-sm float-right ml-1" data-toggle="tooltip" data-placement="top" title="Check Expenses"><i class="fa fa-plus-circle" aria-hidden="true"></i> Expenses</a>
                                <a href="#"
                                    class="browse-add-exp btn-neutral btn-sm float-right employees" 
                                    data-toggle="modal" data-target="#projectEmployee">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Employee
                                </a>
                            </div>
                            <hr class="mb-1 mt-1"/>
                            <div class="card-body">
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Client</h5>
                                    <p class="card-text font-13 custom-color">${project.client}</p>
                                </div>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Assistant Project Manager</h5>
                                    <p class="card-text font-13">${project.Assmanager}</p>
                                </div>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Project Title</h5>
                                    <p class="card-text font-13">${project.title}</p>
                                </div>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Commencement Date</h5>
                                    <p class="card-text font-13">${project.commencement}</p>
                                </div>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Completion Date</h5>
                                    <p class="card-text font-13">${project.completion}</p>
                                </div>
                                <hr class="mb-1 mt-3"/>
                                <div class="row mb-2">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h5 class="card-title mb-0">Current Expenses</h5>
                                        <p class="card-text"><span class="badge badge-warning">3,000,000 UGX</span></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h5 class="card-title mb-0">Expected Amount</h5>
                                        <p class="card-text"><span class="badge badge-success">3,000,000 UGX</span></p>
                                    </div>
                                </div>
                                <hr class="mb-1 mt-1"/>
                                <div class="progress-wrapper">
                                    <div class="progress-info">
                                        <div class="progress-label">
                                            <span>days used</span>
                                        </div>
                                        <div class="progress-percentage">
                                            <span class="font-13">60%</span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-outline-secondary custom-btn-black btn-sm float-right" data-toggle="modal" data-target=".expenses-details">More...</a>
                            </div>
                        </div>
                    </div>
                `);
        });
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