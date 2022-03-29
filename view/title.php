<div class="alert alert-info d-none" id="status"></div>
<div class="container">
    <form id="titleForm">
        <div class="form-group">
            <label for="newtitle">Enter new title for post*</label>
            <input type="text" id="newtitle" name="newtitle" class="form-control" required maxlength="30" rows="5" cols="50" placeholder="<?php echo $p->get_title();?>"/>
        </div>
        <button class="btn btn-primary mt-5" type="submit" name="submit" value="submit">Change title</button>
    </form>
</div>

<script>
    $("#titleForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "ajax/change_title.php",
            data: {
                newtitle: $("#newtitle").val(),
                pid: <?php echo $pid ?>
            },
            success: function(e) {

                $("#status").removeClass("d-none").text("Successfully changed title.Redirecting...");
                setTimeout(function() {
                    window.location.href = "index.php?page=post&id=<?php echo $pid ?>";
                }, 1000);



            },
            error: function(e) {
                console.log(e);
            }

        })
    })
</script>