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
 * CILayouts Class
 *
 * @package			CILayouts
 * @subpackage		Components
 * @category		Components
 * @author			Dida Nurwanda
 */

// GeCi::import('components.CIComponents');

class CILayouts // extends CIComponents
{

	/**
	 * Layout
	 * 
	 * @var			string
	 * @access		public
	 */
	public $layouts='layouts/main';
	
	/**
	 * Column
	 * 
	 * @var			string
	 * @access		public
	 */
	public $columns='layouts/column1';
	
	/**
	 * Path to View
	 * 
	 * @var			string
	 * @access		public
	 */
	public $path;
	
	/**
	 * Data for View
	 * 
	 * @var			array
	 * @access		public
	 */
	public $data;
	
	/**
	 * Condition View
	 * 
	 * @var			boolean
	 * @access 		public
	 */
	public $condition=false;
	
	/**
	 * Instance 
	 * 
	 * @var			static
	 * @access		public
	 */
	public static $instance;
	
	/**
	 * Constructor 
	 * 
	 * @access		public
	 * @return 		null
	 */
	public function __construct()
	{
		// parent::__construct();
	}
	
	/**
	 * Display 
	 * 
	 * @access		public
	 * @params		string, array, boolean
	 * @return 		void
	 */
	public function display($path='', $data='',$condition=false)
	{
		if(!file_exists(APPPATH.'views/'.$path.EXT))
			show_error("Unable to load the requested file: ".APPPATH.'views/'.$path.EXT);
			
		get_instance()->load->view($path, $data, $condition);
	}
	
	/**
	 * Display All 
	 * 
	 * @access		public
	 * @params		string, array, boolean
	 * @return 		void
	 */
	public function displayAll($path='', $data='', $condition=false)
	{
		if(!file_exists(APPPATH.'views/'.$path.EXT))
			show_error("Unable to load the requested file: ".APPPATH.'views/'.$path.EXT);
		
		$this->path=$path;
		$this->data=$data;
		$this->condition=$condition;
		
		$this->display($this->layouts, $this->data, $this->condition);
	}
	
	/**
	 * Register column 
	 * 
	 * @access		public
	 * @return 		void
	 */	
	public function column()
	{
		$this->display($this->columns, $this->data);
	}
	
	/**
	 * Register content 
	 * 
	 * @access		public
	 * @return 		void
	 */
	public function content()
	{
		$this->display($this->path, $this->data);
	}
	
	/**
	 * Get Title Page
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function title($title='', $position = '{title} - {app_name}')
	{
		$appName = GeCi::config('app_name');
		$returnTitle = strtr($position, array(
			'{title}' => $title,
			'{app_name}' => $appName
		)); 
		echo isset($title) && $title !== false && $title !== '' ? $returnTitle : $appName;
	}
	
	/**
	 * Create Instance 
	 * 
	 * @access		public
	 * @return 		object
	 */
	public function getInstance()
	{
		if(self::$instance==null)
			self::$instance=new self;
		return self::$instance;
	}
}