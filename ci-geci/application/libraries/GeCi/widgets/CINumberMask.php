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
 * CINumberMask Class
 *
 * @package			CINumberMask
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CINumberMask')->reg(array(
 *      'options'=>array(
 *           'beforePoint'=>2
 *      )
 * )); 
 */

GeCi::import('widgets.CIWidget');

class CINumberMask extends CIWidget
{		
	
	/**
	 * Running Widget
	 *
	 * @access 		public
	 * @return		void
	 */
	public function run()
	{
		parent::__construct();
		
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/jquery.numberMask.js');
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').numberMask(". CIJavaScript::encode($this->options) .");");
		
		echo CIHtml::textField($this->htmlOptions);
	}
}