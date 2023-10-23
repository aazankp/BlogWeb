$(document).ready(function(){

    function ShowPosts() {
        $.ajax({
        url: "../vendor/Process.php?action=view_post", 
        type: "POST",
        success: function(result){
            $("#show_posts").html(result);
        }});
    }

    ShowPosts();

    $(document).on("submit", "#login_data", function(event) {
        event.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
        url: "../vendor/Process.php?action=login_data", 
        type: "POST",
        data: formdata,
        cache: false,
        processData: false,
        contentType: false,
        success: function(result){
            console.log(result);
            if (result == 1) {
                document.location.href = '../Blog Web/blog_web.php';
            }
            else if (result == 0) {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Your Username or Password is Incorrect!',
                })
            }
        }});
    });

    $(document).on("submit", "#registration_data", function(event) {
        event.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
        url: "../vendor/Process.php?action=registration_data", 
        type: "POST",
        data: formdata,
        cache: false,
        processData: false,
        contentType: false,
        success: function(result){
            console.log(result);
            if (result == 1) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your Data has been Submitted.',
                    showConfirmButton: false,
                    timer: 2000
                })
                $("#registration_data").trigger("reset");
            } else if (result == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something Wents Wrong!',
                })
            }
        }});
    });

    $(document).on("submit", "#publish_post", function(event) {
        event.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
        url: "../vendor/Process.php?action=publish_post", 
        type: "POST",
        data: formdata,
        cache: false,
        processData: false,
        contentType: false,
        success: function(result){
            console.log(result);
            if (result == 1) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your Post has been Uploaded.',
                    showConfirmButton: false,
                    timer: 2000
                })
                ShowPosts();
            } else if (result == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something Wents Wrong!',
                })
            }
        }});
    });

    $(document).on("submit", "#add_comment", function(event) {
        event.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
        url: "../vendor/Process.php?action=comments",
        type: "POST",
        data: formdata,
        cache: false,
        processData: false,
        contentType: false,
        success: function(result){
            console.log(result);
            if (result == 1) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Commented Successfully.',
                    showConfirmButton: false,
                    timer: 1000
                })
                $("#add_comment").trigger("reset");
            } else if (result == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something Wents Wrong!',
                })
            }
        }});
    });

    $(document).on("mouseenter", "#view_comments_id", function() {
        var view_comments_id = $(this).val();
        $.ajax({
        url: "../vendor/Process.php?action=view_comments",
        type: "POST",
        data: {view_comments_id : view_comments_id},
        success: function(result){
            $("#modal_body").html(result);
        }});
    });

});