<?php 
/**
 * Main Layouts
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Dida Nurwanda <dida_n@ymail.com>
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php $this->geci->layouts->title(isset($title) ? $title : false); ?></title>
</head>
<body>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target="#collapse_0">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a href="<?php echo site_url(); ?>" class="brand"><?php echo $this->geci->config('app_name'); ?></a>
			<div class="nav-collapse" id="collapse_0">
				<ul class="nav">
					<li><a href="<?php echo site_url(); ?>"><i class="icon-th-large"></i> Home</a></li>
					<li><a href="<?php echo $this->geci->auth()->authManager()->isGuest() ? site_url('site/login') : site_url('site/logout'); ?>"><i class="icon-th-large"></i> <?php echo $this->geci->auth()->authManager()->isGuest() ? "Login" : "Logout (".$this->geci->auth()->authManager()->name().")"; ?></a></li>
				</ul>
			</div>
		</div>	
	</div>
</div>

<div class="container-fluid">
	<div id="top"></div> <!-- /top -->
	<div id="wrapper">
		<div id="header">
			Selamat datang di GeCi !
		</div>
		<?php $this->geci->layouts->column(); ?>
	</div> <!-- /wrapper -->
		<div id="footer">
			Copyright &copy; <?php echo date('Y'); ?> Dida Nurwanda.  <br />
			Terima Kasih kepada CodeIgniter, jQuery, jQuery UI, dan Lainnya.<br />
			Page rendered in <strong>{elapsed_time}</strong> seconds
		</div> <!-- /footer -->
	<div id="top"></div> <!-- /top -->
</div> <!-- /container -->
</body>
</html>