<?php

/**
 * GeCi
 *
 * Aplikasi widget opensource untuk framework CodeIgniter
 *
 * @package			GeCi
 * @author			Dida Nurwanda
 * @copyright		Copyright (c) 2013
 * @license			http://geci.pusku.com/license.html
 * @link			http://geci.pusku.com
 * @since			Version 0.1
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CGAuthCode Class
 *
 * @package			CGAuthCode
 * @subpackage		Generator
 * @category		Generator
 * @author			Dida Nurwanda
 */

GeCi::import('cgen.CGCore');

class CGAuthCode extends CGCore
{
	
	/**
	 * Instance to CodeIgniter
	 *
	 * @var			static
	 * @access		public
	 */
	public static $CI;
	
	/**
	 * Instance 
	 * 
	 * @var			static
	 * @access		public
	 */
	public static $instance;

	/**
	 * Construct
	 *
	 * @access		public
	 * @return		void
	 */
	public function __construct()
	{		
		$this->load('plugins.bootstrap.bootstrap')->reg(array(
			'responsiveCss'=>true
		));
	
		$this->CI=&get_instance();
	}
	
	/**
	 * Rules
	 *
	 * @access		public
	 * @return		boolean
	 */
	public function rules()
	{
		$this->CI->load->library('form_validation');
		$this->CI->form_validation->set_rules(array(
			array(
				'field'=>'controllername',
				'label'=>'Controller Name',
				'rules'=>'trim|required|xss_clean'
			)
		));
		return $this->CI->form_validation->run();
	}
	
	/**
	 * POST Request
	 *
	 * @access		public
	 * @return		array
	 */
	public function getPost()
	{
		return array(
			'controllername'=>str_replace(' ','_',strtolower($this->post('controllername',true)))
		);
	}
	
	/**
	 * Runnning Generator
	 *
	 * @access		public
	 * @return		void
	 */
	public function execute()
	{
		$show=array(
			'tampil'=>'no',
			'title'=>'Auth Generator'
		);
		if(isset($_POST['submit']) || isset($_POST['generate']))
		{
			if($this->rules())
			{
				$post = $this->getPost();
				$diffController = $this->getDiff(APPPATH.'controllers/'.$post['controllername'].EXT);
				$diffIndex = $this->getDiff(APPPATH.'views/'.$post['controllername'].'/index.php');
				$diffLogin = $this->getDiff(APPPATH.'views/'.$post['controllername'].'/login.php');
				$diffModel = $this->getDiff(APPPATH.'models/login_model.php');
				
				$show=array(
					'tampil'=>'ya',
					'show_controller'=>APPPATH.'controllers/'.$post['controllername'].EXT.$diffController,
					'show_index'=>APPPATH.'views/'.$post['controllername'].'/index.php'.$diffIndex,
					'show_login'=>APPPATH.'views/'.$post['controllername'].'/login.php'.$diffLogin,
					'show_model'=>APPPATH.'models/login_model.php'.$diffModel,
					'controller_name'=>$post['controllername'].EXT,
					'dlg_controller'=>$this->highlight('Auth/templates/controller_template.php',$post),
					'dlg_index'=>$this->highlight('Auth/templates/index_template.php',$post),
					'dlg_login'=>$this->highlight('Auth/templates/login_template.php',$post),
					'dlg_model'=>$this->highlight('Auth/templates/model_template.php',$post),
				);
				if(isset($_POST['generate']))
				{
					$this->makeLayouts();
					$this->makeFolder();
					$this->makeController($post,APPPATH.'controllers/'.$post['controllername'].EXT);
					$this->makeIndex($post,APPPATH.'views/'.$post['controllername'].'/index.php');
					$this->makeLogin($post,APPPATH.'views/'.$post['controllername'].'/login.php');
					$this->makeModel($post,APPPATH.'models/login_model.php');
					$this->setMessage('success','Anda berhasil membuat Auth Controller <strong>'.$post['controllername'].EXT.'</strong> pada direktory <strong>'.APPPATH.'controllers/'.$post['controllername'].EXT.'</strong><br /><a href="'.site_url($post['controllername']).'" target="_blank">View Here</a>');
		
					GeCi::import('components.CIRoute');
					redirect(CIRoute::thisRoute());
				}
			}
		}
		$this->render('Auth/views/index',$show);
	}
	
	/**
	 * Create Controller
	 *
	 * @access		public
	 * @param		array, string
	 * @return		void
	 */
	public function makeController($data=array(), $target)
	{
		$this->createFile($this->CI->load->view('/../libraries/GeCi/cgen/Auth/templates/controller_template.php',$data,true),$target);
	}
	
	/**
	 * Create Index
	 *
	 * @access		public
	 * @param		array, string
	 * @return		void
	 */
	public function makeIndex($data=array(), $target)
	{
		$this->createFile($this->CI->load->view('/../libraries/GeCi/cgen/Auth/templates/index_template.php',$data,true),$target);
	}
	
	/**
	 * Create Login
	 *
	 * @access		public
	 * @param		array, string
	 * @return		void
	 */
	public function makeLogin($data=array(), $target)
	{
		$this->createFile($this->CI->load->view('/../libraries/GeCi/cgen/Auth/templates/login_template.php',$data,true),$target);
	}
	
	/**
	 * Create Model
	 *
	 * @access		public
	 * @param		array, string
	 * @return		void
	 */
	public function makeModel($data=array(), $target)
	{
		$this->createFile($this->CI->load->view('/../libraries/GeCi/cgen/Auth/templates/model_template.php',$data,true),$target);
	}
	
	/**
	 * Create Folder
	 *
	 * @access		public
	 * @return		void
	 */
	public function makeFolder()
	{
		$post = $this->getPost();
		if(!is_dir(APPPATH.'views/'.$post['controllername']))
			mkdir(APPPATH.'views/'.$post['controllername'],0777);
	}
	
	/**
	 * Create Instance
	 *
	 * @access		public
	 * @return		object
	 */
	public function getInstance()
	{
		if (self::$instance==null)
			self::$instance=new self;
		return self::$instance;
	}
}