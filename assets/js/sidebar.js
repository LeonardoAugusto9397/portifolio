$(document).ready(function() {
        $(".navbar-brand").on("click", function() {
        $("#sidebar").toggleClass("active");
        $(this).toggleClass("active");
    });
});