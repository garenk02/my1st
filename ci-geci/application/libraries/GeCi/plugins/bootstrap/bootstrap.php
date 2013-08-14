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
 * bootstrap Class
 *
 * @package			bootstrap
 * @subpackage		Bootstrap
 * @category		Widget
 * @author			Dida Nurwanda
 */

GeCi::import('widgets.CIWidget');

class bootstrap extends CIWidget
{

	/**
	 * jQuery UI Bootstrap
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $jqueryCss = false;
	
	/**
	 * Tooltips Selector
	 *
	 * @var			string
	 * @access		public
	 */
	public $tooltipSelector = 'a[rel="tooltip"]';
	
	/**
	 * Popover Selector
	 *
	 * @var			string
	 * @access		public
	 */
	public $popoverSelector = 'a[rel="popover"]';
	
	/**
	 * Resposive CSS
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $responsiveCss = false;
	
	/**
	 * Bootstrap JavaScript
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $enableJs = true;
	
	/**
	 * Bootstrap CSS
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $coreCss = true;
	
	/**
	 * Style CSS
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $templateStyle = false;
	
	/**
	 * Assets path
	 *
	 * @var			string
	 * @access		public
	 */
	public $assets;
	
	/**
	 * Assets URL
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $assetsUrl;
	
	/**
	 * Constructor
	 *
	 * @access		public
	 * @return		void
	 */
	public function init()
	{
		parent::__construct();
		$this->assets = APPPATH.'libraries/GeCi/plugins/bootstrap/assets';
	}
	
	/**
	 * Execute
	 *
	 * @access		public
	 * @return		void
	 */
	public function run()
	{
		$this->getAssetsUrl();
		
		if($this->enableJs)
			$this->registerJs();
			
		if($this->coreCss)
			$this->registerCoreCss();
		
		if($this->responsiveCss)
			$this->registerResponsiveCss();
			
		if($this->jqueryCss)
			$this->registerJqueryCss();
			
		if($this->templateStyle)
			$this->getTemplateStyle();
	}
	
	/**
	 * Get Assets URL
	 *
	 * @access		public
	 * @return		string
	 */
	public function getAssetsUrl()
	{
		if(isset($this->assetsUrl))
			return $this->assetsUrl;
		else
		{
			$this->assetManager()->registerAssets($this->assets);
			return $this->assetsUrl = $this->assetManager()->getAssets($this->assets);
		}
	}
	
	/**
	 * Register CSS Responsive
	 *
	 * @access		public
	 * @return		void
	 */
	public function registerResponsiveCss()
	{
		CIHtml::registerMetaTag('viewport','width=device-width, initial-scale=1.0');
		CIHtml::registerCssFile($this->getAssetsUrl().'/css/bootstrap-responsive.min.css');
	}
	
	/**
	 * Register JS 
	 *
	 * @access		public
	 * @return		void
	 */
	public function registerJs()
	{
		CIHtml::registerScriptFileBottom($this->getAssetsUrl().'/js/bootstrap.min.js');\
		CIHtml::registerScriptBottom("jQuery('".$this->tooltipSelector."').tooltip();\njQuery('".$this->popoverSelector."').popover();");
	}
	
	/**
	 * Register CSS
	 *
	 * @access		public
	 * @return		void
	 */
	public function registerCoreCss()
	{
		CIHtml::registerCssFile($this->getAssetsUrl().'/css/bootstrap.min.css');
		CIHtml::registerCssFile($this->getAssetsUrl().'/css/bootstrap-geci.css');
	}
	
	/**
	 * jQuery UI Bootstrap
	 *
	 * @access		public
	 * @return		void
	 */
	public function registerJqueryCss()
	{
		CIHtml::registerCssFile($this->getAssetsUrl().'/css/jquery-ui-bootstrap.css');
	}
	
	/**
	 * Template Style
	 *
	 * @access		public
	 * @return		void
	 */
	public function getTemplateStyle()
	{
		CIHtml::registerCssFile($this->assetsUrl.'/style/style.css');
	}
}
