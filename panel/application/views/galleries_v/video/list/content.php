<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                <b><?= $gallery->title ?></b> galerisine ait videolar
                <a href="<?= base_url("galleries/new_gallery_video_form/$gallery->id"); ?>" class="btn btn-outline btn-primary btn-sm float-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
            </h4>
        </div>
        <div class="col-md-12">
            <div class="widget p-lg">

                <?php if (empty($items)) : ?>

                    <div class="alert alert-info text-center">
                        <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?= base_url("galleries/new_gallery_video_form/$gallery->id"); ?>">tıklayınız</a></p>
                    </div>

                <?php else : ?>

                    <table class="table table-hover table-striped table-bordered content-container">
                        <thead>
                            <th class="order"><i class="fa fa-reorder"></i></th>
                            <th class="w50">#id</th>
                            <th>url</th>
                            <th>Görsel</th>
                            <th>Durumu</th>
                            <th>İşlem</th>
                        </thead>
                        <tbody class="sortable" data-url="<?= base_url("galleries/rankGalleryVideoSetter"); ?>">

                            <?php foreach ($items as $item) : ?>

                                <tr id="ord-<?= $item->id; ?>">
                                    <td class="order"><i class="fa fa-reorder"></i></td>
                                    <td class="w50 text-center">#<?= $item->id; ?></td>
                                    <td class="text-center"><?= $item->url; ?></td>
                                    <td class="text-center w100">
                                        <iframe width="100" src="//www.youtube.com/embed/<?= $item->url; ?>" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen>

                                        </iframe>
                                    </td>
                                    <td class="text-center w100">
                                        <input data-url="<?= base_url("galleries/galleryVideoIsActiveSetter/$item->id"); ?>" class="isActive" type="checkbox" data-switchery data-color="#10c469" <?= ($item->isActive) ? "checked" : ""; ?> />
                                    </td>
                                    <td class="text-center w200">
                                        <button data-url="<?= base_url("galleries/galleryVideoDelete/$item->id/$item->gallery_id"); ?>" class="btn btn-sm btn-danger btn-outline remove-btn">
                                            <i class="fa fa-trash"></i> Sil
                                        </button>
                                        <a href="<?= base_url("galleries/update_gallery_video_form/$item->id"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Düzenle</a>
                                    </td>
                                </tr>

                            <?php endforeach ?>

                        </tbody>

                    </table>

                <?php endif ?>

            </div>
        </div>
    </div>
</div>