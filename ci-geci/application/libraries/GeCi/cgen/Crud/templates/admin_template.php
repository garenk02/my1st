<?php echo "<?php\n"; ?>
/**
 * Admin <?php echo ucwords($controllername)."\n"; ?>
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal <?php echo date('d-m-Y')."\n"; ?>
 * Dida Nurwanda <dida_n@ymail.com>
 */
<?php echo "?>\n"; ?>

<ul class="breadcrumb">
  <li><a href="<?php echo "<?php"; ?> echo site_url(); <?php echo "?>"; ?>">Home</a> <span class="divider">/</span></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('<?php echo strtolower($controllername); ?>/index'); <?php echo "?>"; ?>"><?php echo ucwords($controllername); ?></a> <span class="divider">/</span></li>
  <li class="active">Manage</li>
</ul> <!-- /breadcrumb -->

<ul class="nav nav-tabs">
  <li><a href="<?php echo "<?php"; ?> echo site_url('/<?php echo $controllername; ?>/index'); <?php echo "?>"; ?>">List <?php echo ucwords(str_replace('_',' ',$controllername)); ?></a></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('/<?php echo $controllername; ?>/create'); <?php echo "?>"; ?>">Create <?php echo ucwords(str_replace('_',' ',$controllername)); ?></a></li>
</ul> <!-- /nav nav-tabs -->

<h1>Manage <?php echo ucwords(str_replace('_',' ',$controllername)); ?></h1>

<?php echo "<?php"; ?> $this->geci->load('widgets.grid.CIFlexiGrid')->reg(array(
	'id'=>'<?php echo $modelname; ?>_grid',
	'options'=>array(
		'url'=>site_url('<?php echo $controllername; ?>/admin?list'),
		'sortname'=>'<?php echo $primarykey; ?>',
		'sortorder'=>'desc',
		'title'=>'<?php echo ucwords(str_replace('_',' ',$controllername)); ?>',
		'colModel'=>array(
			$this->geci->load('widgets.grid.CIButtonGrid')->actionColumn(array('widthColumn'=>60)),
		<?php $no=0; foreach($fieldUpdate as $row): ?><?php if($no<7): ?>
	array('display'=>$this-><?php echo $modelname; ?>->getLabel('<?php echo $row['field']; ?>'), 'name'=>'<?php echo $row['field']; ?>', 'width'=>140, 'sortable'=>true, 'align'=>'center'),
		<?php else: ?>	// array('display'=>$this-><?php echo $modelname; ?>->getLabel('<?php echo $row['field']; ?>'), 'name'=>'<?php echo $row['field']; ?>', 'width'=>50, 'sortable'=>true, 'align'=>'center'),
		<?php endif; $no++; ?><?php endforeach; ?>
),
		'buttons'=>array(
			array('name'=>'Create','bclass'=>'create','onpress'=>'js:fgbutton')
		)
	)
)); ?>

<?php echo "<?php"; ?> CIHtml::registerScriptBottom("function fgbutton(com,grid) {
	if (com=='Create'){
		window.location.assign('".site_url("<?php echo $controllername; ?>/create")."')
	}            
}") ?>