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
 * CIAuthManager Class
 *
 * @package			CIAuthManager
 * @subpackage		CIBaseAuth
 * @category		Components
 * @author			Dida Nurwanda
 */

GeCi::import('components.CIBaseAuth');

class CIAuthManager extends CIBaseAuth
{
	
	
	/**
	 * Name cookie remember 
	 *
	 * @var			string
	 * @access		public
	 */
	public $cookieName='geci_remember';
	
	/**
	 * Error Message
	 *
	 * @var			string
	 * @access		public
	 */
	public $deniedMessage='You are not authorized to perform this action.';
	
	/**
	 * Instance 
	 *
	 * @var			string
	 * @access		static
	 */
	public static $instance;
	
	/**
	 * Constructor
	 *
	 * @access		public
	 * @return	 	void
	 */	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Check user guest
	 *
	 * @access		public
	 * @return	 	void
	 */	
	public function isGuest()
	{
		return $this->userData('logged_in') ? false : true;
	}
	
	/**
	 * Check access
	 *
	 * @access		public
	 * @param 		string, mixed
	 * @return	 	boolean
	 */	
	public function checkAccess($name='',$value='')
	{
		if(is_array($value))
		{
			$return=array();
			foreach($value as $row)
			{
				if($this->userData($name)==$row)
					$return[]=$row;
			}
			if(count($return)>0)
				return true;
			return false;
		}
		else
			return $this->userData($name)==$value ? true : false;
	}
	
	/**
	 * Get access
	 *
	 * @access		public
	 * @param 		string, mixed
	 * @return	 	void
	 */	
	public function access($name='',$value='')
	{			
		if($name!=='' && $value!=='')
		{
			if(!$this->checkAccess($name, $value))
				$this->getAuthStatus();
		}
		else
		{
			if($this->isGuest())
				$this->accessDeniedError();
		}
	}
	
	/**
	 * Get Username
	 *
	 * @access		public
	 * @return	 	string
	 */	
	public function name()
	{
		return $this->userData('name');
	}
	
	/**
	 * Get Auth Status
	 *
	 * @access		protected
	 * @return	 	void
	 */	
	protected function getAuthStatus()
	{
		if($this->isGuest())
		{
			GeCi::import('components.CIRoute');
			$this->CI->input->set_cookie('geci_return_url_'.GeCi::config('app_name'),CIRoute::thisRoute(),60*60*2);
			redirect(GeCi::config('login_url'));
		}
		else
			$this->accessDeniedError();
	}
	
	/**
	 * Get Url History
	 *
	 * @access		public
	 * @return	 	string
	 */	
	public function returnUrl()
	{
		$url=$this->CI->input->cookie('geci_return_url_'.GeCi::config('app_name'),true)!=='' ? $this->CI->input->cookie('geci_return_url_'.GeCi::config('app_name'),true) : site_url();
		$this->CI->input->set_cookie('geci_return_url_'.GeCi::config('app_name'),'');
		return $url;
	}
	
	/**
	 * Set Remember
	 *
	 * @access		public
	 * @param 		string, string,string, boolean
	 * @return	 	void
	 */	
	public function setRemember($name,$username,$password,$checkbox)
	{
		$this->cookieName=$name;
		$this->CI->input->set_cookie($this->cookieName,base64_encode($username.'-|-'.$password.'-|-'.$checkbox),60*60*24*30);
	}
	
	/**
	 * Get Remember Data
	 *
	 * @access		public
	 * @return	 	string
	 */	
	public function getRemember()
	{
		return base64_decode($this->CI->input->cookie($this->cookieName));
	}
	
	/**
	 * Get Remembre Data Array
	 *
	 * @access		public
	 * @return	 	array
	 */	
	public function getRememberArray()
	{
		return explode('-|-',$this->getRemember());
	}
	
	/**
	 * Get Username Remember
	 *
	 * @access		public
	 * @return	 	string
	 */	
	public function getUsernameRemember()
	{
		$remember = $this->getRememberArray();
		return set_value('username')!=='' ? set_value('username') : (isset($remember[0]) ? $remember[0] : false);
	}
	
	/**
	 * Get Password Remember
	 *
	 * @access		public
	 * @return	 	string
	 */	
	public function getPasswordRemember()
	{
		$remember = $this->getRememberArray();
		return set_value('password')!=='' ? set_value('password') : (isset($remember[1]) ? $remember[1] : false);
	}
	
	/**
	 * Get CheckBox Remember
	 *
	 * @access		public
	 * @return	 	string
	 */	
	public function getCheckBoxRemember()
	{
		$remember = $this->getRememberArray();
		return set_checkbox('rememberme', 'accept')!=='' ? set_checkbox('rememberme', 'accept') : (isset($remember[2]) ? 'checked' : false);
	}
	
	/**
	 * Show Error Message
	 *
	 * @access		public
	 * @return		view
	 */
	public function accessDeniedError()
	{
		show_error($this->deniedMessage,403,'Error 403');
	}
	
	/**
	 * Get Instance 
	 *
	 * @access		public
	 * @return	 	object
	 */	
	public function getInstance()
	{
		if(self::$instance==null)
			self::$instance=new self;
		return self::$instance;
	}
}