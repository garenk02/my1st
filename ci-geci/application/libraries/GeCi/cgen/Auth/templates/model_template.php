<?php echo '<?php'; ?> if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model login_model
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal <?php echo date('d-m-Y')."\n"; ?>
 * Dida Nurwanda <dida_n@ymail.com>
 */
 
class login_model extends CI_Model
{
	
	/**
	 * Form Validation
	 *
	 * @access		public
	 * @return		boolean
	 */
	public function validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules(array(
			array(
				'label'=>'Username',
				'field'=>'username',
				'rules'=>'trim|required|xss_clean'
			),
			array(
				'label'=>'Password',
				'field'=>'password',
				'rules'=>'trim|required|xss_clean'
			),
			array(
				'label'=>'Remember Me',
				'field'=>'rememberme',
				'rules'=>'trim|xss_clean'
			)
		)); 
		return $this->form_validation->run();
	}
	
	/**
	 * Identification Auth
	 *
	 * @access		public
	 * @return		boolean
	 */
	 public function identity()
	{
		$user=array(
			// username => password
			'admin'=>'admin',
			'demo'=>'demo'
		);
		
		if(!isset($user[$this->input->post('username',true)]))
		{
			$this->geci->auth()->setFlashData('error','Incorrect username or password.');
			return false;
		}
		elseif($user[$this->input->post('username',true)]!==$this->input->post('password',true))
		{
			$this->geci->auth()->setFlashData('error','Incorrect username or password.');
			return false;
		}
		else
			return true;
	}
	
	/**
	 * Initialize Preferences
	 *
	 * @access		public
	 * @return		boolean
	 */
	public function initialize()
	{
		if($this->validation() && $this->identity())
		{
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);
				
			$data=array(
				'name' => $username,
				'logged_in' => true
			);
			$this->geci->auth()->setUserData($data);
			if($this->input->post('rememberme',true)=='accept')
			{
				$this->geci->auth()->authManager()->setRemember('geci_remember',$username,$password,true);
			}
			return true;
		}
		return false;
	}
}

/* End of file login_model.php */
/* Location: application/models/login_model.php */