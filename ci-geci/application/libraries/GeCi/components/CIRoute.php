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
 * CIRoute Class
 *
 * @package			CIRoute
 * @subpackage		Components
 * @category		Components
 * @author			Dida Nurwanda
 */

GeCi::import('components.CIComponents');

class CIRoute extends CIComponents
{

	/**
	 * Instance 
	 * 
	 * @var			static
	 * @access		public
	 */
	public static $instance;
	
	/**
	 * Get Url Active
	 * 
	 * @access		public
	 * @return		string
	 */
	public function thisRoute()
	{
		$pageUrl="http";
		if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"]=="on")
			$pageUrl.="s";
		$pageUrl.="://";
		if($_SERVER["SERVER_PORT"]!="80")
			$pageUrl.=$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		else
			$pageUrl.=$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		return $pageUrl;
	}
	
	/**
	 * Get Current Url
	 *
	 * @access		public
	 * @return		string
	 */
	public function curentUrl()
	{
		return current_url();
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