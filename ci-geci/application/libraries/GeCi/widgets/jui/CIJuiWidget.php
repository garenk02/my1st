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
 * CIJuiWidget Class
 *
 * @package			CIJuiWidget
 * @subpackage		Base Widget jQuery UI
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
GeCi::import('widgets.CIWidget');

abstract class CIJuiWidget extends CIWidget
{

	/**
	 * CSS jQuery UI File
	 *
	 * @var 		string
	 * @access		public
	 */
	public $cssFile='jquery-ui/css/base/jquery-ui.css';
	
	/**
	 * JS jQuery UI File
	 *
	 * @var			string
	 * @access		public
	 */
	public $jsFile='jquery-ui/js/jquery-ui.min.js';
	
	/** 
	 * I18n jQuery UI
	 *
	 * @var			string
	 * @access		public
	 */
	public $i18nFile='jquery-ui/js/jquery-ui-i18n.min.js';
	
	/**
	 * Path to jQuery Style
	 *
	 * @var			string
	 * @access		public
	 */
	public $pathCss;
	
	/**
	 * Path to jQuery Script
	 *
	 * @var			string
	 * @access		public
	 */
	public $pathJs;
	
	/**
	 * Path to jQuery Script
	 *
	 * @var			string
	 * @access		public
	 */
	public $pathJsI18n;
	
	/**
	 * Active I18n jQuery UI
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $i18nActive=false;
	
	/**
	 * Disable jQuery UI Css
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $disableCss=false;
	
	/**
	 * Disable jQuery UI Js
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $disableJs=false;
	
	/**
	 * Constructor
	 *
	 * @access		public
	 * @return		void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->regScript();
	}
	
	/**
	 * Register jQuery UI
	 *
	 * @access		protected
	 * @return		void
	 */
	protected function regScript()
	{
		if($this->disableCss==false)
		{
			if($this->pathCss===null)
				CIHtml::registerCssFile(GeCi::assetManager()->getAssets().'/'.$this->cssFile);
			else
				CIHtml::registerCssFile($this->pathCss.$this->cssFile);
		}
		
		if($this->disableJs==false)
		{
			if($this->pathJs===null)
				CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/'.$this->jsFile);
			else
				CIHtml::registerScriptFileBottom($this->pathJs.$this->jsFile);
		}
		
		if($this->pathJsI18n===null)
		{
			if($this->i18nActive)
				CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/'.$this->i18nFile);
		}
		else
		{
			if($this->i18nActive)
				CIHtml::registerScriptFileBottom($this->pathJsI18n.$this->i18nFile);
		}
	}
}