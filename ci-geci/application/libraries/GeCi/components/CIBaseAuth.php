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
 * CIBaseAuth Class
 *
 * @package			CIBaseAuth
 * @subpackage		Components
 * @category		Components
 * @author			Dida Nurwanda
 */

GeCi::import('components.CIComponents');

class CIBaseAuth extends CIComponents
{
	
	/**
	 * Instance 
	 *
	 * @var			static
	 * @accerr		public
	 */
	public static $instance;
	
	/**
	 * Constructor
	 *
	 * @access		public
	 * @param 		array
	 * @return	 	void
	 */	
	public function __construct($params = array())
	{
		parent::__construct();
		@session_start();
	}
	
	/**
	 * Set User Data
	 *
	 * @access		public
	 * @param		mixed, string
	 * @return		void
	 */
	public function setUserData($newdata=array(), $newvalue='')
	{
		if(is_array($newdata))
		{
			foreach($newdata as $key => $val)
			{
				$this->setSession($key, $val);
			}
		}
		else
			$this->setSession($newdata, $newvalue);
	}
	
	/**
	 * Get Session Data
	 *
	 * @access		public
	 * @return		string
	 */
	public function userData($data='')
	{
		$this->checkTimeSession();
		return isset($_SESSION[$data]) ? $_SESSION[$data] : false;
	}
	
	/**
	 * Remove Session
	 *
	 * @access		public
	 * @param		mixed
	 */
	public function unsetUserData($newdata=array())
	{
		if(is_array($newdata))
		{
			foreach($newdata as $row)
			{
				unset($_SESSION[$row]);
			}
		}
		else
			unset($_SESSION[$newdata]);
	}
	
	/**
	 * Session Destroy
	 *
	 * @access		public
	 * @return		void
	 */
	public function sessDestroy()
	{
		@session_start();
		session_destroy();
	}
	
	/**
	 * Add or change flashdata, only available
	 * until the next request
	 *
	 * @access	public
	 * @param	mixed, string
	 * @return	void
	 */
	public function setFlashData($newdata=array(), $newvalue='')
	{
		$this->CI->session->set_flashdata($newdata,$newvalue);
	}
	
	/**
	 * Fetch a specific flashdata item from the session array
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function flashData($key)
	{
		return $this->CI->session->flashdata($key);
	}
	
	/**
	 * Keeps existing flashdata available to next request.
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	public function keepFlashData($key)
	{
		$this->CI->session->keep_flashdata($key);
	}
	
	/**
	 * Set Session
	 *
	 * @access		public
	 * @param		string
	 * @return 		void
	 */
	public function setSession($newdata='', $newvalue='')
	{
		$_SESSION[$newdata]=$newvalue;
		$this->setTime();
	}
	
	/**
	 * Set time
	 *
	 * @access		public
	 * @return		void
	 */
	public function setTime()
	{
		if(isset($_SESSION['sess_expiration']))
			unset($_SESSION['sess_expiration']);
	
		$_SESSION['sess_expiration']=time() + $this->CI->config->item('sess_expiration');
	}
	
	/**
	 * Check Time Session
	 *
	 * @access		public
	 * @return		void
	 */
	public function checkTimeSession()
	{
		if(isset($_SESSION['sess_expiration']))
		{
			if(time() > $_SESSION['sess_expiration'])
			{
				$this->sessDestroy();
			}
			else
			{
				$this->setTime();
			}
		}
	}
	
	/**
	 * Create Instance
	 *
	 * @access		public
	 * @return	 	object
	 */	
	public function getInstance()
	{
		$encryption_key=array();
		if($this->CI->config->item('encryption_key')=='')
			$encryption_key['encryption_key'] = md5($this->CI->input->ip_address().site_url().$this->CI->input->user_agent());
			
		$this->CI->load->library('session',$encryption_key);
		if(self::$instance==null)
			self::$instance=new self;
		return self::$instance;
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
}