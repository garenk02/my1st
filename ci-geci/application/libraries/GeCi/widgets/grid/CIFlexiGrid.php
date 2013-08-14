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
 * CIFlexiGrid Class
 *
 * @package			CIFlexiGrid
 * @subpackage		Grid Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Contoh
 *
 * $this->geci->load('widgets.grid.CIFlexiGrid')->reg(array(
 *	'id'=>'country_model_grid',
 *	'options'=>array(
 *		'url'=>site_url('country/list_data'),
 *		'sortname'=>'id',
 *		'sortorder'=>'desc',
 *		'title'=>'Country',
 *		'colModel'=>array(
 *			$this->geci->load('widgets.grid.CIButtonGrid')->actionColumn(array('widthColumn'=>60)),
 *			array('display'=>'Id', 'name'=>'id', 'width'=>140, 'sortable'=>true, 'align'=>'center'),
 *			array('display'=>'Iso', 'name'=>'iso', 'width'=>140, 'sortable'=>true, 'align'=>'center'),
 *			array('display'=>'Name', 'name'=>'name', 'width'=>140, 'sortable'=>true, 'align'=>'center'),
 *			array('display'=>'Printable Name', 'name'=>'printable_name', 'width'=>140, 'sortable'=>true, 'align'=>'center'),
 *			array('display'=>'Iso3', 'name'=>'iso3', 'width'=>140, 'sortable'=>true, 'align'=>'center'),
 *			array('display'=>'Numcode', 'name'=>'numcode', 'width'=>140, 'sortable'=>true, 'align'=>'center'),
 *		),
 *		'buttons'=>array(
 *			array('name'=>'Create','bclass'=>'create','onpress'=>'js:fgbutton')
 *		)
 *	)
 * ));
 */

GeCi::import('widgets.CIWidget');

class CIFlexiGrid extends CIWidget
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
		
		$this->clientScriptOptions();
		
		echo CIHtml::tag('table',$this->htmlOptions,'',true);
		
		CIHtml::registerScriptFileBottom(GeCi::assetManager()->getAssets().'/flexigrid/flexigrid.pack.js');
		CIHtml::registerCssFile(GeCi::assetManager()->getAssets().'/flexigrid/css/flexigrid.pack.css');
		CIHtml::registerScriptBottom("jQuery('#".$this->getId()."').flexigrid(".CIJavaScript::encode($this->options).");"); 
	}
	
	
	/**
	 * Register Script
	 *
	 * @access		public
	 * @return		void
	 */
	public function clientScriptOptions()
	{
		if (!array_key_exists('dataType', $this->options))
            $this->options['dataType'] = 'json';
		
		if (!array_key_exists('usepager', $this->options))
			$this->options['usepager'] = true;
		
		if (!array_key_exists('searchitems', $this->options))
		{
			$search=array();
			foreach($this->options['colModel'] as $row)
			{
				if($row['display']!='Action')
					$search[]=array('display'=>$row['display'],'name'=>$row['name']);
			}
			$this->options['searchitems']=$search;
		}
	}
}
