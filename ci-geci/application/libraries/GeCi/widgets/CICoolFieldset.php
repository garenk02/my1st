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
 * CICoolFieldset Class
 *
 * @package			CICoolFieldset
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CICoolFieldset')->open(array(
 *      'legend'=>'Default Functionality'
 * )); ?>
 * <div style="padding:10px">
 *   <p>By default the <b>fieldset</b> is opened or expanded at start. Click on its <b>legend</b> to close or collapse it.</p>
 *   <p>The code is simply like below</p>
 * </div>
 * $this->geci->close();
 */

GeCi::import('widgets.CIWidget');

class CICoolFieldset extends CIWidget
{	
	
	/**
	 * Css File
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $css=false;
	
	/**
	 * Legend Name
	 *
	 * @var			string
	 * @access		public
	 */
	public $legend;
	
	/**
	 * Legend Html Attribute
	 *
	 * @var			array
	 * @access		public
	 */
	public $legendHtmlOptions=array();
	
	/**
	 * Open Widget
	 *
	 * @access		public
	 * @return		void
	 */
	public function init()
	{
		$this->htmlOptions['class']='coolfieldset';
		parent::__construct();
		
		echo CIHtml::openTag('fieldset',$this->htmlOptions);
		echo CIHtml::tag('legend',$this->legendHtmlOptions,$this->legend);
		$this->regClientScript();
	}
	
	/**
	 * Close Widget
	 *
	 * @access		public
	 * @return		void
	 */public function run()
	{
		echo CIHtml::closeTag('fieldset');
	}
	
	/**
	 * Register Script
	 *
	 * @access		public
	 * @return		void
	 */
	protected function regClientScript()
	{
		CIHtml::registerCssFile(GeCi::assetManager()->getAssets().'/coolfieldset/css/jquery.coolfieldset.css');
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/coolfieldset/js/jquery.coolfieldset.min.js');
		
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').coolfieldset(". CIJavaScript::encode($this->options) .");");
	}
}
