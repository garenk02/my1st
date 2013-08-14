<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model user_model
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal 07-08-2013
 * Dida Nurwanda <dida_n@ymail.com>
 */
 
class user_model extends CIActiveModel
{
	
	/**
	 * Primary Key or Alternative Key
	 *
	 * @var			string
	 * @access		public
	 */
	public $key='id';
	
	/**
	 * Table Name
	 *
	 * @var			string
	 * @access		public
	 */
	public $table='tbl_user';
	
	/**
	 * Constructor
	 *
	 * @access		public
	 * @return		void
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Rules
	 *
	 * @access		public
	 * @return		array
	 */
	public function rules()
	{
		return array(
			array(
				'field'=>'username',
				'label'=>'Username',
				'rules'=>'trim|xss_clean|max_length[30]|required',
			),
			array(
				'field'=>'password',
				'label'=>'Password',
				'rules'=>'trim|xss_clean|max_length[32]|required',
			),
		);
	}
	
	/**
	 * Label Field
	 *
	 * @access		public
	 * @return		array
	 */
	public function label()
	{
		return array(
			'id' => 'Id',
			'username' => 'Username',
			'password' => 'Password',		
		);
	}
	
	/**
	 * Form Input
	 *
	 * @access		public
	 * @return		array
	 */
	public function form()
	{
		return array(
			'id' => $this->input->post('id',true),
			'username' => $this->input->post('username',true),
			'password' => $this->input->post('password',true),		
		);
	}
	
	/**
	 * Get JSON
	 * 
	 * @access		public
	 * @param		string
	 * @return		text/json
	 */
	public function getJSON($controller)
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rp = isset($_POST['rp']) ? intval($_POST['rp']) : 10;
		$sortname = isset($_POST['sortname']) ? $_POST['sortname'] : $this->key;
		$sortorder = isset($_POST['sortorder']) ? $_POST['sortorder'] : 'desc';
		$where_type= isset($_POST['qtype']) ? $_POST['qtype'] : false;
		$where= isset($_POST['query']) ? $_POST['query'] : false;
		
		$data=array(
			'page'=>$page,
			'total'=>$this->countAll($where_type,$where),
		);
		$data2=array();
		foreach($this->getPage($rp,($page-1)*$rp, $sortname, $sortorder,$where_type, $where)->result_array() as $row)
		{
			$data2[]=array(
				'id'=>$row[$this->key],
				'cell'=>array(
					$this->geci->load('widgets.grid.CIButtonGrid')->actions(array(
						'viewUrl'=>site_url($controller.'/view/'.$row[$this->key]),
						'updateUrl'=>site_url($controller.'/update/'.$row[$this->key]),
						'deleteUrl'=>site_url($controller.'/delete/'.$row[$this->key]),
					)),
					$row['id'], 
					$row['username'], 
					$row['password'], 
				)
			);
		}
		$row=array('rows'=>$data2);
		return json_encode(array_merge($data,$row));
	}
}

/* End of file user_model.php */
/* Location: application/models/user_model.php */