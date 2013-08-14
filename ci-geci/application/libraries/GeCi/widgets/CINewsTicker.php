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
 * CINewsTicker Class
 *
 * @package			CINewsTicker
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CINewsTicker')->reg(array(
 *   'items'=>array(
 *       array(
 *           'url'=>'#',
 *           'value'=>'This is the 1st latest news item.'
 *       ),
 *       array(
 *           'url'=>'#',
 *           'value'=>'This is the 2nd  latest news item.'
 *       ),
 *       array(
 *           'url'=>'#',
 *           'value'=>'This is the 3nd  latest news item.'
 *       ),
 *       array(
 *           'url'=>'#',
 *           'value'=>'This is the 4th latest news item.'
 *       )
 *   )
 * ));
 */

GeCi::import('widgets.CIWidget');

class CINewsTicker extends CIWidget
{	
	/**
	 * Items
	 * @var			array
	 * @access		public
	 */
	public $items=array();
	
	/**
	 * Items Html Attribute
	 *
	 * @var			array
	 * @access		public
	 */
	public $itemHtmlOptions=array();
	
	/**
	 * Constructor
	 *
	 * @access			public
	 * @return			void
	 */
	public function init()
	{
		if(!isset($this->htmlOptions['id']))
			$this->htmlOptions['id']='js-news';
		if(!isset($this->htmlOptions['class']))
			$this->htmlOptions['class']='js-hidden';
			
		parent::__construct();
		echo CIHtml::openTag('ul',$this->htmlOptions);
	}
	
	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return		void
	 */
	public function run()
	{
		if(isset($this->items))
		{
			if(!isset($this->itemHtmlOptions['class']))
				$this->itemHtmlOptions['class']='news-item';
				
			foreach($this->items as $row)
			{
				echo CIHtml::openTag('li',$this->itemHtmlOptions);
				echo CIHtml::link($row['url'],$row['value'],array());
				echo CIHtml::closeTag('li');
			}
		}
		echo CIHtml::closeTag('ul');
		$this->clientScript();
	}
	
	/**
	 * Register Script
	 *
	 * @access		public
	 * @return		void
	 */
	public function clientScript()
	{
		CIHtml::registerCssFile(GeCi::assetManager()->getAssets().'/news_ticker/ticker-style.css');
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/news_ticker/jquery.ticker.js');
		CIHtml::registerScriptBottom("jQuery('#". $this->getId(). "').ticker(".CIJavaScript::encode($this->options).");");
	}
}