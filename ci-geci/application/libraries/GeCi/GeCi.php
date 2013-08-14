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
 * GeCi Class
 *
 * @package			GeCi
 * @subpackage		Base Class
 * @category		Widget
 * @author			Dida Nurwanda
 */

class GeCi 
{
	/**
	 * Instance to CodeIgniter
	 *
	 * @var 		static
	 * @access 		public
	 */	 
	public static $CI;
	
	/**
	 * Instance
	 *
	 * @var 		static
	 * @access 		public
	 */	 
	public static $instance;
	
	/**
	 * Instance to Layouts
	 *
	 * @var 		static
	 * @access 		public
	 */	 
	public static $layouts;
	
	/**
	 * Widget Object
	 *
	 * @var 		static
	 * @access 		public
	 */	
	public $method;
	
	
	/**
	 * Constructor
	 *
	 * @access		public
	 * @param 		array
	 * @return	 	void
	 */	
	public function __construct($data=array())
	{
		$this->CI=& get_instance();
		$this->CI->load->helper('url');
		
		foreach($data as $key=>$val)
			$this->$key=$val;
		
		$this->autoload();
		
		$this->layouts=CILayouts::getInstance();

		$this->assetManager()->run();
	}
	
	/**
	 * Create Instance
	 *
	 * @access		public
	 * @return		object
	 */
	public function getInstance()
	{
		if(self::$instance==null)
			self::$instance=new self;
		return self::$instance;
	}
	
	/**
	 * Import class library geci
	 *
	 * @access		public
	 * @param		array dan string
	 * @return 		void
	 */
	public function import($path)
	{
		if(is_array($path))
		{
			foreach($path as $value)
				self::__require($value);
		}
		else
			self::__require($path);
	}
	
	/**
	 * Require Once
	 *
	 * @access 		protected
	 * @param 		string
	 * @return 		void
	 */
	protected function __require($path)
	{
		$path=str_replace('.','/',$path); 		

		if(!file_exists(__DIR__.'/'.$path.EXT))
			show_error("Unable to load the requested file: ".__DIR__.'/'.$path.EXT);
			
		require_once __DIR__.'/'.$path.EXT;
	}
	
	/**
	 * Include file php di public path
	 *
	 * @access		public 
	 * @return 		void
	 */
	public function requireOnce($path)
	{
		$path=str_replace('.','/',$path);
		if(!file_exists($path.EXT))
			show_error("Unable to load the requested file: ".$path.EXT);
			
		require_once $path.EXT;
	}
	
	/**
	 * Pemanggilan otomatis 
	 *
	 * @access		protected 
	 * @return		viod;
	 */
	protected function autoload()
	{
		$this->import(array(
			'components.CIActiveModel',
			'components.CIAssetManager',
			'components.CIAuthManager',
			'components.CIBaseAuth',
			'components.CIHtml',
			'components.CIJavaScript',
			'components.CILayouts'
		));
		
		$this->CI->load->helper(array(
			'html',
			'form',
			'url'
		));
		
		if($this->config('jquery_autoload'))
			CIHtml::registerScriptFile($this->assetManager()->getAssets().'/jquery-1.7.2.min.js');
	}
	
	/**
	 * Load library dan widget GeCi
	 *
	 * @access		public
	 * @param		string
	 * @return 		object
	 */
	public function load($path)
	{
		$this->import($path);
		
		$ex=explode('.',$path);
		$count=count($ex);
			
		return $this->method=new $ex[$count-1];
	}
	
	/**
	 * Get GeCi Config
	 *
	 * @access		public
	 * @param		string
	 * @return		mixed
	 */
	public function config($name='')
	{
		require(__DIR__.'/config/config.php');
		if(isset($GC[$name]))
			return $GC[$name];
	}

	/**
	 * Delete Widget Instance
	 *
	 * @access 		public
	 * @param		method
	 * @return 		void
	 */
	public function close($method='')
	{
		$this->method->run();
		
		if($this->method==$method)
			$this->method=null;
	}
	
	/**
	 * Load Instance to Assets
	 *
	 * @access		public
	 * @return 		object
	 */
	public function assetManager()
	{
		return CIAssetManager::getInstance();
	}
	
	/**
	 * Load Instance to Auth
	 *
	 * @access		public
	 * @return 		object
	 */
	public function auth()
	{
		return CIBaseAuth::getInstance();
	}
	
	/**
	 * Load Instance to Auth Manager
	 *
	 * @access		public
	 * @return	 	object
	 */		
	public function authManager()
	{
		return CIAuthManager::getInstance();
	}
	
	/**
	 * Load Instance to Layouts
	 *
	 * @access		public
	 * @return	 	object
	 */		
	public function layouts()
	{
		return CILayouts::getInstance();
	}
	
	/**
	 * Load Instance to Route
	 *
	 * @access		public
	 * @return	 	object
	 */		
	public function route()
	{
		return CIRoute::getInstance();
	}
}
