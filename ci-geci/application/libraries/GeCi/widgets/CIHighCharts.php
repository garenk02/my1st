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
 * CIHighCharts Class
 *
 * @package			CIHighCharts
 * @subpackage		Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * $this->geci->load('widgets.CIHighCharts')->reg(array(
 *      'options'=>array(
 *           'chart'=>array(
 *           'plotBackgroundColor'=>null,
 *           'plotBorderWidth'=>null,
 *           'plotShadow'=>false
 *       ),
 *       'title'=>array(
 *           'text'=>'Browser market shares at a specific website, 2010'
 *       ),
 *       'tooltip'=>array(
 *           'pointFormat'=>'{series.name}: <b>{point.percentage}%</b>',
 *           'percentageDecimals'=>1
 *       ),
 *       'plotOptions'=>array(
 *           'pie'=>array(
 *               'allowPointSelect'=>true,
 *               'cursor'=>'pointer',
 *               'dataLabels'=>array(
 *                   'enabled'=>true,
 *                   'color'=>'#000000',
 *                   'connectorColor'=>'#000000',
 *                   'formatter'=>'js:function(){
 *                       return \'<b>\' + this.point.name + \'</b>: \' + this.percentage + \' %\';
 *                   }',
 *               ),
 *           ),
 *       ),
 *       'series'=>array(
 *           array(
 *               'type'=>'pie',
 *               'name'=>'Browser Share',
 *               'data'=>array(
 *                   array('Firefox',45.0),
 *                   array('IE',26.8),
 *                   array(
 *                       'name'=>'Chrome',
 *                       'y'=>12.8,
 *                       'sliced'=>true,
 *                       'selected'=>true
 *                   ),
 *                   array('Safari',8.5),
 *                   array('Opera',6.2),
 *                   array('Others',0.7)
 *               )   
 *           )
 *       )
 *   )
 * ));
 */

GeCi::import('widgets.CIWidget');

class CIHighCharts extends CIWidget
{		

	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return		void
	 */
	public function run()
	{
		if(!isset($this->htmlOptions['style']))
			$this->htmlOptions['style']="min-width: 400px; height: 400px; margin: 0 auto";
			
		parent::__construct();
		
		if(!isset($this->options['chart']) || !isset($this->options['chart']['renderTo']))
		{
			echo CIHtml::tag('div',$this->htmlOptions,'',true);

			if (isset($this->options['chart']) && is_array($this->options['chart']))
				$this->options['chart']['renderTo'] = $this->getId();
			else
				$this->options['chart'] = array('renderTo' => $this->getId());
		}
		
		$this->registerClientScript();
	}
	
	/**
	 * Register script
	 *
	 * @access		public
	 * @return		void
	 */
	public function registerClientScript()
	{
		$defaultOptions = array('exporting' => array('enabled' => true));
		$this->options = array_merge($defaultOptions, $this->options);
		
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/highcharts/highcharts.js');
		
		if (isset($this->options['exporting']) && @$this->options['exporting']['enabled'])
			CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/highcharts/modules/exporting.js');
		if (isset($this->options['theme']))
			CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/highcharts/themes/' . $this->options['theme'] . '.js');
		
		
		$options=CIJavaScript::encode($this->options);
		CIHtml::registerScriptBottom("var highchart{$this->getId()} = new Highcharts.Chart({$options});");
	}
}