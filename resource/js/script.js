$(document).ready(function() {

    $(document).on("click",".card-img",function(e) {
        src = $(e.target).attr("data-postid");
        window.location.href = "index.php?page=post&id=" + src;
    });
});
