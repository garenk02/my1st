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
 * CIJuiDialog Class
 *
 * @package			CIJuiDialog
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
 // ------------------------------------------------------------------------
 
/**
 * Example
 *
 * $this->geci->load('widgets.jui.CIJuiDialog')->reg(array(
 *      'title'=>'Dialog',
 *      'content'=>'<p>Content.</p>'
 * )):
 *
 */

GeCi::import('widgets.jui.CIJuiWidget');

class CIJuiDialog extends CIJuiWIdget
{	

	/**
	 * Dialog Title
	 *
	 * @var			string
	 * @access		public
	 */
	public $title;
	
	/**
	 * Dialog Content
	 *
	 * @var			string
	 * @access		public
	 */
	public $content;
	
	/**
	 * Tag Name
	 *
	 * @var			string
	 * @access		public
	 */
	public $tagName='div';

	/**
	 * Constructor
	 *
	 * @access		public
	 * @return 		void
	 */
	public function init()
	{
		parent::__construct();
		
		if(!isset($this->htmlOptions['title']))
			$this->htmlOptions['title']=$this->title;
			
		echo CIHtml::openTag($this->tagName, $this->htmlOptions);
		echo $this->content;
	}
	
	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return 		void
	 */
	public function run()
	{
		echo CIHtml::closeTag($this->tagName);
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').dialog(". CIJavaScript::encode($this->options) .");"); 
	}
}