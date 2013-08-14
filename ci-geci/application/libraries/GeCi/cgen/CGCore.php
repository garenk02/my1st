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
 * CGCore Class
 *
 * @package			CGCore
 * @subpackage		Basse Generator
 * @category		Generator
 * @author			Dida Nurwanda
 */
 
GeCi::import('widgets.CIWidget');

class CGCore extends CIWidget
{

	/**
	 * Instanc to CodeIgniter
	 *
	 * @var			static
	 * @access		public
	 */
	public static $CI;

	/**
	 * Constructor
	 *
	 * @access		public
	 $ @return		void
	 */
	public function __construct()
	{		
		$this->load('plugins.bootstrap.bootstrap')->reg(array(
			'responsiveCss'=>true,
			'templateStyle'=>true
		));
	
		CILayouts::getInstance()->columns='/../libraries/GeCi/cgen/views/column1';
		CILayouts::getInstance()->layouts='/../libraries/GeCi/cgen/views/main';
		
		$this->CI=&get_instance();
		$this->CI->load->library('form_validation');
		$this->getUrl();
	}
	
	/**
	 * Create File
	 *
	 * @access		public
	 * @param		string
	 * @return		void
	 */
	public function createFile($before, $after)
	{
		$this->CI->load->helper('file');
		@write_file($after, $before);
	}
	
	/**
	 * Check File 
	 *
	 * @access		public
	 * @param		string
	 * @return		boolean
	 */
	public function checkFile($file)
	{
		if(file_exists($file))
			return true;
		return false;
	}
	
	/**
	 * Create Folder 
	 *
	 * @access		public
	 * @param		string
	 * @return		void
	 */
	public function createFolder($dir)
	{
		if(!is_dir($dir))
			mkdir($dir, 0777);
	}	
	
	/**
	 * Get Information Table
	 *
	 * @access		public
	 * @param		string
	 * @return		object
	 */
	public function getTableInformation($table)
	{
		$this->CI->load->database();
		return $this->CI->db->query(base64_decode('U0hPVyBGVUxMIENPTFVNTlMgRlJPTQ==').' '.$table);
	}
	
	/**
	 * Get Diff Indo 
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function getDiff($path)
	{
		if(file_exists($path))
			return ' <span style="color:red">(diff)</span>';
	}
	
	/**
	 * Get URL
	 *
	 * @access		public
	 * @return		void
	 */
	public function getUrl()
	{
		if(isset($_GET['cgen']) && $_GET['cgen']=='true')
		{
			$type=isset($_GET['type']) ? $_GET['type'] : false;
			switch($type):
				case 'model': $this->model(); break;
				case 'controller': $this->controller(); break;
				case 'crud': $this->crud(); break;
				case 'auth': $this->auth(); break;
				default : $this->home(); break;
			endswitch;
		}
	}
	
	/**
	 * Render View
	 *
	 * @access		public
	 * @param		string, array, boolean
	 * @return		void
	 */
	public function render($view,$data=array(), $condition=false)
	{
		CILayouts::getInstance()->displayAll('/../libraries/GeCi/cgen/'.$view,$data,$condition);
	}
	
	/**
	 * Render Template
	 *
	 * @access		public
	 * @param		string, array, boolean
	 * @return		void
	 */
	public function renderTemplate($view,$data=array(),$condition=false)
	{
		$this->CI->load->view('/../libraries/GeCi/cgen/template/'.$view,$data,$condition);		
	}
	
	/**
	 * POST Request
	 *
	 * @access		public
	 * @param		string, boolean
	 * @return		mixed
	 */
	public function post($field,$safe=false)
	{
		return $this->CI->input->post($field,$safe);
	}
	
	
	/**
	 * Set Message
	 *
	 * @access		public
	 * @param		string, string, integer
	 * @return		void
	 */
	public function setMessage($name,$content,$duration=7)
	{
		setcookie($name,$content,time()+$duration);
	}
	
	/**
	 * Get Message
	 *
	 * @access		public
	 * @param		string
	 * return		string
	 */
	public function getMessage($name,$type='success')
	{
		if(isset($_COOKIE[$name]))
		{
			echo CIHtml::openTag('div',array(
				'class'=>'alert alert-'.$type.' fade in',
				'style'=>'font-size:90%'
			)); 
			echo CIHtml::button(array(	
				'class'=>'close',
				'data-dismiss'=>'alert',
				'content'=>'&times;'
			)); 
			echo $_COOKIE[$name];
			echo CIHtml::closeTag('div');
		}
	}
	
	/**
	 * Get Highlight
	 *
	 * @access		public
	 * @param		string, array
	 * @return		void
	 */
	public function highlight($file,$data=array())
	{
		return highlight_string($this->CI->load->view('/../libraries/GeCi/cgen/'.$file,$data,true),true);
	}
	
	/**
	 * Home
	 *
	 * @access		public
	 * @return		void
	 */
	public function home()
	{
		$this->render('views/home',array(
			'title'=>'Selamat datang di CGen - GeCi Code Generator'
		));
	}
	
	/**
	 * Get Generate
	 *
	 * @access		public
	 * @param		string
	 * @return		void
	 */
	public function getGenerator($type)
	{	
		GeCi::requireOnce(APPPATH."libraries.GeCi.cgen.{$type}.CG{$type}Code");
	}
	
	/**
	 * Model
	 *
	 * @access		public
	 * @return		void
	 */
	public function model()
	{	
		$this->getGenerator('Model');
		CGModelCode::getInstance()->execute();
	}
	
	/**
	 * Controller
	 *
	 * @access		public
	 * @return		void
	 */
	public function controller()
	{	
		$this->getGenerator('Controller');
		CGControllerCode::getInstance()->execute();
	}
	
	/**
	 * CRUD
	 *
	 * @access		public
	 * @return		void
	 */
	public function crud()
	{	
		$this->getGenerator('Crud');
		CGCrudCode::getInstance()->execute();
	}
	
	/**
	 * Auth
	 *
	 * @access		public
	 * @return		void
	 */
	public function auth()
	{
		$this->getGenerator('Auth');
		CGAuthCode::getInstance()->execute();
	}
	
	/**
	 * Crate Layouts
	 *
	 * @access		public
	 * @return		void
	 */
	public function makeLayouts()
	{
		$this->assetManager()->createAssetsOnce(APPPATH.'libraries/GeCi/cgen/layouts',APPPATH.'views/layouts');
	}
}