<div class="alert alert-info d-none" id="status"></div>
<div class="container">
    <form id="usernameForm">
        <div class="form-group">
            <label for="password">Enter your old username</label>
            <input type="text" id="olduser" name="olduser" class="form-control" required maxlength="30"/>
        </div>
        <div class="form-group">
            <label for="password">Enter your new username</label>
            <input type="text" id="newuser" name="newuser" class="form-control" required maxlength="30"/>
        </div>

        <button class="btn btn-primary mt-5" type="submit" name="submit" value="submit">Change username</button>
    </form>
</div>

<script>
    $("#usernameForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "ajax/change_username.php",
            data: {
                olduser: $("#olduser").val(),
                newuser: $("#newuser").val(),
                uid: <?php echo $_SESSION["uid"]; ?>
            },
            success: function(e) {

                $("#status").removeClass("d-none").text("Successfully changed username.Redirecting...");
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