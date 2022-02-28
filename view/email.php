<div class="alert alert-info d-none" id="status"></div>
<div class="container">
    <form id="emailForm">
        <div class="form-group">
            <label for="oldemail">Enter your old email address</label>
            <input type="email" id="oldemail" name="oldemail" class="form-control" required maxlength="30"/>
        </div>
        <div class="form-group">
            <label for="newemail">Enter your new email address</label>
            <input type="email" id="newemail" name="newemail" class="form-control" required maxlength="30"/>
        </div>

        <button class="btn btn-primary mt-5" type="submit" name="submit" value="submit">Change email address</button>
    </form>
</div>

<script>
    $("#emailForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "ajax/change_email.php",
            data: {
                oldemail: $("#oldemail").val(),
                newemail: $("#newemail").val(),
                uid: <?php echo $_SESSION["uid"]; ?>
            },
            success: function(e) {

                $("#status").removeClass("d-none").text("Successfully changed email.Redirecting...");
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