<div role="tabpanel" class="tab-pane fade p-4" id="tab-8">
	<div class="row">
		<div class="form-group col-md-12">
			<label>Meta Keywords (Maks. 255 Karakter)</label>
			<textarea name="metakeyw" class="m-0 form-control tinymce"><?= isset($form_error) ? set_value("metakeyw") : $item->meta_keywords; ?></textarea>
		</div>
		<div class="form-group col-md-12">
			<label>Meta Description (Maks. 255 Karakter)</label>
			<textarea name="metadesc" class="m-0 form-control tinymce" ><?= isset($form_error) ? set_value("metadesc") : $item->meta_description; ?></textarea>
		</div>
	</div>
</div>