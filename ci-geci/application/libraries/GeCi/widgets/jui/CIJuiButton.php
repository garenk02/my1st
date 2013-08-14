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
 * CIJuiButton Class
 *
 * @package			CIJuiButton
 * @subpackage		JUI Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
 // ------------------------------------------------------------------------
 
/**
 * Example
 *
 * $this->geci->load('widgets.jui.CIJuiButton')->reg(array(
 *      'buttonType'=>'button',
 *      'label'=>'A button element'
 * ));
 *
 */

GeCi::import('widgets.jui.CIJuiWidget');

class CIJuiButton extends CIJuiWidget
{
	
	/**
	 * Button Type
	 * 
	 * @var			string
	 * @access		public
	 */
	public $buttonType='submit';
	
	/**
	 * Link Button
	 *
	 * @var			string
	 * @access		public
	 */
	public $url;
	
	/**
	 * Button Label
	 *
	 * @var			string
	 * @access		public
	 */
	public $label;
	
	/**
	 * Button List
	 *
	 * @var			array
	 * @access		public
	 */	
	public $buttonList=array();	
	
	/**
	 * ID static radio button
	 *
	 * @var			static numeric
	 * @access		public
	 */
	public static $rid=1;
	
	/**
	 * ID static checkbox button
	 *
	 * @var			static numeric
	 * @access		public
	 */
	public static $cid=1;
	
	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return		void
	 */
	public function run()
	{		
		parent::__construct();
		
		switch($this->buttonType)
		{
			case 'submit':
				$this->htmlOptions['value'] = $this->label;
				echo CIHtml::submitButton($this->htmlOptions);
			break;
			
			case 'button':
				$this->htmlOptions['content'] = $this->label;
				echo CIHtml::button($this->htmlOptions);
			break;
			
			case 'link':
				echo CIHtml::link($this->url,$this->label,$this->htmlOptions);
			break;
				
			case 'radio':
				echo CIHtml::openTag('div',$this->htmlOptions); 
					foreach($this->buttonList as $key=>$val)
					{
						$val['id']=$this->getId().'_radio_'.self::$rid++;
						echo CIHtml::radioButton($val) . form_label($val['label'],$val['id']);
					}
				echo CIHtml::closeTag('div');
			break;
				
			case 'checkbox':
				echo CIHtml::openTag('div',$this->htmlOptions); 
					$this->jButtonSet();
					$newId=$this->getNewId();
					foreach($this->buttonList as $key=>$val)
					{
						$val['id']=$newId.'_checkbox_'.self::$cid++;
						echo CIHtml::checkBox($val) . form_label($val['label'],$val['id']);
					}
				echo CIHtml::closeTag('div');
			break;
		}
		
		if($this->buttonType!=='radio')
			$this->jButton();
		elseif($this->buttonType=='checkbox')
			CIHtml::registerScriptBottom("jQuery('#". $this->getNewId() ."').button(". CIJavaScript::encode($this->options) .");"); 
		else
			$this->jButtonSet();
			
	}
	
	/**
	 * Script single button
	 *
	 * @access		public
	 * @return		void
	 */
	public function jButton()
	{
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').button(". CIJavaScript::encode($this->options) .");"); 
	}
	
	/**
	 * Script multi button
	 *
	 * @access		public
	 * @return		void
	 */
	public function jButtonSet()
	{
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').buttonset(".CIJavaScript::encode($this->options) .");"); 
	}
}
