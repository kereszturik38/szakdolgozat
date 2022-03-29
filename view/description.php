<div class="alert alert-info d-none" id="status"></div>
<div class="container">
    <form id="descriptionForm">
        <div class="form-group">
            <label for="newdesc">Enter new description for post*</label>
            <input type="text" id="newdesc" name="newdesc" class="form-control" required maxlength="50" rows="5" cols="50" placeholder="<?php echo $p->get_description(); ?>"/>
        </div>
        <button class="btn btn-primary mt-5" type="submit" name="submit" value="submit">Change description</button>
    </form>
</div>

<script>
    $("#descriptionForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "ajax/change_description.php",
            data: {
                newdesc: $("#newdesc").val(),
                pid: <?php echo $pid ?>
            },
            success: function(e) {

                $("#status").removeClass("d-none").text("Successfully changed description.Redirecting...");
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