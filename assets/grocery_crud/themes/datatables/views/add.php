<?php

	$this->set_css($this->default_theme_path.'/datatables/css/datatables.css');
    $this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.form.min.js');
	$this->set_js_config($this->default_theme_path.'/datatables/js/datatables-add.js');
	$this->set_css($this->default_css_path.'/ui/simple/'.grocery_CRUD::JQUERY_UI_CSS);
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/ui/'.grocery_CRUD::JQUERY_UI_JS);

	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.noty.js');
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
?>
<div class='col-md-12 col-lg-12'>
	<h3>
		<div class='floatL form-title-left'>
			<a href="#"><?php echo $this->l('form_add'); ?> <?php echo $subject?></a>
		</div>
		<div class='clear'></div>
	</h3>
<div class='form-content form-div'>
	<?php echo form_open( $insert_url, 'method="post" id="crudForm" enctype="multipart/form-data" class="form-horizontal"'); ?>
		<div style="padding-left: 24px">
			<?php
			$counter = 0;
				foreach($fields as $field)
				{
					$even_odd = $counter % 2 == 0 ? 'odd' : 'even';
					$counter++;
			?>
			<div class='form-group <?php echo $even_odd?>' id="<?php echo $field->field_name; ?>_field_box">
				<label  class='col-sm-2' id="<?php echo $field->field_name; ?>_display_as_box">
					<?php echo $input_fields[$field->field_name]->display_as?><?php echo ($input_fields[$field->field_name]->required)? "<span class='required'>*</span> " : ""?> :
				</label >
				<div class='col-sm-8' id="<?php echo $field->field_name; ?>_input_box">
					<?php echo $input_fields[$field->field_name]->input?>
				</div>
				<div class='clear'></div>
			</div>
			<?php }?>
			<!-- Start of hidden inputs -->
				<?php
					foreach($hidden_fields as $hidden_field){
						echo $hidden_field->input;
					}
				?>
			<!-- End of hidden inputs -->
			<?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" /><?php }?>
			<div class='line-1px'></div>
			<div id='report-error' class='report-div error'></div>
			<div id='report-success' class='report-div success'></div>
		</div>
		<div class='buttons-box'>
			<div class='form-button-box'>
				<input id="form-button-save" type='submit' value='<?php echo $this->l('form_save'); ?>' class='btn btn-primary'/>
			</div>
<?php 	if(!$this->unset_back_to_list) { ?>
			<div class='form-button-box'>
				<input type='button' value='<?php echo $this->l('form_save_and_go_back'); ?>' class='btn btn-primary' id="save-and-go-back-button"/>
			</div>
			<div class='form-button-box'>
				<input type='button' value='<?php echo $this->l('form_cancel'); ?>' class='btn btn-danger' id="cancel-button" />
			</div>
<?php   } ?>
			<div class='form-button-box loading-box'>
				<div class='small-loading' id='FormLoading'><?php echo $this->l('form_insert_loading'); ?></div>
			</div>
			<div class='clear'></div>
		</div>
	<?php echo form_close(); ?>
</div>
</div>
<script>
	var validation_url = '<?php echo $validation_url?>';
	var list_url = '<?php echo $list_url?>';

	var message_alert_add_form = "<?php echo $this->l('alert_add_form')?>";
	var message_insert_error = "<?php echo $this->l('insert_error')?>";
</script>