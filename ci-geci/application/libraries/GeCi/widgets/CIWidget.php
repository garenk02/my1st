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
 * CIWidget Class
 *
 * @package			CIWidget
 * @subpackage		Base Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
abstract class CIWidget extends GeCi
{

	/**
	 * Html Attributes
	 *
	 * @var 		array
	 * @access		public
	 */
	public $htmlOptions=array();
	
	/**
	 * JavaScript Decode
	 *
	 * @var			array
	 * @access		public
	 */
	public $options=array();
	
	/**
	 * ID For Widget
	 *
	 * @var			string
	 * @access		public
	 */
	public $id;
	
	/**
	 * Nomor ID
	 * 
	 * @var 		static numeric
	 * @access		public
	 */
	public static $id_number=0;
	
	/**
	 * Prefix ID
	 *
	 * @var			static string
	 * @access		public
	 */
	public static $id_prefix='geci_';
	
	/**
	 * Constructor
	 *
	 * @access		public
	 * @return 		void
	 */
	public function __construct()
	{
		$this->renderId();
		
		if(self::$CI==null)
			self::$CI=&get_instance();
	}
	
	/**
	 * Managing ID
	 *
	 * @access		public
	 * @return		void
	 */
	public function renderId()
	{
		if($this->id!='')
			$this->htmlOptions['id']=$this->id;
		elseif(!isset($this->htmlOptions['id']))
			$this->htmlOptions['id']=$this->getNewId();
		else
			$this->id=$this->htmlOptions['id'];
	}
	
	/**
	 * Get ID
	 *
	 * @access		public
	 * @return		string
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Create New ID
	 *
	 * @access		public
	 * @return		string dan void
	 */
	public function getNewId()
	{
		return $this->id=self::$id_prefix.self::$id_number++;
	}
	
	/**
	 * Auto Register
	 *
	 * @access		protected
	 * @param		array
	 * @return		void
	 */
	protected function autoRegister($data=array())
	{
		if(is_array($data))
		{
			foreach($data as $key=>$val)
				$this->$key=$val;
		}
	}
	
	/**
	 * Running Widget
	 * 
	 * @access		public
	 * @param		array
	 * @return		void
	 */
	public function reg($data=array())
	{
		$this->autoRegister($data);
		if(@method_exists($this,init))
			$this->init();
		$this->run();
	}
	
	/**
	 * Open Widget
	 *
	 * @access		public
	 * @parem		array
	 * @return 		void
	 */
	public function open($data=array())
	{
		$this->autoRegister($data);
		$this->init();
		return $this;		
	}
}