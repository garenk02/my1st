<?php echo "<?php\n"; ?>
/**
 * Login <?php echo $controllername."\n"; ?>
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal <?php echo date('d-m-Y')."\n"; ?>
 * Dida Nurwanda <dida_n@ymail.com>
 */
?>

<ul class="breadcrumb">
  <li><a href="<?php echo "<?php"; ?> echo site_url(); <?php echo "?>"; ?>">Home</a> <span class="divider">/</span></li>
  <li><a href="<?php echo "<?php"; ?> echo site_url('<?php echo strtolower($controllername); ?>/index'); <?php echo "?>"; ?>"><?php echo ucwords($controllername); ?></a> <span class="divider">/</span></li>
  <li class="active">Login</li>
</ul>

<h1>Login</h1>
<?php echo "<?php"; ?> echo CIHtml::formOpen(null); ?>
	
	<?php echo "<?php"; ?> if(validation_errors() || $this->geci->auth()->flashData('error')): ?>
		<div class="alert alert-error  fade in">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo "<?php"; ?> echo validation_errors(); ?>
			<?php echo "<?php"; ?> echo $this->geci->auth()->flashData('error'); ?>
		</div>
	<?php echo "<?php"; ?> endif; ?>

	<?php echo "<?php"; ?> echo CIHtml::label('Username : '); ?>
	<?php echo "<?php"; ?> echo CIHtml::textField(array(
		'name'=>'username',
		'value'=>$username,
		'placeholder'=>'Username',
		'class'=>'span5',
		'maxlength'=>80
	)); ?>
	<?php echo "<?php"; ?> echo CIHtml::formError('username','<p style="color:red">','</p>'); ?>
	
	<?php echo "<?php"; ?> echo CIHtml::label('Password : '); ?>
	<?php echo "<?php"; ?> echo CIHtml::passwordField(array(
		'name'=>'password',
		'value'=>$password,
		'placeholder'=>'Password',
		'class'=>'span5',
		'maxlength'=>80
	)); ?>
	<?php echo "<?php"; ?> echo CIHtml::formError('password','<p style="color:red">','</p>'); ?>
	
	<span class="login-checkbox">
		<label class="checkbox">
			<input type="checkbox" name="rememberme" value="accept" <?php echo "<?php"; ?> echo $checkbox; ?> />
			Remember me next time
		</label>		
	</span>
	<p>You may login with demo/demo or admin/admin. </p>
	<div class="form-actions">
		<?php echo "<?php"; ?> echo CIHtml::button(array(
			'name'=>'country_model',
			'type'=>'submit',
			'class'=>'btn btn-primary',
			'content'=>'<i class="icon-white icon-lock"></i> Login'
		)); ?>
	</div>
<?php echo "<?php"; ?> echo CIHtml::formClose(); ?>