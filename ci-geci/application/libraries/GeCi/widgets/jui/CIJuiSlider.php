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
 * CIJuiSlider Class
 *
 * @package			CIJuiSlider
 * @subpackage		JUI Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
 // ------------------------------------------------------------------------
 
/**
 * Example
 *
 * $this->geci->load('widgets.jui.CIJuiSlider')->reg(array(
 *      'id'=>'slider1',
 *      'options'=>array(
 *           'value'=>100,
 *           'min'=>0,
 *           'max'=>500,
 *           'step'=>20,
 *           'slide'=>'js:function( event, ui ) {
 *                 jQuery("#amount1").val( "$ " + ui.value );
 *           }'
 *       )
 * ));
 *
 */

GeCi::import('widgets.jui.CIJuiWidget');

class CIJuiSlider extends CIJuiWidget
{
	
	/**
	 * Tag Name
	 *
	 * @var			string
	 * @access		public
	 */
	public $tagName='div';
	
	/**
	 * Renge
	 *
	 * @var			string
	 * @access		public
	 */
	public $value;

	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return		void
	 */
	public function run()
	{
		parent::__construct();
		
		echo CIHtml::tag($this->tagName,$this->htmlOptions,'',true);

		if($this->value!==null)
			$this->options['value']=$this->value;
			
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').slider(". CIJavaScript::encode($this->options) .");"); 
	}
}