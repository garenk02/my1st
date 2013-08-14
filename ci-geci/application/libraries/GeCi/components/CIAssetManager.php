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
 * CIAssetManager Class
 *
 * @package			CIAssetManager
 * @subpackage		Components
 * @category		Components
 * @author			Dida Nurwanda
 */

GeCi::import('components.CIComponents');

class CIAssetManager extends CIComponents
{
	/**
	 * Path Default Assets
	 *
	 * @var 		string
	 * @access 		public
	 */
	public $assetDefault;
	
	/**
	 * Path New Assets
	 *
	 * @var 		string
	 * @access 		public
	 */
	public $assets;
	
	/**
	 * Instance 
	 *
	 * @var			static
	 * @access		public
	 */
	public static $instance;
	
	/**
	 * Constructor
	 *
	 * @access		public
	 * @return	 	void
	 */	
	public function __construct()
	{
		$this->assets = GeCi::config('asset_path');
		$this->assetDefault = APPPATH.'libraries/GeCi/assets';
	}
	
	/**
	 * Create Instance
	 *
	 * @access		public
	 * @param		object
	 */
	public function getInstance()
	{
		if(self::$instance==null)
			self::$instance=new self;
		return self::$instance;
	}
	
	/**
	 * Execute Assets
	 *
	 * @access		public
	 * @return	 	void
	 */
	public function run()
	{
		if(ENVIRONMENT=='development')
		{
			if(GeCi::config('asset_load')==2)
				$this->registerAssets($this->assetDefault,$this->assets);
			elseif(GeCi::config('asset_load')==1)
				$this->registerAssetsOnce($this->assetDefault,$this->assets);
		}
	}
	
	/**
	 * Register Assets
	 *
	 * @access		public
	 * @param		string
	 * @return		void
	 */
	public function registerAssets($before, $after='')
	{
		$afterAssets = $after=='' ? $this->assets : $after;
		if(ENVIRONMENT=='development')
		{
			$name=md5($before);
			@mkdir($afterAssets);
			@mkdir($afterAssets.'/'.$name);
			$this->createAssets($before, $afterAssets.'/'.$name);
		}
	}
	
	/**
	 * Register Assets with Check
	 *
	 * @access		public
	 * @param		string
	 * @return		void
	 */
	public function registerAssetsOnce($before, $after='')
	{
		$afterAssets = $after=='' ? $this->assets : $after;
		if(ENVIRONMENT=='development')
		{
			$name=md5($before);
			@mkdir($afterAssets);
			@mkdir($afterAssets.'/'.$name);
			$this->createAssetsOnce($before, $afterAssets.'/'.$name);
		}
	}
	
	/**
	 * Get Assets Path
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function getAssets($before='')
	{
		$before=$before=='' ? $this->assetDefault : $before;
		return base_url($this->assets.'/'.md5($before));
	}

	/**
	 * Create Assets
	 *
	 * @access		public
	 * @param		string
	 * @return		void
	 */
	public function createAssets($before, $after)
	{
		if(is_dir($before))
		{
			@mkdir($after);
			$allDir=scandir($before);
			foreach($allDir as $row)
			{
				if($row!=='.' and $row!=='..')
				{
					if(is_dir($before.'/'.$row))
					{
						self::createAssets($before.'/'.$row,$after.'/'.$row);
					}	
					else
					{
						copy($before.'/'.$row,$after.'/'.$row);
					}
				}
			}
		}
		else
		{
			copy($before, $after);
		}
	}
	
	
	/**
	 * Create Assets with Check
	 *
	 * @access		public
	 * @param		string
	 * @return		void
	 */
	public function createAssetsOnce($before, $after)
	{
		if(is_dir($before))
		{
			if(!is_dir($after))
				@mkdir($after);
			
			$allDir = scandir($before);
			foreach($allDir as $row)
			{
				if($row!=='.' && $row!='..')
				{
					if(is_dir($before.'/'.$row))
					{
						if(!is_dir($after.'/'.$row))
							@mkdir($after.'/'.$row);
						
						self::createAssetsOnce($before.'/'.$row, $after.'/'.$row);
					}
					else
					{
						if(!file_exists($after.'/'.$row))
							copy($before.'/'.$row, $after.'/'.$row);
					}
				}
			}
		}
		else
		{
			if(!file_exists($after))
				copy($before, $after);
		}
	}
	
	/**
	 * Clear Assets
	 *
	 * @access		public
	 * @param		string
	 * @return		void
	 */
	public function clearAssets()
	{
		$this->deleteDir($this->assets);
	}
	
	/**
	 * Delete Folder
	 *
	 * @access		public
	 * @param		string
	 * @return		void
	 */
	public static function deleteDir($dirPath) 
	{
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') 
		{
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}
		@rmdir($dirPath);
	}
}