<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *	Author 			: Optimum Linkup Software
 *	date			: 27 June, 2017
 *	Website			:http://optimumlinkupsoftware.com/school
 *	Email			:info@optimumlinkupsoftware.com
 */


class hostel extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    /***default functin, redirects to login page if no hostel logged in yet***/
    public function index()
    {
        if ($this->session->userdata('hostel_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('hostel_login') == 1)
            redirect(base_url() . 'index.php?hostel/dashboard', 'refresh');
    }
    
    /***hostel DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('hostel_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('hostel_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
  
    /****MANAGE hostelS*****/
    function hostel_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('hostel_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_hostel_id'] = $param2;
        }
        $page_data['hostels']   = $this->db->get('hostel')->result_array();
        $page_data['page_name']  = 'hostel';
        $page_data['page_title'] = get_phrase('hostel_list');
        $this->load->view('backend/index', $page_data);
    }
    

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('hostel_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');
            
            $this->db->where('hostel_id', $this->session->userdata('hostel_id'));
            $this->db->update('hostel', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hostel_image/' . $this->session->userdata('hostel_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?hostel/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('hostel', array(
                'hostel_id' => $this->session->userdata('hostel_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('hostel_id', $this->session->userdata('hostel_id'));
                $this->db->update('hostel', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?hostel/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('hostel', array(
            'hostel_id' => $this->session->userdata('hostel_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

	
	/* * *MANAGE ROOM TYPE PAGE* */

function room_type($param1 = '', $param2 = '', $param3 = '') {
     if ($this->session->userdata('hostel_login') != 1)
            redirect('login', 'refresh');
			
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $this->db->insert('room_type', $data);
        $this->session->set_flashdata('flash_message', get_phrase('room_type_added_successfully'));
        redirect(base_url() . 'index.php?hostel/room_type', 'refresh');
    }
   
    if ($param1 == 'delete') {
        $this->db->where('room_type_id', $param2);
        $this->db->delete('room_type');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?hostel/room_type', 'refresh');
    }
    $page_data['room_types'] = $this->db->get('room_type')->result_array();
    $page_data['page_name'] = 'room_type';
    $page_data['page_title'] = get_phrase('manage_room_type');
    $this->load->view('backend/index', $page_data);
}


/* * *MANAGE HOSTEL CATEGPRY* */

function hostel_category($param1 = '', $param2 = '', $param3 = '') {
   if ($this->session->userdata('hostel_login') != 1)
            redirect('login', 'refresh');
			
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $this->db->insert('hostel_category', $data);
        $this->session->set_flashdata('flash_message', get_phrase('category_added_successfully'));
        redirect(base_url() . 'index.php?hostel/hostel_category', 'refresh');
    }
   
    if ($param1 == 'delete') {
        $this->db->where('hostel_category_id', $param2);
        $this->db->delete('hostel_category');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?hostel/hostel_category', 'refresh');
    }
    $page_data['hostel_categorys'] = $this->db->get('hostel_category')->result_array();
    $page_data['page_name'] = 'hostel_category';
    $page_data['page_title'] = get_phrase('manage_hostel_category');
    $this->load->view('backend/index', $page_data);
}


/* * *MANAGE HOSTEL ROOM PAGE* */

	function hostel_room($param1 = '', $param2 = '', $param3 = '') {
     if ($this->session->userdata('hostel_login') != 1)
            redirect('login', 'refresh');
			
    if ($param1 == 'create') {
        $data['name'] 		= $this->input->post('name');
		$data['room_type_id'] 	= $this->input->post('room_type_id');
        $data['num_bed'] 		= $this->input->post('num_bed');
        $data['cost_bed']	 	= $this->input->post('cost_bed');
		$data['description'] 	= $this->input->post('description');
        $this->db->insert('hostel_room', $data);
        $this->session->set_flashdata('flash_message', get_phrase('hostel_room_added_successfully'));
        redirect(base_url() . 'index.php?hostel/hostel_room', 'refresh');
    }
	
	
	if ($param1 == 'do_update') {
        $data['name'] 		= $this->input->post('name');
		$data['room_type_id'] 	= $this->input->post('room_type_id');
        $data['num_bed'] 		= $this->input->post('num_bed');
        $data['cost_bed']	 	= $this->input->post('cost_bed');
		$data['description'] 	= $this->input->post('description');
		
        $this->db->where('hostel_room_id', $param2);
        $this->db->update('hostel_room', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?hostel/hostel_room', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('hostel_room', array(
                    'hostel_room_id' => $param2
                ))->result_array();
    }

    if ($param1 == 'delete') {
        $this->db->where('hostel_room_id', $param2);
        $this->db->delete('hostel_room');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?hostel/hostel_room', 'refresh');
    }
    $page_data['hostel_rooms'] = $this->db->get('hostel_room')->result_array();
    $page_data['page_name'] = 'hostel_room';
    $page_data['page_title'] = get_phrase('manage_hostel_room');
    $this->load->view('backend/index', $page_data);
}
	
	
	 /**********MANAGE HOLIDAY ********************/
    function holiday($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('hostel_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['holidays']      = $this->db->get('holiday')->result_array();
        $page_data['page_name']  = 'holiday';
        $page_data['page_title'] = get_phrase('manage_holidays');
        $this->load->view('backend/index', $page_data);
        
    }
	
	
	 /**********MANAGE todays_thought ********************/
    function todays_thought($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('hostel_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['todays_thoughts']      = $this->db->get('todays_thought')->result_array();
        $page_data['page_name']  = 'todays_thought';
        $page_data['page_title'] = get_phrase('manage_todays_thought');
        $this->load->view('backend/index', $page_data);
        
    }
	


/**********MANAGE LOAN APPLICATIONS *******************/
    function loan_applicant($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('hostel_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
		
		    $data['staff_name']     	= $this->input->post('staff_name');
		    $data['name']     			= $this->input->post('name');
            $data['amount']        	 	= $this->input->post('amount');
            $data['purpose']    	  	= $this->input->post('purpose');
            $data['l_duration']       	= $this->input->post('l_duration');
			//$data['file_name'] 			= $_FILES["file_name"]["name"];
            $data['mop']       			= $this->input->post('mop');
			
			$data['g_name']     		= $this->input->post('g_name');
            $data['g_relationship']     = $this->input->post('g_relationship');
            $data['g_number']     		= $this->input->post('g_number');
			
			$data['g_address']     		= $this->input->post('g_address');
            $data['g_country']         	= $this->input->post('g_country');
            $data['c_name']     		= $this->input->post('c_name');
			
			$data['c_type']     		= $this->input->post('c_type');
            $data['model']         		= $this->input->post('model');
            $data['make']     			= $this->input->post('make');
			
			$data['serial_number']     	= $this->input->post('serial_number');
            $data['value']   			= $this->input->post('value');
            $data['condition']     		= $this->input->post('condition');
			$data['date']         		= $this->input->post('date');
            $data['status']     		= $this->input->post('status');
			
            $this->db->insert('loan', $data);
            $assignment_id = $this->db->insert_id();
			
			$data['file_name'] 			= $_FILES["file_name"]["name"];
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/loan_applicant/" . $_FILES["file_name"]["name"]);
			$this->session->set_flashdata('flash_message' , get_phrase('application_submitted'));
            redirect(base_url() . 'index.php?hostel/loan_applicant' , 'refresh');
        }
		
        $page_data['page_name']  = 'loan_applicant';
        $page_data['page_title'] = get_phrase('manage_loan_applicants');
        $page_data['loan_applicants']  = $this->db->get('loan')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	
	
	/**********MANAGE LOAN APPLICATIONS *******************/
    function loan_approval($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('hostel_login') != 1)
            redirect('login', 'refresh');
       
        $page_data['page_name']  = 'loan_approval';
        $page_data['page_title'] = get_phrase('approval_status');
        $page_data['loan_approvals']  = $this->db->get('loan')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	
	
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('hostel_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);
        
    }
	

	 /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    function dormitory($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('hostel_login') != 1)
            redirect('login', 'refresh');
        
		if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['hostel_room_id'] = $this->input->post('hostel_room_id');
        $data['hostel_category_id'] = $this->input->post('hostel_category_id');
        $data['capacity'] = $this->input->post('capacity');
        $data['address'] = $this->input->post('address');
        $data['description'] = $this->input->post('description');
        $this->db->insert('dormitory', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?hostel/dormitory', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
		$data['hostel_room_id'] = $this->input->post('hostel_room_id');
        $data['capacity'] = $this->input->post('capacity');
        $data['address'] = $this->input->post('address');
        $data['description'] = $this->input->post('description');

        $this->db->where('dormitory_id', $param2);
        $this->db->update('dormitory', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?hostel/dormitory', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('dormitory', array(
                    'dormitory_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('dormitory_id', $param2);
        $this->db->delete('dormitory');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?hostel/dormitory', 'refresh');
    }
    $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
    $page_data['page_name'] = 'dormitory';
    $page_data['page_title'] = get_phrase('manage_dormitory');
    $this->load->view('backend/index', $page_data);
}
	
	
	
	
    /**********VIEW NEWS ********************/
    function news($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('hostel_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['newss'] = $this->db->get('news')->result_array();
        $page_data['page_name']  = 'news';
        $page_data['page_title'] = get_phrase('manage_news');
        $this->load->view('backend/index', $page_data);
        
    }
    
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('hostel_login') != 1)
            redirect(base_url(), 'refresh');
        
       
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
	
	
	/****MANAGE HELPFUL LINK*****/
    function help_link($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('hostel_login') != 1)
            redirect(base_url(), 'refresh');
			
       
        $page_data['help_links']    = $this->db->get('help_link')->result_array();
        $page_data['page_name']  = 'help_link';
        $page_data['page_title'] = get_phrase('manage_help_link');
        $this->load->view('backend/index', $page_data);
    }
	
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('hostel_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?hostel/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?hostel/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }
}