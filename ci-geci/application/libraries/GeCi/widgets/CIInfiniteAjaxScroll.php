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
 * CIInfiniteAjaxScroll Class
 *
 * @package			CIInfiniteAjaxScroll
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
 /**
  * Example
  *
  * $this->geci->load('widgets.CIInfiniteAjaxScroll')->reg(array(
  *  'options'=>array(
  *      'container'=>'.listing',
  *      'item'=>'.post',
  *      'pagination'=>'.pagination',
  *      'next'=>'.next-page a',
  *      'triggerPageTreshold'=>4,
  *  )
  * ));
  */
  
GeCi::import('widgets.CIWidget');

class CIInfiniteAjaxScroll extends CIWidget
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
		
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/ias/jquery.ias.min.js');
		CIHtml::registerCssFile(GeCi::assetManager()->getAssets().'/ias/jquery.ias.css');
		
		if(!isset($this->options['loader']))
			$this->options['loader'] = img(GeCi::assetManager()->getAssets().'/ias/loading.gif');
			
		CIHtml::registerScriptBottom("jQuery.ias(".CIJavaScript::encode($this->options).");");
	}
}