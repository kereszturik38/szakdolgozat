<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <form action="index.php" method="get">
            <input type="hidden" name="page" value="search" />
            <input type="hidden" name="pageNum" value="0" />
            <div class="text-center text-white input-group">

                <input type="text" class="form-control-lg form-control" name="search" placeholder="Search...">
                <select class="form-select-md form-select" name="select">
                    <option selected="true" disabled="disabled">Select filter</option>
                    <option>Title</option>
                    <option>Image</option>
                    <option>Video</option>
                    <option>Private</option>
                    <option>Uploader</option>
                </select>
                <button type="submit" class="btn btn-lg btn-success">
                <i class=" bi-search em-1"></i>
                </button>

            </div>
        </form>
    </div>
</header>

<div class="d-grid gap-3">