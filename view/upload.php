<div class="container mx-auto w-50">
    <form action="?page=upload" method="post" enctype="multipart/form-data">

        <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" class="form-control"/>
        </div>

        <div class="form-group">
        <label for="fileToUpload">File</label>
        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control"/>
        <small>Note: your file upload limit is </small>
        </div>

        <div class="form-check">
        <input type="checkbox" class="form-check-input" id="publicCheck" name="publicCheck" checked>
        <label class="form-check-label" for="publicCheck">This post is public</label>
        </div>

        
        <button class="btn btn-primary mt-5" type="submit" name="submit" value="submit">Upload</button>

    </form>

</div>