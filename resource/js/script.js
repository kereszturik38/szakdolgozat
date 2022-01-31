$(document).ready(function() {
    $(document).on("click",".card-img",function(e) {
        src = $(e.target).attr("src");
        alert(src);
    });
});
