<section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src=<?php echo $imgstr ?> alt="..." /></div>
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder"><?php echo $p->get_title() ?></h1>
                        <div class="fs-5 mb-5">
                            <span><a class="link-success text-decoration-none" href="#"><?php echo $u->get_username(); ?></a></span><br>
                            <i class="bi-bookmark em-1"><span class="badge badge-secondary bg-dark"><?php echo $p->get_bookmark_count() ?></span></i>
                        </div>
                        
                        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                        <div class="d-flex">
                            <button class="btn btn-outline-dark flex-shrink-0" type="button">
                                <i class="bi-bookmark em-1"></i>
                                Add to bookmarks
                                
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <h2>Comments <span class="badge badge-secondary bg-dark"><?php echo $p->get_comment_count() ?></span></h2>
                    
                </div>
            </div>
        </section>