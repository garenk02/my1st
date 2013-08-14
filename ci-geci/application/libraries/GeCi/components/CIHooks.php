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
 * @since			Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Hooks function
 *
 * @package			Hooks
 * @subpackage		Widget
 * @category		Components
 * @author			Dida Nurwanda
 */
 
class CIHooks
{
	public function execute()
	{
		$CI=& get_instance();
		$buffer=$CI->output->get_output();
		$buffer = str_replace("</title>","</title>".$this->__meta().$this->__styleFileTop().$this->__scriptFileTop().$this->__styleTop().$this->__scriptTop(),$buffer);
		$buffer = str_replace("</body>",$this->__styleFileBottom().$this->__scriptFileBottom().$this->__styleBottom().$this->__scriptBottom()."\n</body>",$buffer);
		$CI->output->set_output($buffer);
		$CI->output->_display();
	}
	
	public function __meta()
	{
		$meta=isset(CIHtml::$meta) ? CIHtml::$meta : array();
		if(count($meta)>0)
		{
			$scr='';
			foreach(array_unique($meta) as $key=>$val)
				$scr.="\n\t".$val;
		}
		else
			$scr='';
		return $scr;
	}

	function __scriptTop()
	{
		$script=isset(CIHtml::$scriptTop) ? CIHtml::$scriptTop : array();
		if(count($script)>0)
		{
			$scr="<script type='text/javascript'>\n/*<![CDATA[*/\njQuery(function(){";
			foreach(array_unique($script) as $key=>$val)
				$scr.="\n".$val;
			$scr.="\n});\n/*]]>*/\n</script>";
		}
		else
			$scr='';
		return $scr;
	}
	
	function __scriptFileTop()
	{
		$script=isset(CIHtml::$scriptFileTop) ? CIHtml::$scriptFileTop : array();
		if(count($script)>0)
		{
			$scr='';
			foreach(array_unique($script) as $key=>$val)
				$scr.="\t".$val;
		}
		else
			$scr='';
		return $scr;
	}

	function __styleTop()
	{
		$style=isset(CIHtml::$styleTop) ? CIHtml::$styleTop : array();
		if(count($style)>0)
		{
			$scr="\t<style type='text/css'>";
			foreach(array_unique($style) as $key=>$val)	
				$scr.="\n\t".$val;
			$scr.="\n\t</style>\n";
		}
		else
			$scr='';
		return $scr;
	}

	function __styleFileTop()
	{
		$style=isset(CIHtml::$styleFileTop) ? CIHtml::$styleFileTop : array();
		if(count($style)>0)
		{
			$scr="";
			foreach(array_unique($style) as $key=>$val)
				$scr.="\t".$val."\n";
		}
		else
			$scr='';
		return $scr;
	}
	
	function __scriptBottom()
	{
		$script=isset(CIHtml::$scriptBottom) ? CIHtml::$scriptBottom : array();
		if(count($script)>0)
		{
			$scr="<script type=\"text/javascript\">\n/*<![CDATA[*/\njQuery(function(){";
			foreach(array_unique($script) as $key=>$val)
				$scr.="\n".$val;
			$scr.="\n});\n/*]]>*/\n</script>";
		}
		else
			$scr='';
		return $scr;
	}

	function __scriptFileBottom()
	{
		$script=isset(CIHtml::$scriptFileBottom) ? CIHtml::$scriptFileBottom : array();
		if(count($script)>0)
		{
			$scr='';
			foreach(array_unique($script) as $key=>$val)
				$scr.=$val."\n";
		}	
		else
			$scr='';
		return $scr;
	}

	function __styleBottom()
	{
		$style=isset(CIHtml::$styleBottom) ? CIHtml::$styleBottom : array();
		if(count($style)>0)
		{
			$scr="<style type=\"text/css\">";
			foreach(array_unique($style) as $key=>$val)	
				$scr.="\n".$val;
			$scr.="\n</style>\n";
		}
		else
			$scr='';
		return $scr;
	}

	function __styleFileBottom()
	{
		$style=isset(CIHtml::$styleFileBottom) ? CIHtml::$styleFileBottom : array();
		if(count($style)>0)
		{
			$scr='';
			foreach(array_unique($style) as $key=>$val)
				$scr.=$val."\n";
		}
		else
			$scr='';
		return $scr;
	}
}