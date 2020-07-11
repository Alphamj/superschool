<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *	Author 			: Optimum Linkup Software
 *	date			: 27 June, 2017
 *	Website			:http://optimumlinkupsoftware.com/school
 *	Email			:info@optimumlinkupsoftware.com
 */


class librarian extends CI_Controller
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
    
    /***default functin, redirects to login page if no librarian logged in yet***/
    public function index()
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('librarian_login') == 1)
            redirect(base_url() . 'index.php?librarian/dashboard', 'refresh');
    }
    
    /***librarian DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('librarian_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    
    /*ENTRY OF A NEW STUDENT*/
    
    
    /****MANAGE STUDENTS CLASSWISE*****/
    function student_add()
	{
		if ($this->session->userdata('librarian_login') != 1)
            redirect(base_url(), 'refresh');
			
		$page_data['page_name']  = 'student_add';
		$page_data['page_title'] = get_phrase('add_student');
		$this->load->view('backend/index', $page_data);
	}
	
	function student_information($class_id = '')
	{
		if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');
			
		$page_data['page_name']  	= 'student_information';
		$page_data['page_title'] 	= get_phrase('student_information'). " - ".get_phrase('class')." : ".
											$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}
	
	function student_marksheet($student_id = '') {
        if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('student' , array('student_id' => $student_id))->row()->class_id;
        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $page_data['page_name']  =   'student_marksheet';
        $page_data['page_title'] =   get_phrase('marksheet_for') . ' ' . $student_name . ' (' . get_phrase('class') . ' ' . $class_name . ')';
        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_marksheet_print_view($student_id , $exam_id) {
        if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('student' , array('student_id' => $student_id))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/librarian/student_marksheet_print_view', $page_data);
    }
	
    function student($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['birthday']   = $this->input->post('birthday');
            $data['sex']        = $this->input->post('sex');
            $data['address']    = $this->input->post('address');
            $data['phone']      = $this->input->post('phone');
            $data['email']      = $this->input->post('email');
            $data['password']   = $this->input->post('password');
            $data['class_id']   = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');
            $data['parent_id']  = $this->input->post('parent_id');
            $data['roll']       = $this->input->post('roll');
            $this->db->insert('student', $data);
            $student_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
            $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?librarian/student_add/' . $data['class_id'], 'refresh');
        }
        if ($param2 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $data['class_id']    = $this->input->post('class_id');
            $data['section_id']  = $this->input->post('section_id');
            $data['parent_id']   = $this->input->post('parent_id');
            $data['roll']        = $this->input->post('roll');
            
            $this->db->where('student_id', $param3);
            $this->db->update('student', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');
            $this->crud_model->clear_cache();
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?librarian/student_information/' . $param1, 'refresh');
        } 
		
		if ($param2 == 'edit_book') {
	 
            $data['issue_date']  = $this->input->post('issue_date');
            $data['expire_date'] = $this->input->post('expire_date');
            $data['card_number'] = $this->input->post('card_number');

            $this->db->where('student_id', $param3);
        	$this->db->update('student', $data);
			$this->crud_model->clear_cache();
            $this->session->set_flashdata('flash_message', get_phrase('card_issued_successfully'));
            redirect(base_url() . 'index.php?librarian/search_student/'.$class_id . $param1, 'refresh');
        }
		
        if ($param2 == 'delete') {
            $this->db->where('student_id', $param3);
            $this->db->delete('student');
            redirect(base_url() . 'index.php?librarian/student_information/' . $param1, 'refresh');
        }
    }

    function get_class_section($class_id)
    {
        $sections = $this->db->get_where('section' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }
	



/* * ****MANAGE SEARCH STUDENT PAGE** */
function search_student($class_id = '', $param2 = '', $sparam3 = '') {
    if ($this->session->userdata('librarian_login') != 1)
            redirect(base_url(), 'refresh');
			
    if ($this->input->post('operation') == 'selection') 
	{
        $page_data['class_id'] = $this->input->post('class_id');

        if ($page_data['class_id'] > 0 ) 
		{
            redirect(base_url() . 'index.php?librarian/search_student/' . $page_data['class_id'], 'refresh');
        } 
		else 
		{
            $this->session->set_flashdata('info', 'please_select_class');
            redirect(base_url() . 'index.php?librarian/search_student/', 'refresh');
        }
    }
	
	$page_data['class_id'] = $class_id;
    $page_data['page_info'] = 'search_student';

    $page_data['page_name'] = 'search_student';
    $page_data['page_title'] = get_phrase('issue_library_card_number');
    $this->load->view('backend/index', $page_data);
}
    
    /****MANAGE LIBRARIAN *****/
    function librarian_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_librarian_id'] = $param2;
        }
        $page_data['librarians']   = $this->db->get('librarian')->result_array();
        $page_data['page_name']  = 'librarian';
        $page_data['page_title'] = get_phrase('librarian_list');
        $this->load->view('backend/index', $page_data);
    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');
            
            $this->db->where('librarian_id', $this->session->userdata('librarian_id'));
            $this->db->update('librarian', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/librarian_image/' . $this->session->userdata('librarian_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?librarian/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('librarian', array(
                'librarian_id' => $this->session->userdata('librarian_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('librarian_id', $this->session->userdata('librarian_id'));
                $this->db->update('librarian', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?librarian/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('librarian', array(
            'librarian_id' => $this->session->userdata('librarian_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
   
    
    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');
        
		if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $data['price'] = $this->input->post('price');
        $data['author_id'] = $this->input->post('author_id');
        $data['publisher_id'] = $this->input->post('publisher_id');
        $data['book_category_id'] = $this->input->post('book_category_id');
        $data['isbn'] = $this->input->post('isbn');
        $data['edition'] = $this->input->post('edition');
        $data['subject'] = $this->input->post('subject');
        $data['quantity'] = $this->input->post('quantity');
        $data['date'] = $this->input->post('date');
        $data['class_id'] = $this->input->post('class_id');
        $data['status'] = $this->input->post('status');
        $this->db->insert('book', $data);
		$book_id = $this->db->insert_id();
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/book_files/' . $book_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?librarian/book', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $data['price'] = $this->input->post('price');
        $data['author_id'] = $this->input->post('author_id');
		$data['class_id'] = $this->input->post('class_id');
        $data['status'] = $this->input->post('status');

        $this->db->where('book_id', $param2);
        $this->db->update('book', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?librarian/book', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('book', array(
                    'book_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('book_id', $param2);
        $this->db->delete('book');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?librarian/book', 'refresh');
    }
    $page_data['books'] = $this->db->get('book')->result_array();
    $page_data['page_name'] = 'book';
    $page_data['page_title'] = get_phrase('manage_library_books');
    $this->load->view('backend/index', $page_data);
}


/* * ********MANAGE BOOK CATEGORY ******************* */

function book_category($param1 = '', $param2 = '', $param3 = '') {
     if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');
			
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $this->db->insert('book_category', $data);
        $this->session->set_flashdata('flash_message', get_phrase('book_category_added_successfully'));
        redirect(base_url() . 'index.php?librarian/book_category', 'refresh');
    }
   
    if ($param1 == 'delete') {
        $this->db->where('book_category_id', $param2);
        $this->db->delete('book_category');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?librarian/book_category', 'refresh');
    }
    $page_data['book_categorys'] = $this->db->get('book_category')->result_array();
    $page_data['page_name'] = 'book_category';
    $page_data['page_title'] = get_phrase('manage_book_category');
    $this->load->view('backend/index', $page_data);
}


/* * ********MANAGE BOOK AUTHOR ******************* */

function author($param1 = '', $param2 = '', $param3 = '') {
       if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');
			
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $this->db->insert('author', $data);
        $this->session->set_flashdata('flash_message', get_phrase('author_added_successfully'));
        redirect(base_url() . 'index.php?librarian/author', 'refresh');
    }
   
    if ($param1 == 'delete') {
        $this->db->where('author_id', $param2);
        $this->db->delete('author');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?librarian/author', 'refresh');
    }
    $page_data['authors'] = $this->db->get('author')->result_array();
    $page_data['page_name'] = 'author';
    $page_data['page_title'] = get_phrase('manage_authors');
    $this->load->view('backend/index', $page_data);
}


/* * ********MANAGE BOOK PUBLISHER ******************* */

function publisher($param1 = '', $param2 = '', $param3 = '') {
     if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');
			
    if ($param1 == 'create') {
        $data['publisher_name'] = $this->input->post('publisher_name');
        $data['description'] = $this->input->post('description');
        $this->db->insert('publisher', $data);
        $this->session->set_flashdata('flash_message', get_phrase('publisher_added_successfully'));
        redirect(base_url() . 'index.php?librarian/publisher', 'refresh');
    }
   
    if ($param1 == 'delete') {
        $this->db->where('publisher_id', $param2);
        $this->db->delete('publisher');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?librarian/publisher', 'refresh');
    }
    $page_data['publishers'] = $this->db->get('publisher')->result_array();
    $page_data['page_name'] = 'publisher';
    $page_data['page_title'] = get_phrase('manage_publisher');
    $this->load->view('backend/index', $page_data);
}



	
	
	 /**********MANAGE HOLIDAY ********************/
    function holiday($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['holidays']      = $this->db->get('holiday')->result_array();
        $page_data['page_name']  = 'holiday';
        $page_data['page_title'] = get_phrase('manage_holidays');
        $this->load->view('backend/index', $page_data);
        
    }
	
	
	 /**********MANAGE todays_thought ********************/
    function todays_thought($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['todays_thoughts']      = $this->db->get('todays_thought')->result_array();
        $page_data['page_name']  = 'todays_thought';
        $page_data['page_title'] = get_phrase('manage_todays_thought');
        $this->load->view('backend/index', $page_data);
        
    }
	


/**********MANAGE LOAN APPLICATIONS *******************/
    function loan_applicant($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
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
			$this->session->set_flashdata('flash_message' , get_phrase('loan_application_submitted_successfully'));
            redirect(base_url() . 'index.php?librarian/loan_applicant' , 'refresh');
        }
		
        $page_data['page_name']  = 'loan_applicant';
        $page_data['page_title'] = get_phrase('loan_application');
        $page_data['loan_applicants']  = $this->db->get('loan')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	
	
	/**********MANAGE LOAN APPLICATIONS *******************/
    function loan_approval($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');

		
        $page_data['page_name']  = 'loan_approval';
        $page_data['page_title'] = get_phrase('approval_status');
        $page_data['loan_approvals']  = $this->db->get('loan')->result_array();
        $this->load->view('backend/index', $page_data);
    }

	
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);
        
    }
	

    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function news($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['newss'] = $this->db->get('news')->result_array();
        $page_data['page_name']  = 'news';
        $page_data['page_title'] = get_phrase('manage_news');
        $this->load->view('backend/index', $page_data);
        
    }
    
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect(base_url(), 'refresh');
        
       
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
	
	
	/****MANAGE HELPFUL LINK*****/
    function help_link($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect(base_url(), 'refresh');
			
       
        $page_data['help_links']    = $this->db->get('help_link')->result_array();
        $page_data['page_name']  = 'help_link';
        $page_data['page_title'] = get_phrase('manage_help_link');
        $this->load->view('backend/index', $page_data);
    }
	

    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('librarian_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?librarian/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?librarian/message/message_read/' . $param2, 'refresh');
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