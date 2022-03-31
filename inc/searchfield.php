<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <form action="index.php" method="get">
            <input type="hidden" name="page" value="search" />
            <input type="hidden" name="pageNum" value="0" />
            <div class="text-center text-white input-group">

                <input type="text" class="form-control-lg form-control" name="search" placeholder="Search...">
                <select class="form-select-md form-select" name="select" id="selectDropdown">
                    <option selected="true" value="default" name="default">Select filter</option>
                    <option value="title" name="title">Title</option>
                    <option value="image" name="image">Image</option>
                    <option value="video" name="video">Video</option>
                    <option value="private" name="private">Private</option>
                    <option value="uploader" name="uploader">Uploader</option>
                </select>
                <button type="submit" class="btn btn-lg btn-success" id="searchBtn">
                <i class=" bi-search em-1"></i>
                </button>

            </div>
        </form>
    </div>
</header>

<script>
    $(document).ready(() => {
        $("#searchBtn").attr("disabled",true);

        $("#selectDropdown").on('change',() =>{
            
            let selected = $("#selectDropdown").val();
            if(selected==="default"){
                $("#searchBtn").attr("disabled",true);
            }else{
                $("#searchBtn").attr("disabled",false);
            }
        })
    })
    


</script>

<div class="d-grid gap-3">