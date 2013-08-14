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
 * CIJavaScript Class
 *
 * @package			CIJavaScript
 * @subpackage		Components
 * @category		Components
 * @author			Dida Nurwanda
 */
 
/**
 * Class ini mengambil ide dari Yii CJavaScript
 */

GeCi::import('components.CIComponents');

class CIJavaScript extends CIComponents
{
	
	/**
	 * Javascript encode
	 *
	 * @access		public
	 * @param		array boolean
	 * @return		string
	 */
	public static function encode($value,$safe=false)
	{
		if(is_string($value))
		{
			if(strpos($value,'js:')===0 && $safe===false)
				return substr($value,3);
			else
				return "'".self::quote($value)."'";
		}
		elseif($value===null)
			return 'null';
		elseif(is_bool($value))
			return $value?'true':'false';
		elseif(is_integer($value))
			return "$value";
		elseif(is_float($value))
		{
			if($value===-INF)
				return 'Number.NEGATIVE_INFINITY';
			elseif($value===INF)
				return 'Number.POSITIVE_INFINITY';
			else
				return rtrim(sprintf('%.8F',$value),'0');  // locale-independent representation
		}
		elseif(is_object($value))
			return self::encode(get_object_vars($value),$safe);
		elseif(is_array($value))
		{
			$es=array();
			if(($n=count($value))>0 && array_keys($value)!==range(0,$n-1))
			{
				foreach($value as $k=>$v)
					$es[]=self::quote($k).":".self::encode($v,$safe);
				return '{'.implode(',',$es).'}';
			}
			else
			{
				foreach($value as $v)
					$es[]=self::encode($v,$safe);
				return '['.implode(',',$es).']';
			}
		}
		else
			return '';
	}
		
	/**
	 * Quote convert
	 *
	 * @access 		public
	 * @param		string boolean
	 * @return		string
	 */
	public static function quote($js,$forUrl=false)
	{
		if($forUrl)
			return strtr($js,array('%'=>'%25',"\t"=>'\t',"\n"=>'\n',"\r"=>'\r','"'=>'\"','\''=>'\\\'','\\'=>'\\\\','</'=>'<\/'));
		else
			return strtr($js,array("\t"=>'\t',"\n"=>'\n',"\r"=>'\r','"'=>'\"','\''=>'\\\'','\\'=>'\\\\','</'=>'<\/'));
	}
	
	/**
	 * Json encode
	 *
	 * @access 		public
	 * @param		array
	 * @return		string
	 */
	public function jsonEncode($json)
	{
		return json_encode($json);
	}
	
	/**
	 * Json decode
	 *
	 * @access 		public
	 * @param		string
	 * @return		string
	 */
	public function jsonDecode($json)
	{
		return json_decode($json);
	}
}