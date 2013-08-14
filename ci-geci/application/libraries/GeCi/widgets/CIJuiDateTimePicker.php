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
 * CIJuiDateTimePicker Class
 *
 * @package			CIJuiDateTimePicker
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

class CIJuiDateTimePicker extends CIJuiDatePicker
{

	/**
	 * Mode datetimepicker
	 *
	 * @var			string
	 * @access		public
	 */
	public $mode='datetime';
	
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
		$options=CIJavaScript::encode($this->options);
			
		CIHtml::registerScriptBottom("jQuery('#{$this->getId()}').{$this->mode}picker(jQuery.extend({showMonthAfterYear:false},{$options}));");
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/dateTimePicker/jquery-ui-timepicker-addon.js');
		CIHtml::registerCssFile(GeCi::assetManager()->getAssets().'/dateTimePicker/jquery-ui-timepicker-addon.css');
	}
}