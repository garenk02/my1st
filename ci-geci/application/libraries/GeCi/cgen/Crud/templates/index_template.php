<?php echo "<?php\n"; ?>
/**
 * Index <?php echo ucwords($controllername)."\n"; ?>
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal <?php echo date('d-m-Y')."\n"; ?>
 * Dida Nurwanda <dida_n@ymail.com>
 */
?>

<ul class="breadcrumb">
  <li><a href="<?php echo "<?php"; ?> echo site_url(); ?>">Home</a> <span class="divider">/</span></li>
  <li class="active"><?php echo ucwords($controllername); ?></li>
</ul> <!-- /breadcrumb -->

<ul class="nav nav-tabs">
  <li><a href="<?php echo "<?php"; ?> echo site_url('/<?php echo $controllername; ?>/create'); ?>">Create <?php echo ucwords(str_replace('_',' ',$controllername)); ?></a></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('/<?php echo $controllername; ?>/admin'); ?>">Manage <?php echo ucwords(str_replace('_',' ',$controllername)); ?></a></li>
</ul> <!-- /nav nav-tabs -->

<h1><?php echo ucwords(str_replace('_',' ',$controllername)); ?></h1>

<?php echo "<?php"; ?> foreach($model->result_array() as $row): ?>
<div class="well well-small">
	<address><?php $no=0; foreach($fieldUpdate as $row) : if($no<5): ?>	
		<b><?php echo "<?php"; ?> echo $this-><?php echo $modelname; ?>->getLabel('<?php echo $row['field']; ?>'); ?></b> : <?php echo "<?php"; ?> echo $row['<?php echo $row['field']; ?>'] ?><br /><?php else: echo "\n\t\t"; ?><!--<b><?php echo ucwords(str_replace('_',' ',$row['field']));?></b> : <?php echo "<?php"; ?> echo $row['<?php echo $row['field']; ?>'] ?><br />--><?php endif; ?>
	<?php $no++;?>
	<?php endforeach; ?><?php echo "\n\t"; ?>
	<?php echo "<?php"; ?> echo anchor(site_url('<?php echo $controllername; ?>/view/'.$row['<?php echo $primarykey; ?>']),'View Detail',array(
			'class'=>'btn btn-success pull-right'
		)); ?><br />
	</address>
</div> <!-- /well well-small -->
<?php echo "<?php"; ?> endforeach; ?>

<?php echo "<?php"; ?> echo $pagination; ?>