$(document).ready(function(){
    // toggling expences forms
    $(".project-expense").click(function (e) {
        var toggleText = $('.togglexpe').text();
        if (toggleText === "Add Expense") {
            $('.expense-inputs').removeClass('d-none');
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
            $('.expense-inputs').addClass('d-none');
            $('.expenses-contents').removeClass('toggleForms');
        }
    });
    //toggling project
    $(".project-add-btn").click(function(e) {
        var toggleText = $('.toggleproject').text();
        if (toggleText === "Create Project") {
            $('.project-inputs').removeClass('d-none');
            $('.project-contents').addClass('d-none');
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
});