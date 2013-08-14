<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Auth site
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal 07-08-2013
 * Dida Nurwanda <dida_n@ymail.com>
 */
 
class site extends CI_Controller
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
		// $this->geci->layouts->displayAll('site/index');
		redirect('welcome/generator?cgen=true');
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
		$this->geci->layouts->displayAll('site/login',$data);
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
		redirect('site');
	}
}

/* End of file site.php */
/* Location: application/controllers/site.php */