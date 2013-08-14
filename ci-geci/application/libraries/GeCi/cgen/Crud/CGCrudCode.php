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
 * CGCrudCode Class
 *
 * @package			CGCrudCode
 * @subpackage		Generator
 * @category		Generator
 * @author			Dida Nurwanda
 */

GeCi::import('cgen.CGCore');

class CGCrudCode extends CGCore
{

	/**
	 * Instance to CodeIgniter
	 *
	 * @var			static
	 * @access		public
	 */
	public static $CI;
	
	/**
	 * Instance 
	 * 
	 * @var			static
	 * @access		public
	 */
	public static $instance;

	/**
	 * Construct
	 *
	 * @access		public
	 * @return		void
	 */
	public function __construct()
	{		
		$this->load('plugins.bootstrap.bootstrap')->reg(array(
			'responsiveCss'=>true
		));
	
		$this->CI=&get_instance();
	}
	
	/**
	 * Rules
	 *
	 * @access		public
	 * @return		boolean
	 */
	public function rules()
	{
		$this->CI->load->library('form_validation');
		$this->CI->form_validation->set_rules(array(
			array(
				'field'=>'modelname',
				'label'=>'Model Name',
				'rules'=>'trim|required|xss_clean'
			),
			array(
				'field'=>'controllername',
				'label'=>'Controller Name',
				'rules'=>'trim|required|xss_clean'
			),
			array(
				'field'=>'basecontroller',
				'label'=>'Base Controller',
				'rules'=>'trim|required|xss_clean'
			),
			array(
				'field'=>'auth',
				'label'=>'Build Auth',
				'rules'=>'trim|xss_clean'
			),
			array(
				'field'=>'controller_overwrite',
				'label'=>'Controller Overwrite',
				'rules'=>'trim|xss_clean'
			),
			array(
				'field'=>'index_overwrite',
				'label'=>'Index Overwrite',
				'rules'=>'trim|xss_clean'
			),
			array(
				'field'=>'view_overwrite',
				'label'=>'View Overwrite',
				'rules'=>'trim|xss_clean'
			),
			array(
				'field'=>'create_overwrite',
				'label'=>'Create Overwrite',
				'rules'=>'trim|xss_clean'
			),
			array(
				'field'=>'update_overwrite',
				'label'=>'Update Overwrite',
				'rules'=>'trim|xss_clean'
			),
			array(
				'field'=>'admin_overwrite',
				'label'=>'Admin Overwrite',
				'rules'=>'trim|xss_clean'
			),
			array(
				'field'=>'checkall_overwrite',
				'label'=>'CheckAll Overwrite',
				'rules'=>'trim|xss_clean'
			),
		));
		return $this->CI->form_validation->run();
	}
	
	/**
	 * POST Request
	 *
	 * @access		public
	 * @return		array
	 */
	public function getPost()
	{
		return array(
			'modelname'=>$this->post('modelname',true),
			'controllername'=>str_replace(' ','_',$this->post('controllername',true)),
			'basecontroller'=>$this->post('basecontroller',true)
		);
	}
	
	/**
	 * Check Controller Name
	 *
	 * @access		public
	 * @return		array
	 */
	public function checkController()
	{
		$post = $this->getPost();
		if($post['controllername']===$post['modelname'])
			return false;
		return true;
	}
	
	/**
	 * Primary Key
	 *
	 * @access		public
	 * @return		string
	 */
	public function primaryKey()
	{
		foreach($this->getTable()->result_array() as $row)
			if($row['Key']==='PRI')
				return $row['Field'];
	}
	
	/**
	 * All Field for Create
	 *
	 * @access		public
	 * @return		array
	 */
	public function fieldCreate()
	{
		$fields=array();
		foreach($this->getTable()->result_array() as $row)
		{
			if($row['Extra']!=='auto_increment')
			{
				$fields[]=array(
					'field'=>$row['Field'],
					'max_length'=>preg_match('/varchar/',$row['Type']) ? (preg_replace('/[A-Za-z()]/','',$row['Type'])!=='' ? '\'maxlength\'=>'.preg_replace('/[A-Za-z()]/','',$row['Type']).',' : false) : false,
					'type'=>preg_match('/text/',$row['Type']) ? 'Area' : 'Field',
					'required'=>$row['Null']=='NO' ? true : false,
					'input'=>preg_match('/^(password|pass|passwd|passcode)$/i',$row['Field']) ? 'password' : 'text',
				);
			}
		}
		return $fields;
	}
	
	/**
	 * All Field for Update
	 *
	 * @access		public
	 * @return		array
	 */
	public function fieldUpdate()
	{
		$fieldUpdate=array();
		foreach($this->getTable()->result_array() as $row)
		{
			$fieldUpdate[]=array(
				'field'=>$row['Field'],
				'max_length'=>preg_match('/varchar/',$row['Type']) ? (preg_replace('/[A-Za-z()]/','',$row['Type'])!=='' ? '\'maxlength\'=>'.preg_replace('/[A-Za-z()]/','',$row['Type']).',' : false) : false,
				'type'=>preg_match('/text/',$row['Type']) ? 'Area' : 'Field',
				'required'=>$row['Null']=='NO' ? true : false,
				'input'=>preg_match('/^(password|pass|passwd|passcode)$/i',$row['Field']) ? 'password' : 'text',
			);
		}
		return $fieldUpdate;
	}
	
	/**
	 * All Validate for Create
	 *
	 * @access		public
	 * @return		array
	 */
	public function validationCreate()
	{
		$validationCreate=array();
		foreach($this->getTable()->result_array() as $row)
		{
			if($row['Extra']!=='auto_increment')
			{
				$validationCreate[]=array(
					'field'=>$row['Field'],
					'maxlength'=>preg_match('/varchar/',$row['Type']) ? (preg_replace('/[A-Za-z()]/','',$row['Type'])!=='' ? '\'maxlength\'=>'.preg_replace('/[A-Za-z()]/','',$row['Type']).',' : false) : false,
					'required'=>$row['Null']=='NO' ? '\'required\'=>true,' : false,
					'email'=>preg_match('/email/',$row['Field']) ? '\'email\'=>true,' : false,
				);
			}
		}
		return $validationCreate;
	}
	
	/**
	 * All Validate for Update
	 *
	 * @access		public
	 * @return		array
	 */
	public function validationUpdate()
	{
		$validationUpdate=array();
		foreach($this->getTable()->result_array() as $row)
		{
			$validationUpdate[]=array(
				'field'=>$row['Field'],
				'maxlength'=>preg_match('/varchar/',$row['Type']) ? (preg_replace('/[A-Za-z()]/','',$row['Type'])!=='' ? '\'maxlength\'=>'.preg_replace('/[A-Za-z()]/','',$row['Type']).',' : false) : false,
				'required'=>$row['Null']=='NO' ? '\'required\'=>true,' : false,
				'email'=>preg_match('/email/',$row['Field']) ? '\'email\'=>true,' : false,
			);
		}
		return $validationUpdate;
	}
	
	/**
	 * Runnning Generator
	 *
	 * @access		public
	 * @return		void
	 */
	public function execute()
	{
		$show=array(
			'tampil'=>'no',
			'error'=>'',
			'title'=>'CRUD Generator'
		);
		if(isset($_POST['submit']) || isset($_POST['generate']))
		{
			if($this->rules())
			{
				if($this->checkController()==false)
				{
					$show['error']='Controller Name don\'t same with Model Name';
				}
				elseif($this->checkPk()==false)
				{
					$show['error']='Model must contained Primary Key';
				}
				else
				{
					$data=array(
						'fieldCreate'=>$this->fieldCreate(),
						'fieldUpdate'=>$this->fieldUpdate(),
						'validationCreate'=>$this->validationCreate(),
						'validationUpdate'=>$this->validationUpdate(),
						'primarykey'=>$this->primaryKey(),
						'auth'=> $this->post('auth',true)=='accept' ? true : false,
					);
					$data=array_merge($this->getPost(),$data);
					
					$diffController=$this->getDiff(APPPATH.'controllers/'.$data['controllername'].EXT);
					$diffIndex=$this->getDiff(APPPATH.'views/'.$data['controllername'].'/index.php');
					$diffCreate=$this->getDiff(APPPATH.'views/'.$data['controllername'].'/create.php');
					$diffUpdate=$this->getDiff(APPPATH.'views/'.$data['controllername'].'/update.php');
					$diffView=$this->getDiff(APPPATH.'views/'.$data['controllername'].'/view.php');
					$diffAdmin=$this->getDiff(APPPATH.'views/'.$data['controllername'].'/admin.php');
					
					$show=array(
						'error'=>'',
						'tampil'=>'ya',
						'show_controller'=>APPPATH.'controllers/'.$data['controllername'].EXT.$diffController,
						'show_index'=>APPPATH.'views/'.$data['controllername'].'/index.php'.$diffIndex,
						'show_create'=>APPPATH.'views/'.$data['controllername'].'/create.php'.$diffCreate,
						'show_update'=>APPPATH.'views/'.$data['controllername'].'/update.php'.$diffUpdate,
						'show_view'=>APPPATH.'views/'.$data['controllername'].'/view.php'.$diffView,
						'show_admin'=>APPPATH.'views/'.$data['controllername'].'/admin.php'.$diffAdmin,
						'controller_name'=>$data['controllername'].EXT,
						'dlg_controller'=>$this->highlight('Crud/templates/controller_template.php',$data),
						'dlg_index'=>$this->highlight('Crud/templates/index_template.php',$data),
						'dlg_create'=>$this->highlight('Crud/templates/create_template.php',$data),
						'dlg_update'=>$this->highlight('Crud/templates/update_template.php',$data),
						'dlg_view'=>$this->highlight('Crud/templates/view_template.php',$data),
						'dlg_admin'=>$this->highlight('Crud/templates/admin_template.php',$data),
						'diffController'=>$diffController,
						'diffIndex'=>$diffIndex,
						'diffCreate'=>$diffCreate,
						'diffUpdate'=>$diffUpdate,
						'diffAdmin'=>$diffAdmin,
						'diffView'=>$diffView,
					);
					
					if(isset($_POST['generate']))
					{
						// if($data['auth']==true)
							// $this->makeSiteAuth();
							
						$this->makeLayouts();
						if(isset($_POST['index_overwrite']) || isset($_POST['view_overwrite']) || isset($_POST['create_overwrite']) || isset($_POST['update_overwrite']) || isset($_POST['admin_overwrite']))
							$this->makeFolder();
												
						if(isset($_POST['controller_overwrite']))
							$this->makeController($data,APPPATH.'controllers/'.$data['controllername'].EXT);
								
						if(isset($_POST['index_overwrite']))
							$this->makeView('index',$data,APPPATH.'views/'.$data['controllername'].'/index.php');
								
						if(isset($_POST['view_overwrite']))
							$this->makeView('view',$data,APPPATH.'views/'.$data['controllername'].'/view.php');
						
						if(isset($_POST['create_overwrite']))
							$this->makeView('create',$data,APPPATH.'views/'.$data['controllername'].'/create.php');
						
						if(isset($_POST['update_overwrite']))
							$this->makeView('update',$data,APPPATH.'views/'.$data['controllername'].'/update.php');
								
						if(isset($_POST['admin_overwrite']))
							$this->makeView('admin',$data,APPPATH.'views/'.$data['controllername'].'/admin.php');
					
						$this->setMessage('success','Anda berhasil membuat CRUD dengan controller <strong>'.$data['controllername'].EXT.'</strong> pada direktory <strong>'.APPPATH.'controllers/'.$data['controllername'].EXT.'</strong><br /><a href="'.site_url($data['controllername']).'" target="_blank">View Here</a>');
		
						GeCi::import('components.CIRoute');
						redirect(CIRoute::thisRoute());
					}
				}
			}
		}
		$this->render('Crud/views/index',$show);
	}
	
	/**
	 * Get Table 
	 *
	 * @access		public
	 * @return		object
	 */
	public function getTable()
	{
		return $this->getTableInformation($this->instanceTable()->table);
	}
	
	/**
	 * Check Primary Key
	 *
	 * @access		public
	 * @return		boolean
	 */
	public function checkPk()
	{
		if($this->instanceTable()->key=='')
			return false;
		return true;
	}
	
	/**
	 * Create Folder views
	 *
	 * @access		public
	 * @return		void
	 */
	public function makeFolder()
	{
		$post = $this->getPost();
		if(!is_dir(APPPATH.'views/'.$post['controllername']))
			@mkdir(APPPATH.'views/'.$post['controllername'],0777);
	}
	
	/**
	 * Instance to Model
	 *
	 * @access		public
	 * @return		void
	 */
	public function instanceTable()
	{
		$post = $this->getPost();
		$modelname=$post['modelname'];
		GeCi::requireOnce('application.models.'.$modelname);
		return new $modelname;
	}
	
	/**
	 * Create Controller
	 *
	 * @access		public
	 * @param		array, string
	 * @return		void
	 */
	public function makeController($data=array(), $target)
	{
		$this->createFile($this->CI->load->view('/../libraries/GeCi/cgen/Crud/templates/controller_template.php',$data,true),$target);
	}
	
	/**
	 * Create Views
	 *
	 * @access		public
	 * @param		string, array, string
	 * @return		void
	 */
	public function makeView($view, $data=array(), $target)
	{
		$this->createFile($this->CI->load->view('/../libraries/GeCi/cgen/Crud/templates/'.$view.'_template.php',$data,true),$target);
	}
	
	/**
	 * Create Instance
	 *
	 * @access		public
	 * @return		object
	 */
	public function getInstance()
	{
		if (self::$instance==null)
			self::$instance=new self;
		return self::$instance;
	}
}