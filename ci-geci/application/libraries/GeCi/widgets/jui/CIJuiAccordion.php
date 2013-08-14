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
 * CIJuiAccordion Class
 *
 * @package			CIJuiAccordion
 * @subpackage		JUI Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
 // ------------------------------------------------------------------------
 
/**
 * Example
 *
 * $this->geci->load('widgets.jui.CIJuiAccordion')->reg(array(
 *      'panels'=>array(
 *           'Panel 1'=>'Content 1',
 *           'Panel 2'=>'Content 2',
 *           'Panel 3'=>'Content 3'
 *       )
 * ));
 *
 */

GeCi::import('widgets.jui.CIJuiWidget');

class CIJuiAccordion extends CIJuiWidget
{
	
	/**
	 * Panels
	 * 
	 * @var			array
	 * @access		public
	 */
	public $panels=array();
	
	/**
	 * Template for Header
	 *
	 * @var			string
	 * @access		public
	 */
	public $headerTemplate='<h3><a href="#">{title}</a></h3>';
	
	/**
	 * Tag Name
	 *
	 * @var			string
	 * @access		public
	 */
	public $tagName='div';
	
	/**
	 * Template for Content
	 *
	 * @var			string
	 * @access		public
	 */
	public $contentTemplate='<div>{content}</div>';
	
	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return		void
	 */
	public function run()
	{	
		parent::__construct();
		
		echo CIHtml::openTag($this->tagName,$this->htmlOptions);
		
		foreach($this->panels as $key=>$val)
		{
			echo strtr($this->headerTemplate,array('{title}'=>$key));
			echo strtr($this->contentTemplate,array('{content}'=>$val));
		}
		
		echo CIHtml::closeTag($this->tagName);
		
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').accordion(". CIJavaScript::encode($this->options) .");"); 
	}
}