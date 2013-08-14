<?php echo '<?php'; ?> if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller <?php echo $controllername."\n"; ?>
 *
 * Dibuat dengan CGen - GeCi Code Generator
 * Tanggal <?php echo date('d-m-Y')."\n"; ?>
 * Dida Nurwanda <dida_n@ymail.com>
 */
 
class <?php echo $controllername; ?> extends CI_Controller
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
		$this->geci->load('plugins.bootstrap.bootstrap')->reg(array(
			'responsiveCss'=>true,
			'templateStyle'=>true
		));
	}
	
	/**
	 * Index 
	 *
	 * @access		public
	 * @return		void
	 */
	public function index()
	{
		$this->geci->layouts->displayAll('<?php echo $controllername; ?>/index');
	}
}

/* End of file <?php echo $controllername; ?>.php */
/* Location: <?php echo APPPATH.'controllers/'.$controllername; ?>.php */