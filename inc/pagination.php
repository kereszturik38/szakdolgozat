<?php
$lastPage = $numberOfPages - 1;

if($numberOfPages != 0):
    if($pageNum+1 >= $numberOfPages){
        $nextPageExtraClass = " disabled ";
    }

if($pageNum == 0){
    $prevPageExtraClass = " disabled ";
    $prevPage = 0;
    $nextPage = 1;
}else{
    $prevPage = $pageNum-1;
    $nextPage = $pageNum+1;
}

?>
<div class="container d-flex align-items-center justify-content-center mt-5">
    <ul class="pagination">
        <li class="page-item <?php echo $prevPageExtraClass  ?>"><a class="page-link" href="index.php?<?php echo "page=search&pageNum={$prevPage}&select={$select}&search={$searchRaw}" ?>">Previous</a></li>
        <li class="page-item active"><a class="page-link"><?php echo $pageNum+1 ?></a></li>
    <?php if($pageNum != $lastPage): ?>
        <li class="page-item"><a class="page-link">..</a></li>
        <li class="page-item"><a class="page-link" href="index.php?<?php echo "page=search&pageNum={$lastPage}&select={$select}&search={$searchRaw}" ?>"><?php echo $numberOfPages; ?></a></li>
    <?php endif ?>
        <li class="page-item <?php echo $nextPageExtraClass  ?>"><a class="page-link" href="index.php?<?php echo "page=search&pageNum={$nextPage}&select={$select}&search={$searchRaw}" ?>">Next</a></li>
    </ul>
</div>
<?php endif ?>