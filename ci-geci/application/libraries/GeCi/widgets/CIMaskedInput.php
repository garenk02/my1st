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
 * CIMaskedInput Class
 *
 * @package			CIMaskedInput
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CIMaskedInput')->reg(array(
 *      'mask'=>'99/99/9999'
 * )); 
 */

GeCi::import('widgets.CIWidget');

class CIMaskedInput extends CIWidget
{		
	
	/**
	 * Masked
	 * 
	 * @var			string
	 * @access		public
	 */
	public $mask;
	
	/**
	 * Running Widget
	 *
	 * @access 		public
	 * @return		void
	 */
	public function run()
	{
		parent::__construct();
		
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/jquery.masked-input.min.js');
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').mask('{$this->mask}',". CIJavaScript::encode($this->options) .");");
		
		echo CIHtml::textField($this->htmlOptions);
	}
}