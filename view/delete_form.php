<div class="alert alert-info d-none" id="status"></div>
<div class="container w-50">
    <h3>Are you sure you wish to delete this post?</h3>
    <media src=<?php echo fetch_file($p); ?> class="w-50" />
    <form id="deleteForm">
        <div class="form-group">
            <label for="password">Enter your password to confirm deletion</label>
            <input type="password" id="password" name="password" class="form-control" required maxlength="32"/>
        </div>

        <button class="btn btn-primary mt-5" type="submit" name="submit" value="submit">Yes,delete this post</button>

    </form>
</div>

<script>
    $("#deleteForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"ajax/delete_post.php",
            data:{
                postid: <?php echo $pid; ?>,
                uid: <?php echo $request_uid; ?>
            },
            success: function(e){
                $("#status").removeClass("d-none").text("Successfully deleted post.Redirecting...");
                setTimeout(function(){
                    window.location.href="index.php";
                },1000);

            },
            error: function(e){
                console.log(e);
            }

        })
    })

</script>