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
 * CICLEditor Class
 *
 * @package			CICLEditor
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CICLEditor')->reg(array(
 *      'name'=>'content'
 * ));
 */

GeCi::import('widgets.CIWidget');

class CICLEditor extends CIWidget
{	
	/**
	 * Name Html Attributes
	 *
	 * @var			string
	 * @access		public
	 */
	public $name;
	
	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return		void
	 */
	public function run()
	{
		parent::__construct();
		
		if($this->name!=='')
			$this->htmlOptions['name']=$this->name;
		
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/cleditor/jquery.cleditor.min.js');
		CIHtml::registerCssFileBottom(GeCi::assetManager()->getAssets().'/cleditor/jquery.cleditor.css');
			
		CIHtml::registerScriptBottom("jQuery('#".$this->getId()."').cleditor(".CIJavaScript::encode($this->options).");"); 
		
		echo CIHtml::textArea($this->htmlOptions);
	}
}
