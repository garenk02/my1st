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
 * CIFlowPlayer Class
 *
 * @package			CIFlowPlayer
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CIFlowPlayer')->reg(array(
 *      'video'=>CIHtml::baseUrl('assets/video/dora.flv'),
 * ));
 */

GeCi::import('widgets.CIWidget');

class CIFlowPlayer extends CIWidget
{		
	
	/**
	 * Video file
	 *
	 * @var			string
	 * @access		public
	 */
	public $video;
	
	/** 
	 * Running Widget
	 *
	 * @access		public
	 * @return		void
	 */
	public function run()
	{
		if(!isset($this->htmlOptions['style']))	
			$this->htmlOptions['style']='display:block;width:520px;height:330px';
			
		parent::__construct();
		
		echo CIHtml::link($this->video,'',$this->htmlOptions);
		
		$fp=GeCi::assetManager()->getAssets().'/flowplayer/flowplayer-3.2.10.swf';
		
		CIHtml::registerScriptBottom("flowplayer('{$this->getId()}','{$fp}');");
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/flowplayer/flowplayer-3.2.9.min.js');
	}
}