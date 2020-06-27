<?php if (empty($item_images)) : ?>
    <div class="alert alert-info text-center">
        <p>Burada herhangi bir resim bulunmamaktadır.</a></p>
    </div>
<?php else : ?>
    <table class="table table-bordered table-striped table-hover pictures_list">
        <thead>
            <th class="order"><i class="fa fa-reorder"></i></th>
            <th>#id</th>
            <th>Görsel</th>
            <th>Resim Adı</th>
            <th>Durumu</th>
            <th>Kapak</th>
            <th>İşlem</th>
        </thead>
        <tbody class="sortable" data-url="<?= base_url("portfolio/imageRankSetter"); ?>">
            <?php foreach ($item_images as $image) : ?>
                <tr id="ord-<?= $image->id; ?>">
                    <td class="order"><i class="fa fa-reorder"></i></td>
                    <td class="w50 text-center">#<?= $image->id; ?></td>
                    <td class="w100 text-center">
                        <img width="30" src="<?= get_picture($viewFolder, $image->img_url, "255x157"); ?>" alt="<?= $image->img_url; ?>" class="img-responsive">
                    </td>
                    <td><?= $image->img_url; ?></td>
                    <td class="w100 text-center">
                        <input data-url="<?= base_url("portfolio/imageIsActiveSetter/$image->id"); ?>" class="isActive" type="checkbox" data-switchery data-color="#10c469" <?= ($image->isActive) ? "checked" : ""; ?> />
                    </td>
                    <td class="w100 text-center">
                        <input data-url="<?= base_url("portfolio/isCoverSetter/$image->id/$image->portfolio_id"); ?>" class="isCover" type="checkbox" data-switchery data-color="#ff5b5b" <?= ($image->isCover) ? "checked" : ""; ?> />
                    </td>
                    <td class="w100 text-center">
                        <button data-url="<?= base_url("portfolio/imageDelete/$image->id/$image->portfolio_id"); ?>" class="btn btn-sm btn-danger btn-outline remove-btn btn-block">
                            <i class="fa fa-trash"></i> Sil
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>