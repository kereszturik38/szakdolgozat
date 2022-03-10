<div class="container mx-auto w-50">
    <form action="?page=pfp" method="post" enctype="multipart/form-data">


        <div class="form-group">
        <label for="pfpToUpload">Profile Picture File</label>
        <input type="file" name="pfpToUpload" id="pfpToUpload" class="form-control" required/>
        <small>Note: your file upload limit is <?php echo $UPLOAD_LIMIT_BY_LEVEL[$_SESSION["level"]]/1000000 . " mb"; ?></small>
        </div>
        
        <button class="btn btn-primary mt-5" type="submit" name="submit" value="submit">Upload</button>

    </form>

</div>