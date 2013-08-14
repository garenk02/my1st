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
 * CIRedactor Class
 *
 * @package			CIRedactor
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CIRedactor')->reg(array(
 *      'name'=>'content'
 * ));
 */

GeCi::import('widgets.CIWidget');

class CIRedactor extends CIWidget
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
	 * Heigt Textarea
	 *
	 * @var			string
	 * @access		public
	 */
	public $height='200px';
	
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
		
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/redactor/redactor.min.js');
		CIHtml::registerCssFile(GeCi::assetManager()->getAssets().'/redactor/redactor.css');
			
		CIHtml::registerScriptBottom("jQuery('#".$this->getId()."').redactor(".CIJavaScript::encode($this->options).");"); 
		
		echo CIHtml::textArea($this->htmlOptions);
	}
}
