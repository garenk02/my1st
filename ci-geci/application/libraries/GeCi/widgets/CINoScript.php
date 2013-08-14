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
 * CINoScript Class
 *
 * @package			CINoScript
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CINoScript')->open();
 * <strong>JavaScript tidak aktif.</strong> Mohon agar segera mengaktifkan JavaScript agar aplikasi ini berjalan normal kemudian reload halaman ini kembali.
 * $this->geci->close();
 */

GeCi::import('widgets.CIWidget');

class CINoScript extends CIWidget
{	

	/**
	 * Redirect URL
	 *
	 * @var			string
	 * @access		public
	 */
	public $redirect;
	
	/**
	 * Open Tag
	 *
	 * @var			string
	 * @access		public
	 */
	public $tagName='div';
	
	/**
	 * Messages
	 *
	 * @var			string
	 * @access		public
	 */
	public $content;
	
	/**
	 * Html Class
	 *
	 * @var			string
	 * @access		public
	 */
	public $class='alert alert-error';
	
	/**
	 * Constructor
	 *
	 * @access		public
	 * @return 		void
	 */
	public function init()
	{
		if(!isset($this->htmlOptions['class']))
			$this->htmlOptions['class']=$this->class;
			
		parent::__construct();
		
		echo CIHtml::openTag('noscript',array());
		echo CIHtml::openTag($this->tagName,$this->htmlOptions);
	}
	
	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return 		void
	 */
	public function run()
	{
		if($this->redirect!==null)
			echo CIHtml::tag('meta',array(
				'http-equiv'=>'refresh',
				'content'=>'0; url='. $this->redirect
			));
		if($this->content!==null)
			echo $this->content;
		
		echo CIHtml::closeTag($this->tagName);
		echo CIHtml::closeTag('noscript');
		
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').hide()"); 
	}
}