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
 * CIJuiTabs Class
 *
 * @package			CIJuiTabs
 * @subpackage		JUI Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
 // ------------------------------------------------------------------------
 
/**
 * Example
 *
 * $this->geci->load('widgets.jui.CIJuiTabs')->reg(array(
 *      'tabs'=>array(
 *           'Static Tab 1'=>'Content tab 1',
 *           'Static Tab 2'=>'Content tab 2',
 *           'Static Tab 3'=>'Content tab 3'
 *      )
 *  ));
 *
 */

GeCi::import('widgets.jui.CIJuiWidget');

class CIJuiTabs extends CIJuiWidget
{

	/**
	 * Tag Name
	 *
	 * @var 		string
	 * @accesss		public
	 */
	public $tagName='div';
	
	/**
	 * Item tabs
	 *
	 * @var 		array
	 * @access		public
	 */
	public $tabs=array();
	
	/**
	 * Template header
	 *
	 * @var			string
	 * @access		public
	 */
	public $headerTemplate='<li><a href="{url}" title="{id}">{title}</a></li>';
	
	/**
	 * Template content
	 *
	 * @var			string
	 * @access		public
	 */
	public $contentTemplate='<div id="{id}">{content}</div>';
	
	/**
	 * Sortable
	 * 
	 * @var			boolean
	 * @access		public
	 */
	public $sortable=false;
	
	/**
	 * Sort Options
	 *
	 * @var			array
	 * @access		public
	 */
	public $sortableOptions=array();
	
	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return		void
	 */
	public function run()
	{		
		parent::__construct();
		echo CIHtml::openTag($this->tagName,$this->htmlOptions);
		
		$tabsOut='';
		$contentOut='';
		$tabCount=0;
		
		foreach($this->tabs as $title=>$content)
		{
			$id=$this->getId();
			
			$tabId = (is_array($content) && isset($content['id']))?$content['id']:$id.'_tab_'.$tabCount++;

			if (!is_array($content))
			{
				$tabsOut .= strtr($this->headerTemplate, array('{title}'=>$title, '{url}'=>'#'.$tabId, '{id}'=>$title))."\n";
				$contentOut .= strtr($this->contentTemplate, array('{content}'=>$content,'{id}'=>$tabId))."\n";
			}
			else
			{
				$tabsOut .= strtr($this->headerTemplate, array('{title}'=>$title, '{url}'=>'#'.$tabId, '{id}'=>$title))."\n";
				if(isset($content['content']))
					$contentOut .= strtr($this->contentTemplate, array('{content}'=>$content['content'],'{id}'=>$tabId))."\n";
			}
		}
		echo "<ul>\n" . $tabsOut . "</ul>\n";
		echo $contentOut;

		echo CIHtml::closeTag($this->tagName)."\n";
		
		if($this->sortable)
			CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').tabs(". CIJavaScript::encode($this->options) .").find( '.ui-tabs-nav' ).sortable(". CIJavaScript::encode($this->sortableOptions) .");"); 
		else
			CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').tabs(". CIJavaScript::encode($this->options) .");");

	}
}
