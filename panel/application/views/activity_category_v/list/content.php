<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                Etkinlik Kategori Listesi
                <a href="<?= base_url("activity_category/new_form"); ?>" class="btn btn-outline btn-primary btn-sm float-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
            </h4>
        </div>
        <div class="col-md-12">
            <div class="widget p-lg">
                <?php if (empty($items)) : ?>
                    <div class="alert alert-info text-center">
                        <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?= base_url("portfolio_categories/new_form"); ?>">tıklayınız</a></p>
                    </div>
                <?php else : ?>
                    <table class="table table-hover table-striped table-bordered content-container">
                        <thead>
                            <th class="w50">#id</th>
                            <th>Başlık</th>
                            <th>Durumu</th>
                            <th>İşlem</th>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item) : ?>
                                <tr id="ord-<?= $item->id; ?>">
                                    <td class="w50 text-center">#<?= $item->id; ?></td>
                                    <td><?= $item->title; ?></td>
                                    <td class="text-center w100">
                                        <input data-url="<?= base_url("activity_category/isActiveSetter/$item->id"); ?>" class="isActive" type="checkbox" data-switchery data-color="#10c469" <?= ($item->isActive) ? "checked" : ""; ?> />
                                    </td>
                                    <td class="text-center w200">
                                        <button data-url="<?= base_url("activity_category/delete/$item->id"); ?>" class="btn btn-sm btn-danger btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
                                        <a href="<?= base_url("activity_category/update_form/$item->id"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Düzenle</a>
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