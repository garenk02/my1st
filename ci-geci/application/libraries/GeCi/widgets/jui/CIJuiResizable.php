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
 * CIJuiResizable Class
 *
 * @package			CIJuiResizable
 * @subpackage		JUI Widget
 * @category		Widgets
 * @author			Dida Nurwanda
 */
 
 // ------------------------------------------------------------------------
 
/**
 * Contoh
 *
 * $this->geci->load('widgets.jui.CIJuiResizable')->open(array(
 *      'id'=>'resizable1',
 *      'htmlOptions'=>array(
 *           'class'=>'ui-widget-content'
 *       )
 * ));
 * <h5 class="ui-widget-header">Resizable</h5>
 * $this->geci->close();
 *
 */
 
 GeCi::import('widgets.jui.CIJuiWidget');

class CIJuiResizable extends CIJuiWidget
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
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').resizable(". CIJavaScript::encode($this->options) .")"); 
	}
}