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
 * CIButtonGrid Class
 *
 * @package			CIButtonGrid
 * @subpackage		Grid Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
/**
 * Example
 *
 * 	$this->geci->load('widgets.grid.CIButtonGrid')->actions(array(
 *		'viewUrl'=>site_url($controller.'/view/'.$row['id']),
 *		'updateUrl'=>site_url($controller.'/update/'.$row['id']),
 *		'deleteUrl'=>site_url($controller.'/delete/'.$row['id']),
 *	)),
 */

GeCi::import('widgets.CIWidget');

class CIButtonGrid extends CIWidget
{	
	
	/**
	 * Template button actions
	 *
	 * @var			string
	 * @access		public
	 */
	public $templateActions='{view} {update} {delete}';
	
	/**
	 * Url view botton
	 *
	 * @var			string
	 * @access		public
	 */
	public $viewUrl='#';
	
	/**
	 * Url update button
	 *
	 * @var			string
	 * @access		public
	 */
	public $updateUrl='#';
	
	/**
	 * Url delete button
	 *
	 * @var			string
	 * @access		public
	 */
	public $deleteUrl='#';
	
	/**
	 * Pesan delete
	 *
	 * @var			string
	 * @access		public
	 */
	public $deleteMsg='Are you sure you want to delete this item?';
	
	/**
	 * Adding Buttons
	 *
	 * @var			array
	 * @access		public
	 */
	public $buttons=array();
	
	/**
	 * Button All
	 *
	 * @var 		array
	 * @access		public
	 */
	public $buttonData=array();
	
	/**
	 * Width button column
	 *
	 * @var 		integer
	 * @access		public
	 */
	public $widthColumn=60;
	
	/**
	 * Display header column actoin
	 *
	 * @var 		string
	 * @access		public
	 */
	public $displayColumn='Action';
	
	/**
	 * Name header column button
	 *
	 * @var 		string
	 * @access		public
	 */
	public $nameColumn='action';
	
	/**
	 * Align header action
	 *
	 * @var 		center
	 * @access		public
	 */
	public $alignColumn='center';
		
	/**
	 * Get Button Actions
	 *
	 * @access		public
	 * @param		array
	 * @return		array
	 */
	public function actions($data=array())
	{
		$this->autoRegister($data);
		$this->buttonData['view']=$this->actionView();
		$this->buttonData['update']=$this->actionUpdate();
		$this->buttonData['delete']=$this->actionDelete();
		if(isset($this->buttons))
			foreach($this->buttons as $key=>$val)
				$this->buttonData[$key]=$this->parseButtons($val);
		
		$btn=array();
		foreach($this->buttonData as $key=>$val)
			$btn['{'.$key.'}']=$val;
		$button=strtr($this->templateActions, $btn);
		return $button;
	}
	
	/**
	 * Create Buttons
	 *
	 * @access		public
	 * @param		array
	 * @return		string
	 */
	public function parseButtons($val)
	{
		$url=isset($val['url']) ? $val['url'] : false;
		$icon=isset($val['icon']) ? img($val['icon']).' ' : false;
		$label=isset($val['label']) ? $val['label'] : false;
		$htmlOptions=isset($val['htmlOptions']) ? $val['htmlOptions'] : false;
		
		return anchor($url,$icon.$label,$htmlOptions);
	}
	
	/**
	 * Create Button View
	 *
	 * @access		public
	 * @return		string
	 */
	public function actionView()
	{
		return anchor(
			$this->viewUrl,
			img(GeCi::assetManager()->getAssets().'/flexigrid/css/images/eye.png'),
			array('title'=>'View','rel'=>'tooltip')
		);
	}
	
	/**
	 * Create Button Update
	 *
	 * @access		public
	 * @return		string
	 */
	public function actionUpdate()
	{
		return anchor(
			$this->updateUrl,
			img(GeCi::assetManager()->getAssets().'/flexigrid/css/images/pencil_add.png'),
			array('title'=>'Update','rel'=>'tooltip')
		);
	}
	
	/**
	 * Create button delete
	 *
	 * @access		public
	 * @return		string
	 */
	public function actionDelete()
	{
		return anchor(
			$this->deleteUrl,
			img(GeCi::assetManager()->getAssets().'/flexigrid/css/images/cancel.png'),
			array('title'=>'Delete','rel'=>'tooltip','onclick'=>'return confirm(\''.$this->deleteMsg.'\');')
		);
	}
	
	/**
	 * Get Button Columns
	 * 
	 * @access		public
	 * @param		array
	 * @return		array
	 */
	public function actionColumn($data=array())
	{
		$this->autoRegister($data);
		return array(
			'display'=>$this->displayColumn,
			'name'=>$this->nameColumn,
			'width'=>$this->widthColumn,
			'align'=>$this->alignColumn
		);
	}
}
