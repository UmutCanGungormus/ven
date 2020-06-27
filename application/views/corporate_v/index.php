<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-details-inner">
                    <div class="blog-detail-title">
                        <h2><?= $item->title ?></h2>
                        <p><?= $item->title ?> <span>- <?= date("d/m/Y", strtotime($item->createdAt)); ?></span></p>
                    </div>
                    <div class="blog-large-pic">
                        <img src="<?= base_url("panel/uploads/references_v/555x343/".$item->img_url)?>" alt="">
                    </div>
                    <div class="blog-detail-desc blog-quote">
                        <p>
                            <?=$item->description?>
                        </p>
                    </div>
                  
            

                </div>
            </div>
        </div>
    </div>
</section>