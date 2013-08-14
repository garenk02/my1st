<?php
/**
 * Login site
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal 07-08-2013
 * Dida Nurwanda <dida_n@ymail.com>
 */
?>

<ul class="breadcrumb">
  <li><a href="<?php echo site_url(); ?>">Home</a> <span class="divider">/</span></li>
  <li><a href="<?php echo site_url('site/index'); ?>">Site</a> <span class="divider">/</span></li>
  <li class="active">Login</li>
</ul>

<h1>Login</h1>
<?php echo CIHtml::formOpen(null); ?>
	
	<?php if(validation_errors() || $this->geci->auth()->flashData('error')): ?>
		<div class="alert alert-error  fade in">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo validation_errors(); ?>
			<?php echo $this->geci->auth()->flashData('error'); ?>
		</div>
	<?php endif; ?>

	<?php echo CIHtml::label('Username : '); ?>
	<?php echo CIHtml::textField(array(
		'name'=>'username',
		'value'=>$username,
		'placeholder'=>'Username',
		'class'=>'span5',
		'maxlength'=>80
	)); ?>
	<?php echo CIHtml::formError('username','<p style="color:red">','</p>'); ?>
	
	<?php echo CIHtml::label('Password : '); ?>
	<?php echo CIHtml::passwordField(array(
		'name'=>'password',
		'value'=>$password,
		'placeholder'=>'Password',
		'class'=>'span5',
		'maxlength'=>80
	)); ?>
	<?php echo CIHtml::formError('password','<p style="color:red">','</p>'); ?>
	
	<span class="login-checkbox">
		<label class="checkbox">
			<input type="checkbox" name="rememberme" value="accept" <?php echo $checkbox; ?> />
			Remember me next time
		</label>		
	</span>
	<p>You may login with demo/demo or admin/admin. </p>
	<div class="form-actions">
		<?php echo CIHtml::button(array(
			'name'=>'country_model',
			'type'=>'submit',
			'class'=>'btn btn-primary',
			'content'=>'<i class="icon-white icon-lock"></i> Login'
		)); ?>
	</div>
<?php echo CIHtml::formClose(); ?>