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
 * CGModelCode Class
 *
 * @package			CGModelCode
 * @subpackage		Generator
 * @category		Generator
 * @author			Dida Nurwanda
 */

GeCi::import('cgen.CGCore');

class CGModelCode extends CGCore
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
				'field'=>'tablename',
				'label'=>'Table Name',
				'rules'=>'trim|required|xss_clean'
			),
			array(
				'field'=>'modelname',
				'label'=>'Model Name',
				'rules'=>'trim|required|xss_clean'
			),
			array(
				'field'=>'modelpath',
				'label'=>'Model Path',
				'rules'=>'trim|required|xss_clean'
			)
		));
		return $this->CI->form_validation->run();
	}
	
	public function getPost()
	{
		return array(
			'tablename'=>$this->post('tablename',true),
			'modelname'=>$this->post('modelname',true).'_model',
			'modelpath'=>$this->post('modelpath',true)
		);
	}
	
	/**
	 * Create Validation
	 *
	 * @access		public
	 * @return		array
	 */
	public function modelValidation()
	{
		$modelValidation=array();
		foreach($this->getTable()->result_array() as $row)
		{
			if($row['Extra']!=='auto_increment')
			{
				$modelValidation[]=array(
					'name_field'=>$row['Field'],
					'label_field'=>ucwords(str_replace('_',' ',$row['Field'])),
					'max_length'=>preg_match('/varchar/',$row['Type']) ? (preg_replace('/[A-Za-z()]/','',$row['Type'])!=='' ? '|max_length['.preg_replace('/[A-Za-z()]/','',$row['Type']).']' : false) : false,
					'type'=>preg_match('/int/',$row['Type']) ? '|integer' : (preg_match('/float|decimal/',$row['Type']) ? '|float' : false),
					'required'=>$row['Null']=='NO' ? '|required' : false,
					'unique'=>$row['Key']=='UNI' ? '|is_unique[\'.$this->table.\'.'.$row['Field'].']' : false,
					'email'=>preg_match('/email/',$row['Field']) ? '|valid_email' : false,
				);
			}
		}
		return $modelValidation;
	}
	
	/**
	 * Get Primary Key
	 *
	 * @access		public
	 * @return		string
	 */
	public function modelPrimaryKey()
	{
		foreach($this->getTable()->result_array() as $row)
			if($row['Key']==='PRI')
				return $row['Field'];
	}
	
	/**
	 * Check Primary Key
	 *
	 * @access		public
	 * @return		boolean
	 */
	public function checkPk()
	{
		$pri=array();
		foreach($this->getTable()->result_array() as $row)
			if($row['Key']==='PRI')
				$pri[]=$row['Field'];
		
		if(count($pri)>0)
			return true;
		return false;
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
			'title'=>'Model Generator'
		);
		if(isset($_POST['submit']) || isset($_POST['generate']))
		{
			if($this->rules())
			{
				$post=$this->getPost();
				$data=array(
					'fieldtable' => $this->getTable(),
					'validation' => $this->modelValidation(),
					'modelpath' => str_replace('.','/',$post['modelpath']),
					'primarykey' => $this->modelPrimaryKey(),
				);
				$data=array_merge($this->getPost(),$data);
				
				// if($this->checkPk()==false)
				// {
					// $this->setMessage("error","Maaf, table ".$data['tablename']." tidak memiliki Primary Key");
				// }
				// else
				// {
					$diff=$this->getDiff($data['modelpath'].'/'.$data['modelname'].EXT);
					$show=array(
						'tampil' => 'ya',
						'show_model' => str_replace('.','/',$data['modelpath']).'/'.$data['modelname'].EXT.$diff,
						'model_name' => $data['modelname'].EXT,
						'dialog' => $this->highlight('Model/templates/model_template.php',$data)
					);
				
					if(isset($_POST['generate']))
					{
						$this->makeModel($data,$data['modelpath'].'/'.$data['modelname'].EXT);
						$this->setMessage('success','Anda berhasil membuat model <strong>'.$data['modelname'].EXT.'</strong> pada direktory <strong>'.$data['modelpath'].'/'.$data[	'modelname'].EXT.'</strong>');
					
						GeCi::import('components.CIRoute');
						redirect(CIRoute::thisRoute());
					
					}
				// }
			}
		}
		$this->render('Model/views/index',$show);
	}
	
	/**
	 * Get Table Information
	 *
	 * @access		public
	 * @return		object
	 */
	public function getTable()
	{
		$post = $this->getPost();
		return $this->getTableInformation($post['tablename']);
	}
	
	/**
	 * Create Model
	 *
	 * @access		public
	 * @return		void
	 */
	public function makeModel($data, $target)
	{
		$this->createFile($this->CI->load->view('/../libraries/GeCi/cgen/Model/templates/model_template.php',$data,true),$target);
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