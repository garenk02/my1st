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
 * CIJuiDroppable Class
 *
 * @package			CIJuiDroppable
 * @subpackage		JUI Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
 // ------------------------------------------------------------------------
 
/**
 * Example
 *
 * $this->geci->load('widgets.jui.CIJuiDraggable')->open(array(
 *      'id'=>'draggable',
 *      'htmlOptions'=>array(
 *           'class'=>'draggable ui-widget-content'
 *       )
 * ));
 * <p>Drag me around</p>
 * $this->geci->close();
 *
 */

GeCi::import('widgets.jui.CIJuiWidget');

class CIJuiDroppable extends CIJuiWidget
{

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
		echo CIHtml::openTag($this->tagName, $this->htmlOptions);
	}
	
	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return		void
	 */
	public function run()
	{		
		echo CIHtml::closeTag($this->tagName);
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').droppable(". CIJavaScript::encode($this->options) .")"); 
	}
}