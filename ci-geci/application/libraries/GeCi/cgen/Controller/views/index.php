<div class="row-fluid">
							<div class="span12">
								<h3>Controller Generator</h3>
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
								
								<?php CGControllerCode::getInstance()->getMessage('success'); ?>
								
								<form method="POST">
									<label>Controller Name <span class="required">*</span></label>
									<?php echo CIHtml::textField(array(
										'name'=>'controllername',
										'placeholder'=>'Controller Name',
										'value'=>CIHtml::setValue('controllername')
									)); ?>
									<?php echo CIHtml::formError('controllername','<p style="color:red">','</p>'); ?>
									
									<?php if($tampil=='ya'): ?>
										<div class="alert alert-error  fade in" style="font-size:90%">
											<strong>Preview</strong><br />
											<?php echo "<a href='javascript:void(0);' onclick='jQuery(\"#dlg_controller\").dialog(\"open\");'>$show_controller</a>"; ?><br />
											<?php echo "<a href='javascript:void(0);' onclick='jQuery(\"#dlg_index\").dialog(\"open\");'>$show_index</a>"; ?>
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
										'id'=>'dlg_controller',
										'title'=>$controller_name,
										'content'=>$dlg_controller,
										'options'=>array(
											'autoOpen'=>false,
											'modal'=>true,
											'width'=>960,
											'height'=>500
										)
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
									<?php endif; ?>
									
								</form>
							</div>
						</div>