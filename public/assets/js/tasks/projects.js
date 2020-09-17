$(document).ready(function(){
    //-----------------CRUD Projetcs-----------------------
    //Create Project
    $.when(postRequest("projects/create", projectData)).done(response => {
        renderProjects(response);
        notification("Project created successfully", "success");
    }).fail(error => {
        notification("An error occuired", "warning");
        console.log(error);
    });
    
    //Fetching Projects
    $.when(getRequest("projects/fetch")).done(response => {
        renderProjects(response);
    }).fail(error => {
        notification("Couldn't fetch data", "warning")
        console.log(error);
    });
    //Rendering Projects
    const renderProjects = (project_data) => {
        console.log(project_data);
    }

    //Updating Project
    $.when(postRequest("projects/update", projectData)).done(response => {
        renderProjects(response);
        notification("Updated successfully", "success");
    }).fail(error => {
        notification("An error occuired", "warning");
        console.log(error);
    });
    
    //Delete Project
    $(document).on("click", ".delete-project", function(){
        $.when(deleteRequest("projects/delete", projectId)).done(response => {
            renderProjects(response);
            notification("Deleted Successfully", "success");
        }).fail(error => {
            notification("An error occuired", "warning");
        })
    });
})