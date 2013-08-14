<?php echo '<?php'; ?> if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model <?php echo $modelname."\n"; ?>
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal <?php echo date('d-m-Y')."\n"; ?>
 * Dida Nurwanda <dida_n@ymail.com>
 */
 
class <?php echo $modelname; ?> extends CIActiveModel
{
	
	/**
	 * Primary Key or Alternative Key
	 *
	 * @var			string
	 * @access		public
	 */
	public $key='<?php echo $primarykey; ?>';
	
	/**
	 * Table Name
	 *
	 * @var			string
	 * @access		public
	 */
	public $table='<?php echo $tablename; ?>';
	
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
		<?php foreach($validation as $row): ?>
	array(
				'field'=>'<?php echo $row['name_field']; ?>',
				'label'=>'<?php echo $row['label_field']; ?>',
				'rules'=>'trim|xss_clean<?php echo $row['max_length']; ?><?php echo $row['required']; ?><?php echo $row['type']; ?><?php echo $row['unique']; ?><?php echo $row['email']; ?>',
			),
		<?php endforeach; ?>
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
		return array(<?php foreach($fieldtable->result_array() as $row)
		{
			echo "\n\t\t\t'".$row['Field']."' => '".ucwords(str_replace('_',' ',$row['Field']))."',";
		} 
		?>		
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
		return array(<?php foreach($fieldtable->result_array() as $row)
		{
			echo "\n\t\t\t'".$row['Field']."'".' => $this->input->post(\''.$row['Field'].'\',true),';
		} 
		?>		
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
					)),<?php $no=0; foreach($fieldtable->result_array() as $row): ?><?php if($no<7): ?><?php echo "\n\t\t\t\t\t"; ?>$row['<?php echo $row['Field']; ?>'], <?php else: ?> <?php echo "\n\t\t\t\t\t"; ?>//$row['<?php echo $row['Field']; ?>'], <?php endif; ?><?php $no++; endforeach; ?><?php echo "\n\t\t\t\t"; ?>)
			);
		}
		$row=array('rows'=>$data2);
		return json_encode(array_merge($data,$row));
	}
}

/* End of file <?php echo $modelname; ?>.php */
/* Location: <?php echo $modelpath; ?>/<?php echo $modelname; ?>.php */