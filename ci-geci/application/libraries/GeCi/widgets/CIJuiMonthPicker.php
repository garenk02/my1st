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
 * CIJuiMonthPicker Class
 *
 * @package			CIJuiMonthPicker
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CIJuiDateTimePicker')->reg(array(
 *      'htmlOptions'=>array(
 *           'name'=>'daftar'
 *      )
 * ));
 */

GeCi::import('widgets.jui.CIJuiDatePicker');

class CIJuiMonthPicker extends CIJuiDatePicker
{
	
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
			echo CIHtml::tag('div',$this->htmlOptions,'',true); 
	
		$default=array(
			'monthNames'=>array('January','February','March','April','May','June','July','August','September','October','November','December'),
			'monthNamesShort'=>array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'),
			'prevText'=>'Prev',
			'nextText'=>'Next',
		);
		$options=array_merge($this->options,$default);
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/monthPicker/jquery.ui.monthpicker.js');
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').monthpicker(".CIJavaScript::encode($options).");");
		
	}
}