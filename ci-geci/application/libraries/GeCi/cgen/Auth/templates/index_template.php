<?php echo "<?php\n"; ?>
/**
 * Index <?php echo $controllername."\n"; ?>
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal <?php echo date('d-m-Y')."\n"; ?>
 * Dida Nurwanda <dida_n@ymail.com>
 */
?>

<ul class="breadcrumb">
  <li><a href="<?php echo "<?php"; ?> echo site_url(); <?php echo "?>"; ?>">Home</a> <span class="divider">/</span></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('<?php echo strtolower($controllername); ?>/index'); <?php echo "?>"; ?>"><?php echo ucwords($controllername); ?></a> <span class="divider">/</span></li>
  <li class="active">Index</li>
</ul>

<h1>Index <?php echo $controllername; ?></h1>

<p>
    You may change the content of this page by modifying
    the file <tt><?php echo APPPATH.'views/'.$controllername.'/index.php'; ?></tt>.
</p>