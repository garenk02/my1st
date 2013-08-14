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
 * CIShortcut Class
 *
 * @package			CIShortcut
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CIShortcut')->reg(array(
 *      'options'=>array(
 *           'type'=>'down',
 *           'mask'=>'p',
 *           'handler'=>'js:function() {
 *                 window.print();
 *           }'
 *      )
 * ));
 */

GeCi::import('widgets.CIWidget');

class CIShortcut extends CIWidget
{	

	/**
	 * Running Widget
	 *
	 * @access			public
	 * @return			void
	 */
	public function run()
	{
		parent::__construct();
		
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/jquery.shortcuts.min.js');
		CIHtml::registerScriptBottom("jQuery.Shortcuts.add(". CIJavaScript::encode($this->options) .").start();");
	}
}