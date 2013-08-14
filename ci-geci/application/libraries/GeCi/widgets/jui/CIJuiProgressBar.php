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
 * CIJuiProgressBar Class
 *
 * @package			CIJuiProgressBar
 * @subpackage		JUI Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
 // ------------------------------------------------------------------------
 
/**
 * Example
 *
 * $this->geci->load('widgets.jui.CIJuiProgressBar')->reg(array(
 *      'value'=>40
 * )); 
 *
 */

GeCi::import('widgets.jui.CIJuiWIdget');

class CIJuiProgressBar extends CIJuiWidget
{
	
	/**
	 * Tag Name
	 *
	 * @var			string
	 * @access		public
	 */
	public $tagName='div';
	
	/**
	 * Value Progress Bar
	 *
	 * @var			string
	 * @access		public
	 */
	public $value=0;
	
	/**
	 * Animate
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $animated=false;
	
	/**
	 * Animate Path
	 *
	 * @var			string
	 * @access		public
	 */
	public $animatePath;
	
	/**
	 * Resize
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $resizable=false;
	
	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return		string
	 */
	public function run()
	{
		parent::__construct();
		
		echo CIHtml::Tag($this->tagName,$this->htmlOptions,'',true);
		
		if(!isset($this->options['value']))
			$this->options['value']=$this->value;
		
		CIHtml::registerScript("jQuery('#". $this->getId() ."').progressbar(". CIJavaScript::encode($this->options) .");"); 
		
		if($this->resizable)
			CIHtml::registerScript("jQuery('#". $this->getId() ."').resizable({maxHeight:22,minHeight:22});"); 
		
		if($this->animated)
			CIHtml::registerStyle($this->tagName.'#'.$this->getId().'.ui-progressbar .ui-progressbar-value{ background-image: url( '.($this->animatePath===null ? base_url(APPPATH.'libraries/GeCi/assets/jquery-ui/images/pbar-ani.gif') : $this->animatePath).' )}');
	}
}