$('.show_confirm_deletebook').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `Are you sure you want to delete this book?`,
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
});

$('.show_confirm').click(function (event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `Are you sure you want to delete this user?`,
        /*text: "If you delete this, it will be gone forever.",*/
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
});

$('.show_confirm_role').click(function (event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `Are you sure you want to change this user's role?`,
        /*text: "If you delete this, it will be gone forever.",*/
        icon: "info",
        buttons: true,
    })
        .then((value) => {
            if (value) {
                form.submit();
            }
        });
});


$('.show_confirm_newbook').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    if ( document.forms['formNewBook'].reportValidity()){
    swal({
        title: `Do you want to create a new book?`,
        icon: "info",
        buttons: true,
    })
        .then((value) => {
            if (value) {
                form.submit();
            }
        });
    }
});

$('.show_confirm_editbook').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    if ( document.forms['formEditBook'].reportValidity()){
        swal({
            title: `Do you want to edit this book?`,
            icon: "info",
            buttons: true,
        })
            .then((value) => {
                if (value) {
                    form.submit();
                }
            });
    }
});

$('.show_confirm_activityTheme').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    if ( document.forms['formActivityTypeCreate'].reportValidity()){
        swal({
            title: `Do you want to create this new activity theme?`,
            icon: "info",
            buttons: true,
        })
            .then((value) => {
                if (value) {
                    form.submit();
                }
            });
    }
});

$('.show_confirm_activityThemeEdit').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    if ( document.forms['formActivityTypeEdit'].reportValidity()){
        swal({
            title: `Do you want to edit this activity theme?`,
            icon: "info",
            buttons: true,
        })
            .then((value) => {
                if (value) {
                    form.submit();
                }
            });
    }
});

$('.show_confirm_author').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    if ( document.forms['formAuthorCreate'].reportValidity()){
        swal({
            title: `Do you want to create this new author?`,
            icon: "info",
            buttons: true,
        })
            .then((value) => {
                if (value) {
                    form.submit();
                }
            });
    }
});

$('.show_confirm_authorEdit').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    if ( document.forms['formAuthorEdit'].reportValidity()){
        swal({
            title: `Do you want to edit this author?`,
            icon: "info",
            buttons: true,
        })
            .then((value) => {
                if (value) {
                    form.submit();
                }
            });
    }
});



$('.show_confirm_theme').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    if ( document.forms['formThemeCreate'].reportValidity()){
        swal({
            title: `Do you want to create this new book theme?`,
            icon: "info",
            buttons: true,
        })
            .then((value) => {
                if (value) {
                    form.submit();
                }
            });
    }
});


$('.show_confirm_themeEdit').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    if ( document.forms['formThemeEdit'].reportValidity()){
        swal({
            title: `Do you want to edit this book theme?`,
            icon: "info",
            buttons: true,
        })
            .then((value) => {
                if (value) {
                    form.submit();
                }
            });
    }
});

$('.show_confirm_ageGroup').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    if ( document.forms['formAgeGroupCreate'].reportValidity()){
        swal({
            title: `Do you want to create this new age group?`,
            icon: "info",
            buttons: true,
        })
            .then((value) => {
                if (value) {
                    form.submit();
                }
            });
    }
});

$('.show_confirm_ageGroupEdit').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    if ( document.forms['formAgeGroupEdit'].reportValidity()){
        swal({
            title: `Do you want to edit this age group?`,
            icon: "info",
            buttons: true,
        })
            .then((value) => {
                if (value) {
                    form.submit();
                }
            });
    }
});


$('.show_confirm_itemAdminHome').click(function (event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `Are you sure you want to delete this item?`,
        /*text: "If you delete this, it will be gone forever.",*/
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
});

$('.show_confirm_edituser').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    if ( document.forms['formEditUser'].reportValidity()){
        swal({
            title: `Do you want to edit your profile?`,
            icon: "info",
            buttons: true,
        })
            .then((value) => {
                if (value) {
                    form.submit();
                }
            });
    }
});

$('.show_confirm_newaudio').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    if ( document.forms['formNewAudio'].reportValidity()){
        swal({
            title: `Do you want to create a  new audio?`,
            icon: "info",
            buttons: true,
        })
            .then((value) => {
                if (value) {
                    form.submit();
                }
            });
    }
});

$('.show_confirm_deleteaudio').click(function (event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `Are you sure you want to delete this audio?`,
        /*text: "If you delete this, it will be gone forever.",*/
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
});
