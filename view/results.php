<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

        <div class="col mb-5">
            <div class="card h-100">
                <!-- File type badge -->
                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><i class="bi-image em-1"></i></div>
                <!-- Post image-->
                <img class="card-img-top" src="<?php echo $imgstr; ?>" alt="..." />
                <!-- Post details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder"><?php $p->get_title() ?></h5>
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View</a></div>
                </div>
            </div>
        </div>
    </div>
</div>