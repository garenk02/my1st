<?php echo CIHtml::registerScriptBottom('
	jQuery("input[name=tablename]").keyup(function(){
	jQuery("input[name=modelname]").val(jQuery("input[name=tablename]").val())
});
'); ?><div class="row-fluid">
							<div class="span12">
								<h3>Model Generator</h3>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span12">
							
								<?php if(CIHtml::validationErrors()): ?>
								<div class="alert alert-error  fade in" style="font-size:90%">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<?php echo CIHtml::validationErrors(); ?>
								</div>
								<?php endif; ?>
								
								<?php CGModelCode::getInstance()->getMessage('success'); ?>
								<?php CGModelCode::getInstance()->getMessage('error','error'); ?>
								
								<form method="POST">
									<label>Table Name <span class="required">*</span></label>
									<?php $this->geci->load('widgets.jui.CIJuiAutoComplete')->reg(array(
										'id'=>'table',
										// 'options'=>array('source'=>$this->db->getTable()),
										'htmlOptions'=>array(
											'name'=>'tablename',
											'placeholder'=>'Table Name',
											'value'=>CIHtml::setValue('tablename')
										)
									)); ?>
									<?php echo CIHtml::formError('tablename','<p style="color:red">','</p>'); ?>
									<label>Model Name <span class="required">*</span></label>
									<div class="input-append">
										<?php echo CIHtml::textField(array(
											'name'=>'modelname',
											'id'=>'model',
											'placeholder'=>'Model Name',
											'value'=>CIHtml::setValue('modelname')
										)); ?>
										<span class="add-on">_model</span>
									</div >
									<?php echo CIHtml::formError('modelname','<p style="color:red">','</p>'); ?>
									<label>Model Path <span class="required">*</span></label>
									<?php echo CIHtml::textField(array(
										'name'=>'modelpath',
										'placeholder'=>'Model Path',
										'value'=>CIHtml::setValue('modelpath')!=='' ? CIHtml::setValue('modelpath') : 'application.models'
									)); ?>
									<?php echo CIHtml::formError('modelpath','<p style="color:red">','</p>'); ?>
									
									<?php if($tampil=='ya'): ?>
										<div class="alert alert-error  fade in" style="font-size:90%">
											<strong>Preview</strong><br />
											<?php echo "<a href='javascript:void(0);' onclick='jQuery(\"#dialog\").dialog(\"open\");'>$show_model</a>"; ?>
										</div>
									<?php endif; ?>
									
									<div class="form-actions">
										<?php echo CIHtml::submitButton(array('name'=>'submit','value'=>'Preview','class'=>'btn btn-primary')); ?>
										<?php if($tampil=='ya'): ?>
											<?php echo CIHtml::submitButton(array('name'=>'generate','value'=>'Generate','class'=>'btn btn-primary')); ?>
										<?php endif; ?>
									</div>
									
									<?php if($tampil=='ya'): ?>
									<?php $this->geci->load('widgets.jui.CIJuiDialog')->reg(array(
										'id'=>'dialog',
										'title'=>$model_name,
										'content'=>$dialog,
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