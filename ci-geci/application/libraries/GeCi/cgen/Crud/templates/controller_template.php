<?php echo '<?php'; ?> if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller <?php echo $controllername."\n"; ?>
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal <?php echo date('d-m-Y')."\n"; ?>
 * Dida Nurwanda <dida_n@ymail.com>
 */

class <?php echo $controllername; ?> extends <?php echo $basecontroller."\n"; ?>
{
	
	/**
	 * Constructor
	 * 
	 * @access		public
	 * @return		void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('<?php echo $modelname; ?>');
		$this->geci->load('plugins.bootstrap.bootstrap')->reg(array(
			'responsiveCss'=>true,
			'templateStyle'=>true
		));
	}
	
	/**
	 * Index 
	 *
	 * @access		public
	 * @param		integer
	 * @return		void
	 */
	public function index($offset=null)
	{
		$config=array(
			'base_url'=>site_url('/<?php echo $controllername; ?>/index/'),
			'total_rows'=>$this-><?php echo $modelname; ?>->countAll(),
			'per_page'=>10,
			'uri_segment'=>3,
		);
		$paging=$this->geci->load('plugins.bootstrap.bootPagination');
        $paging->initialize($config);
		
		$data=array(
			'pagination'=>$paging->create_links(),
			'model'=>$this-><?php echo $modelname; ?>->getPage($config['per_page'],$offset),
			'title'=>'<?php echo ucwords(str_replace('_',' ',$controllername)); ?>'
		);
		$this->geci->layouts->displayAll('<?php echo $controllername; ?>/index',$data);
	}
	
	/**
	 * Create 
	 *
	 * @access		public
	 * @return		void
	 */
	public function create()
	{
<?php echo $auth===true ? "\t\t".'$this->geci->auth()->authManager()->access(\'name\',array(\'admin\',\'demo\'));'."\n\n" : false; ?>
		if($this-><?php echo $modelname; ?>->validation())
		{
			$model=$this-><?php echo $modelname; ?>->form();
			if($this-><?php echo $modelname; ?>->save($model))
				redirect('<?php echo $controllername; ?>/view/'.$this-><?php echo $modelname; ?>->last()-><?php echo $primarykey; ?>);
		}
		
		$data=array(
			'title'=>'Create <?php echo ucwords(str_replace('_',' ',$controllername)); ?>'
		);
		$this->geci->layouts->displayAll('<?php echo $controllername; ?>/create',$data);
	}
	
	/**
	 * View 
	 *
	 * @access		public
	 * @param		integer/string
	 * @return		void
	 */
	public function view($id=null)
	{
		$data=array(
			'model'=>$this->getModel($id)->row(),
			'title'=>'View Detail # '.$this->getModel($id)->row()-><?php echo $primarykey."\n"; ?>
		);
		$this->geci->layouts->displayAll('<?php echo $controllername; ?>/view',$data);
	}
	
	/**
	 * Update 
	 *
	 * @access		public
	 * @param		integer/string
	 * @return		void
	 */
	public function update($id=null)
	{
<?php echo $auth===true ? "\t\t".'$this->geci->auth()->authManager()->access(\'name\',array(\'admin\',\'demo\'));'."\n\n" : false; ?>
		if($this-><?php echo $modelname; ?>->validation())
		{
			$model=$this-><?php echo $modelname; ?>->form();
			if($this-><?php echo $modelname; ?>->update($model))
				redirect('<?php echo $controllername; ?>/view/'.$model['<?php echo $primarykey; ?>']);
		}
		
		$data=array(
			'model'=>$this->getModel($id)->row(),
			'title'=>'Update <?php echo ucwords(str_replace('_',' ',$controllername)); ?> # '.$id
		);
		$this->geci->layouts->displayAll('<?php echo $controllername; ?>/update',$data);
	}
	
	/**
	 * Admin 
	 *
	 * @access		public
	 * @return		void
	 */
	public function admin()
	{
<?php echo $auth===true ? "\t\t".'$this->geci->auth()->authManager()->access(\'name\',array(\'admin\'));'."\n\n" : false; ?>
		$data=array(
			'title'=>'Manage <?php echo ucwords(str_replace('_',' ',$controllername)); ?>'
		);
		
		if(isset($_GET['list']))
			echo $this-><?php echo $modelname; ?>->getJSON('<?php echo $controllername; ?>');
		else
			$this->geci->layouts->displayAll('<?php echo $controllername; ?>/admin',$data);
	}
	
	/**
	 * Delete 
	 *
	 * @access		public
	 * @param		integer/string
	 * @return		void
	 */
	public function delete($id=null)
	{
<?php echo $auth===true ? "\t\t".'$this->geci->auth()->authManager()->access(\'name\',array(\'admin\'));'."\n\n" : false; ?>
		if($this-><?php echo $modelname; ?>->delete($id))
			redirect('<?php echo $controllername; ?>/admin');
		show_error('Invalid request. Please do not repeat this request again.',400);
	}
	
	/**
	 * Get Model
	 *
	 * @access		protected
	 * @params		integer/string
	 * @return		void
	 */
	protected function getModel($pk)
	{
		$model=$this-><?php echo $modelname; ?>->findByPk($pk);
		if($model->num_rows()===0)
			show_404('The requested page does not exist.');
		return $model;
	}
}

/* End of file <?php echo $controllername; ?>.php */
/* Location: application/controllers/<?php echo $controllername; ?>.php */