<style type="text/css">
    .sidebar li.active>a {
        background: {{ auth()->user()->company->sub_color }} 0% 0% no-repeat padding-box !important;
    }
    .sidebar li.active>a {
        color: {{ auth()->user()->company->main_color }} !important;
    }
    .sidebar li.active>a i {
        color: {{ auth()->user()->company->main_color }} !important;
    }
    /* button.dropdown-toggle[data-id="error_message"] {
        background-color: {{ auth()->user()->company->other_color }};
    } */
    .btn-success,
    .card-header-success,
    .project-action button[data-action="0"],
    span.update-action[data-action="0"] {
        background-color: {{ auth()->user()->company->main_color }} !important;
    }
    .btn-success:hover,
    .project-action button[data-action="1"],
    .bg-success-light,
    span.update-action[data-action="1"] {
        background-color: {{ auth()->user()->company->sub_color }} !important;
    }
    .btn-danger {
        background-color: {{ auth()->user()->company->other_color }} !important;
    }
    .btn-danger:hover {
        background-color: {{ auth()->user()->company->other_color }}77 !important;
    }
    .text-success {
        color: {{ auth()->user()->company->main_color }} !important;
    }
    .btn-light-success {
        background-color: {{ auth()->user()->company->sub_color }} !important;
    }
    
    .btn-link {
        background-color: transparent !important;
    }
</style>