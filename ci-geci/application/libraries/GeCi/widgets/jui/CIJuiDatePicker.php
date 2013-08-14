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
 * CIJuiDatePicker Class
 *
 * @package			CIJuiDatePicker
 * @subpackage		JUI Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
 // ------------------------------------------------------------------------
 
/**
 * Example
 *
 * $this->geci->load('widgets.jui.CIJuiDatePicker')->reg(array(
 *      'htmlOptions'=>array(
 *           'name'=>'date',
 *           'placeholder'=>'Tanggal Lahir'
 *      ),
 *      'options'=>array(
 *           'changeMonth'=>true,
 *           'changeYear'=>true,
 *           'yearRange'=>'-50:+10',
 *          'dateFormat'=>'dd-mm-yy'
 *       )
 * ));
 *
 */

GeCi::import('widgets.jui.CIJuiWidget');

class CIJuiDatePicker extends CIJuiWIdget
{
	/**
	 * View Field
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $showField=true;

	/**
	 * Tag Name
	 *
	 * @var			string
	 * @access		public
	 */
	public $tagName='div';
	
	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return		void
	 */
	public function run()
	{
		parent::__construct();
		
		if($this->showField)
			echo CIHtml::textField($this->htmlOptions);
		else
			echo CIHtml::tag($this->tagName,$this->htmlOptions,'',true); 
		
		CIHtml::registerScriptBottom("jQuery('#". $this->getId(). "').datepicker(".CIJavaScript::encode($this->options) .");"); 
	}
}