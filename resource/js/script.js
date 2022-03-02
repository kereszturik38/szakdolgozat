$(document).ready(function() {

    
    $('[data-bs-toggle="popover"]').popover();


    $(document).on("click",".enlargePost",(e)=>{
        e.preventDefault();
        if($(e.target).is("img")){
            src = $(e.target).attr("src");
        }else if($(e.target).is("video")){
            src = $('source').attr("src");
        }
        
        
        window.open(src);
    });

    $(document).on("click",".result",(e)=>{
        src = $(e.target).attr("data-postid");
        window.location.href = "index.php?page=post&id=" + src;
    });

    $(document).on("click","#shareBtn",(e)=>{
        let data = $(e.target).attr("data-clipboard-text");
        if(navigator.clipboard){
            navigator.clipboard.writeText(data);
        }
    })

    if(!navigator.clipboard){
        let clipboard = new ClipboardJS(".bi-share");
        clipboard.on("success",(e)=>{
        });
        clipboard.on('error', (e)=>{
            console.error('Action:', e.action);
            console.error('Trigger:', e.trigger);
        });
    }

    $("#loggedUser").click( () => {
        window.location.href="index.php?page=profile";
    })
});
