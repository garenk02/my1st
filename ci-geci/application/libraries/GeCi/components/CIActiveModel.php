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
 * CIActiveModel Class
 *
 * @package			CIActiveModel
 * @subpackage		Database
 * @category		Components
 * @author			Dida Nurwanda
 */ 

GeCi::requireOnce(SYSDIR.'.core.Model');

abstract class CIActiveModel extends CI_Model
{
	
	/**
	 * Constructor 
	 * 
	 * @access		public
	 * @return 		void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * Get Data with Primary Key
	 * 
	 * @access		public
	 * @param		string/integer
	 * @return 		object
	 */
	public function findByPk($pk)
	{
		return $this->db->get_where($this->table,array(
			$this->key=>$pk
		));
	}
	
	/**
	 * Get Data All
	 * 
	 * @access		public
	 * @param		string
	 * @return 		object
	 */
	public function findAll($where='',$fill='')
	{
		if(is_array($where))
			$this->db->where($where);
		elseif($where!='' && $fill!='')
			$this->db->where($where,$fill);
			
		return $this->db->get($this->table);
	}
	
	/**
	 * Save
	 * 
	 * @access		public
	 * @param		array
	 * @return 		boolean
	 */
	public function save($data=array())
	{
		return $this->db->insert($this->table,$data);
	}
	
	/**
	 * Update
	 * 
	 * @access		public
	 * @params		array
	 * @return 		boolean
	 */
	public function update($data=array())
	{
		$this->db->where($this->key,$data[$this->key]);
		return $this->db->update($this->table,$data);
	}
	
	/**
	 * Delete
	 * 
	 * @access		public
	 * @param		string/integer
	 * @return 		boolean
	 */
	public function delete($pk)
	{
		return $this->db->delete($this->table,array($this->key=>$pk));
	}
	
	
	/**
	 * Get Last Data
	 * 
	 * @access		public
	 * @return 		object
	 */
	public function last()
	{
		return $this->findAll()->last_row();
	}
	
	/**
	 * Get Count Record
	 *
	 * @access		public
	 * @param		string
	 * @return		object
	 * echo $this->pegawai_model->countAll('content','find');
	 */
	public function countAll($where='', $where2='')
	{
		if($where!='' && $where2!='')
			$this->db->like($where,$where2);
		return $this->db->get($this->table)->num_rows();
	}
	
	/**
	 * Get Limit Data
	 *
	 * @access		public
	 * @param		integer, integer, string, string, string, string
	 * @return		object
	 * $this->pegawai_model->getPage(5,1);
	 * $this->pegawai_model->getPage(5,1,'content','asc');
	 * $this->pegawai_model->getPage(5,1,'content','asc','content','find');
	 */
	public function getPage($limit,$offset,$sortname='', $sortorder='', $where='', $where2='')
	{
		if($sortname!='' && $sortorder!='')
			$this->db->order_by($sortname,$sortorder);
			
		if($where!='' && $where2!='')
			$this->db->like($where,$where2);
			
		return $this->db->get($this->table,$limit,$offset);
	}
	
	/**
	 * Get Label
	 * 
	 * @access		public
	 * @param		string
	 * @return 		string
	 */
	public function getLabel($label='')
	{
		$newlabel = $this->label();
		return $label==='' ? false : (isset($newlabel[$label]) ? $newlabel[$label] : $label);
	}
	
	/**
	 * Form Validation
	 * 
	 * @access		public
	 * @param		array
	 * @return		boolean
	 */
	public function validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->rules());
		return $this->form_validation->run();
	}
}