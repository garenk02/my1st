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
 * bootPagination Class
 *
 * @package			bootPagination
 * @subpackage		Bootstrap
 * @category		Widget
 * @author			Dida Nurwanda
 */
 
GeCi::requireOnce(SYSDIR.'.libraries.Pagination');

class bootPagination extends CI_Pagination
{
	public $full_tag_open = '<div class="pagination"><ul>';
	public $full_tag_close ='</ul></div>';
	public $cur_tag_open = '<li class="active"><a href="#">';
	public $cur_tag_close = '</a></li>';
	public $first_tag_open = '<li>';
	public $first_tag_close = '</li>';
	public $last_tag_open = '<li>';
	public $last_tag_close = '</li>';
	public $next_tag_open = '<li>';
	public $next_tag_close = '</li>';
	public $prev_tag_open = '<li>';
	public $prev_tag_close = '</li>';
	public $num_tag_open = '<li>';
	public $num_tag_close = '</li>';
}