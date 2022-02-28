<div class="alert alert-info d-none" id="status"></div>
<div class="container">
    <form id="pwForm">
        <div class="form-group">
            <label for="oldpw">Enter your old password</label>
            <input type="password" id="oldpw" name="oldpw" class="form-control" required maxlength="32"/>
        </div>
        <div class="form-group">
            <label for="newpw">Enter your new password</label>
            <input type="password" id="newpw" name="newpw" class="form-control" required maxlength="32"/>
        </div>

        <button class="btn btn-primary mt-5" type="submit" name="submit" value="submit">Change password</button>
    </form>
</div>

<script>
    $("#pwForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "ajax/change_password.php",
            data: {
                oldpw: $("#oldpw").val(),
                newpw: $("#newpw").val(),
                uid: <?php echo $_SESSION["uid"]; ?>
            },
            success: function(e) {

                $("#status").removeClass("d-none").text("Successfully changed password.Redirecting...");
                setTimeout(function() {
                    window.location.href = "index.php?page=logout";
                }, 1000);



            },
            error: function(e) {
                console.log(e);
            }

        })
    })
</script>