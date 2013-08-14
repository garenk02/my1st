	
<?php echo CIHtml::registerScriptBottom('
jQuery("table input[name=checkAll]").click(function() {
	jQuery("table input[type=checkbox]").prop("checked", this.checked);
});
jQuery("input[name=modelname]").bind("keyup change", function(){
	var controller=jQuery("input[name=controllername]");
	var modelname=$(this).val();
	if(!controller.data("changed")) {
		var modelClass="";
		jQuery.each(modelname.split("_model"), function() {
			if(this.length>0)
				modelClass+=this.substring(0,1)+this.substring(1);
		});
		controller.val(modelClass);
	}
});
'); ?>
<div class="row-fluid">
							<div class="span12">
								<h3>CRUD Generator</h3>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span12">
							
								<?php if(CIHtml::validationErrors() || $error!==''): ?>
								<div class="alert alert-error  fade in" style="font-size:90%">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<?php echo CIHtml::validationErrors(); ?>
									<?php echo $error; ?>
								</div>
								<?php endif; ?>
								
								<?php CGCrudCode::getInstance()->getMessage('success'); ?>
								
								<form method="POST">
								
									<label>Model Name <span class="required">*</span></label>
									<?php $this->geci->load('widgets.jui.CIJuiAutoComplete')->reg(array(
										'options'=>array('source'=>preg_replace('/.php|index.html|\./','',scandir(APPPATH.'/models'))),
										'htmlOptions'=>array(
											'name'=>'modelname',
											'placeholder'=>'Model Name',
											'value'=>CIHtml::setValue('modelname')
										)
									)); ?>
									<?php echo CIHtml::formError('modelname','<p style="color:red">','</p>'); ?>
									
									<label>Controller Name <span class="required">*</span></label>
									<?php echo CIHtml::textField(array(
										'name'=>'controllername',
										'placeholder'=>'Controller Name',
										'value'=>CIHtml::setValue('controllername')
									)); ?>
									<?php echo CIHtml::formError('controllername','<p style="color:red">','</p>'); ?>
									
									<label>Base Controller <span class="required">*</span></label>
									<?php echo CIHtml::textField(array(
										'name'=>'basecontroller',
										'placeholder'=>'Base Controller',
										'value'=>CIHtml::setValue('basecontroller')!=='' ? CIHtml::setValue('basecontroller') : 'CI_Controller'
									)); ?>
									<?php echo CIHtml::formError('basecontroller','<p style="color:red">','</p>'); ?>
									<span class="login-checkbox">
										<label class="checkbox">
											<input type="checkbox" name="auth" value="accept" <?php echo set_checkbox('auth','accept'); ?> />
											Build Auth
										</label>		
									</span>
									<?php if($tampil=='ya'): ?>
										<!--<div class="alert alert-error  fade in" style="font-size:90%">-->
<table class="table-condensed table-bordered alert alert-error fade in" style="width:100%">
	<tr>
		<td width="90%"><strong>Preview</strong></td>
		<td width="10%">
			<span class="checkbox_overwrite">
				<label class="checkbox">
					<input type="checkbox" name="checkAll" value="accept" <?php echo set_checkbox('checkall_overwrite','accept'); ?> />
					<strong>Generator</strong>
				</label>
			</span>
		</td>
	</tr>
	<tr>
		<td><?php echo "<a href='javascript:void(0);' onclick='jQuery(\"#dlg_controller\").dialog(\"open\");'>$show_controller</a>"; ?></td>
		<td>
			<span class="checkbox_overwrite">
				<label class="checkbox">
					<input type="checkbox" name="controller_overwrite" value="accept" <?php echo set_checkbox('controller_overwrite','accept'); ?> />
					<?php echo $diffController=='' ? 'New' : 'Overwrite'; ?>
				</label>
			</span>
		</td>
	</tr>
	<tr>
		<td><?php echo "<a href='javascript:void(0);' onclick='jQuery(\"#dlg_index\").dialog(\"open\");'>$show_index</a>"; ?></td>
		<td>
			<span class="checkbox_overwrite">
				<label class="checkbox">
					<input type="checkbox" name="index_overwrite" value="accept" <?php echo set_checkbox('index_overwrite','accept'); ?> />
					<?php echo $diffIndex=='' ? 'New' : 'Overwrite'; ?>
				</label>
			</span>
		</td>
	</tr>
	<tr>
		<td><?php echo "<a href='javascript:void(0);' onclick='jQuery(\"#dlg_create\").dialog(\"open\");'>$show_create</a>"; ?></td>
		<td>
			<span class="checkbox_overwrite">
				<label class="checkbox">
					<input type="checkbox" name="create_overwrite" value="accept" <?php echo set_checkbox('create_overwrite','accept'); ?> />
					<?php echo $diffCreate=='' ? 'New' : 'Overwrite'; ?>
				</label>
			</span>
		</td>
	</tr>
	<tr>
		<td><?php echo "<a href='javascript:void(0);' onclick='jQuery(\"#dlg_view\").dialog(\"open\");'>$show_view</a>"; ?></td>
		<td>
			<span class="checkbox_overwrite">
				<label class="checkbox">
					<input type="checkbox" name="view_overwrite" value="accept" <?php echo set_checkbox('view_overwrite','accept'); ?> />
					<?php echo $diffView=='' ? 'New' : 'Overwrite'; ?>
				</label>
			</span>
		</td>
	</tr>
	<tr>
		<td><?php echo "<a href='javascript:void(0);' onclick='jQuery(\"#dlg_update\").dialog(\"open\");'>$show_update</a>"; ?></td>
		<td>
			<span class="checkbox_overwrite">
				<label class="checkbox">
					<input type="checkbox" name="update_overwrite" value="accept" <?php echo set_checkbox('update_overwrite','accept'); ?> />
					<?php echo $diffUpdate=='' ? 'New' : 'Overwrite'; ?>
				</label>
			</span>
		</td>
	</tr>
	<tr>
		<td><?php echo "<a href='javascript:void(0);' onclick='jQuery(\"#dlg_admin\").dialog(\"open\");'>$show_admin</a>"; ?></td>
		<td>
			<span class="checkbox_overwrite">
				<label class="checkbox">
					<input type="checkbox" name="admin_overwrite" value="accept" <?php echo set_checkbox('admin_overwrite','accept'); ?> />
					<?php echo $diffAdmin=='' ? 'New' : 'Overwrite'; ?>
				</label>
			</span>
		</td>
	</tr>
</table>
												
										<!--</div>-->
									<?php endif; ?>
									
									<div class="form-actions">
										<?php echo CIHtml::submitButton(array('name'=>'submit','value'=>'Preview','class'=>'btn btn-primary')); ?>
										<?php if($tampil=='ya'): ?>
											<?php echo CIHtml::submitButton(array('name'=>'generate','value'=>'Generate','class'=>'btn btn-primary')); ?>
										<?php endif; ?>
									</div>
									
									<?php if($tampil=='ya'): ?>
									<?php $this->geci->load('widgets.jui.CIJuiDialog')->reg(array(
										'id'=>'dlg_controller',
										'title'=>$controller_name,
										'content'=>$dlg_controller,
										'options'=>array(
											'autoOpen'=>false,
											'modal'=>true,
											'width'=>960,
											'height'=>500
										),
									)); ?>
									<?php $this->geci->load('widgets.jui.CIJuiDialog')->reg(array(
										'id'=>'dlg_index',
										'title'=>'index.php',
										'content'=>$dlg_index,
										'options'=>array(
											'autoOpen'=>false,
											'modal'=>true,
											'width'=>960,
											'height'=>500
										)
									)); ?>
									<?php $this->geci->load('widgets.jui.CIJuiDialog')->reg(array(
										'id'=>'dlg_create',
										'title'=>'create.php',
										'content'=>$dlg_create,
										'options'=>array(
											'autoOpen'=>false,
											'modal'=>true,
											'width'=>960,
											'height'=>500
										)
									)); ?>
									<?php $this->geci->load('widgets.jui.CIJuiDialog')->reg(array(
										'id'=>'dlg_view',
										'title'=>'view.php',
										'content'=>$dlg_view,
										'options'=>array(
											'autoOpen'=>false,
											'modal'=>true,
											'width'=>960,
											'height'=>500
										)
									)); ?>
									<?php $this->geci->load('widgets.jui.CIJuiDialog')->reg(array(
										'id'=>'dlg_update',
										'title'=>'update.php',
										'content'=>$dlg_update,
										'options'=>array(
											'autoOpen'=>false,
											'modal'=>true,
											'width'=>960,
											'height'=>500
										)
									)); ?>
									<?php $this->geci->load('widgets.jui.CIJuiDialog')->reg(array(
										'id'=>'dlg_admin',
										'title'=>'admin.php',
										'content'=>$dlg_admin,
										'options'=>array(
											'autoOpen'=>false,
											'modal'=>true,
											'width'=>960,
											'height'=>500
										)
									)); ?>
									<?php endif; ?>
									
								</form>
							</div>
						</div>