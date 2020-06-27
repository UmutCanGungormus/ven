<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                Film Listesi
                <a href="<?= base_url("cinema/new_form"); ?>" class="float-right btn btn-outline btn-primary btn-sm"><i class="fa fa-plus"></i>Yeni Ekle</a>
            </h4>
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget p-lg">
                <?php if (empty($items)) : ?>
                    <div class="alert alert-info text-center">
                        <h5 class="alert-title">Kayıt Bulunamadı</h5>
                        <p>Burada herhangi bir veri bulunmamaktadır. Ekleme için lütfen <a href="<?= base_url("cinema/new_form"); ?>">tıklayınız...</a></p>
                    </div>
                <?php else : ?>
                    <table class="table table-hover table-striped table-bordered content-container">

                        <thead>
                            <th class="order"><i class="fa fa-reorder"></i></th>
                            <th class="w50">#id</th>
                            <th>Başlık</th>
                            <th>Kategori</th>
                            <th>Görsel</th>
                            <th>Durumu</th>
                            <th>İşlem</th>
                        </thead>
                        <tbody class="sortable" data-url="<?= base_url("cinema/rankSetter"); ?>">
                            <?php foreach ($items as $item) : ?>
                                <tr id="ord-<?= $item->id; ?>">
                                    <td class="order"><i class="fa fa-reorder"></i></td>
                                    <td class="w50 text-center">#<?= $item->id; ?></td>
                                    <td><?= $item->title; ?></td>
                                    <td class="w200 text-center">
                                        <?php $cat = json_decode($item->category_id);

                                        foreach ($cat as $category) :
                                            echo " " . get_cinema_category_title($category);
                                        endforeach
                                        ?>
                                    </td>
                                    <td class="text-center w100">
                                        <img width="75" src="<?= get_picture($viewFolder, $item->img_url, "255x157"); ?>" alt="" class="img-fluid">
                                    </td>
                                    <td class="text-center w100">
                                        <input data-url="<?= base_url("cinema/isActiveSetter/$item->id"); ?>" class="isActive" type="checkbox" data-switchery data-color="#10c469" <?= ($item->isActive) ? "checked" : ""; ?> />
                                    </td>
                                    <td class="text-center w200">
                                        <button data-url="<?= base_url("cinema/delete/$item->id"); ?>" class="btn btn-sm btn-danger btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
                                        <a href="<?= base_url("cinema/update_form/$item->id"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Düzenle</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>

                    </table>
                <?php endif ?>
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
</div>