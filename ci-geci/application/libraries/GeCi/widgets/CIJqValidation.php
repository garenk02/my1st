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
 * CIJqValidation Class
 *
 * @package			CIJqValidation
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CIJqValidation')->reg(array(
 *      'id'=>'register-form',
 *      'options'=>array(
 *           'rules'=>array(
 *                'firstname'=>'required',
 *                'username'=>array(
 *                      'required'=>true,
 *                      'minlength'=>6
 *                 ),
 *                'email'=>array(
 *                      'required'=>true,
 *                      'email'=>true
 *                 ),
 *           ),
 *      )
 * ));
 */

GeCi::import('widgets.CIWidget');

class CIJqValidation extends CIWidget
{	
	
	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return 		void
	 */
	public function run()
	{
		parent::__construct();
		
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/jquery.validate.min.js');
		CIHtml::registerScriptBottom("jQuery('#".$this->getId()."').validate(". CIJavaScript::encode($this->options) .");");
	}
}