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
 * CIZTree Class
 *
 * @package			CIZTree
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CIZTree')->reg(array(
 *   'zNodes'=>array(
 *       array('id'=>1, 'pId'=>0, 'name'=>'zTree Home', 'url'=>'http://www.baby666.cn', 'target'=>'_blank'),
 *       array('id'=>2, 'pId'=>0, 'name'=>'zTree in Google', 'url'=>'http://www.google.com', 'target'=>'_blank'),
 *       array('id'=>3, 'pId'=>0, 'name'=>'zTree in Iteye', 'url'=>'http://ztreeapi.iteye.com', 'target'=>'_blank'),
 *   )
 * ));
 */

GeCi::import('widgets.CIWidget');

class CIZTree extends CIWidget
{	

	/**
	 * ZTree Setting
	 * 
	 * @var			array
	 * @access		public
	 */
	public $setting=array(
		'data'=>array(
			'simpleData'=>array(
				'enable'=>true
			)
		)
	);
	 
	/**
	 * Running Widget
	 *
	 * @access			public
	 * @return			void
	 */
	public function run()
	{
		if(!isset($this->htmlOptions['class']))
			$this->htmlOptions['class'] = 'ztree';
			
		parent::__construct();
		echo CIHtml::tag('ul',$this->htmlOptions,'',true);
		
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/zTree/jquery.ztree.all-3.5.min.js');
		CIHtml::registerCssFile(GeCi::assetManager()->getAssets().'/zTree/zTreeStyle.css');
		CIHtml::registerScriptBottom("jQuery.fn.zTree.init(jQuery('#{$this->getId()}'), ".CIJavaScript::encode($this->setting).", ".CIJavaScript::encode($this->options).");");
	}
}