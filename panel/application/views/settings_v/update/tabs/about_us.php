<div role="tabpanel" class="tab-pane fade p-4" id="tab-2">
	<div class="row">
		<div class="form-group col-md-12">
			<label>Hakkımızda</label>
			<textarea name="about_us" class="m-0 tinymce"  data-options="{height: 250}">
				<?= isset($form_error) ? set_value("about_us") : $item->about_us; ?>
			</textarea>
		</div>
	</div>
</div>