<div class="container mx-auto w-50">
    <form action="?page=upload" method="post" enctype="multipart/form-data">

        <div class="form-group">
        <label for="title">Title*</label>
        <input type="text" id="title" name="title" class="form-control" required maxlength="30"/>
        </div>

        <div class="form-group">
        <label for="fileToUpload">File*</label>
        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required/>
        <small>Note: your file upload limit is <?php echo $UPLOAD_LIMIT_BY_LEVEL[$_SESSION["level"]]/1000000 . " mb"; ?></small>
        </div>

        <div class="form-group">
        <label for="description">Description (optional)</label>
        <input type="textarea" name="description" id="description" class="form-control" maxlength="50" rows="5" cols="50"/>
        </div>

        <div class="form-check">
        <input type="checkbox" class="form-check-input" id="publicCheck" name="publicCheck" value="public" checked>
        <label class="form-check-label" for="publicCheck">This post is public</label>
        </div>

        
        <button class="btn btn-primary mt-5" type="submit" name="submit" value="submit">Upload</button>

    </form>

</div>