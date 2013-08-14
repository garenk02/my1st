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
 * CIStrongPassword Class
 *
 * @package			CIStrongPassword
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CIStrongPassword')->reg(array(
 *	'htmlOptions'=>array(
 *		'name'=>'password'
 *	)
 * ));
 */

GeCi::import('widgets.CIWidget');

class CIStrongPassword extends CIWidget
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
		echo CIHtml::passwordField($this->htmlOptions);
		
		if(!isset($this->options['minChar']))
			$this->options['minChar']=4;
			
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/digitialspaghetti.password.min.js');
		CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').pstrength(". CIJavaScript::encode($this->options) .");");
	}
}