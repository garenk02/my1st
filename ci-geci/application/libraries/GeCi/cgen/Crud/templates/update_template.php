<?php echo "<?php\n"; ?>
/**
 * Update <?php echo ucwords($controllername)."\n"; ?>
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal <?php echo date('d-m-Y')."\n"; ?>
 * Dida Nurwanda <dida_n@ymail.com>
 */
<?php echo "?>\n"; ?>

<!-- Breadcrumbs -->
<ul class="breadcrumb">
  <li><a href="<?php echo "<?php"; ?> echo site_url(); <?php echo "?>"; ?>">Home</a> <span class="divider">/</span></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('<?php echo strtolower($controllername); ?>/index'); <?php echo "?>"; ?>"><?php echo ucwords($controllername); ?></a> <span class="divider">/</span></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('<?php echo strtolower($controllername); ?>/view/'.$model-><?php echo $primarykey; ?>); <?php echo "?>"; ?>"><?php echo "<?php"; ?> echo $model-><?php echo $primarykey; ?>; ?></a> <span class="divider">/</span></li>
  <li class="active">Update</li>
</ul> <!-- /breadcrumb -->

<!-- Menu -->
<ul class="nav nav-tabs">
  <li><a href="<?php echo "<?php"; ?> echo site_url('/<?php echo $controllername; ?>/index'); <?php echo "?>"; ?>">List <?php echo ucwords(str_replace('_',' ',$controllername)); ?></a></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('/<?php echo $controllername; ?>/create'); <?php echo "?>"; ?>">Create <?php echo ucwords(str_replace('_',' ',$controllername)); ?></a></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('/<?php echo $controllername; ?>/admin'); <?php echo "?>"; ?>">Manage <?php echo ucwords(str_replace('_',' ',$controllername)); ?></a></li>
</ul> <!-- /nav nav-tabs -->

<!-- Title -->
<h1>Update <?php echo ucwords(str_replace('_',' ',$controllername)); ?> # <?php echo "<?php"; ?> echo $model-><?php echo $primarykey; ?>; ?></h1>

<!-- Form Open -->
<?php echo "<?php"; ?> echo CIHtml::formOpen(null,array(
	'class'=>'form-horizontal', 
	'id'=>'<?php echo $modelname; ?>_form'
)); ?>

<!-- Form Validation -->
<?php echo "<?php"; ?> if(validation_errors()): ?>
<div class="alert alert-error  fade in">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo "<?php"; ?> echo validation_errors(); ?>
</div> <!-- /alert alert-error fade in -->
<?php echo "<?php"; ?> endif; ?>

<?php foreach($fieldUpdate as $row): ?><?php echo "\n"; ?>
<!-- Form input <?php echo $row['field']; ?> -->
<div class="control-group">
	<?php echo "<?php"; ?> echo CIHtml::label($this-><?php echo $modelname; ?>->getLabel('<?php echo $row['field']; ?>')<?php echo $row['required'] ? '.CIHtml::REQUIRED' : ''; ?> .' : ','<?php echo $row['field']; ?>',array(
		'class'=>'control-label'
	)); ?>
	<div class="controls">
		<?php echo "<?php"; ?> echo CIHtml::<?php echo $row['input']; ?><?php echo $row['type']; ?>(array(
			'name'=>'<?php echo $row['field']; ?>',
			'value'=>CIHtml::setValue('<?php echo $row['field']; ?>')!=='' ? CIHtml::setValue('<?php echo $row['field']; ?>') : $model-><?php echo $row['field']; ?>,
			'placeholder'=>$this-><?php echo $modelname; ?>->getLabel('<?php echo $row['field']; ?>'),
			'class'=>'span5',<?php echo $row['field']==$primarykey ? "\n\t\t\t'readonly'=>'readonly',\n" : "\n"; ?>
			<?php echo $row['max_length']."\n"; ?>
		)); ?>
		<?php echo "<?php"; ?> echo CIHtml::formError('<?php echo $row['field']; ?>','<p style="color:red">','</p>'); ?>
	</div>
</div>
<?php endforeach; ?>

<!-- Submit Button -->
<div class="form-actions">
	<?php echo "<?php"; ?> echo CIHtml::button(array(
		'name'=>'<?php echo $modelname; ?>',
		'type'=>'submit',
		'class'=>'btn btn-primary',
		'content'=>'<i class="icon-white icon-file"></i> Update'
	)); ?>
</div>

<!-- Form Close -->
<?php echo "<?php"; ?> echo CIHtml::formClose(); ?>

<!-- Client Validation -->
<?php echo "<?php"; ?> $this->geci->load('widgets.CIJqValidation')->reg(array(
    'id'=>'<?php echo $modelname; ?>_form',
    'options'=>array(
        'rules'=>array(<?php foreach($validationUpdate as $row): ?><?php echo "\n\t\t\t"; ?>
'<?php echo $row['field']; ?>'=>array(
		<?php echo "\t\t".$row['required']; ?>
			<?php echo "\t".$row['email']."\n"; ?>
			<?php echo "\t".$row['maxlength']."\n"; ?>
			),<?php endforeach; ?>
		<?php echo "\n\t\t"; ?>),
    )
)); ?>