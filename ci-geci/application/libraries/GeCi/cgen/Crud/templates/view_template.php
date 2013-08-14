<?php echo "<?php\n"; ?>
/**
 * View <?php echo ucwords($controllername)."\n"; ?>
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal <?php echo date('d-m-Y')."\n"; ?>
 * Dida Nurwanda <dida_n@ymail.com>
 */
<?php echo "?>\n"; ?>

<ul class="breadcrumb">
  <li><a href="<?php echo "<?php"; ?> echo site_url(); <?php echo "?>"; ?>">Home</a> <span class="divider">/</span></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('<?php echo strtolower($controllername); ?>/index'); <?php echo "?>"; ?>"><?php echo ucwords($controllername); ?></a> <span class="divider">/</span></li>
  <li class="active"><?php echo "<?php"; ?> echo $model-><?php echo $primarykey; ?>; ?></li>
</ul> <!-- /breadcrumb -->

<ul class="nav nav-tabs">
  <li><a href="<?php echo "<?php"; ?> echo site_url('/<?php echo $controllername; ?>/index'); <?php echo "?>"; ?>">List <?php echo ucwords(str_replace('_',' ',$controllername)); ?></a></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('/<?php echo $controllername; ?>/create'); <?php echo "?>"; ?>">Create <?php echo ucwords(str_replace('_',' ',$controllername)); ?></a></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('/<?php echo $controllername; ?>/update/'.$model-><?php echo $primarykey; ?>); <?php echo "?>"; ?>">Update <?php echo ucwords(str_replace('_',' ',$controllername)); ?></a></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('/<?php echo $controllername; ?>/delete/'.$model-><?php echo $primarykey; ?>); <?php echo "?>"; ?>" onclick="return confirm('Are you sure you want to delete this item?')" >Delete <?php echo ucwords(str_replace('_',' ',$controllername)); ?></a></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('/<?php echo $controllername; ?>/admin'); <?php echo "?>"; ?>">Manage <?php echo ucwords(str_replace('_',' ',$controllername)); ?></a></li>
</ul> <!-- /nav nav-tabs -->

<h1>View Detail # <?php echo "<?php"; ?> echo $model-><?php echo $primarykey; ?>; ?></h1>

<div class="alert alert-success">
	<table class="table table-striped table-condensed"><?php foreach($fieldUpdate as $row): ?><?php echo "\n"; ?>
		<tr>
			<td width="25%"><strong><?php echo "<?php"; ?> echo $this-><?php echo $modelname; ?>->getLabel('<?php echo $row['field']; ?>'); ?></strong></td>
			<td width="75%"><?php echo "<?php"; ?> echo $model-><?php echo $row['field']; ?>; <?php echo "?>"; ?></td>
		</tr>
	<?php endforeach; ?>
</table>
</div>