<?php echo '<?php'; ?> if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Auth <?php echo $controllername."\n"; ?>
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal <?php echo date('d-m-Y')."\n"; ?>
 * Dida Nurwanda <dida_n@ymail.com>
 */
 
class <?php echo $controllername; ?> extends CI_Controller
{
	
	/**
	 * Constructor
	 *
	 * @access		public
	 * @return		void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->geci->load('plugins.bootstrap.bootstrap')->reg(array(
			'responsiveCss'=>true,
			'templateStyle'=>true
		));
	}
	
	/**
	 * Index
	 *
	 * @access		public
	 * @return		void
	 */
	public function index()
	{
		$this->geci->layouts->displayAll('<?php echo $controllername; ?>/index');
	}
	
	/**
	 * login 
	 *
	 * @access		public
	 * @return		void
	 */
	public function login()
	{
		$this->load->model('login_model');
		if($this->login_model->initialize())
			redirect($this->geci->auth()->authManager()->returnUrl());
			
		$data=array(
			'username'=>$this->geci->auth()->authManager()->getUsernameRemember(),
			'password'=>$this->geci->auth()->authManager()->getPasswordRemember(),
			'checkbox'=>$this->geci->auth()->authManager()->getCheckBoxRemember(),
			'title'=>'Login'
		);
		$this->geci->layouts->displayAll('<?php echo $controllername; ?>/login',$data);
	}
	
	/**
	 * logout 
	 *
	 * @access		public
	 * @return		void
	 */
	public function logout()
	{
		$this->geci->auth()->sessDestroy();
		redirect('<?php echo $controllername; ?>');
	}
}

/* End of file <?php echo $controllername; ?>.php */
/* Location: application/controllers/<?php echo $controllername; ?>.php */