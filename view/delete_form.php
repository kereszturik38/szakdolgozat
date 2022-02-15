<div id="status"></div>
<div class="container w-50">
    <h3>Are you sure you wish to delete this post?</h3>
    <form id="deleteForm">
        <div class="form-group">
            <label for="password">Enter your password to confirm deletion</label>
            <input type="password" id="password" name="password" class="form-control" required/>
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

            }

        })
    })

</script>