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
 * CIComponents Class
 *
 * @package			CIComponents
 * @subpackage		Base Components
 * @category		Components
 * @author			Dida Nurwanda
 */

class CIComponents extends GeCi
{
	public static $CI;
	
	public function __construct()
	{
		$this->CI=&get_instance();
	}
}