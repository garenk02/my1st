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
 * CIJuiSortable Class
 *
 * @package			CIJuiSortable
 * @subpackage		JUI Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
 // ------------------------------------------------------------------------
 
/**
 * Example
 *
 *  $this->geci->load('widgets.jui.CIJuiSelectable')->reg(array(
 *  'id'=>'selectable1',
 *  'items'=>array(
 *       'id1'=>'Item 1',
 *       'id2'=>'Item 2',
 *       'id3'=>'Item 3'
 *   ),
 *   'itemHtmlOptions'=>array(
 *       'class'=>'ui-state-default'
 *   ),
 *   'options'=>array(
 *       'delay'=>'300',
 *   ),
 *   'htmlOptions'=>array(
 *       'class'=>'selectable'
 *   ),
 * ))
 *
 */
 
 GeCi::import('widgets.jui.CIJuiWidget');

class CIJuiSortable extends CIJuiWidget
{

	/**
	 * Item 
	 *
	 * @var 		array
	 * @access		public
	 */
	public $items=array();
	
	/**
	 * Open tag Name
	 *
	 * @var			string
	 * @access		public
	 */
	public $tagName='ul';
	
	/**
	 * Item html options
	 *
	 * @var			array
	 * @access		public
	 */
	public $itemHtmlOptions=array();
	
	/**
	 * Template layout
	 *
	 * @var			string
	 * @access		public
	 */
	public $itemTemplate='<li id="{id}" {items}>{content}</li>';

	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return 		void
	 */
	public function run()
	{		
		parent::__construct();
		echo CIHtml::openTag($this->tagName,$this->htmlOptions);
		
		if(isset($this->itemHtmlOptions['id']))
			unset($this->itemHtmlOptions['id']);
			
		$itemHtmlOptions=CIHtml::parseAttributes($this->itemHtmlOptions);
		
		foreach($this->items as $id=>$content)
		{
			echo strtr($this->itemTemplate,array(
				'{id}'=>$id,
				'{content}'=>$content,
				'{items}'=>$itemHtmlOptions
			));
		}
			
		echo CIHtml::closeTag($this->tagName);
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').sortable(". CIJavaScript::encode($this->options) .")"); 
	}
}