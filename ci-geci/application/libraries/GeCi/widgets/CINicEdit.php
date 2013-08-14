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
 * CINicEdit Class
 *
 * @package			CINicEdit
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CINicEdit')->reg(array(
 *      'name'=>'content'
 * ));
 */

GeCi::import('widgets.CIWidget');

class CINicEdit extends CIWidget
{	
	/**
	 * Name Html Attributes
	 *
	 * @var			string
	 * @access		public
	 */
	public $name;
	
	/**
	 * Width Textarea
	 *
	 * @var			string
	 * @access		public
	 */
	public $width='100%';
	
	/**
	 * Height Textarea
	 *
	 * @var			string
	 * @access		public
	 */
	public $height='150px';
	
	
	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return		void
	 */
	public function run()
	{
		parent::__construct();
		
		if (!array_key_exists('style', $this->htmlOptions))
            $this->htmlOptions['style'] = "width:{$this->width};height:{$this->height};";
        
		if($this->name!=='')
			$this->htmlOptions['name']=$this->name;
		
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/nicEdit/nicEdit.js');
			
		$options=array_merge(array('iconsPath'=>GeCi::assetManager()->getAssets().'/nicEdit/nicEditorIcons.gif'),$this->options);
		CIHtml::registerScriptBottom("new nicEditor(". CIJavaScript::encode($options) .").panelInstance('".$this->getId()."');"); 
		
		echo CIHtml::textArea($this->htmlOptions);
	}	
}