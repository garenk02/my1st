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
 * CIJuiAutoComplete Class
 *
 * @package			CIJuiAutoComplete
 * @subpackage		JUI Widget
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
 // ------------------------------------------------------------------------
 
/**
 * Example
 *
 * $this->geci->load('widgets.jui.CIJuiAutoComplete')->reg(array(
 *      'options'=>array(
 *           'source'=>array('Aku','Bisa','Cinta','Dan','Engga','Fantasi','Gundah','Hati','Ini','Jika')
 *      )
 * ));
 *
 */

GeCi::import('widgets.jui.CIJuiWidget');

class CIJuiAutoComplete extends CIJuiWidget
{

	/**
	 * Running Categori AutoComplete
	 *
	 * @var			boolean
	 * @access		public
	 */
	public $catcomplete=false;
	
	/**
	 * Running Widget
	 *
	 * @access		public
	 * @return		void
	 */
	public function run()
	{
		parent::__construct();
		
		echo CIHtml::textField($this->htmlOptions);
		
		if($this->catcomplete)
		{
			$this->catcompleteActive();
			CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').catcomplete(". CIJavaScript::encode($this->options) .");"); 
		}
		else
			CIHtml::registerScriptBottom("jQuery('#". $this->getId() ."').autocomplete(". CIJavaScript::encode($this->options) .");"); 
	}
	
	public function catcompleteActive()
	{
CIHtml::registerScriptBottom('$.widget( "custom.catcomplete", $.ui.autocomplete, {
    _renderMenu: function( ul, items ) {
        var self = this,
            currentCategory = "";
        $.each( items, function( index, item ) {
            if ( item.category != currentCategory ) {
                ul.append( "<li class=\'ui-autocomplete-category\'>" + item.category + "</li>" );
                currentCategory = item.category;
            }
            self._renderItem( ul, item );
        });
    }
});'); 
CIHtml::registerStyle('.ui-autocomplete-category {
    font-weight: bold;
    padding: .2em .4em;
    margin: .8em 0 .2em;
    line-height: 1.5;
}');
	}
}