<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

/*
 *	@author 	: Optimum Linkup Universal Concepts
 *	date		: 27 June, 2016
 *	Optimum Linkup Universal Concepts
 *	http://optimumlinkup.com.ng/school/Optimum Linkup Universal Concepts
 *	optimumproblemsolver@gmail.com
 */

class Welcome extends CI_Controller
{
  function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
		
       
    }
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {	
		
		if ($this->session->userdata('name')){
			$this->load->view('backend/login');
		}else{
			 $this->load->view('backend/login');
		}
    }
	
	function teacher()
	{
	$this->load->view('backend/welcome/teacher');	
	}
	
	function news()
	{
	$this->load->view('backend/welcome/news');	
	}
	
	function contact($param1 = '', $param2 = '', $param3 = '')
	{
	if ($param1 == 'create') {
        $data['category'] 		= $this->input->post('category');
        $data['mobile'] 		= $this->input->post('mobile');
        $data['purpose'] 		= $this->input->post('purpose');
        $data['name'] 			= $this->input->post('name');
        $data['whom_to_meet'] 	= $this->input->post('whom_to_meet');
        $data['email'] 			= $this->input->post('email');
        $data['content'] 		= $this->input->post('content');
        $res = $this->db->insert('enquiry', $data);
		if($res==true)
        {
            $data['success'] = 'CONGRATULATIONS! YOU HAVE SUCCESSFULLY SUBMITTED ENQUIRY FORM. OUR STAFF WILL CONTACT YOU SOON';
			$this->load->view('backend/welcome/contact',$data,'refresh');
        }
	}		
	$this->load->view('backend/welcome/contact');	
	}
	
	function news_content($news_id)
	{
	$page_data['edit_data'] = $this->db->get_where('news', array('news_id' => $news_id))->result_array();
	$this->load->view('backend/welcome/news_content', $page_data);
	}
	
    function enquiry($param1 = '', $param2 = '', $param3 = '')
	{
	 if ($param1 == 'create') {
        $data['category'] 		= $this->input->post('category');
        $data['mobile'] 		= $this->input->post('mobile');
        $data['purpose'] 		= $this->input->post('purpose');
        $data['name'] 			= $this->input->post('name');
        $data['whom_to_meet'] 	= $this->input->post('whom_to_meet');
        $data['email'] 			= $this->input->post('email');
        $data['content'] 		= $this->input->post('content');
        $res = $this->db->insert('enquiry', $data);
		if($res==true)
        {
            $data['success'] = 'CONGRATULATIONS! YOU HAVE SUCCESSFULLY SUBMITTED ENQUIRY FORM. OUR STAFF WILL CONTACT YOU SOON';
			$this->load->view('backend/welcome/enquiry',$data,'refresh');
        }				
    }
	$this->load->view('backend/welcome/enquiry');	
	}
	
	function about()
	{
	$this->load->view('backend/welcome/about');
	}
	
	function admission()
	{
	$this->load->view('backend/welcome/admission');
	}
	
	function gallery()
	{
	$this->load->view('backend/welcome/gallery');
	}

}
