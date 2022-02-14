$(document).ready(function() {

    $(document).on("click",".enlargePost",function(e) {
        src = $(e.target).attr("src");
        window.open(src);
    });

    $(document).on("click",".result",function(e) {
        src = $(e.target).attr("data-postid");
        window.location.href = "index.php?page=post&id=" + src;
    });
});
