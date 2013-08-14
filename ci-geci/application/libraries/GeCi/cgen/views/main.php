<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php CILayouts::getInstance()->title(isset($title) ? $title : false); ?></title>
	<?php CIHtml::registerStyle(".ui-widget{font-size:80%;} .navbar { font-size: 90%; }"); ?>
</head>
<body>

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?php echo site_url(); ?>"><?php echo $this->geci->config('app_name'); ?></a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li><a href="?cgen=true"><i class="icon-th-large"></i> Home</a></li>
					<li><a href="?cgen=true&type=auth"><i class="icon-th-large"></i> Auth Generator</a></li>
					<li><a href="?cgen=true&type=controller"><i class="icon-th-large"></i> Controller Generator</a></li>
					<li><a href="?cgen=true&type=crud"><i class="icon-th-large"></i> CRUD Generator</a></li>
					<li><a href="?cgen=true&type=model"><i class="icon-th-large"></i> Model Generator</a></li>
				</ul>
			</div>
		</div>	
	</div>
</div>
<div class="container-fluid">
	<div id="top"></div> <!-- /top -->
	<div id="wrapper">
		<div id="header">
			Selamat datang di CGen - Geci Code Generator
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