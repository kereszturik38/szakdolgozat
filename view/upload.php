<div class="container mx-auto w-50">
    <form action="?page=upload" method="post">

        <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" class="form-control"/>
        </div>

        <div class="form-group">
        <label for="fileToUpload">File</label>
        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control"/>
        </div>

        
        <button class="btn btn-primary mt-5" type="submit">Upload</button>

    </form>

</div>