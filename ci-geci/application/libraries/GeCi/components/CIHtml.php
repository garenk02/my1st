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
 * CIHtml Class
 *
 * @package			CIHtml
 * @subpackage		Widget
 * @category		Components
 * @author			Dida Nurwanda
 */

class CIHtml extends GeCi
{
	
	/**
	 * File js atas
	 *
	 * @var			array
	 * @access		public
	 */
	public static $scriptFileTop=array();
	
	/**
	 * File css atas
	 *
	 * @var			array
	 * @access		public
	 */
	public static $styleFileTop=array();
	
	/**
	 * Js atas
	 *
	 * @var			array
	 * @access		public
	 */
	public static $scriptTop=array();
	
	/**
	 * Css atas
	 *
	 * @var			array
	 * @access		public
	 */
	public static $styleTop=array();
	
	/**
	 * File js bawah
	 *
	 * @var			array
	 * @access		public
	 */
	public static $scriptFileBottom=array();
	
	/**
	 * File css bawah
	 *
	 * @var			array
	 * @access		public
	 */
	public static $styleFileBottom=array();
	
	/**
	 * Js bawah
	 *
	 * @var			array
	 * @access		public
	 */
	public static $scriptBottom=array();
	
	/**
	 * Css bawah
	 *
	 * @var			array
	 * @access		public
	 */
	public static $styleBottom=array();
	
	public static $meta=array();
	
	const REQUIRED = ' <span class="required">*</span>';
	
	/**
	 * Tutup single tag
	 *
	 * @var			boolean
	 * @access		public
	 */
	public static $closeSingleTags=true;
	
	/**
	 * Form pembuka
	 *
	 * @access		public
	 * @param		string array
	 * @return		string
	 */
	public function formOpen($action = '', $attributes = '', $hidden = array())
	{
		return form_open($action, $attributes, $hidden);
	}
	
	/**
	 * Form pembuka multipart
	 *
	 * @access		public
	 * @param		string array
	 * @return		string
	 */	
	public function formOpenMultiPart($action = '', $attributes = array(), $hidden = array())
	{
		return form_open_multipart($action, $attributes, $hidden);
	}	
	
	/**
	 * Input hidden
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function formHidden($name, $value = '', $recursing = FALSE)
	{
		return form_hidden($name, $value, $recursing);
	}
	
	/**
	 * Input text
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function textField($data = '', $value = '', $extra = '')
	{
		return form_input($data, $value, $extra);
	}
	
	/**
	 * Input password
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function passwordField($data = '', $value = '', $extra = '')
	{
		return form_password($data, $value, $extra);
	}
	
	/**
	 * Input file
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function fileField($data = '', $value = '', $extra = '')
	{
		return form_upload($data, $value, $extra);
	}
	
	/**
	 * Textarea
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function textArea($data = '', $value = '', $extra = '')
	{
		return form_textarea($data, $value, $extra);
	}
	
	/**
	 * Dropdown List
	 *
	 * @access		public
	 * @param		string array
	 * @return		string
	 */
	public function dropDownList($name = '', $options = array(), $selected = array(), $extra = '')
	{
		return form_multiselect($name, $options, $selected, $extra);
	}
	
	/**
	 * Dropdown
	 *
	 * @access		public
	 * @param		string array
	 * @return		string
	 */
	public function dropDown($name = '', $options = array(), $selected = array(), $extra = '')
	{
		return form_dropdown($name, $options, $selected, $extra);
	}
	
	/**
	 * Input checkbox
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function checkBox($data = '', $value = '', $checked = FALSE, $extra = '')
	{
		return form_checkbox($data, $value, $checked, $extra);
	}
	
	/**
	 * Input radio
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function radioButton($data = '', $value = '', $checked = FALSE, $extra = '')
	{
		return form_radio($data, $value, $checked, $extra);
	}
	
	/**
	 * Input submit
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function submitButton($data = '', $value = '', $extra = '')
	{
		return form_submit($data, $value, $extra);
	}
	
	/**
	 * Input reset
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function resetButton($data = '', $value = '', $extra = '')
	{
		return form_reset($data, $value, $extra);
	}
	
	/**
	 * Button
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function button($data = '', $content = '', $extra = '')
	{
		return form_button($data, $content, $extra);
	}
	
	/**
	 * Label
	 *
	 * @access		public
	 * @param		string array
	 * @return		string
	 */
	public function label($label_text = '', $id = '', $attributes = array())
	{
		return form_label($label_text, $id, $attributes);
	}
	
	/**
	 * Fieldset
	 *
	 * @access		public
	 * @param		string array
	 * @return		string
	 */
	public function fieldSet($legend_text = '', $attributes = array())
	{
		return form_fieldset($legend_text, $attributes);
	}
	
	/**
	 * Fieldset penutup
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function fieldSetClose($extra = '')
	{
		return form_fieldset_close($extra);
	}
	
	/**
	 * Form penutup
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function formClose($extra = '')
	{
		return form_close($extra);
	}
	
	/**
	 * Prepped
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function prep($str = '', $field_name = '')
	{
		return form_prep($str, $field_name);
	}
	
	/**
	 * Set value
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function setValue($field = '', $default = '')
	{
		return set_value($field, $default);
	}
	
	/**
	 * Set select
	 *
	 * @access		public
	 * @param		string boolean
	 * @return		string
	 */
	public function setSelect($field = '', $value = '', $default = FALSE)
	{
		return set_select($field, $value, $default);
	}
	
	/**
	 * Set checkbox
	 *
	 * @access		public
	 * @param		string boolean
	 * @return		string
	 */
	public function setCheckBox($field = '', $value = '', $default = FALSE)
	{
		return set_checkbox($field, $value, $default);
	}
	
	/**
	 * Set radio
	 *
	 * @access		public
	 * @param		string boolean
	 * @return		string
	 */
	public function setRadio($field = '', $value = '', $default = FALSE)
	{
		return set_radio($field, $value, $default);
	}
	
	/**
	 * Form error
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function formError($field = '', $prefix = '', $suffix = '')
	{
		return form_error($field, $prefix, $suffix);
	}
	
	/**
	 * Validation error
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function validationErrors($prefix = '', $suffix = '')
	{
		return validation_errors($prefix, $suffix);
	}
	
	/**
	 * Site Url
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function siteUrl($uri = '')
	{
		return site_url($uri);
	}
	
	/**
	 * Base Url
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function baseUrl($uri = '')
	{
		return base_url($uri);
	}
	
	/**
	 * Current Url
	 *
	 * @access		public
	 * @return		string
	 */
	public function currentUrl()
	{
		return current_url();
	}
	
	/**
	 * Uri string
	 *
	 * @access		public
	 * @return		string
	 */
	public function uriString()
	{
		return uri_string();
	}
	
	/**
	 * index page
	 *
	 * @access		public
	 * @return		string
	 */
	public function indexPage()
	{
		return index_page();
	}
	
	/**
	 * Link
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function link($uri = '', $title = '', $attributes='')
	{
		$attributes['href']=$uri;
		return self::tag('a',$attributes,$title,true);
	}
	
	/**
	 * PopUp
	 *
	 * @access		public
	 * @param		string boolean
	 * @return		string
	 */
	public function linkPopUp($uri = '', $title = '', $attributes = FALSE)
	{
		return anchor_popup($uri, $title, $attributes);
	}
	
	/**
	 * Mailto
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function linkEmail($email, $title = '', $attributes = '')
	{
		return mailto($email, $title, $attributes);
	}
	
	/**
	 * Mailto safe
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function linkEmailSafe($email, $title = '', $attributes = '')
	{
		return safe_mailto($email, $title, $attributes);
	}
	
	/**
	 * Linkauto
	 *
	 * @access		public
	 * @param		string boolean
	 * @return		string
	 */
	public function linkAuto($str, $type = 'both', $popup = FALSE)
	{
		return auto_link($str, $type, $popup);
	}
	
	/**
	 * Prep link
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function prepLink($str = '')
	{
		return prep_url($str);
	}
	
	/**
	 * Link title
	 *
	 * @access		public
	 * @param		string boolean
	 * @return		string
	 */
	public function linkTitle($str, $separator = '-', $lowercase = FALSE)
	{	
		return url_title($str, $separator, $lowercase);
	}
	
	/**
	 * redirect
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function redirect($uri = '', $method = 'location', $http_response_code = 302)
	{
		return redirect($uri, $method, $http_response_code);
	}
	
	/**
	 * Heading 
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function heading($data = '', $h = '1', $attributes = '')
	{
		return heading($data, $h, $attributes);
	}
	
	/**
	 * UL
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function ul($list, $attributes = '')
	{
		return ul($list, $attributes);
	}
	
	/**
	 * OL
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function ol($list, $attributes = '')
	{
		return ol($list, $attributes);
	}
	
	/**
	 * List data
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function listData($type = 'ul', $list, $attributes = '', $depth = 0)
	{
		return _list($type, $list, $attributes, $depth);
	}
	
	/**
	 * BR
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function br($num = 1)
	{
		return br($num);
	}
	
	/**
	 * Img
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function image($src = '', $index_page = FALSE)
	{
		return img($src, $index_page);
	}
	
	/**
	 * Doctype
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function doctype($type = 'xhtml1-strict')
	{
		return doctype($type);
	}
	
	/**
	 * Meta tag
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function registerMetaTag($name = '', $content = '', $type = 'name', $newline = "\n")
	{
		self::$meta[] =  meta($name, $content, $type, $newline);
	}
	
	/**
	 * Meta tag
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function metaTag($name = '', $content = '', $type = 'name', $newline = "\n")
	{
		return meta($name, $content, $type, $newline);
	}
	
	/**
	 * NBS
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function nbs($num = 1)
	{
		return nbs($num);
	}
	
	/**
	 * Tag
	 *
	 * @access		public
	 * @param		string array boolean
	 * @return		string
	 */
	public static function tag($tag,$htmlOptions=array(),$content=false,$closeTag=true)
	{
		$html='<' . $tag . self::parseAttributes($htmlOptions);
		
		if($content===false)
			return $closeTag && self::$closeSingleTags ? $html.' />' : $html.'>';
		else
			return $closeTag ? $html.'>'.$content.'</'.$tag.'>' : $html.'>'.$content;
	}
	
	/**
	 * Tag open
	 *
	 * @access		public
	 * @param		string array
	 * @return		string
	 */
	public static function openTag($tag,$htmlOptions=array())
	{
		return '<' . $tag . self::parseAttributes($htmlOptions) . '>';
	}
	
	/**
	 * Tag close
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public static function closeTag($tag)
	{
		return '</'.$tag.'>';
	}
	
	/**
	 * Parse tag
	 *
	 * @access		public
	 * @param		array
	 * @return		string
	 */
	public function parseAttributes($htmlOptions=array())
	{
		$html='';
		foreach($htmlOptions as $key=>$val)
			$html.= ' '.$key .'="'. $val.'"';
		return $html;
	}
	
	/**
	 * Css file top
	 *
	 * @access		public
	 * @param		string boolean
	 * @return		string
	 */
	public function registerCssFile($href = '', $rel = 'stylesheet', $type = 'text/css', $title = '', $media = '', $index_page = FALSE)
	{
		self::$styleFileTop[] = link_tag($href, $rel, $type, $title, $media, $index_page);
	}

	/**
	 * Css top
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function registerStyle($style = '')
	{
		self::$styleTop[] = $style;
	}
	
	/**
	 * Script top
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function registerScript($script = '')
	{
		self::$scriptTop[] = $script;
	}
	
	/**
	 * Script file top
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function registerScriptFile($path = '')
	{
		self::$scriptFileTop[] = self::tag('script',array('type'=>'text/javascript','src'=>$path),'',true); 
	}
	
	/**
	 * Css file bottom
	 *
	 * @access		public
	 * @param		string boolean
	 * @return		string
	 */
	public function registerCssFileBottom($href = '', $rel = 'stylesheet', $type = 'text/css', $title = '', $media = '', $index_page = FALSE)
	{
		self::$styleFileBottom[] = link_tag($href, $rel, $type, $title, $media, $index_page);
	}
	
	/**
	 * Css bottom
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function registerStyleBottom($style = '')
	{
		self::$styleBottom[] = $style;
	}
	
	/**
	 * Script bottom
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function registerScriptBottom($script = '')
	{
		self::$scriptBottom[] = $script;
	}
	
	/**
	 * Script file bottom
	 *
	 * @access		public
	 * @param		string
	 * @return		string
	 */
	public function registerScriptFileBottom($path = '')
	{
		self::$scriptFileBottom[] = self::tag('script',array('type'=>'text/javascript','src'=>$path),'',true); 
	}
}