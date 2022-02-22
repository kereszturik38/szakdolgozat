<?php

if($numberOfPages != 1):


if($pageNum == 0){
    $prevPage = 0;
    $nextPage = 1;
}else{
    $prevPage = $pageNum-1;
    $nextPage = $pageNum+1;
}

?>
<ul class="pagination d-flex">
    <li class="page-item"><a class="page-link" href="index.php?<?php echo "page=search&pageNum={$prevPage}&select={$select}&search={$searchRaw}" ?>">Previous</a></li>
    <li class="page-item active"><a class="page-link"><?php echo $pageNum+1 ?></a></li>
    <li class="page-item"><a class="page-link" href="index.php?<?php echo "page=search&pageNum={$nextPage}&select={$select}&search={$searchRaw}" ?>">Next</a></li>
</ul>

<?php endif ?>