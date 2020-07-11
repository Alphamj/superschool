<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* ...................................................................
......................................................................
 * 	Author 			: Optimum Linkup Software ........................
 * 	date			: 27 June, 2017 ..................................
 * 	Website			:http://optimumlinkupsoftware.com/superschool.....
 * 	Email			:info@optimumlinkupsoftware.com ..................
 .....................................................................
 .....................................................................
 LOCATION : application - controller - Admin.php
 */

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	
	/*nursery report card*/
	function nursery_add_class() {
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'nurseryaddclass';
        $page_data['page_title'] = get_phrase('nursery_add_class');
        $this->load->view('backend/index', $page_data);
	}
	
	
	function nurseryreport() {
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'nurseryreport';
        $page_data['page_title'] = get_phrase('nursery_report_card');
        $this->load->view('backend/index', $page_data);
	}
	

    /*     * **MANAGE STUDENTS CLASSWISE**** */

    function student_add() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		$this->session->unset_userdata('redir_page');
		$this->session->unset_userdata('rdirect');
        $page_data['page_name'] = 'student_add';
        $page_data['page_title'] = get_phrase('student_admission_form');
        $this->load->view('backend/index', $page_data);
    }
  function student_bulk_add($param1 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'import_excel') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_import.xlsx');
            // Importing excel sheet for bulk student uploads

            include 'Simplexlsx.class.php';

            $xlsx = new SimpleXLSX('uploads/student_import.xlsx');

            //list($num_cols, $num_rows) = $xlsx->dimension();
            $f = 0;
            $head  = $xlsx->rows()[0];
            foreach ($xlsx->rows() as $r) {
                // Ignore the inital name row of excel file
                if ($f == 0) {
                    $f++;
                    continue;
                }
				$array_combine = array_combine( $head ,$r);
				if($array_combine['name']){
					$data['name'] = $array_combine['name'];
				}
				if($array_combine['sur_name']){
					$data['surname'] = $array_combine['sur_name'];
				}
				if($array_combine['birthday']){
					$data['birthday'] 	=  $array_combine['birthday'];
				}
				if($array_combine['age']){
                    $data['age'] =$array_combine['age']; 
				}	
				if($array_combine['place_birth']){
                    $data['place_birth'] =$array_combine['place_birth'];
                }
                if($array_combine['sex']){
                    $data['sex'] =  $array_combine['sex']; 
				}
				if($array_combine['m_tongue']){
                    $data['m_tongue'] 	= $array_combine['m_tongue'];
                }
                if($array_combine['religion']){
				    $data['religion'] 	=  $array_combine['religion']; 
				}
				if($array_combine['blood_group']){
                    $data['blood_group'] =  $array_combine['blood_group'];
                }
                if($array_combine['address']){
					$data['address'] 	= $array_combine['address']; 
				}
				if($array_combine['city']){
                    $data['city'] = $array_combine['city'];
				}
				if($array_combine['state']){
					$data['state'] 		=  $array_combine['state'];
				}
				if($array_combine['nationality']){
                    $data['nationality'] =  $array_combine['nationality'];
				}
                if($array_combine['phone']){
                    $data['phone'] 	=  $array_combine['phone'];
                }
                if($array_combine['email']){
                    $data['email'] 		= $array_combine['email'];
                }   
                if($array_combine['password']){
                    $data['password'] 	=  $array_combine['password'];
                }else{
					$data['password'] 	= $array_combine['email'];
				}
                if($array_combine['roll']){ 
                    $data['roll']= $array_combine['roll'];
				}
                
                $data['class_id'] = $this->input->post('class_id');

                $this->db->insert('student', $data);
                print_r($data);
            }
            redirect(base_url() . 'index.php?admin/student_information/' . $this->input->post('class_id'), 'refresh');
			$this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));

        }
        $page_data['page_name'] = 'student_bulk_add';
        $page_data['page_title'] = get_phrase('add_bulk_student');
        $this->load->view('backend/index', $page_data);
    }
	/*function update_password(){
		 $sql = "select student_id,email from student where `class_id` = '8'";
		$result = $this->db->query($sql)->result_array();	
		foreach($result as $users){
			$data['roll'] 	= 'jss'.$users['student_id'];
        
			$this->db->where('student_id',$users['student_id']);
			$this->db->update('student',$data);
		}
	}*/
    function student_information($class_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
			
		if ($this->input->post('operation') == 'selection'){
			$page_data['class_id'] = $this->input->post('class_id');
			if ($page_data['class_id'] > 0 ) {
				redirect(base_url() . 'index.php?admin/student_information/' . $page_data['class_id'], 'refresh');
			}else {
				$this->session->set_flashdata('info', 'please_select_class');
				redirect(base_url() . 'index.php?admin/student_information/', 'refresh');
			}
		}

        $page_data['page_name'] = 'student_information';
        $page_data['page_title'] = get_phrase('student_information') . " - " . get_phrase('class') . " : " .
                $this->crud_model->get_class_name($class_id);
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_marksheet($student_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $class_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->class_id;
        $student_name = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
        $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
        $page_data['page_name'] = 'student_marksheet';
        $page_data['page_title'] = get_phrase('marksheet_for') . ' ' . $student_name . ' (' . get_phrase('class') . ' ' . $class_name . ')';
        $page_data['student_id'] = $student_id;
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_marksheet_print_view($student_id, $class_id) {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['student_id'] = $student_id;
        $page_data['class_id'] = $class_id;
        
        $this->load->view('backend/admin/student_marksheet_print_view', $page_data);
    }

    //PDF Loader
    function report_pdf(){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        $this->load->library('Pdf');
        $this->load->view('backend/admin/tabulation_sheet_print_view_single_pdf');
    }

    //MANAGE EVENTS
    
    function event() {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($this->input->post('operation') == 'update') {
        $data['exam_id']    = $this->input->post('exam_id');
        $data['status'] = $this->input->post('status');
        $data['session_year']   = $this->input->post('session');

        //$this->db->where('status', $status);
		$this->db->where('exam_id', $this->input->post('exam_id'));
		$this->db->where('session_year', $this->input->post('session'));
        $this->db->update('status', $data);
    
        $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/event/' . $this->input->post('exam_id') . '/' . $this->input->post('status') . '/' . $this->input->post('session'), 'refresh');
        }

    $page_data['page_info'] = 'Events';
    $page_data['page_name'] = 'event';
    $page_data['page_title'] = get_phrase('event');
    $this->load->view('backend/index', $page_data);
    }

    //function added on 20-06-18 sandeep
	function student_check($param){
		$student_info = $this->db->get_where('student', array('roll'=> $param))->row()->student_id;
         if(count($student_info) >0){
			$msg = 'Exist';
		}else{
			$msg = 'Done';
		}
		echo $msg;
	}
	//function added on 28-06-18 sandeep
	function student_session_year($session,$class_id,$current_year =''){
		if($current_year){
			$students	=	$this->crud_model->get_students($class_id); 
             foreach($students as $row2): ?>
               <option class="student_id" value="<?php echo $row2['student_id'];?>"><?php echo $row2['name'].' '.$row2['surname'];?>
                </option>
                            <?php endforeach;
		}else{
			$this->db->distinct();
			$this->db->select('t1.student_id, t1.name,t1.surname')
					->from('mark as t2')
					->where('t2.class_id', $class_id)
					->where('t2.session_year', $session)
					->join('student as t1', 't1.student_id = t2.student_id', 'LEFT');
			$query = $this->db->get();
			$query_array = $query->result_array();
			
			foreach($query_array as $students_ids){
				$students_id =$students_ids['student_id'];
				$students_name =$students_ids['name'];
				$surname =$students_ids['surname'];
			?>
				<option value="<?php echo $students_id; ?>"><?php echo $students_name.' '.$surname; ?></option>
			<?php	}
		}

	}
	//function added on 29-06-18 sandeep
	function nursery_subjects($class_id){
		$this->db->distinct();
		$this->db->select('t1.subject_id, t1.name')
					->from('class_subject as t2')
					->where('t2.class_id', $class_id)
					
					->join('subject as t1', 't1.subject_id = t2.subject_id');
			$query = $this->db->get();
			$query_array = $query->result_array();
			
			foreach($query_array as $students_ids){
				$students_id =$students_ids['subject_id'];
				$students_name =$students_ids['name'];
				
			?>
				<option value="<?php echo $students_id; ?>"><?php echo $students_name; ?></option>
			<?php	}
		

	}
    function student($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
			
			$data1= array();
            $data['name'] 				= $this->input->post('name');
            $data['surname'] 			= $this->input->post('surname');
            $data['birthday'] 			= $this->input->post('birthday');
            $data['age'] 				= $this->input->post('age');
            $data['place_birth'] 		= $this->input->post('place_birth');
            $data['sex'] 				= $this->input->post('sex');
            $data['m_tongue'] 			= $this->input->post('m_tongue');
            $data['religion'] 			= $this->input->post('religion');
            $data['blood_group'] 		= $this->input->post('blood_group');
            $data['address'] 			= $this->input->post('address');
            $data['city'] 				= $this->input->post('city');
            $data['state'] 				= $this->input->post('state');
            $data['nationality'] 		= $this->input->post('nationality');
            $data['phone'] 				= $this->input->post('phone');
            $data['email'] 				= $this->input->post('email');
            $data['notes'] 				= $this->input->post('notes');

            $data['ps_attend'] 			= $this->input->post('ps_attend');
            $data['ps_address'] 		= $this->input->post('ps_address');
            $data['ps_purpose'] 		= $this->input->post('ps_purpose');
            $data['class_study'] 		= $this->input->post('class_study');
            $data['date_of_leaving'] 	= $this->input->post('date_of_leaving');
            $data['am_date'] 			= $this->input->post('am_date');
            $data['tran_cert'] 			= $this->input->post('tran_cert');
            $data['dob_cert'] 			= $this->input->post('dob_cert');
            $data['mark_join'] 			= $this->input->post('mark_join');
            $data['physical_h'] 		= $this->input->post('physical_h');

            $data['password'] 			= $this->input->post('password');
            $data['class_id'] 			= $this->input->post('class_id');
           
            $data['parent_id'] 			= $this->input->post('parent_id');
            $data['dormitory_id'] 		= $this->input->post('dormitory_id');
            $data['session'] 			= $this->input->post('session');
            $data['transport_id'] 		= $this->input->post('transport_id');
            $data['roll'] 				= $this->input->post('roll');
            
           
            
            $this->db->insert('student', $data);
            $student_id = $this->db->insert_id();
            $ext2 =$ext3 =$ext4 =$otherext1 =$otherext2 =$otherext3 =array();
            if($_FILES['userfile2']['name']){
				$ext2 = explode('.',$_FILES['userfile2']['name']);
			}
			if($_FILES['userfile3']['name']){
				$ext3 = explode('.',$_FILES['userfile3']['name']);
			}
            if($_FILES['userfile4']['name']){
				$ext4 = explode('.',$_FILES['userfile4']['name']);
			}
            if($_FILES['other1']['name']){
				$otherext1 = explode('.',$_FILES['other1']['name']);
			}
			if($_FILES['other2']['name']){
				$otherext2 = explode('.',$_FILES['other2']['name']);
			}
			if($_FILES['other3']['name']){
				$otherext3 = explode('.',$_FILES['other3']['name']);
			}
           
            
           //others_files
            
           move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
           $data1['birth_certificate'] = $data1['transfer_certificate'] = $data1['medical_certificate'] =$data1['attach_other1'] =
           $data1['attach_other2'] =$data1['attach_other3'] ='';
			if(count($ext2) ==2){
				$data1['birth_certificate'] =  $student_id .'birth_certificate.'. $ext2[1];
				move_uploaded_file($_FILES['userfile2']['tmp_name'], 'uploads/student_image/birth_certificate/' . $student_id .'birth_certificate.'. $ext2[1]);
            }
            if(count($ext3) ==2){
				  $data1['transfer_certificate'] =  $student_id .'transfer_certificate.'. $ext3[1];
				move_uploaded_file($_FILES['userfile3']['tmp_name'], 'uploads/student_image/transfer_certificate/' . $student_id .'transfer_certificate.'.$ext3[1]);
            }
            if(count($ext4) ==2){
				$data1['medical_certificate'] =  $student_id .'medical_certificate.'. $ext4[1];
				move_uploaded_file($_FILES['userfile4']['tmp_name'], 'uploads/student_image/medical_certificate/' . $student_id .'medical_certificate.'.$ext4[1]);
            }
            if(count($otherext1) ==2){
				$data1['attach_other1'] = $student_id .'other1.'.$otherext1[1];
				move_uploaded_file($_FILES['other1']['tmp_name'], 'uploads/student_image/others_files/' . $student_id .'other1.'.$otherext1[1]);
            }
            if(count($otherext2) ==2){
				$data1['attach_other2'] = $student_id .'other2.'.$otherext2[1];
				move_uploaded_file($_FILES['other2']['tmp_name'], 'uploads/student_image/others_files/' . $student_id .'other2.'.$otherext2[1]);
            }
            if(count($otherext3) ==2){
				$data1['attach_other3'] = $student_id .'other3.'.$otherext3[1];
				move_uploaded_file($_FILES['other3']['tmp_name'], 'uploads/student_image/others_files/' . $student_id .'other3.'.$otherext3[1]);
            }
             $this->db->where('student_id', $student_id);
            $this->db->update('student', $data1);
            
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/student_add/' . $data['class_id'], 'refresh');
        }
        if ($param2 == 'do_update') {
            $data['name'] 				= $this->input->post('name');
            $data['surname'] 				= $this->input->post('surname');
            $data['birthday'] 			= $this->input->post('birthday');
            $data['age'] 				= $this->input->post('age');
            $data['sex'] 				= $this->input->post('sex');
            $data['m_tongue'] 			= $this->input->post('m_tongue');
            $data['religion'] 			= $this->input->post('religion');
            $data['address'] 			= $this->input->post('address');
            $data['phone'] 				= $this->input->post('phone');
            $data['email'] 				= $this->input->post('email');
            $data['class_id'] 			= $this->input->post('class_id');
           
            $data['parent_id'] 			= $this->input->post('parent_id');
            $data['dormitory_id'] 		= $this->input->post('dormitory_id');
            $data['transport_id'] 		= $this->input->post('transport_id');
            $data['roll'] 				= $this->input->post('roll');
            $data['notes'] 				= $this->input->post('notes');
			
			 $ext2 =$ext3 =$ext4 =$otherext1 =$otherext2 =$otherext3 =array();
            if($_FILES['userfile2']['name']){
				$ext2 = explode('.',$_FILES['userfile2']['name']);
			}
			if($_FILES['userfile3']['name']){
				$ext3 = explode('.',$_FILES['userfile3']['name']);
			}
            if($_FILES['userfile4']['name']){
				$ext4 = explode('.',$_FILES['userfile4']['name']);
			}
			
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');
			 $data1['birth_certificate'] = $data1['transfer_certificate'] = $data1['medical_certificate'] ='';
            if(count($ext2) ==2){
				$data['birth_certificate'] = $param3 .'.'. $ext2[1];
				move_uploaded_file($_FILES['userfile2']['tmp_name'], 'uploads/student_image/birth_certificate/' . $student_id .'birth_certificate.'. $ext2[1]);
            }
            if(count($ext3) ==2){
				  $data['transfer_certificate'] = $param3 .'.'. $ext3[1];
				move_uploaded_file($_FILES['userfile3']['tmp_name'], 'uploads/student_image/transfer_certificate/' . $student_id .'transfer_certificate.'.$ext3[1]);
            }
            if(count($ext4) ==2){
				$data['medical_certificate'] = $param3 .'.'. $ext4[1];
				move_uploaded_file($_FILES['userfile4']['tmp_name'], 'uploads/student_image/medical_certificate/' . $student_id .'medical_certificate.'.$ext4[1]);
            }
             $this->db->where('student_id', $param3);
            $this->db->update('student', $data);
           
            $this->crud_model->clear_cache();
            $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/student_information/' . $param1, 'refresh');
        }
		
		if ($param2 == 'edit_book') {
	 
            $data['issue_date']  = $this->input->post('issue_date');
            $data['expire_date'] = $this->input->post('expire_date');
            $data['card_number'] = $this->input->post('card_number');

            $this->db->where('student_id', $param3);
        	$this->db->update('student', $data);
			$this->crud_model->clear_cache();
            $this->session->set_flashdata('flash_message', get_phrase('card_issued_successfully'));
            redirect(base_url() . 'index.php?admin/search_student/'. $param1, 'refresh');
        }
		
        if ($param2 == 'delete') {
            $this->db->where('student_id', $param3);
            $this->db->delete('student');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/student_information/' . $param1, 'refresh');
        }
		
    }

    /*     * **MANAGE PARENTS CLASSWISE**** */

    function parent($param1 = '', $param2 = '', $param3 = '')
    {
		
    if($this->  session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $data['phone'] = $this->input->post('phone');
        $data['address'] = $this->input->post('address');
        $data['profession'] = $this->input->post('profession');
        $this->db->insert('parent', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        if($this->session->userdata('redir_page')){
			$this->session->set_userdata(array('rdirect' =>'yes' ));
		}
		redirect(base_url() . 'index.php?admin/parent/', 'refresh');
    }
    if ($param1 == 'edit') {
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['address'] = $this->input->post('address');
        $data['profession'] = $this->input->post('profession');
        $this->db->where('parent_id', $param2);
        $this->db->update('parent', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/parent/', 'refresh');
    }
    if ($param1 == 'delete') {
        $this->db->where('parent_id', $param2);
        $this->db->delete('parent');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/parent/', 'refresh');
    }
    if($param1 == 'student_add'){
		$this->session->set_userdata(array('redir_page' =>$param1 ));
	}
	
    $page_data['page_title'] = get_phrase('all_parents');
    $page_data['page_name'] = 'parent';
    $this->load->view('backend/index', $page_data);
     if($this->session->userdata('rdirect') =='yes'){
		redirect(base_url() . 'index.php?admin/'.$this->session->userdata('redir_page'), 'refresh');
	}
}

/*Add Class code*/

// function teacher($param1 = '', $param2 = '', $param3 = '') {
    // if ($this->session->userdata('admin_login') != 1)
        // redirect(base_url(), 'refresh');
    // if ($param1 == 'create') {
        // $data['name'] = $this->input->post('name');
        // $data['birthday'] = $this->input->post('birthday');
        // $data['sex'] = $this->input->post('sex');
		
		// $data['religion'] = $this->input->post('religion');
        // $data['blood_group'] = $this->input->post('blood_group');
		
        // $data['address'] = $this->input->post('address');
        // $data['phone'] = $this->input->post('phone');
        // $data['email'] = $this->input->post('email');

		// $data['facebook'] = $this->input->post('facebook');
        // $data['twitter'] = $this->input->post('twitter');
		// $data['googleplus'] = $this->input->post('googleplus');
        // $data['linkedin'] = $this->input->post('linkedin');
        // $data['qualification'] = $this->input->post('qualification');
		// $data['file_name'] = $_FILES["file_name"]["name"];

        // $data['password'] = $this->input->post('password');
        // $this->db->insert('teacher', $data);
        // $teacher_id = $this->db->insert_id();
		
		// move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/teacher_image/" . $_FILES["file_name"]["name"]);
        // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
        // $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        // $this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        // redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
    // }
    // if ($param1 == 'do_update') {
        // $data['name'] = $this->input->post('name');
        // $data['birthday'] = $this->input->post('birthday');
        // $data['sex'] = $this->input->post('sex');
        // $data['address'] = $this->input->post('address');
        // $data['phone'] = $this->input->post('phone');
        // $data['email'] = $this->input->post('email');

        // $this->db->where('teacher_id', $param2);
        // $this->db->update('teacher', $data);
        // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
        // $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        // redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
    // } else if ($param1 == 'personal_profile') {
        // $page_data['personal_profile'] = true;
        // $page_data['current_teacher_id'] = $param2;
    // } else if ($param1 == 'edit') {
        // $page_data['edit_data'] = $this->db->get_where('teacher', array(
                    // 'teacher_id' => $param2
                // ))->result_array();
    // }
    // if ($param1 == 'delete') {
        // $this->db->where('teacher_id', $param2);
        // $this->db->delete('teacher');
        // $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        // redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
    // }
    // $page_data['teachers'] = $this->db->get('teacher')->result_array();
    // $page_data['page_name'] = 'teacher';
    // $page_data['page_title'] = get_phrase('manage_teacher');
    // $this->load->view('backend/index', $page_data);
// }
/*add class code end*/


/* * **MANAGE TEACHERS**** */

function teacher($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['birthday'] = $this->input->post('birthday');
        $data['sex'] = $this->input->post('sex');
		
		$data['religion'] = $this->input->post('religion');
        $data['blood_group'] = $this->input->post('blood_group');
		
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['section'] = $this->input->post('section');
        $data['email'] = $this->input->post('email');

		$data['facebook'] = $this->input->post('facebook');
        $data['twitter'] = $this->input->post('twitter');
		$data['googleplus'] = $this->input->post('googleplus');
        $data['linkedin'] = $this->input->post('linkedin');
        $data['qualification'] = $this->input->post('qualification');
		$data['file_name'] = $_FILES["file_name"]["name"];

        $data['password'] = $this->input->post('password');
        $this->db->insert('teacher', $data);
        $teacher_id = $this->db->insert_id();
		
		move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/teacher_image/" . $_FILES["file_name"]["name"]);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        $this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['birthday'] = $this->input->post('birthday');
        $data['sex'] = $this->input->post('sex');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['section'] = $this->input->post('section');
        $data['email'] = $this->input->post('email');

        $this->db->where('teacher_id', $param2);
        $this->db->update('teacher', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
    } else if ($param1 == 'personal_profile') {
        $page_data['personal_profile'] = true;
        $page_data['current_teacher_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('teacher', array(
                    'teacher_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('teacher_id', $param2);
        $this->db->delete('teacher');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
    }
    $page_data['teachers'] = $this->db->get('teacher')->result_array();
    $page_data['page_name'] = 'teacher';
    $page_data['page_title'] = get_phrase('manage_teacher');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE ALUMNI**** */

function alumni($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['sex'] = $this->input->post('sex');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');
        $data['address'] = $this->input->post('address');
        $data['profession'] = $this->input->post('profession');
        $data['marital_status'] = $this->input->post('marital_status');
        $data['g_year'] = $this->input->post('g_year');
        $data['club'] = $this->input->post('club');
        $data['interest'] = $this->input->post('interest');


        $this->db->insert('alumni', $data);
        $alumni_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/alumni_image/' . $alumni_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        $this->email_model->account_opening_email('alumni', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'index.php?admin/alumni', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['sex'] = $this->input->post('sex');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');
        $data['address'] = $this->input->post('address');
        $data['profession'] = $this->input->post('profession');
        $data['marital_status'] = $this->input->post('marital_status');
        $data['g_year'] = $this->input->post('g_year');
        $data['club'] = $this->input->post('club');
        $data['interest'] = $this->input->post('interest');

        $this->db->where('alumni_id', $param2);
        $this->db->update('alumni', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/alumni_image/' . $param2 . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/alumni', 'refresh');
    } else if ($param1 == 'personal_profile') {
        $page_data['personal_profile'] = true;
        $page_data['current_alumni_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('alumni', array(
                    'alumni_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('alumni_id', $param2);
        $this->db->delete('alumni');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/alumni', 'refresh');
    }
    $page_data['alumni'] = $this->db->get('alumni')->result_array();
    $page_data['page_name'] = 'alumni';
    $page_data['page_title'] = get_phrase('manage_alumni');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE HEADS**** */

function head($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['birthday'] = $this->input->post('birthday');
        $data['sex'] = $this->input->post('sex');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['section'] = $this->input->post('section');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $this->db->insert('head', $data);
        $head_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/head_image/' . $head_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        $this->email_model->account_opening_email('head', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'index.php?admin/head/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['birthday'] = $this->input->post('birthday');
        $data['sex'] = $this->input->post('sex');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['section'] = $this->input->post('section');
        $data['email'] = $this->input->post('email');

        $this->db->where('head_id', $param2);
        $this->db->update('head', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/head_image/' . $param2 . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/head/', 'refresh');
    } else if ($param1 == 'personal_profile') {
        $page_data['personal_profile'] = true;
        $page_data['current_head_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('head', array(
                    'head_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('head_id', $param2);
        $this->db->delete('head');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/head/', 'refresh');
    }
    $page_data['head'] = $this->db->get('head')->result_array();
    $page_data['page_name'] = 'head';
    $page_data['page_title'] = 'manage head';
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE TEACHERS
  function teacher_id_card($param1 = '', $param2 = '', $param3 = '')
  {
  if ($this->session->userdata('admin_login') != 1)
  redirect(base_url(), 'refresh');
  if ($param1 == 'create') {
  $data['name']        = $this->input->post('name');
  $data['birthday']    = $this->input->post('birthday');
  $data['sex']         = $this->input->post('sex');
  $data['address']     = $this->input->post('address');
  $data['phone']       = $this->input->post('phone');
  $data['email']       = $this->input->post('email');
  $data['password']    = $this->input->post('password');
  $this->db->insert('teacher', $data);
  $teacher_id = $this->db->insert_id();
  move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
  $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
  $this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
  redirect(base_url() . 'index.php?admin/teacher_id_card/', 'refresh');
  }
  if ($param1 == 'do_update') {
  $data['name']        = $this->input->post('name');
  $data['birthday']    = $this->input->post('birthday');
  $data['sex']         = $this->input->post('sex');
  $data['address']     = $this->input->post('address');
  $data['phone']       = $this->input->post('phone');
  $data['email']       = $this->input->post('email');

  $this->db->where('teacher_id', $param2);
  $this->db->update('teacher', $data);
  move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
  $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
  redirect(base_url() . 'index.php?admin/teacher_id_card/', 'refresh');
  } else if ($param1 == 'personal_profile') {
  $page_data['personal_profile']   = true;
  $page_data['current_teacher_id'] = $param2;
  } else if ($param1 == 'edit') {
  $page_data['edit_data'] = $this->db->get_where('teacher', array(
  'teacher_id' => $param2
  ))->result_array();
  }
  if ($param1 == 'delete') {
  $this->db->where('teacher_id', $param2);
  $this->db->delete('teacher');
  $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
  redirect(base_url() . 'index.php?admin/teacher_idcard/', 'refresh');
  }
  $page_data['teachers']   = $this->db->get('teacher')->result_array();
  $page_data['page_name']  = 'teacher_id_card';
  $page_data['page_title'] = get_phrase('manage_teacher_idcard');
  $this->load->view('backend/index', $page_data);
  }


 * *** */

/* * **MANAGE TEACHERS generateidcard
  function generateidcard($param1 = '', $param2 = '', $param3 = '')
  {
  if ($this->session->userdata('admin_login') != 1)
  redirect(base_url(), 'refresh');
  if ($param1 == 'create') {
  $data['name']        = $this->input->post('name');
  $data['birthday']    = $this->input->post('birthday');
  $data['sex']         = $this->input->post('sex');
  $data['address']     = $this->input->post('address');
  $data['phone']       = $this->input->post('phone');
  $data['email']       = $this->input->post('email');
  $data['password']    = $this->input->post('password');
  $this->db->insert('teacher', $data);
  $teacher_id = $this->db->insert_id();
  move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
  $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
  $this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
  redirect(base_url() . 'index.php?admin/generateidcard/', 'refresh');
  }
  if ($param1 == 'do_update') {
  $data['name']        = $this->input->post('name');
  $data['birthday']    = $this->input->post('birthday');
  $data['sex']         = $this->input->post('sex');
  $data['address']     = $this->input->post('address');
  $data['phone']       = $this->input->post('phone');
  $data['email']       = $this->input->post('email');

  $this->db->where('teacher_id', $param2);
  $this->db->update('teacher', $data);
  move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
  $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
  redirect(base_url() . 'index.php?admin/generateidcard/', 'refresh');
  } else if ($param1 == 'personal_profile') {
  $page_data['personal_profile']   = true;
  $page_data['current_teacher_id'] = $param2;
  } else if ($param1 == 'edit') {
  $page_data['edit_data'] = $this->db->get_where('teacher', array(
  'teacher_id' => $param2
  ))->result_array();
  }
  if ($param1 == 'delete') {
  $this->db->where('teacher_id', $param2);
  $this->db->delete('teacher');
  $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
  redirect(base_url() . 'index.php?admin/generateidcard/', 'refresh');
  }
  $page_data['teachers']   = $this->db->get('teacher')->result_array();
  $page_data['page_name']  = 'teacher_idcard';
  $page_data['page_title'] = get_phrase('teacher_idcard');
  $this->load->view('backend/index', $page_data);
  }

 * *** */

/* * **MANAGE LIBRARIANS**** */

function librarian($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['birthday'] = $this->input->post('birthday');
        $data['sex'] = $this->input->post('sex');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $this->db->insert('librarian', $data);
        $librarian_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/librarian_image/' . $librarian_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        $this->email_model->account_opening_email('librarian', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'index.php?admin/librarian/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['birthday'] = $this->input->post('birthday');
        $data['sex'] = $this->input->post('sex');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');

        $this->db->where('librarian_id', $param2);
        $this->db->update('librarian', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/librarian_image/' . $param2 . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/librarian/', 'refresh');
    } else if ($param1 == 'personal_profile') {
        $page_data['personal_profile'] = true;
        $page_data['current_librarian_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('librarian', array(
                    'librarian_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('librarian_id', $param2);
        $this->db->delete('librarian');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/librarian/', 'refresh');
    }
    $page_data['librarians'] = $this->db->get('librarian')->result_array();
    $page_data['page_name'] = 'librarian';
    $page_data['page_title'] = get_phrase('manage_librarian');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE BANNER **** */

function banar($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['b_text_one'] = $this->input->post('b_text_one');
        $data['b_text_two'] = $this->input->post('b_text_two');
		$data['file_name'] = $_FILES["file_name"]["name"];

        $this->db->insert('banar', $data);
        $banar_id = $this->db->insert_id();
		move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/banner_image/" . $_FILES["file_name"]["name"]);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/banar', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['b_text_one'] = $this->input->post('b_text_one');
        $data['b_text_two'] = $this->input->post('b_text_two');
		$data['file_name'] = $_FILES["file_name"]["name"];


        $this->db->where('banar_id', $param2);
        $this->db->update('banar', $data);
		move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/banner_image/" . $_FILES["file_name"]["name"]);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/banar', 'refresh');
    } else if ($param1 == 'personal_profile') {
        $page_data['personal_profile'] = true;
        $page_data['current_banar_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('banar', array(
                    'banar_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('banar_id', $param2);
        $this->db->delete('banar');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/banar', 'refresh');
    }
    $page_data['banars'] = $this->db->get('banar')->result_array();
    $page_data['page_name'] = 'banar';
    $page_data['page_title'] = get_phrase('manage_banar');
    $this->load->view('backend/index', $page_data);
}


/* * **MANAGE GALLERY **** */

function gallery($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['title'] = $this->input->post('title');
        $data['content'] = $this->input->post('content');
		$data['file_name'] = $_FILES["file_name"]["name"];
        $data['date'] = $this->input->post('date');

        $this->db->insert('gallery', $data);
        $gallery_id = $this->db->insert_id();
		move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/gallery_image/" . $_FILES["file_name"]["name"]);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/gallery', 'refresh');
    }
    if ($param1 == 'do_update') {
         $data['title'] = $this->input->post('title');
        $data['content'] = $this->input->post('content');
		$data['file_name'] = $_FILES["file_name"]["name"];
		$data['date'] = $this->input->post('date');

        $this->db->where('gallery_id', $param2);
        $this->db->update('gallery', $data);
		move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/gallery_image/" . $_FILES["file_name"]["name"]);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/gallery', 'refresh');
    } else if ($param1 == 'personal_profile') {
        $page_data['personal_profile'] = true;
        $page_data['current_gallery_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('gallery', array(
                    'gallery_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('gallery_id', $param2);
        $this->db->delete('gallery');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/gallery', 'refresh');
    }
    $page_data['gallerys'] = $this->db->get('gallery')->result_array();
    $page_data['page_name'] = 'gallery';
    $page_data['page_title'] = get_phrase('manage_gallery');
    $this->load->view('backend/index', $page_data);
}


// ACADEMIC SYLLABUS
function academic_syllabus($class_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    // detect the first class
    if ($class_id == '')
        $class_id = $this->db->get('class')->first_row()->class_id;

    $page_data['page_name'] = 'academic_syllabus';
    $page_data['page_title'] = get_phrase('academic_syllabus');
    $page_data['class_id'] = $class_id;
    $this->load->view('backend/index', $page_data);
}

function upload_academic_syllabus() {
    $data['academic_syllabus_code'] = substr(md5(rand(0, 1000000)), 0, 7);
    $data['title'] = $this->input->post('title');
    $data['description'] = $this->input->post('description');
    $data['class_id'] = $this->input->post('class_id');
    $data['subject_id'] = $this->input->post('subject_id');
    $data['uploader_type'] = $this->session->userdata('login_type');
    $data['uploader_id'] = $this->session->userdata('login_user_id');
    $data['session'] = $this->db->get_where('settings', array('type' => 'session'))->row()->description;
    $data['timestamp'] = strtotime(date("Y-m-d H:i:s"));
    //uploading file using codeigniter upload library
    $files = $_FILES['file_name'];
    $this->load->library('upload');
    $config['upload_path'] = 'uploads/syllabus/';
    $config['allowed_types'] = '*';
    $_FILES['file_name']['name'] = $files['name'];
    $_FILES['file_name']['type'] = $files['type'];
    $_FILES['file_name']['tmp_name'] = $files['tmp_name'];
    $_FILES['file_name']['size'] = $files['size'];
    $this->upload->initialize($config);
    $this->upload->do_upload('file_name');

    $data['file_name'] = $_FILES['file_name']['name'];

    $this->db->insert('academic_syllabus', $data);
    $this->session->set_flashdata('flash_message', get_phrase('syllabus_uploaded'));
    redirect(base_url() . 'index.php?admin/academic_syllabus/' . $data['class_id'], 'refresh');
}

function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('academic_syllabus');
    $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
    redirect(base_url() . 'index.php?admin/academic_syllabus', 'refresh');
}

function download_academic_syllabus($academic_syllabus_code) {
    $file_name = $this->db->get_where('academic_syllabus', array(
                'academic_syllabus_code' => $academic_syllabus_code
            ))->row()->file_name;
    $this->load->helper('download');
    $data = file_get_contents("uploads/syllabus/" . $file_name);
    $name = $file_name;

    force_download($name, $data);
}

/* * **MANAGE ACCOUNTANT**** */

function accountant($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['birthday'] = $this->input->post('birthday');
        $data['sex'] = $this->input->post('sex');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $this->db->insert('accountant', $data);
        $accountant_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/accountant_image/' . $accountant_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        $this->email_model->account_opening_email('accountant', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'index.php?admin/accountant/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['birthday'] = $this->input->post('birthday');
        $data['sex'] = $this->input->post('sex');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');

        $this->db->where('accountant_id', $param2);
        $this->db->update('accountant', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/accountant_image/' . $param2 . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/accountant/', 'refresh');
    } else if ($param1 == 'personal_profile') {
        $page_data['personal_profile'] = true;
        $page_data['current_accountant_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('accountant', array(
                    'accountant_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('accountant_id', $param2);
        $this->db->delete('accountant');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/accountant/', 'refresh');
    }
    $page_data['accountants'] = $this->db->get('accountant')->result_array();
    $page_data['page_name'] = 'accountant';
    $page_data['page_title'] = get_phrase('manage_accountant');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE HOSTEL**** */

function hostel($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['birthday'] = $this->input->post('birthday');
        $data['sex'] = $this->input->post('sex');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $this->db->insert('hostel', $data);
        $hostel_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hostel_image/' . $hostel_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        $this->email_model->account_opening_email('hostel', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'index.php?admin/hostel/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['birthday'] = $this->input->post('birthday');
        $data['sex'] = $this->input->post('sex');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');

        $this->db->where('hostel_id', $param2);
        $this->db->update('hostel', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hostel_image/' . $param2 . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/hostel/', 'refresh');
    } else if ($param1 == 'personal_profile') {
        $page_data['personal_profile'] = true;
        $page_data['current_hostel_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('hostel', array(
                    'hostel_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('hostel_id', $param2);
        $this->db->delete('hostel');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/hostel/', 'refresh');
    }
    $page_data['hostels'] = $this->db->get('hostel')->result_array();
    $page_data['page_name'] = 'hostel';
    $page_data['page_title'] = get_phrase('manage_hostel');
    $this->load->view('backend/index', $page_data);
}


/**Subject templates**/


function subject_template($param1 = '', $param2 = '', $param3 = '') {
	if ($this->session->userdata('admin_login') != 1){
        redirect(base_url(), 'refresh');
	}
    if ($param1 == 'create') {
		$data['Subject_id'] = $this->input->post('subject_id');
        $data['Template_name'] = $this->input->post('template_name');
        $this->db->insert('subject_template', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/subject_template/', 'refresh');
    }
    if ($param1 == 'do_update') {
		
		$data['Subject_id'] = $this->input->post('subject_id');
        $data['Template_name'] = $this->input->post('template_name');
        $this->db->where('Subject_id', $param2);
        $this->db->update('subject_template', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/subject_template/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('subject_template', array(
                    'Subject_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('Subject_id', $param2);
        $this->db->delete('subject_template');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/subject_template/' . $param3, 'refresh');
    }
    $page_data['Subject_id'] = $param1;
    $page_data['subjects'] = $this->db->get('subject_template')->result_array();//$this->db->get_where('subject_template', array('Subject_id' => $param1))->result_array();
    $page_data['page_name'] = 'subject_template';
    $page_data['page_title'] = get_phrase('manage_subject');
    $this->load->view('backend/index', $page_data);
	
}


/* * **MANAGE SUBJECTS**** */

function subject($param1 = '', $param2 = '', $param3 = '') {
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        //$data['class_id'] = $this->input->post('class_id');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $this->db->insert('subject', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/subject/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
       // $data['class_id'] = $this->input->post('class_id');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $dataa['teacher_id'] = $this->input->post('teacher_id');

        $this->db->where('subject_id', $param2);
        $this->db->update('subject', $data);

        $this->db->where('subject_id', $param2);
        $this->db->update('class_subject', $dataa);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/subject/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('subject', array(
                    'subject_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('subject_id', $param2);
        $this->db->delete('subject');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/subject/' . $param3, 'refresh');
    }
    $page_data['class_id'] = $param1;
    $page_data['subjects'] = $this->db->get_where('subject', array('class_id' => $param1))->result_array();
    $page_data['page_name'] = 'subject';
    $page_data['page_title'] = get_phrase('manage_subject');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE CLASSES SUBJECTS**** */
function class_subject($class_id = ''){
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($this->input->post('operation') == 'selection'){
		$page_data['class_id'] = $this->input->post('class_id');
		if ($page_data['class_id'] > 0 ) {
			redirect(base_url() . 'index.php?admin/class_subject/' . $page_data['class_id'], 'refresh');
		}else {
			$this->session->set_flashdata('info', 'please_select_class');
			redirect(base_url() . 'index.php?admin/class_subject/', 'refresh');
		}
	}    
	 if ($class_id == 'create') {
       
        $class_sub = $this->input->post('subject_ids');
        foreach($class_sub as $subject_ids){
			$subjects_res=$this->db->get_where('class_subject', array('class_id' => $this->input->post('class_ids'),'subject_id'=>$subject_ids))->result_array();
			if(count($subjects_res) ==0){
                $subject = $this->db->get('subject',array('subject_id' => $subject_ids))->result_array();
				$data['class_id'] = $this->input->post('class_ids');
                $data['subject_id'] = $subject_ids;
                $data['teacher_id'] = $subject[0]['teacher_id'];
				$this->db->insert('class_subject', $data);
			}
		}
        
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/class_subject/', 'refresh');
    }
    $page_data['class_id'] = $class_id;
	$page_data['classes'] = $this->db->get('class')->result_array();
    $page_data['page_name'] = 'class_subject';
    $page_data['page_title'] = get_phrase('manage_subject');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE STUDENTS SUBJECTS**** */
function student_subject($class_id = ''){
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($this->input->post('operation') == 'selection'){
		$page_data['class_id'] = $this->input->post('class_id');
		if ($page_data['class_id'] > 0 ) {
			redirect(base_url() . 'index.php?admin/student_subject/' . $page_data['class_id'], 'refresh');
		}else {
			$this->session->set_flashdata('info', 'please_select_student');
			redirect(base_url() . 'index.php?admin/student_subject/', 'refresh');
		}
	}    
	 if ($class_id == 'create') {
        
        $class_stu = $this->input->post('student_ids');
        foreach($class_stu as $student_ids){
            $class_sub = $this->input->post('subject_ids');
            $b = 0;
            foreach($class_sub as $subject_ids){
                $subjects_res=$this->db->get_where('class_subject', array('class_id' => $this->input->post('class_ids'),
                                                                            'student_id' => $student_ids,
                                                                            'subject_id'=>$subject_ids))->result_array();
		    	if(count($subjects_res) ==0){
                    $subject = $this->db->get_where('subject',array('subject_id' => $subject_ids))->result_array();
		    		$data['class_id'] = $this->input->post('class_ids');
                    $data['subject_id'] = $subject_ids;
                    $data['student_id'] = $student_ids;
                    $data['teacher_id'] = $subject[0]['teacher_id'];
		    		$this->db->insert('class_subject', $data);
		    	}$b++;
            }
        }
        
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/student_subject/', 'refresh');
    }
    $page_data['class_id'] = $class_id;
	$page_data['classes'] = $this->db->get('class')->result_array();
    $page_data['page_name'] = 'student_subject';
    $page_data['page_title'] = get_phrase('manage_student_subject');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE NURSERY SUBJECTS**** */
//nursery 1
function nursery_subject($param1 = '', $param2 = '', $param3 = '') {
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');
        $this->db->insert('nursery_subject', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/nursery_subject/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');

        $this->db->where('nursub_id', $param2);
        $this->db->update('nursery_subject', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/nursery_subject/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('nursery_subject', array(
                    'nursub_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('nursub_id', $param2);
        $this->db->delete('nursery_subject');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/nursery_subject/' . $param3, 'refresh');
    }
    $page_data['nursub_id'] = $param1;
    $page_data['subjects'] = $this->db->get_where('nursery_subject', array('nursub_id' => $param1))->result_array();
    $page_data['page_name'] = 'nursery_subject';
    $page_data['page_title'] = get_phrase('nursery_1_subject');
    $this->load->view('backend/index', $page_data);
}

//nursery 1 term 2
function nursery_subject_2($param1 = '', $param2 = '', $param3 = '') {
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');
        $this->db->insert('nursery_subject_2', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/nursery_subject_2/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');

        $this->db->where('nursub_id', $param2);
        $this->db->update('nursery_subject_2', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/nursery_subject_2/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('nursery_subject_2', array(
                    'nursub_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('nursub_id', $param2);
        $this->db->delete('nursery_subject_2');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/nursery_subject_2/' . $param3, 'refresh');
    }
    $page_data['nursub_id'] = $param1;
    $page_data['subjects'] = $this->db->get_where('nursery_subject_2', array('nursub_id' => $param1))->result_array();
    $page_data['page_name'] = 'nursery_subject_2';
    $page_data['page_title'] = get_phrase('nursery_1_subject');
    $this->load->view('backend/index', $page_data);
}

//nursery 2
function nursery_subject1($param1 = '', $param2 = '', $param3 = '') {
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');
        $this->db->insert('nursery_subject1', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/nursery_subject1/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');

        $this->db->where('nursub_id', $param2);
        $this->db->update('nursery_subject1', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/nursery_subject1/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('nursery_subject1', array(
                    'nursub_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('nursub_id', $param2);
        $this->db->delete('nursery_subject1');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/nursery_subject1/' . $param3, 'refresh');
    }
    $page_data['nursub_id'] = $param1;
    $page_data['subjects'] = $this->db->get_where('nursery_subject1', array('nursub_id' => $param1))->result_array();
    $page_data['page_name'] = 'nursery_subject1';
    $page_data['page_title'] = get_phrase('nursery_2_subject');
    $this->load->view('backend/index', $page_data);
}

//nursery 2 term 2
function nursery_subject1_2($param1 = '', $param2 = '', $param3 = '') {
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');
        $this->db->insert('nursery_subject1_2', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/nursery_subject1_2/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');

        $this->db->where('nursub_id', $param2);
        $this->db->update('nursery_subject1_2', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/nursery_subject1_2/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('nursery_subject1_2', array(
                    'nursub_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('nursub_id', $param2);
        $this->db->delete('nursery_subject1_2');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/nursery_subject1_2/' . $param3, 'refresh');
    }
    $page_data['nursub_id'] = $param1;
    $page_data['subjects'] = $this->db->get_where('nursery_subject1_2', array('nursub_id' => $param1))->result_array();
    $page_data['page_name'] = 'nursery_subject1_2';
    $page_data['page_title'] = get_phrase('nursery_2_subject');
    $this->load->view('backend/index', $page_data);
}

//nursery 3
function nursery_subject2($param1 = '', $param2 = '', $param3 = '') {
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');
        $this->db->insert('nursery_subject2', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/nursery_subject2/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');

        $this->db->where('nursub_id', $param2);
        $this->db->update('nursery_subject2', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/nursery_subject2/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('nursery_subject2', array(
                    'nursub_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('nursub_id', $param2);
        $this->db->delete('nursery_subject2');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/nursery_subject2/' . $param3, 'refresh');
    }
    $page_data['nursub_id'] = $param1;
    $page_data['subjects'] = $this->db->get_where('nursery_subject2', array('nursub_id' => $param1))->result_array();
    $page_data['page_name'] = 'nursery_subject2';
    $page_data['page_title'] = get_phrase('nursery_3_subject');
    $this->load->view('backend/index', $page_data);
}

//nursery 3 term 2
function nursery_subject2_2($param1 = '', $param2 = '', $param3 = '') {
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');
        $this->db->insert('nursery_subject2_2', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/nursery_subject2_2/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');

        $this->db->where('nursub_id', $param2);
        $this->db->update('nursery_subject2_2', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/nursery_subject2_2/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('nursery_subject2_2', array(
                    'nursub_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('nursub_id', $param2);
        $this->db->delete('nursery_subject2_2');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/nursery_subject2_2/' . $param3, 'refresh');
    }
    $page_data['nursub_id'] = $param1;
    $page_data['subjects'] = $this->db->get_where('nursery_subject2_2', array('nursub_id' => $param1))->result_array();
    $page_data['page_name'] = 'nursery_subject2_2';
    $page_data['page_title'] = get_phrase('nursery_3_subject');
    $this->load->view('backend/index', $page_data);
}

//toddler
function nursery_subject3($param1 = '', $param2 = '', $param3 = '') {
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
   
    if ($param1 == 'create') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');
        $this->db->insert('nursery_subject3', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/nursery_subject3/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');

        $this->db->where('nursub_id', $param2);
        $this->db->update('nursery_subject3', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/nursery_subject3/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('nursery_subject3', array(
                    'nursub_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('nursub_id', $param2);
        $this->db->delete('nursery_subject3');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/nursery_subject3/' . $param3, 'refresh');
    }
    $page_data['nursub_id'] = $param1;
    //$page_data['exam_id'] = $this->input->post('exam_id');
    $page_data['subjects'] = $this->db->get_where('nursery_subject3', array('nursub_id' => $param1))->result_array();
    $page_data['page_name'] = 'nursery_subject3';
    $page_data['page_title'] = get_phrase('toddler');
    $this->load->view('backend/index', $page_data);
}

//toddler term 2
function nursery_subject3_2($param1 = '', $param2 = '', $param3 = '') {
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
   
    if ($param1 == 'create') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');
        $this->db->insert('nursery_subject3_2', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/nursery_subject3_2/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['language'] = $this->input->post('language');
        $data['social'] = $this->input->post('social');
        $data['knowledge'] = $this->input->post('knowledge');

        $this->db->where('nursub_id', $param2);
        $this->db->update('nursery_subject3_2', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/nursery_subject3_2/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('nursery_subject3_2', array(
                    'nursub_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('nursub_id', $param2);
        $this->db->delete('nursery_subject3_2');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/nursery_subject3_2/' . $param3, 'refresh');
    }
    $page_data['nursub_id'] = $param1;
    //$page_data['exam_id'] = $this->input->post('exam_id');
    $page_data['subjects'] = $this->db->get_where('nursery_subject3_2', array('nursub_id' => $param1))->result_array();
    $page_data['page_name'] = 'nursery_subject3_2';
    $page_data['page_title'] = get_phrase('toddler');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE CLASSES**** */

function classes($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['name_numeric'] = $this->input->post('name_numeric');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $this->db->insert('class', $data);
        if($this->session->userdata('redir_page')){
			$this->session->set_userdata(array('rdirect' =>'yes' ));
		}
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/classes/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['name_numeric'] = $this->input->post('name_numeric');
        $data['teacher_id'] = $this->input->post('teacher_id');

        $this->db->where('class_id', $param2);
        $this->db->update('class', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/classes/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('class', array(
                    'class_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('class_id', $param2);
        $this->db->delete('class');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/classes/', 'refresh');
    }
    if($param1 == 'student_add'){
		$this->session->set_userdata(array('redir_page' =>$param1 ));
	}
    $page_data['classes'] = $this->db->get('class')->result_array();
    $page_data['page_name'] = 'class';
    $page_data['page_title'] = get_phrase('manage_class');
    $this->load->view('backend/index', $page_data);
     if($this->session->userdata('rdirect') =='yes'){
		redirect(base_url() . 'index.php?admin/'.$this->session->userdata('redir_page'), 'refresh');
	}
}

/* * **MODIFY SUBJECTS**** */

function modify_subject($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '') {
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($param1 == 'display') {
        $page_data['class_id'] = $this->input->post('class_id');
        $page_data['student_id'] = $this->input->post('student_id');
        if ($page_data['class_id'] > 0 && $page_data['student_id'] > 0) {
            redirect(base_url() . 'index.php?admin/modify_subject/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
        } else {
            redirect(base_url() . 'index.php?admin/modify_subject/', 'refresh');
        }
    }
    

    if ($param1 == 'do_update') {
        //$data['subject_id'] = $param2;
        $data['subject_id'] = $this->input->post('sub_id');
        $teac_id = $this->db->get_where('subject', array('subject_id' => $this->input->post('sub_id')))->result_array();
        $data['teacher_id'] = $teac_id[0]['teacher_id'];
        

        $this->db->where('subject_id', $param2);
        $this->db->where('class_id', $this->input->post('class_ids'));
        $this->db->update('class_subject', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/modify_subject/' . $param3 . '/' . $param4, 'refresh');;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('class_subject', array(
                    'subject_id' => $param2
                ))->result_array();}

    if ($param1 == 'delete') {
        $this->db->where('class_id', $param3);
        $this->db->where('student_id', $param4);
        $this->db->where('subject_id', $param2);
        $this->db->delete('class_subject');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/modify_subject/' . $param3 . '/' . $param4, 'refresh');
    }
    $page_data['class_id'] = $param1;
    $page_data['student_id'] = $param2;
    $page_data['page_name'] = 'modify_subject';
    $page_data['page_title'] = get_phrase('modify_subject');
    $this->load->view('backend/index', $page_data);
}

function modify_subject_jss($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '') {
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($param1 == 'display') {
        $page_data['class_id'] = $this->input->post('class_id');
        if ($page_data['class_id'] > 0) {
            redirect(base_url() . 'index.php?admin/modify_subject_jss/' . $page_data['class_id'], 'refresh');
        } else {
            redirect(base_url() . 'index.php?admin/modify_subject_jss/', 'refresh');
        }
    }
    

    if ($param1 == 'do_update') {
        //$data['subject_id'] = $param2;
        $data['subject_id'] = $this->input->post('sub_id');
        $teac_id = $this->db->get_where('subject', array('subject_id' => $this->input->post('sub_id')))->result_array();
        $data['teacher_id'] = $teac_id[0]['teacher_id'];
        

        $this->db->where('subject_id', $param2);
        $this->db->where('class_id', $this->input->post('class_ids'));
        $this->db->update('class_subject', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/modify_subject_jss/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('class_subject', array(
                    'subject_id' => $param2
                ))->result_array();}

    if ($param1 == 'delete') {
        $this->db->where('class_id', $param3);
        $this->db->where('subject_id', $param2);
        $this->db->delete('class_subject');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/modify_subject_jss/' . $param3 . '/' . $param2, 'refresh');
    }
    $page_data['class_id'] = $param1;
    $page_data['student_id'] = $param2;
    $page_data['page_name'] = 'modify_subject_jss';
    $page_data['page_title'] = get_phrase('modify_subject_jss');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE SESSION HERE **** */

function session($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $this->db->insert('session', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/session', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');

        $this->db->where('session_id', $param2);
        $this->db->update('session', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/session', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('session', array(
                    'session_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('session_id', $param2);
        $this->db->delete('session');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/session', 'refresh');
    }
    $page_data['sessions'] = $this->db->get('session')->result_array();
    $page_data['page_name'] = 'session';
    $page_data['page_title'] = get_phrase('manage_session');
    $this->load->view('backend/index', $page_data);
}



/* * **MANAGE HELPFUL LINK**** */

function help_link($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {

        $data['title'] = $this->input->post('title');
        $data['link'] = $this->input->post('link');
		$data['class_id'] 		= $this->input->post('class_id');
		
        $this->db->insert('help_link', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/help_link', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['title'] = $this->input->post('title');
        $data['link'] = $this->input->post('link');
		$data['class_id'] 		= $this->input->post('class_id');

        $this->db->where('helplink_id', $param2);
        $this->db->update('help_link', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/help_link', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('help_link', array(
                    'helplink_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('helplink_id', $param2);
        $this->db->delete('help_link');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/help_link', 'refresh');
    }
    $page_data['help_links'] = $this->db->get('help_link')->result_array();
    $page_data['page_name'] = 'help_link';
    $page_data['page_title'] = get_phrase('manage_help_link');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE CLUB**** */

function club($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {

        $data['club_name'] = $this->input->post('club_name');
        $data['desc'] = $this->input->post('desc');

        $this->db->insert('club', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/club', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['club_name'] = $this->input->post('club_name');
        $data['desc'] = $this->input->post('desc');

        $this->db->where('club_id', $param2);
        $this->db->update('club', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/club', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('club', array(
                    'club_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('club_id', $param2);
        $this->db->delete('club');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/club', 'refresh');
    }
    $page_data['club'] = $this->db->get('club')->result_array();
    $page_data['page_name'] = 'club';
    $page_data['page_title'] = get_phrase('manage_club');
    $this->load->view('backend/index', $page_data);
}


/* * **MANAGE TESTIMONY**** */

function testimony($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {

        $data['name'] = $this->input->post('name');
        $data['position'] = $this->input->post('position');
        $data['content'] = $this->input->post('content');

        $this->db->insert('testimony', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/testimony', 'refresh');
    }
    if ($param1 == 'do_update') {
	
        $data['name'] = $this->input->post('name');
        $data['position'] = $this->input->post('position');
        $data['content'] = $this->input->post('content');

        $this->db->where('testimony_id', $param2);
        $this->db->update('testimony', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/testimony', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('testimony', array(
                    'testimony_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('testimony_id', $param2);
        $this->db->delete('testimony');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/testimony', 'refresh');
    }
    $page_data['testimony'] = $this->db->get('testimony')->result_array();
    $page_data['page_name'] = 'testimony';
    $page_data['page_title'] = get_phrase('manage_testimony');
    $this->load->view('backend/index', $page_data);
}



/* * **MANAGE HELP DESK**** */

function help_desk($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {

        $data['name'] = $this->input->post('name');
        $data['purpose'] = $this->input->post('purpose');
        $data['content'] = $this->input->post('content');

        $this->db->insert('help_desk', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/help_desk', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['purpose'] = $this->input->post('purpose');
        $data['content'] = $this->input->post('content');

        $this->db->where('helpdesk_id', $param2);
        $this->db->update('help_desk', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/help_desk', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('help_desk', array(
                    'helpdesk_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('helpdesk_id', $param2);
        $this->db->delete('help_desk');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/help_desk', 'refresh');
    }
    $page_data['help_desk'] = $this->db->get('help_desk')->result_array();
    $page_data['page_name'] = 'help_desk';
    $page_data['page_title'] = get_phrase('manage_help_desk');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE HOLIDAY**** */

function holiday($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {

        $data['title'] = $this->input->post('title');
        $data['holiday'] = $this->input->post('holiday');
        $data['date'] = $this->input->post('date');

        $this->db->insert('holiday', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/holiday', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['title'] = $this->input->post('title');
        $data['holiday'] = $this->input->post('holiday');
        $data['date'] = $this->input->post('date');

        $this->db->where('holiday_id', $param2);
        $this->db->update('holiday', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/holiday', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('holiday', array(
                    'holiday_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('holiday_id', $param2);
        $this->db->delete('holiday');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/holiday', 'refresh');
    }
    $page_data['holiday'] = $this->db->get('holiday')->result_array();
    $page_data['page_name'] = 'holiday';
    $page_data['page_title'] = get_phrase('manage_holiday');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE circular**** */

function circular($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {

        $data['subject'] = $this->input->post('subject');
        $data['ref'] = $this->input->post('ref');
        $data['content'] = $this->input->post('content');
        $data['date'] = $this->input->post('date');

        $this->db->insert('circular', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/circular', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['subject'] = $this->input->post('subject');
        $data['ref'] = $this->input->post('ref');
        $data['content'] = $this->input->post('content');
        $data['date'] = $this->input->post('date');

        $this->db->where('circular_id', $param2);
        $this->db->update('circular', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/circular', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('circular', array(
                    'circular_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('circular_id', $param2);
        $this->db->delete('circular');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/circular', 'refresh');
    }
    $page_data['circular'] = $this->db->get('circular')->result_array();
    $page_data['page_name'] = 'circular';
    $page_data['page_title'] = get_phrase('manage_circular');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE TASK MANAGER**** */

function task_manager($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {

        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $data['priority'] = $this->input->post('priority');
        $data['date'] = $this->input->post('date');
        $data['user'] = $this->input->post('user');
        $data['status'] = $this->input->post('status');

        $this->db->insert('task_manager', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/task_manager', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $data['priority'] = $this->input->post('priority');
        $data['date'] = $this->input->post('date');
        $data['user'] = $this->input->post('user');
        $data['status'] = $this->input->post('status');

        $this->db->where('task_manager_id', $param2);
        $this->db->update('task_manager', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/task_manager', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('task_manager', array(
                    'task_manager_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('task_manager_id', $param2);
        $this->db->delete('task_manager');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/task_manager', 'refresh');
    }
    $page_data['task_managers'] = $this->db->get('task_manager')->result_array();
    $page_data['page_name'] = 'task_manager';
    $page_data['page_title'] = get_phrase('manage_task_manager');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE TODAY'S THOUGHT**** */

function todays_thought($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {

        $data['thought'] = $this->input->post('thought');


        $this->db->insert('todays_thought', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/todays_thought', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['thought'] = $this->input->post('thought');

        $this->db->where('tthought_id', $param2);
        $this->db->update('todays_thought', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/todays_thought', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('tthought_id', array(
                    'tthought_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('tthought_id', $param2);
        $this->db->delete('todays_thought');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/todays_thought', 'refresh');
    }
    $page_data['todays_thought'] = $this->db->get('todays_thought')->result_array();
    $page_data['page_name'] = 'todays_thought';
    $page_data['page_title'] = get_phrase('manage_todays_thought');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE ENQUIRY SETTINGS**** */

function enquiry_setting($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['category'] = $this->input->post('category');
        $data['purpose'] = $this->input->post('purpose');
        $data['whom'] = $this->input->post('whom');
        $this->db->insert('enquiry_category', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/enquiry_setting/', 'refresh');
    }

    if ($param1 == 'do_update') {
        $data['category'] = $this->input->post('category');
        $data['purpose'] = $this->input->post('purpose');
        $data['whom'] = $this->input->post('whom');

        $this->db->where('enquirycat_id', $param2);
        $this->db->update('enquiry_category', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/enquiry_setting/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('enquiry_category', array(
                    'class_id' => $param2
                ))->result_array();
    }


    if ($param1 == 'delete') {
        $this->db->where('enquirycat_id', $param2);
        $this->db->delete('enquiry_category');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/enquiry_setting/', 'refresh');
    }
    $page_data['enquiry_setting'] = $this->db->get('enquiry_category')->result_array();
    $page_data['page_name'] = 'enquiry_setting';
    $page_data['page_title'] = get_phrase('manage_enquiry_category');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE ALL ENQUIRY SETTINGS**** */

function enquiry($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['category'] = $this->input->post('category');
        $data['mobile'] = $this->input->post('mobile');
        $data['purpose'] = $this->input->post('purpose');
        $data['name'] = $this->input->post('name');
        $data['whom'] = $this->input->post('whom');
        $this->db->insert('enquiry', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/enquiry/', 'refresh');
    }

    if ($param1 == 'do_update') {
        $data['category'] = $this->input->post('category');
        $data['mobile'] = $this->input->post('mobile');
        $data['purpose'] = $this->input->post('purpose');
        $data['name'] = $this->input->post('name');
        $data['whom'] = $this->input->post('whom');

        $this->db->where('enquiry_id', $param2);
        $this->db->update('enquiry', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/enquiry/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('enquiry', array(
                    'enquiry_id' => $param2
                ))->result_array();
    }

    if ($param1 == 'delete') {
        $this->db->where('enquiry_id', $param2);
        $this->db->delete('enquiry');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/enquiry/', 'refresh');
    }
    $page_data['enquiry_setting'] = $this->db->get('enquiry')->result_array();
    $page_data['page_name'] = 'enquiry';
    $page_data['page_title'] = get_phrase('manage_enquiries');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE SECTIONS**** */

function section($class_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    // detect the first class
    if ($class_id == '')
        $class_id = $this->db->get('class')->first_row()->class_id;
	if($class_id == 'student_add'){
		$this->session->set_userdata(array('redir_page' =>$class_id ));
	}
    $page_data['page_name'] = 'section';
    $page_data['page_title'] = get_phrase('manage_sections');
    $page_data['class_id'] = $class_id;
    $this->load->view('backend/index', $page_data);
    if($this->session->userdata('rdirect') =='yes'){
		redirect(base_url() . 'index.php?admin/'.$this->session->userdata('redir_page'), 'refresh');
	}
}

function sections($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['nick_name'] = $this->input->post('nick_name');
        $data['class_id'] = $this->input->post('class_id');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $this->db->insert('section', $data);
        if($this->session->userdata('redir_page')){
			$this->session->set_userdata(array('rdirect' =>'yes' ));
		}
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/section/' . $data['class_id'], 'refresh');
    }

    if ($param1 == 'edit') {
        $data['name'] = $this->input->post('name');
        $data['nick_name'] = $this->input->post('nick_name');
        $data['class_id'] = $this->input->post('class_id');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $this->db->where('section_id', $param2);
        $this->db->update('section', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/section/' . $data['class_id'], 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('section_id', $param2);
        $this->db->delete('section');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/section', 'refresh');
    }
}

function get_class_section($class_id) {
    $sections = $this->db->get_where('section', array(
                'class_id' => $class_id
            ))->result_array();
    foreach ($sections as $row) {
        echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
    }
}

function get_class_subject($class_id) {
    $subjects = $this->db->get_where('subject', array(
                'class_id' => $class_id
            ))->result_array();
    foreach ($subjects as $row) {
        echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
    }
}

function get_class_students($class_id) {
    $students = $this->db->get_where('student', array(
                'class_id' => $class_id
            ))->result_array();
    foreach ($students as $row) {
        echo '<option value="' . $row['student_id'] . '">' . $row['name'] .' '.$row['surname']. '</option>';
    }
}

function get_class_students_mass($class_id) {
    $students = $this->db->get_where('student', array(
                'class_id' => $class_id
            ))->result_array();
    echo '<div class="form-group">
                <label class="col-sm-3 control-label">' . get_phrase('students') . '</label>
                <div class="col-sm-9">';
    foreach ($students as $row) {
        echo '<div class="checkbox">
                    <label><input type="checkbox" class="check" name="student_id[]" value="' . $row['student_id'] . '">' . $row['name'] . '</label>
                </div>';
    }
    echo '<br><button type="button" class="btn btn-default" onClick="select()">' . get_phrase('select_all') . '</button>';
    echo '<button style="margin-left: 5px;" type="button" class="btn btn-default" onClick="unselect()"> ' . get_phrase('select_none') . ' </button>';
    echo '</div></div>';
}

/* * *******MANAGE STUDY MATERIAL*********** */

function study_material($task = "", $document_id = "") {
    if ($this->session->userdata('admin_login') != 1) {
        $this->session->set_userdata('last_page', current_url());
        redirect(base_url(), 'refresh');
    }

    if ($task == "create") {
        $this->crud_model->save_study_material_info();
        $this->session->set_flashdata('flash_message', get_phrase('study_material_info_saved_successfuly'));
        redirect(base_url() . 'index.php?admin/study_material', 'refresh');
    }

    if ($task == "update") {
        $this->crud_model->update_study_material_info($document_id);
        $this->session->set_flashdata('flash_message', get_phrase('study_material_info_updated_successfuly'));
        redirect(base_url() . 'index.php?admin/study_material', 'refresh');
    }

    if ($task == "delete") {
        $this->crud_model->delete_study_material_info($document_id);
        redirect(base_url() . 'index.php?admin/study_material');
    }

    $data['study_material_info'] = $this->crud_model->select_study_material_info();
    $data['page_name'] = 'study_material';
    $data['page_title'] = get_phrase('study_material');
    $this->load->view('backend/index', $data);
}

/* * **MANAGE EXAMS**** */

function exam($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['date'] = $this->input->post('date');
        $data['comment'] = $this->input->post('comment');
        $this->db->insert('exam', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/exam/', 'refresh');
    }
    if ($param1 == 'edit' && $param2 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['date'] = $this->input->post('date');
        $data['comment'] = $this->input->post('comment');

        $this->db->where('exam_id', $param3);
        $this->db->update('exam', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/exam/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('exam', array(
                    'exam_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('exam_id', $param2);
        $this->db->delete('exam');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/exam/', 'refresh');
    }
    $page_data['exams'] = $this->db->get('exam')->result_array();
    $page_data['page_name'] = 'exam';
    $page_data['page_title'] = get_phrase('manage_exam');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE NEWS**** */

function news($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {

        $data['news_title'] = $this->input->post('news_title');
        $data['uploader'] = $this->input->post('uploader');
        $data['date'] = $this->input->post('date');
		$data['short_content'] = $this->input->post('short_content');
        $data['file_name'] = $_FILES["file_name"]["name"];
        $data['news_content'] = $this->input->post('news_content');
        $this->db->insert('news', $data);
        $news_id = $this->db->insert_id();

        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/news_image/" . $_FILES["file_name"]["name"]);
        redirect(base_url() . 'index.php?admin/news', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['news_title'] = $this->input->post('news_title');
        $data['uploader'] = $this->input->post('uploader');
        $data['date'] = $this->input->post('date');
		$data['short_content'] = $this->input->post('short_content');
        $data['news_content'] = $this->input->post('news_content');
		
        $this->db->where('news_id', $param2);
        $this->db->update('news', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/news/' . $data['news_id'], 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('news_id', $param2);
        $this->db->delete('news');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/news', 'refresh');
    }

    $page_data['page_name'] = 'news';
    $page_data['page_title'] = get_phrase('manage_news');
    $page_data['news'] = $this->db->get('news')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGE AASIGNMENTS ****************** */

function assignment($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {

        $data['timestamp'] = $this->input->post('timestamp');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['file_name'] = $_FILES["file_name"]["name"];
        $data['class_id'] = $this->input->post('class_id');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $data['file_type'] = $this->input->post('file_type');
        $this->db->insert('assignment', $data);
        $assignment_id = $this->db->insert_id();

        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/assignment/" . $_FILES["file_name"]["name"]);
        redirect(base_url() . 'index.php?admin/assignment', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['timestamp'] = $this->input->post('timestamp');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['class_id'] = $this->input->post('class_id');
        $data['file_type'] = $this->input->post('file_type');

        $this->db->where('assignment_id', $param2);
        $this->db->update('assignment', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/assignment/' . $data['assignment_id'], 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('assignment_id', $param2);
        $this->db->delete('assignment');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/assignment', 'refresh');
    }

    $page_data['page_name'] = 'assignment';
    $page_data['page_title'] = get_phrase('manage_assignment');
    $page_data['assignments'] = $this->db->get('assignment')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGE AASIGNMENTS ****************** */

function examquestion($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {

        $data['timestamp'] = $this->input->post('timestamp');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['description'] = $this->input->post('description');
        $data['file_name'] = $_FILES["file_name"]["name"];
        $data['class_id'] = $this->input->post('class_id');
        $data['file_type'] = $this->input->post('file_type');
        $data['status'] = $this->input->post('status');
        $this->db->insert('examquestion', $data);
        $examquestion_id = $this->db->insert_id();

        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/examquestion/" . $_FILES["file_name"]["name"]);
        redirect(base_url() . 'index.php?admin/examquestion', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['timestamp'] = $this->input->post('timestamp');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['description'] = $this->input->post('description');
        $data['class_id'] = $this->input->post('class_id');
        $data['status'] = $this->input->post('status');


        $this->db->where('examquestion_id', $param2);
        $this->db->update('examquestion', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/examquestion' . $data['examquestion_id'], 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('examquestion_id', $param2);
        $this->db->delete('examquestion');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/examquestion', 'refresh');
    }

    $page_data['page_name'] = 'examquestion';
    $page_data['page_title'] = get_phrase('manage_exam_questions');
    $page_data['examquestions'] = $this->db->get('examquestion')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGE LOAN ****************** */

function loan_applicant($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {

        $data['staff_name'] = $this->input->post('staff_name');
        $data['name'] = $this->input->post('name');
        $data['amount'] = $this->input->post('amount');
        $data['purpose'] = $this->input->post('purpose');
        $data['l_duration'] = $this->input->post('l_duration');
        $data['file_name'] = $_FILES["file_name"]["name"];

        $data['mop'] = $this->input->post('mop');

        $data['g_name'] = $this->input->post('g_name');
        $data['g_relationship'] = $this->input->post('g_relationship');
        $data['g_number'] = $this->input->post('g_number');

        $data['g_address'] = $this->input->post('g_address');
        $data['g_country'] = $this->input->post('g_country');
        $data['c_name'] = $this->input->post('c_name');

        $data['c_type'] = $this->input->post('c_type');
        $data['model'] = $this->input->post('model');
        $data['make'] = $this->input->post('make');

        $data['serial_number'] = $this->input->post('serial_number');
        $data['value'] = $this->input->post('value');
        $data['condition'] = $this->input->post('condition');
        $data['date'] = $this->input->post('date');
        $data['status'] = $this->input->post('status');

        $this->db->insert('loan', $data);
        $assignment_id = $this->db->insert_id();

        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/loan_applicant/" . $_FILES["file_name"]["name"]);
        $this->session->set_flashdata('flash_message', get_phrase('application_submitted'));
        redirect(base_url() . 'index.php?admin/loan_applicant', 'refresh');
    }
   
    
    $page_data['page_name'] = 'loan_applicant';
    $page_data['page_title'] = get_phrase('add_loan_page');
    $page_data['loan_applicants'] = $this->db->get('loan')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGE LOAN ****************** */

function loan_approval($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
   
    if ($param1 == 'do_update') {

        $data['status'] = $this->input->post('status');

        $this->db->where('loan_id', $param2);
        $this->db->update('loan', $data);
        $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
        redirect(base_url() . 'index.php?admin/loan_approval' . $data['loan_id'], 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('loan_id', $param2);
        $this->db->delete('loan');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/loan_approval', 'refresh');
    }

    $page_data['page_name'] = 'loan_approval';
    $page_data['page_title'] = get_phrase('manage_loan_approval');
    $page_data['loan_approvals'] = $this->db->get('loan')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGING MEDIA HERE****************** */

function media($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {

        $data['timestamp'] = $this->input->post('timestamp');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['file_name'] = $_FILES["file_name"]["name"];
        $data['class_id'] = $this->input->post('class_id');
        $data['file_type'] = $this->input->post('file_type');
        $data['mlink'] = $this->input->post('mlink');
        $this->db->insert('media', $data);
        $media_id = $this->db->insert_id();

        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/media_files/" . $_FILES["file_name"]["name"]);
        redirect(base_url() . 'index.php?admin/media', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['timestamp'] = $this->input->post('timestamp');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['class_id'] = $this->input->post('class_id');
        $data['file_type'] = $this->input->post('file_type');
        $data['mlink'] = $this->input->post('mlink');

        $this->db->where('media_id', $param2);
        $this->db->update('media', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/media/' . $data['media_id'], 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('media_id', $param2);
        $this->db->delete('media');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/media', 'refresh');
    }

    $page_data['page_name'] = 'media';
    $page_data['page_title'] = get_phrase('manage_media');
    $page_data['medias'] = $this->db->get('media')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* * ***FRONT_END ******** */

function front_end($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');

    if ($param1 == 'do_update') {

        $data['description'] = $this->input->post('about_us');
        $this->db->where('type', 'about_us');
        $this->db->update('front_end', $data);

        $data['description'] = $this->input->post('vission');
        $this->db->where('type', 'vission');
        $this->db->update('front_end', $data);

        $data['description'] = $this->input->post('mission');
        $this->db->where('type', 'mission');
        $this->db->update('front_end', $data);

        $data['description'] = $this->input->post('goal');
        $this->db->where('type', 'goal');
        $this->db->update('front_end', $data);

        $data['description'] = $this->input->post('services');
        $this->db->where('type', 'services');
        $this->db->update('front_end', $data);
		
		$data['description'] = $this->input->post('youtube');
        $this->db->where('type', 'youtube');
        $this->db->update('front_end', $data);
		
		$data['description'] = $this->input->post('news');
        $this->db->where('type', 'news');
        $this->db->update('front_end', $data);
		
		$data['description'] = $this->input->post('teacher');
        $this->db->where('type', 'teacher');
        $this->db->update('front_end', $data);
		
		$data['description'] = $this->input->post('event');
        $this->db->where('type', 'event');
        $this->db->update('front_end', $data);
		
		$data['description'] = $this->input->post('testimonies');
        $this->db->where('type', 'testimonies');
        $this->db->update('front_end', $data);
		
		$data['description'] = $this->input->post('map');
        $this->db->where('type', 'map');
        $this->db->update('front_end', $data);
		
		$data['description'] = $this->input->post('facebook');
        $this->db->where('type', 'facebook');
        $this->db->update('front_end', $data);
		
		$data['description'] = $this->input->post('twitter');
        $this->db->where('type', 'twitter');
        $this->db->update('front_end', $data);
		
		$data['description'] = $this->input->post('linkedin');
        $this->db->where('type', 'linkedin');
        $this->db->update('front_end', $data);
		
		$data['description'] = $this->input->post('instagram');
        $this->db->where('type', 'instagram');
        $this->db->update('front_end', $data);
		
		$data['description'] = $this->input->post('full_about');
        $this->db->where('type', 'full_about');
        $this->db->update('front_end', $data);
		
		$data['description'] = $this->input->post('footer_text');
        $this->db->where('type', 'footer_text');
        $this->db->update('front_end', $data);
		
		$data['description'] = $this->input->post('reg');
        $this->db->where('type', 'reg');
        $this->db->update('front_end', $data);

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/front_end/', 'refresh');
    }


    $page_data['page_name'] = 'front_end';
    $page_data['page_title'] = get_phrase('front_ends');
    $page_data['settings'] = $this->db->get('front_end')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* * **** SEND EXAM MARKS VIA SMS ******* */

function exam_marks_sms($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($param1 == 'send_sms') {

        $exam_id = $this->input->post('exam_id');
        $class_id = $this->input->post('class_id');
        $receiver = $this->input->post('receiver');

        // get all the students of the selected class
        $students = $this->db->get_where('student', array(
                    'class_id' => $class_id
                ))->result_array();
        // get the marks of the student for selected exam
        foreach ($students as $row) {
            if ($receiver == 'student')
                $receiver_phone = $row['phone'];
            if ($receiver == 'parent' && $row['parent_id'] != '')
                $receiver_phone = $this->db->get_where('parent', array('parent_id' => $row['parent_id']))->row()->phone;


            $this->db->where('exam_id', $exam_id);
            $this->db->where('student_id', $row['student_id']);
            $marks = $this->db->get('mark')->result_array();
            $message = '';
            foreach ($marks as $row2) {
                $subject = $this->db->get_where('subject', array('subject_id' => $row2['subject_id']))->row()->name;
                $mark_obtained = $row2['mark_obtained'];
                $message .= $row2['student_id'] . $subject . ' : ' . $mark_obtained . ' , ';
            }
            // send sms
            $this->sms_model->send_sms($message, $receiver_phone);
        }
        $this->session->set_flashdata('flash_message', get_phrase('message_sent'));
        redirect(base_url() . 'index.php?admin/exam_marks_sms', 'refresh');
    }

    $page_data['page_name'] = 'exam_marks_sms';
    $page_data['page_title'] = get_phrase('send_marks_by_sms');
    $this->load->view('backend/index', $page_data);
}

 /****MANAGE EXAM MARKS*****/
 
    function nursery_student_question($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'insert') {
            $data['exam_id']    = $this->input->post('exam_id');
            $data['class_id']   = $this->input->post('class_id');
            $data['question']   = $this->input->post('question_text');
            $data['session_year']   = $this->input->post('session_year');
            $data['subject_id']   = $this->input->post('subject_id');
            
            if ($data['exam_id'] > 0 && $data['class_id'] > 0 && $data['subject_id'] > 0) {
				 $this->db->insert('nursery_student_question', $data);
				$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(base_url() . 'index.php?admin/nursery_student_question/', 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?admin/nursery_student_question/', 'refresh');
            }
        }
        if ($this->input->post('operation') == 'update') {
            $data['exam_id']    = $this->input->post('exam_id');
            $data['class_id']   = $this->input->post('class_id');
            $data['question']   = $this->input->post('question_text');
            $data['subject_id']   = $this->input->post('subject_id');
			$question_id = $this->input->post('question_id');
			$this->db->where('question_id', $question_id);
			$this->db->update('nursery_student_question', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/nursery_student_question/', 'refresh');
        }
        if($param1 =='delete'){
			$this->db->where('question_id',$param2);
			$this->db->delete('nursery_student_question');
			$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?admin/nursery_student_question/', 'refresh');
		}
       
		$page_data['page_name'] = 'nursery_student_question';
		$page_data['page_title'] = get_phrase('nursery_student_question');
        $this->load->view('backend/index', $page_data);
    }
 
 // MID TERM
    function marks0($exam_id = '', $class_id = '', $student_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');
            $page_data['student_id'] = $this->input->post('student_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0) {
                redirect(base_url() . 'index.php?admin/marks0/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?admin/marks0/', 'refresh');
            }
        }
        if ($this->input->post('operation') == 'update') {
            $subjects = $this->db->get_where('class_subject' , array('class_id' => $class_id))->result_array();
            $session_year = $this->input->post('session_year');
            $student_id = $this->input->post('student_id');
            $strand = $this->db->get('strand')->result_array();
            $ca1 = $ca2 = $cat = 0;

            foreach($strand as $rows){
                $dataa['ca_1']      = $this->input->post('ca_1s_' . $rows['strand_id']);
                $dataa['ca_2']      = $this->input->post('ca_2s_' . $rows['strand_id']);
                $dataa['ca_marks']      = $this->input->post('ca_markss_' . $rows['strand_id']);

                $ca1 += $this->input->post('ca_1s_' . $rows['strand_id']);
                $ca2 += $this->input->post('ca_2s_' . $rows['strand_id']);
                $cat += $this->input->post('ca_markss_' . $rows['strand_id']);
                  
                $this->db->where('strands_id', $this->input->post('strands_id_' . $rows['strand_id']));
                $this->db->where('session_year', $session_year);
                $this->db->update('strands0', $dataa);
                }

            foreach($subjects as $row) {
				if($this->input->post('class_types') == 'primary'){
					$data['ca_1']      = $this->input->post('ca_1_' . $row['subject_id']);
					$data['ca_2']      = $this->input->post('ca_2_' . $row['subject_id']);
					$data['ca_marks']      = $this->input->post('ca_marks_' . $row['subject_id']);


                    // Comments for primary
                    $data0['TeacherName']  = $this->input->post('TeacherName');
                    $data0['Attendances']  = $this->input->post('Attendances');

                    $this->db->where('class_id', $class_id);
                    $this->db->where('student_id', $student_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('session_year', $session_year);
                    $this->db->update('comments0', $data0);
                    
                }
                if($this->input->post('class_types') != 'nursery 3' && $this->input->post('class_types') != 'nursery 2' 
                    && $this->input->post('class_types') != 'nursery 1' && $this->input->post('class_types') != 'primary' && 
                    $this->input->post('class_types') != 'toddler'){                     
                
					$data['ca_marks']      = $this->input->post('ca_marks_' . $row['subject_id']);
					$data['mark_obtained']      = $this->input->post('mark_obtained_' . $row['subject_id']);
					$data['mark_total']      = $this->input->post('mark_total_' . $row['subject_id']);
				
					//code added on 31 may sandeep
					$data['effort_marks']      = $this->input->post('effort_marks_' . $row['subject_id']);
					$data['attitude_marks']      = $this->input->post('attitude_marks_' . $row['subject_id']);
					$data['attentiveness_mark']      = $this->input->post('attentiveness_mark_' . $row['subject_id']);
					$data['assignment_marks']      = $this->input->post('assignment_marks_' . $row['subject_id']);
					$data['interest_marks']      = $this->input->post('interest_marks_' . $row['subject_id']);
                    $data['willingness_marks']      = $this->input->post('willingness_marks_' . $row['subject_id']);
                    $data['teacher']      = $this->input->post('teacher_' . $row['subject_id']);

                    // comments for secondary
                    $data0['TeacherNames']  = $this->input->post('TeacherNames');
                    $data0['VPName']  = $this->input->post('VPName');
                    $data0['TeacherComments']  = $this->input->post('TeacherComments');
                    $data0['VPComment']  = $this->input->post('VPComment');
                    $data0['Attendances']  = $this->input->post('Attendances');

                    $this->db->where('class_id', $class_id);
                    $this->db->where('student_id', $student_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('session_year', $session_year);
                    $this->db->update('comments0', $data0);
                }
                if($this->input->post('class_types') != 'nursery 3' && $this->input->post('class_types') != 'nursery 2' 
                    && $this->input->post('class_types') != 'nursery 1' && $this->input->post('class_types') != 'toddler' 
                    && $this->input->post('class_types') != 'primary'){ 

					$this->db->where('mark_id', $this->input->post('mark_id_' . $row['subject_id']));
					//$this->db->where('student_id', $student_id);
					//$this->db->where('class_id', $class_id);
					$this->db->where('session_year', $session_year);
                    $this->db->update('mark0', $data);
                }

                if($this->input->post('class_types') == 'primary'){ 

					$this->db->where('mark_id', $this->input->post('mark_id_' . $row['subject_id']));
					//$this->db->where('student_id', $student_id);
					//$this->db->where('class_id', $class_id);
					$this->db->where('session_year', $session_year);
                    $this->db->update('mark0_pri', $data);
                }
                
                if($this->input->post('class_types') == 'primary'){  
                    $eng = $this->db->get_where('mark0_pri', array('class_id' => $class_id, 'student_id' => $student_id,
                                                                'exam_id' => $exam_id, 'session_year' => $session_year))->result_array();
                    
                    $place['ca_1'] = round(($ca1/3),1);
                    $place['ca_2'] = round(($ca2/6),1);
                    $ca_marks = (round(($ca1/3),1))+(round(($ca2/6),1));
                    $place['ca_marks'] = round($ca_marks,1);

                    $this->db->where('class_id', $class_id);
                    $this->db->where('student_id', $student_id);
					$this->db->where('exam_id', $exam_id);
                    $this->db->where('session_year', $session_year);
                    $this->db->where('subject_id', $eng[0]['subject_id']);
                    $this->db->update('mark0_pri', $place);
				}
            }
            if($this->input->post('class_types') == 'nursery 3'){ 
                $datas['effort_marks']      = $this->input->post('literacy');
                $datas['attitude_marks']      = $this->input->post('numeracy');
                $datas['attentiveness_mark']      = $this->input->post('kutw');
                $datas['assignment_marks']      = $this->input->post('phse');
                $datas['interest_marks']      = $this->input->post('rhyme');
                $datas['willingness_marks']      = $this->input->post('creative');
                $datas['science']      = $this->input->post('science');
                $datas['hand_writing']      = $this->input->post('hand_writing');
                
                $this->db->where('class_id', $class_id);
                $this->db->where('student_id', $student_id);
				$this->db->where('exam_id', $exam_id);
				$this->db->where('session_year', $session_year);
                $this->db->update('mark0_nur', $datas);

                
            }

            if($this->input->post('class_types') == 'nursery 2'){ 
                $datas['effort_marks']      = $this->input->post('literacy');
                $datas['attitude_marks']      = $this->input->post('numeracy');
                $datas['attentiveness_mark']      = $this->input->post('kutw');
                $datas['assignment_marks']      = $this->input->post('phse');
                $datas['interest_marks']      = $this->input->post('rhyme');
                $datas['willingness_marks']      = $this->input->post('creative');
                $datas['hand_writing']      = $this->input->post('hand_writing');
                $datas['work_habbit']      = $this->input->post('work_habbit');
                
                $this->db->where('class_id', $class_id);
                $this->db->where('student_id', $student_id);
				$this->db->where('exam_id', $exam_id);
				$this->db->where('session_year', $session_year);
                $this->db->update('mark0_nur', $datas);

            }

            if($this->input->post('class_types') == 'nursery 1'){ 
                $datas['effort_marks']      = $this->input->post('literacy');
                $datas['attitude_marks']      = $this->input->post('numeracy');
                $datas['attentiveness_mark']      = $this->input->post('kutw');
                $datas['assignment_marks']      = $this->input->post('phse');
                $datas['interest_marks']      = $this->input->post('rhyme');
                $datas['willingness_marks']      = $this->input->post('creative');
                $datas['work_habbit']      = $this->input->post('work_habbit');
                $datas['comm_skills']      = $this->input->post('comm_skills');
                $datas['gms']      = $this->input->post('gms');
                $datas['fms']      = $this->input->post('fms');
                
                $this->db->where('class_id', $class_id);
                $this->db->where('student_id', $student_id);
				$this->db->where('exam_id', $exam_id);
				$this->db->where('session_year', $session_year);
                $this->db->update('mark0_nur', $datas);

            }

            if($this->input->post('class_types') == 'toddler'){ 
                $datas['attitude_marks']      = $this->input->post('numeracy');
                $datas['attentiveness_mark']      = $this->input->post('kutw');
                $datas['assignment_marks']      = $this->input->post('phse');
                $datas['interest_marks']      = $this->input->post('rhyme');
                $datas['social_skills']      = $this->input->post('social_skills');
                $datas['comm_skills']      = $this->input->post('comm_skills');
                $datas['gms']      = $this->input->post('gms');
                $datas['fms']      = $this->input->post('fms');
                
                
                $this->db->where('class_id', $class_id);
                $this->db->where('student_id', $student_id);
				$this->db->where('exam_id', $exam_id);
				$this->db->where('session_year', $session_year);
                $this->db->update('mark0_nur', $datas);
            }

            if($this->input->post('class_types') == 'nursery 3' || $this->input->post('class_types') == 'nursery 2' 
                || $this->input->post('class_types') == 'nursery 1' || $this->input->post('class_types') == 'toddler'){

             // Comments for nursery
             $data0['TeacherName']  = $this->input->post('TeacherName');

             $this->db->where('class_id', $class_id);
             $this->db->where('student_id', $student_id);
             $this->db->where('exam_id', $exam_id);
             $this->db->where('session_year', $session_year);
             $this->db->update('comments0', $data0);
            }

            if($this->input->post('class_types') == 'ss 3'){ 
                //code for update vacation date
                $data4['resumption_date'] = $this->input->post('resumption_date');
                $data4['vacation_date'] = $this->input->post('vacation_date');
                $this->db->where('class_id', $class_id);
                $this->db->where('exam_id', $exam_id);
                $this->db->where('session_year', $session_year);
                $this->db->update('mark0', $data4);
            }
            

            //code for update vacation date
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/marks0/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['student_id'] = $student_id;
        $page_data['page_info'] = 'Exam marks';
        
        $page_data['page_name']  = 'marks0';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

// END OF TERM MARKS 
function marks($exam_id = '', $class_id = '', $student_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');
            $page_data['student_id'] = $this->input->post('student_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0) {
                redirect(base_url() . 'index.php?admin/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?admin/marks/', 'refresh');
            }
        }
        if ($this->input->post('operation') == 'update') {
            $subjects = $this->db->get_where('class_subject' , array('class_id' => $class_id))->result_array();
            $session_year = $this->input->post('session_year');
            $student_id = $this->input->post('student_id');
            $total_subs = '';
            $strand = $this->db->get('strand')->result_array();
            $ca1 = $cw = $ca2 = $project = $cat = $mao = $mat = 0;

            foreach($strand as $rows){
                $dataa['ca_1']      = $this->input->post('ca_1s_' . $rows['strand_id']);
                $dataa['cw']      = $this->input->post('cws_' . $rows['strand_id']);
                $dataa['ca_2']      = $this->input->post('ca_2s_' . $rows['strand_id']);
                $dataa['project_score']      = $this->input->post('project_scores_' . $rows['strand_id']);
                $dataa['ca_marks']      = $this->input->post('ca_markss_' . $rows['strand_id']);
                $dataa['mark_obtained']      = $this->input->post('mark_obtaineds_' . $rows['strand_id']);
                $dataa['mark_total']      = $this->input->post('mark_totals_' . $rows['strand_id']);

                $ca1 += $this->input->post('ca_1s_' . $rows['strand_id']);
                $cw += $this->input->post('cws_' . $rows['strand_id']);
                $ca2 += $this->input->post('ca_2s_' . $rows['strand_id']);
                $project += $this->input->post('project_scores_' . $rows['strand_id']);
                $cat += $this->input->post('ca_markss_' . $rows['strand_id']);
                $mao += $this->input->post('mark_obtaineds_' . $rows['strand_id']);
                $mat += $this->input->post('mark_totals_' . $rows['strand_id']);

                $this->db->where('strands_id', $this->input->post('strands_id_' . $rows['strand_id']));
                $this->db->where('session_year', $session_year);
                $this->db->update('strands', $dataa);
                }
                
            foreach($subjects as $row) {
				if($this->input->post('class_types') == 'primary'){
					$datap['ca_1']      = $this->input->post('ca_1_' . $row['subject_id']);
					$datap['cw']      = $this->input->post('cw_' . $row['subject_id']);
					$datap['ca_2']      = $this->input->post('ca_2_' . $row['subject_id']);
					$datap['project_score']      = $this->input->post('project_score_' . $row['subject_id']);
					$datap['ca_marks']      = $this->input->post('ca_marks_' . $row['subject_id']);
					$datap['mark_obtained']      = $this->input->post('mark_obtained_' . $row['subject_id']);
                    $datap['mark_total']      = $this->input->post('mark_total_' . $row['subject_id']);


					$data2['punctuality_grade']  = $this->input->post('punctuality_grade');
					$data2['mental_grade']  = $this->input->post('mental_grade');
					$data2['respect_grade']  = $this->input->post('respect_grade');
					$data2['neatness_grade']  = $this->input->post('neatness_grade');
					$data2['politness_grade']  = $this->input->post('politness_grade');
					$data2['honesty_grade']  = $this->input->post('honesty_grade');
					$data2['peers_grade']  = $this->input->post('peers_grade');
					$data2['learn_grade']  = $this->input->post('learn_grade');
					$data2['teamwork_grade']  = $this->input->post('teamwork_grade');
					$data2['health_grade']  = $this->input->post('health_grade');
					$data2['verbal_grade']  = $this->input->post('verbal_grade');
					$data2['sports_grade']  = $this->input->post('sports_grade');
					$data2['creativity_grade']  = $this->input->post('creativity_grade');
					$data2['music_grade']  = $this->input->post('music_grade');
                    $data2['dance_grade']  = $this->input->post('dance_grade');
                    
					
					$this->db->where('student_id', $student_id);
					$this->db->where('class_id', $class_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('session_year', $session_year);
					$this->db->update('primary_student_grade', $data2);
					
                    
                    // Comments for primary
                    $data0['TeacherName']  = $this->input->post('TeacherName');
                    $data0['HeadTeacherName']  = $this->input->post('HeadTeacherName');
                    $data0['TeacherComment']  = $this->input->post('TeacherComment');
                    $data0['HeadTeacherComment']  = $this->input->post('HeadTeacherComment');
                    $data0['Attendance']  = $this->input->post('Attendance');

                    $this->db->where('class_id', $class_id);
                    $this->db->where('student_id', $student_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('session_year', $session_year);
                    $this->db->update('comments', $data0);
                    
				}else if($this->input->post('class_types') == 'nursery'){ 

					
				}else{
					$data['ca_marks']      = $this->input->post('ca_marks_' . $row['subject_id']);
					$data['mark_obtained']      = $this->input->post('mark_obtained_' . $row['subject_id']);
					$data['mark_total']      = $this->input->post('mark_total_' . $row['subject_id']);
                    
                    $data['effort_marks']      = $this->input->post('effort_marks_' . $row['subject_id']);
					$data['attitude_marks']      = $this->input->post('attitude_marks_' . $row['subject_id']);
					$data['attentiveness_mark']      = $this->input->post('attentiveness_mark_' . $row['subject_id']);
					$data['assignment_marks']      = $this->input->post('assignment_marks_' . $row['subject_id']);
					$data['interest_marks']      = $this->input->post('interest_marks_' . $row['subject_id']);
                    $data['willingness_marks']      = $this->input->post('willingness_marks_' . $row['subject_id']);
                    $data['teacher']      = $this->input->post('teacher_' . $row['subject_id']);
                    
                    
                    // comments for secondary
                    $data0['TeacherNames']  = $this->input->post('TeacherNames');
                    $data0['VPName']  = $this->input->post('VPName');
                    $data0['TeacherComments']  = $this->input->post('TeacherComments');
                    $data0['VPComment']  = $this->input->post('VPComment');
                    $data0['Attendances']  = $this->input->post('Attendances');

                    $this->db->where('class_id', $class_id);
                    $this->db->where('student_id', $student_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('session_year', $session_year);
                    $this->db->update('comments', $data0);

                    // Remarks for secondary
                    $data_R['R1']  = $this->input->post('R1');
                    $data_R['R2']  = $this->input->post('R2');
                    $data_R['R3']  = $this->input->post('R3');
                    $data_R['R4']  = $this->input->post('R4');
                    $data_R['R5']  = $this->input->post('R5');
                    $data_R['R6']  = $this->input->post('R6');
                    $data_R['R7']  = $this->input->post('R7');
                    $data_R['R8']  = $this->input->post('R8');
                    $data_R['R9']  = $this->input->post('R9');
                    $data_R['R10']  = $this->input->post('R10');
                    $data_R['R11']  = $this->input->post('R11');
                    $data_R['R12']  = $this->input->post('R12');
                    $data_R['R13']  = $this->input->post('R13');
                    $data_R['R14']  = $this->input->post('R14');
                    $data_R['R15']  = $this->input->post('R15');
                    $data_R['R16']  = $this->input->post('R16');
                    $data_R['R17']  = $this->input->post('R17');
                    $data_R['R18']  = $this->input->post('R18');

                    $this->db->where('class_id', $class_id);
                    $this->db->where('student_id', $student_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('session_year', $session_year);
                    $this->db->update('Remark', $data_R);

                }
                if($this->input->post('class_types') != 'nursery 3' && $this->input->post('class_types') != 'nursery 2' 
                        && $this->input->post('class_types') != 'nursery 1' && $this->input->post('class_types') != 'toddler' 
                        && $this->input->post('class_types') != 'primary'){            
					$this->db->where('mark_id', $this->input->post('mark_id_' . $row['subject_id']));
					//$this->db->where('student_id', $student_id);
					//$this->db->where('class_id', $class_id);
					$this->db->where('session_year', $session_year);
                    $this->db->update('mark', $data);

                }

                if($this->input->post('class_types') == 'primary' ){            
					$this->db->where('mark_id', $this->input->post('mark_id_' . $row['subject_id']));
					//$this->db->where('student_id', $student_id);
					//$this->db->where('class_id', $class_id);
					$this->db->where('session_year', $session_year);
                    $this->db->update('mark_pri', $datap);

                }
                
                if($this->input->post('class_types') == 'primary'){
                    
                    $eng = $this->db->get_where('mark_pri', array('class_id' => $class_id, 'student_id' => $student_id,
                                                                'exam_id' => $exam_id, 'session_year' => $session_year))->result_array();
                    $place['ca_1'] = round(($ca1/3),1);
                    $place['cw'] = round(($cw/6),1);
                    $place['ca_2'] = round(($ca2/3),1);
                    $place['project_score'] = round(($project/6),1);
                    $ca_marks = (round(($ca1/3),1))+(round(($cw/6),1))+(round(($ca2/3),1))+(round(($project/6),1));
                    $place['ca_marks'] = round($ca_marks,1);
                    $place['mark_obtained'] = round(($mao/1.5),1);
                    $mark_total = round($ca_marks,1)+round(($mao/1.5),1);
                    $place['mark_total'] = round($mark_total,1);

                    $this->db->where('class_id', $class_id);
                    $this->db->where('student_id', $student_id);
					$this->db->where('exam_id', $exam_id);
                    $this->db->where('session_year', $session_year);
                    $this->db->where('subject_id', $eng[0]['subject_id']);
                    $this->db->update('mark_pri', $place);

				}
            }
            if($this->input->post('class_types') == 'nursery' || $this->input->post('class_types') == 'toddler'){
                $data2['language']      = $this->input->post('language');
                $data2['social']        = $this->input->post('social');
                $data2['knowledge']     = $this->input->post('knowledge');
                $data2['language1']     = $this->input->post('language1');
                $data2['social101']     = $this->input->post('social101');
                $data2['knowledge201']  = $this->input->post('knowledge201');
                $data2['language2']     = $this->input->post('language2');
                $data2['social102']     = $this->input->post('social102');
                $data2['knowledge202']  = $this->input->post('knowledge202');
                $data2['language3']     = $this->input->post('language3');
                $data2['social103']     = $this->input->post('social103');
                $data2['knowledge203']  = $this->input->post('knowledge203');
                $data2['language4']     = $this->input->post('language4');
                $data2['social104']     = $this->input->post('social104');
                $data2['knowledge204']  = $this->input->post('knowledge204');
                $data2['language5']     = $this->input->post('language5');
                $data2['social105']     = $this->input->post('social105');
                $data2['knowledge205']  = $this->input->post('knowledge205');
                $data2['language6']     = $this->input->post('language6');
                $data2['social106']     = $this->input->post('social106');
                $data2['knowledge206']  = $this->input->post('knowledge206');
                $data2['language7']     = $this->input->post('language7');
                $data2['social107']     = $this->input->post('social107');
                $data2['knowledge207']  = $this->input->post('knowledge207');
                $data2['language8']     = $this->input->post('language8');
                $data2['social108']     = $this->input->post('social108');
                $data2['knowledge208']  = $this->input->post('knowledge208');
                $data2['language9']     = $this->input->post('language9');
                $data2['social109']     = $this->input->post('social109');
                $data2['knowledge209']  = $this->input->post('knowledge209');
                $data2['language10']    = $this->input->post('language10');
                $data2['social110']     = $this->input->post('social110');
                $data2['knowledge210']  = $this->input->post('knowledge210');
                $data2['language11']    = $this->input->post('language11');
                $data2['social111']     = $this->input->post('social111');
                $data2['knowledge211']  = $this->input->post('knowledge211');
                $data2['language12']    = $this->input->post('language12');
                $data2['social112']     = $this->input->post('social112');
                $data2['knowledge212']  = $this->input->post('knowledge212');
                $data2['language13']    = $this->input->post('language13');
                $data2['social113']     = $this->input->post('social113');
                $data2['knowledge213']  = $this->input->post('knowledge213');
                $data2['language14']    = $this->input->post('language14');
                $data2['social114']     = $this->input->post('social114');
                $data2['knowledge214']  = $this->input->post('knowledge214');
                $data2['language15']    = $this->input->post('language15');
                $data2['social115']     = $this->input->post('social115');
                $data2['knowledge215']  = $this->input->post('knowledge215');
                $data2['language16']    = $this->input->post('language16');
                $data2['social116']     = $this->input->post('social116');
                $data2['knowledge216']  = $this->input->post('knowledge216');
                $data2['language17']    = $this->input->post('language17');
                $data2['social117']     = $this->input->post('social117');
                $data2['knowledge217']  = $this->input->post('knowledge217');
                $data2['language18']    = $this->input->post('language18');
                $data2['social118']     = $this->input->post('social118');
                $data2['knowledge218']  = $this->input->post('knowledge218');
                $data2['language19']    = $this->input->post('language19');
                $data2['social119']     = $this->input->post('social119');
                $data2['knowledge219']  = $this->input->post('knowledge219');
                $data2['language20']    = $this->input->post('language20');
                $data2['social120']     = $this->input->post('social120');
                $data2['knowledge220']  = $this->input->post('knowledge220');
                $data2['language21']    = $this->input->post('language21');
                $data2['social121']     = $this->input->post('social121');
                $data2['knowledge221']  = $this->input->post('knowledge221');
                $data2['language22']    = $this->input->post('language22');
                $data2['social122']     = $this->input->post('social122');
                $data2['knowledge222']  = $this->input->post('knowledge222');
                $data2['language23']    = $this->input->post('language23');
                $data2['social123']     = $this->input->post('social123');
                $data2['knowledge223']  = $this->input->post('knowledge223');
                $data2['language24']    = $this->input->post('language24');
                $data2['social124']     = $this->input->post('social124');
                $data2['knowledge224']  = $this->input->post('knowledge224');
                $data2['language25']    = $this->input->post('language25');
                $data2['social125']     = $this->input->post('social125');
                $data2['knowledge225']  = $this->input->post('knowledge225');
                $data2['language26']    = $this->input->post('language26');
                $data2['social126']     = $this->input->post('social126');
                $data2['knowledge226']  = $this->input->post('knowledge226');
                $data2['language27']    = $this->input->post('language27');
                $data2['social127']     = $this->input->post('social127');
                $data2['knowledge227']  = $this->input->post('knowledge227');
                $data2['language28']    = $this->input->post('language28');
                $data2['social128']     = $this->input->post('social128');
                $data2['knowledge228']  = $this->input->post('knowledge228');
                $data2['language29']    = $this->input->post('language29');
                $data2['social129']     = $this->input->post('social129');
                $data2['knowledge229']  = $this->input->post('knowledge229');
                $data2['language30']    = $this->input->post('language30');
                $data2['social130']     = $this->input->post('social130');
                $data2['knowledge230']  = $this->input->post('knowledge230');
                $data2['language31']    = $this->input->post('language31');
                $data2['social131']     = $this->input->post('social131');
                $data2['knowledge231']  = $this->input->post('knowledge231');
                $data2['language32']    = $this->input->post('language32');
                $data2['social132']     = $this->input->post('social132');
                $data2['knowledge232']  = $this->input->post('knowledge232');
                $data2['language33']    = $this->input->post('language33');
                $data2['social133']     = $this->input->post('social133');
                $data2['knowledge233']  = $this->input->post('knowledge233');
                $data2['language34']    = $this->input->post('language34');
                $data2['social134']     = $this->input->post('social134');
                $data2['knowledge234']  = $this->input->post('knowledge234');
                $data2['language35']    = $this->input->post('language35');
                $data2['social135']     = $this->input->post('social135');
                $data2['knowledge235']  = $this->input->post('knowledge235');
                $data2['language36']    = $this->input->post('language36');
                $data2['social136']     = $this->input->post('social136');
                $data2['knowledge236']  = $this->input->post('knowledge236');
                $data2['language37']    = $this->input->post('language37');
                $data2['social137']     = $this->input->post('social137');
                $data2['knowledge237']  = $this->input->post('knowledge237');
                $data2['language38']    = $this->input->post('language38');
                $data2['social138']     = $this->input->post('social138');
                $data2['knowledge238']  = $this->input->post('knowledge238');
                $data2['language39']    = $this->input->post('language39');
                $data2['social139']     = $this->input->post('social139');
                $data2['knowledge239']  = $this->input->post('knowledge239');
                $data2['language40']    = $this->input->post('language40');
                $data2['social140']     = $this->input->post('social140');
                $data2['knowledge240']  = $this->input->post('knowledge240');
                $data2['resumption_date'] = $this->input->post('resumption_date');
                $data2['vacation_date'] = $this->input->post('vacation_date'); 
                    
                $this->db->where('student_id', $student_id);
                $this->db->where('class_id', $class_id);
                $this->db->where('exam_id', $exam_id);
                $this->db->where('session_year', $session_year);
                $this->db->update('nursery_student_marks', $data2);
                
                }

                // Comments for nursery
                $data0['TeacherName']  = $this->input->post('TeacherName');
                $data0['HeadTeacherName']  = $this->input->post('HeadTeacherName');
                $data0['TeacherComment']  = $this->input->post('TeacherComment');
                $data0['HeadTeacherComment']  = $this->input->post('HeadTeacherComment');
                $data0['Attendance']  = $this->input->post('Attendance');

                $this->db->where('class_id', $class_id);
                $this->db->where('student_id', $student_id);
                $this->db->where('exam_id', $exam_id);
                $this->db->where('session_year', $session_year);
                $this->db->update('comments', $data0);

            if($this->input->post('class_types') == 'primary'){
                //code for update vacation date
                $datapr['resumption_date'] = $this->input->post('resumption_date');
                $datapr['vacation_date'] = $this->input->post('vacation_date');
                $this->db->where('class_id', $class_id);
                $this->db->where('exam_id', $exam_id);
                $this->db->where('session_year', $session_year);
                $this->db->update('mark_pri', $datapr);
            }

            if($this->input->post('class_types') != 'nursery 3' && $this->input->post('class_types') != 'nursery 2' 
                    && $this->input->post('class_types') != 'nursery 1' && $this->input->post('class_types') != 'toddler' 
                    && $this->input->post('class_types') != 'primary'){
                //code for update vacation date
                $data4['resumption_date'] = $this->input->post('resumption_date');
                $data4['vacation_date'] = $this->input->post('vacation_date');
                $this->db->where('class_id', $class_id);
                $this->db->where('exam_id', $exam_id);
                $this->db->where('session_year', $session_year);
                $this->db->update('mark', $data4);
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/marks/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['student_id'] = $student_id;
        //$page_data['subject_id'] = $section_id;
        $page_data['page_info'] = 'Exam marks';
        
        $page_data['page_name']  = 'marks';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function manage_marks()
    {  
        $page_data['exam_id']    = $this->input->post('exam_id');
        $page_data['class_id']   = $this->input->post('class_id');
        $page_data['student_id'] = $this->input->post('student_id');
        if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0) {
            redirect(base_url() . 'index.php?admin/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
        } else {
            $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
            redirect(base_url() . 'index.php?admin/marks/', 'refresh');
        }
    }

    function manage_marks0()
    {  
        $page_data['exam_id']    = $this->input->post('exam_id');
        $page_data['class_id']   = $this->input->post('class_id');
        $page_data['student_id'] = $this->input->post('student_id');
        if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0) {
            redirect(base_url() . 'index.php?admin/marks0/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
        } else {
            $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
            redirect(base_url() . 'index.php?admin/marks0/', 'refresh');
        }
    }
	

// TABULATION SHEET
function tabulation_sheet($class_id = '', $exam_id = '', $student_id = '', $sessoin_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($this->input->post('operation') == 'selection') {
        $page_data['exam_id'] = $this->input->post('exam_id');
        $page_data['class_id'] = $this->input->post('class_id');
        $page_data['student_id'] = $this->input->post('student_id');
        $page_data['sessoin_id'] = $this->input->post('session_year');

        if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0 ) {
            redirect(base_url() . 'index.php?admin/tabulation_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' . $page_data['student_id'].'/'.$page_data['sessoin_id'], 'refresh');
        } else {
            $this->session->set_flashdata('mark_message', 'Choose class and exam');
            redirect(base_url() . 'index.php?admin/tabulation_sheet/', 'refresh');
        }
    }
    $page_data['exam_id'] = $exam_id;
    $page_data['class_id'] = $class_id;
    $page_data['student_id'] = $student_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $page_data['page_info'] = 'Exam marks';

    $page_data['page_name'] = 'tabulation_sheet';
    $page_data['page_title'] = get_phrase('tabulation_sheet');
    $this->load->view('backend/index', $page_data);
}

// TABULATION SHEET
function tabulation_sheet_midterm($class_id = '', $exam_id = '', $student_id = '', $sessoin_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($this->input->post('operation') == 'selection') {
        $page_data['exam_id'] = $this->input->post('exam_id');
        $page_data['class_id'] = $this->input->post('class_id');
        $page_data['student_id'] = $this->input->post('student_id');
        $page_data['sessoin_id'] = $this->input->post('session_year');

        if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0 ) {
            redirect(base_url() . 'index.php?admin/tabulation_sheet_midterm/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' . $page_data['student_id'].'/'.$page_data['sessoin_id'], 'refresh');
        } else {
            $this->session->set_flashdata('mark_message', 'Choose class and exam');
            redirect(base_url() . 'index.php?admin/tabulation_sheet_midterm/', 'refresh');
        }
    }
    $page_data['exam_id'] = $exam_id;
    $page_data['class_id'] = $class_id;
    $page_data['student_id'] = $student_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $page_data['page_info'] = 'Exam marks';

    $page_data['page_name'] = 'tabulation_sheet_midterm';
    $page_data['page_title'] = get_phrase('tabulation_sheet');
    $this->load->view('backend/index', $page_data);
}

function tabulation_sheet_print_view($class_id, $exam_id,$sessoin_id) {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $this->load->view('backend/admin/tabulation_sheet_print_view', $page_data);
}

function tabulation_sheet_print_view_control($class_id, $exam_id,$sessoin_id) {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    redirect(base_url() . 'index.php?admin/tabulation_sheet_print_view/' . $page_data['class_id'] . '/' . $page_data['exam_id'].'/'.$page_data['sessoin_id'], 'refresh');
}
// added on 28-06-2018 sandeep

// added on 21-10-2018

function tabulation_sheet_midterm_print_view($class_id, $exam_id,$sessoin_id) {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $this->load->view('backend/admin/tabulation_sheet_midterm_print_view', $page_data);
}

function tabulation_sheet_midterm_print_view_control($class_id, $exam_id,$sessoin_id) {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    redirect(base_url() . 'index.php?admin/tabulation_sheet_midterm_print_view/' . $page_data['class_id'] . '/' . $page_data['exam_id'].'/'.$page_data['sessoin_id'], 'refresh');
}

function tabulation_sheet_midterm_print_view_single($class_id, $exam_id,$sessoin_id,$student_id){
     if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $page_data['student_id'] = $student_id;
    $this->load->view('backend/admin/tabulation_sheet_midterm_print_view_single', $page_data);
}

function tabulation_sheet_midterm_print_single_control($class_id, $exam_id,$sessoin_id,$student_id){
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $page_data['student_id'] = $student_id;
    redirect(base_url() . 'index.php?admin/tabulation_sheet_midterm_print_view_single/' . $page_data['class_id'] . '/' . $page_data['exam_id'].'/'.$page_data['sessoin_id'].'/'.$student_id, 'refresh');
}

function tabulation_sheet_print_view_single($class_id, $exam_id,$sessoin_id,$student_id){
	 if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $page_data['student_id'] = $student_id;
    $this->load->view('backend/admin/tabulation_sheet_print_view_single', $page_data);
}

function tabulation_sheet_print_single_control($class_id, $exam_id,$sessoin_id,$student_id){
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $page_data['student_id'] = $student_id;
    redirect(base_url() . 'index.php?admin/tabulation_sheet_print_view_single/' . $page_data['class_id'] . '/' . $page_data['exam_id'].'/'.$page_data['sessoin_id'].'/'.$student_id, 'refresh');
}

function tabulation_sheet_print_singlee_control($class_id, $exam_id,$sessoin_id,$student_id){
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $page_data['student_id'] = $student_id;
    
    //$this->load->library('pdf');
    
    $this->load->view('backend/admin/test', $page_data);
}

//MIT SCORESHEET
function score_sheet0($class_id = '', $exam_id = '', $sessoin_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($this->input->post('operation') == 'selection') {
        $page_data['exam_id'] = $this->input->post('exam_id');
        $page_data['class_id'] = $this->input->post('class_id');
        $page_data['sessoin_id'] = $this->input->post('session_year');

        if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
            redirect(base_url() . 'index.php?admin/score_sheet0/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' .$page_data['sessoin_id'], 'refresh');
        } else {
            $this->session->set_flashdata('mark_message', 'Choose class and exam');
            redirect(base_url() . 'index.php?admin/score_sheet0/', 'refresh');
        }
    }
    $page_data['exam_id'] = $exam_id;
    $page_data['class_id'] = $class_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $page_data['page_info'] = 'BROAD SHEET';

    $page_data['page_name'] = 'score_sheet0';
    $page_data['page_title'] = get_phrase('score_sheet0');
    $this->load->view('backend/index', $page_data);
}

// EOT SCORESHEET
function score_sheet($class_id = '', $exam_id = '', $sessoin_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($this->input->post('operation') == 'selection') {
        $page_data['exam_id'] = $this->input->post('exam_id');
        $page_data['class_id'] = $this->input->post('class_id');
        $page_data['sessoin_id'] = $this->input->post('session_year');

        if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
            redirect(base_url() . 'index.php?admin/score_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' .$page_data['sessoin_id'], 'refresh');
        } else {
            $this->session->set_flashdata('mark_message', 'Choose class and exam');
            redirect(base_url() . 'index.php?admin/score_sheet/', 'refresh');
        }
    }
    $page_data['exam_id'] = $exam_id;
    $page_data['class_id'] = $class_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $page_data['page_info'] = 'BROAD SHEET';

    $page_data['page_name'] = 'score_sheet';
    $page_data['page_title'] = get_phrase('score_sheet');
    $this->load->view('backend/index', $page_data);
}

/* * **MANAGE GRADES**** */

function grade($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['grade_point'] = $this->input->post('grade_point');
        $data['mark_from'] = $this->input->post('mark_from');
        $data['mark_upto'] = $this->input->post('mark_upto');
        $data['comment'] = $this->input->post('comment');
        $this->db->insert('grade', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/grade/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['grade_point'] = $this->input->post('grade_point');
        $data['mark_from'] = $this->input->post('mark_from');
        $data['mark_upto'] = $this->input->post('mark_upto');
        $data['comment'] = $this->input->post('comment');

        $this->db->where('grade_id', $param2);
        $this->db->update('grade', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/grade/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('grade', array(
                    'grade_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('grade_id', $param2);
        $this->db->delete('grade');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/grade/', 'refresh');
    }
    $page_data['grades'] = $this->db->get('grade')->result_array();
    $page_data['page_name'] = 'grade';
    $page_data['page_title'] = get_phrase('manage_grade');
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGING CLASS ROUTINE***************** */

function class_routine($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['class_id'] 			= $this->input->post('class_id');
        $data['subject_id'] 		= $this->input->post('subject_id');
        $data['time_start'] 		= $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
        $data['time_end'] 			= $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
        $data['time_start_min'] 	= $this->input->post('time_start_min');
        $data['time_end_min'] 		= $this->input->post('time_end_min');
        $data['day'] 				= $this->input->post('day');
		$data['teacher_id'] 		= $this->input->post('teacher_id');
        $data['room'] 				= $this->input->post('room');
		
        $this->db->insert('class_routine', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['class_id'] 			= $this->input->post('class_id');
        $data['subject_id'] 		= $this->input->post('subject_id');
        $data['time_start'] 		= $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
        $data['time_end'] 			= $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
        $data['time_start_min'] 	= $this->input->post('time_start_min');
        $data['time_end_min'] 		= $this->input->post('time_end_min');
        $data['day'] 				= $this->input->post('day');
		$data['teacher_id'] 		= $this->input->post('teacher_id');
        $data['room'] 				= $this->input->post('room');

        $this->db->where('class_routine_id', $param2);
        $this->db->update('class_routine', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                    'class_routine_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('class_routine_id', $param2);
        $this->db->delete('class_routine');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
    }
    $page_data['page_name'] = 'class_routine';
    $page_data['page_title'] = get_phrase('manage_class_routine');
    $this->load->view('backend/index', $page_data);
}

/* * **** DAILY ATTENDANCE **************** */

function manage_attendance($date = '', $month = '', $year = '', $class_id = '', $exam_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $active_sms_service = $this->db->get_where('settings', array('type' => 'active_sms_service'))->row()->description;


    if ($_POST) {
        // Loop all the students of $class_id
        $get_system_settings	=	$this->crud_model->get_system_settings();
        $sessoin_id = $get_system_settings[17]['description'];
        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
        foreach ($students as $row) {
            $attendance_status = $this->input->post('status_' . $row['student_id']);
            $full_date = $year . "-" . $month . "-" . $date;
            $this->db->where('student_id', $row['student_id']);
            $this->db->where('date', $full_date);
            $this->db->where('exam_id', $exam_id);
            $this->db->where('class_id', $class_id);
            $this->db->where('session_year', $sessoin_id);

            $this->db->update('attendance', array('status' => $attendance_status));

            // if ($attendance_status == 2) {
            //     if ($active_sms_service != '' || $active_sms_service != 'disabled') {
            //         $student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
            //         $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->phone;
            //         $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
            //         $this->sms_model->send_sms($message,$receiver_phone);
            //     }
            // }
        }
        
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/manage_attendance/' . $date . '/' . $month . '/' . $year . '/' . $class_id . '/' . $exam_id, 'refresh');
    }
    $page_data['date'] = $date;
    $page_data['month'] = $month;
    $page_data['year'] = $year;
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['session_year'] = $sessoin_id;
    $page_data['page_name'] = 'manage_attendance';
    $page_data['page_title'] = get_phrase('manage_daily_attendance');
    $this->load->view('backend/index', $page_data);
}

function attendance_report($class_id = '', $month = '', $year = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $active_sms_service = $this->db->get_where('settings', array('type' => 'active_sms_service'))->row()->description;


    if ($_POST) {
        redirect(base_url() . 'index.php?admin/attendance_report/' . $class_id. '/' . $month . '/' . $year, 'refresh');
    }
    $classes = $this->db->get('class')->result_array();
    foreach ($classes as $row) {
        if (isset($class_id) && $class_id == $row['class_id'])
            $calss_name = $row['name'];
    }
   

    $page_data['month'] = $month;
    $page_data['year'] = $year;
    $page_data['class_id'] = $class_id;
    $page_data['page_name'] = 'attendance_report';
    $page_data['page_title'] = "Attendance Report Of Class " . $calss_name ;
    $this->load->view('backend/index', $page_data);
}

function attendance_report_print_view($class_id = '', $month = '', $year = '') {
    $page_data['month'] = $month;
    $page_data['year'] = $year;
    $page_data['class_id'] = $class_id;
    $this->load->view('backend/attendance_report_print_view.php', $page_data);
}

function attendance_selector() {
    $date = $this->input->post('timestamp');
    $date = date_create($date);
    $date = date_format($date, "d/m/Y");
    redirect(base_url() . 'index.php?admin/manage_attendance/' . $date . '/' . $this->input->post('class_id') . '/' . $this->input->post('exam_id'), 'refresh');
}

function attendance_report_view() {
    redirect(base_url() . 'index.php?admin/attendance_report/' . $this->input->post('class_id') .  '/' . $this->input->post('month') . '/' . $this->input->post('year'), 'refresh');
}

/* * ****MANAGE BILLING / INVOICES WITH STATUS**** */

function invoice($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($param1 == 'create') {
        $data['student_id'] = $this->input->post('student_id');
        $data['title'] = $this->input->post('title');
        //$data['description'] = $this->input->post('description');
        //$data['amount'] = $this->input->post('amount');
        //$data['amount_paid'] = $this->input->post('amount_paid');
        //$data['due'] = $data['amount'] - $data['amount_paid'];
        $data['status'] = $this->input->post('status');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['session_year'] = $this->input->post('session_year');
        $data['creation_timestamp'] = strtotime($this->input->post('date'));

        $test  = $this->db->get_where('invoice',array('student_id' => $this->input->post('student_id'), 
                                        'session_year' => $this->input->post('session_year'),
                                        'exam_id' => $this->input->post('exam_id')))->result_array();
        
        if ($test[0]['student_id'] != ($this->input->post('student_id')) && $test[0]['session_year'] !== ($this->input->post('session_year'))
                                                                        && $test[0]['exam_id'] !== ($this->input->post('exam_id'))) {
    
                $this->db->insert('invoice', $data);
                $invoice_id = $this->db->insert_id();

                $data2['invoice_id'] = $invoice_id;
                $data2['student_id'] = $this->input->post('student_id');
                $data2['title'] = $this->input->post('title');
                //$data2['description'] = $this->input->post('description');
                $data2['payment_type'] = 'income';
                $data2['exam_id'] = $this->input->post('exam_id');
                $data2['session_year'] = $this->input->post('session_year');
                //$data2['method'] = $this->input->post('method');
                //$data2['amount'] = $this->input->post('amount_paid');
                $data2['timestamp'] = strtotime($this->input->post('date'));

                $this->db->insert('payment', $data2);
        }

        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/student_payment', 'refresh');
    }

    if ($param1 == 'create_mass_invoice') {
        if (!($this->input->post('student_id'))) {
            foreach ($this->input->post('student_id') as $id) {

                $data['student_id'] = $id;
                $data['title'] = $this->input->post('title');
                $data['exam_id'] = $this->input->post('exam_id');
                //$data['description'] = $this->input->post('description');
                //$data['amount'] = $this->input->post('amount');
                //$data['amount_paid'] = $this->input->post('amount_paid');
                //$data['due'] = $data['amount'] - $data['amount_paid'];
                $data['status'] = $this->input->post('status');
                $data['session_year'] = $this->input->post('session_year');
                $data['creation_timestamp'] = strtotime($this->input->post('date'));

                $test2  = $this->db->get_where('invoice',array('student_id' => $id, 
                                        'session_year' => $this->input->post('session_year'),
                                        'exam_id' => $this->input->post('exam_id')))->result_array();

                if ($test2[0]['student_id'] != $id && $test2[0]['session_year'] !== ($this->input->post('session_year'))
                                                                        && $test2[0]['exam_id'] !== ($this->input->post('exam_id'))) {

                $this->db->insert('invoice', $data);
                $invoice_id = $this->db->insert_id();

                $data2['invoice_id'] = $invoice_id;
                $data2['student_id'] = $id;
                $data2['title'] = $this->input->post('title');
                $data2['exam_id'] = $this->input->post('exam_id');
                //$data2['description'] = $this->input->post('description');
                $data2['payment_type'] = 'income';
                $data2['session_year'] = $this->input->post('session_year');
                //$data2['method'] = $this->input->post('method');
                //$data2['amount'] = $this->input->post('amount_paid');
                $data2['timestamp'] = strtotime($this->input->post('date'));

                $this->db->insert('payment', $data2);}
            }
        }
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/student_payment', 'refresh');
    }

    if ($param1 == 'do_update') {
        $data['student_id'] = $this->input->post('student_id');
        $data['title'] = $this->input->post('title');
        $data['status'] = $this->input->post('status');
        
        $this->db->where('invoice_id', $param2);
        $this->db->update('invoice', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/invoice', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('invoice', array(
                    'invoice_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'take_payment') {
        $data['invoice_id'] = $this->input->post('invoice_id');
        $data['student_id'] = $this->input->post('student_id');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['payment_type'] = 'income';
        $data['method'] = $this->input->post('method');
        $data['amount'] = $this->input->post('amount');
        $data['timestamp'] = strtotime($this->input->post('timestamp'));
        $this->db->insert('payment', $data);

        $data2['amount_paid'] = $this->input->post('amount');
        $this->db->where('invoice_id', $param2);
        $this->db->set('amount_paid', 'amount_paid + ' . $data2['amount_paid'], FALSE);
        $this->db->set('due', 'due - ' . $data2['amount_paid'], FALSE);
        $this->db->update('invoice');

        $this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
        redirect(base_url() . 'index.php?admin/invoice', 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('invoice_id', $param2);
        $this->db->delete('invoice');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/invoice', 'refresh');
    }
    $page_data['page_name'] = 'invoice';
    $page_data['page_title'] = get_phrase('manage_invoice/payment');
    $this->db->order_by('creation_timestamp', 'desc');
    $page_data['invoices'] = $this->db->get('invoice')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* * ********ACCOUNTING******************* */

function income($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    $page_data['page_name'] = 'income';
    $page_data['page_title'] = get_phrase('student_payments');
    $this->db->order_by('creation_timestamp', 'desc');
    $page_data['invoices'] = $this->db->get('invoice')->result_array();
    $this->load->view('backend/index', $page_data);
}

function student_payment($param1 = '', $param2 = '', $param3 = '') {

    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    $page_data['page_name'] = 'student_payment';
    $page_data['page_title'] = get_phrase('create_student_payment');
    $this->load->view('backend/index', $page_data);
}

function expense($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['title'] = $this->input->post('title');
        $data['expense_category_id'] = $this->input->post('expense_category_id');
        $data['description'] = $this->input->post('description');
        $data['payment_type'] = 'expense';
        $data['method'] = $this->input->post('method');
        $data['amount'] = $this->input->post('amount');
        $data['timestamp'] = strtotime($this->input->post('timestamp'));
        $this->db->insert('payment', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/expense', 'refresh');
    }

    if ($param1 == 'edit') {
        $data['title'] = $this->input->post('title');
        $data['expense_category_id'] = $this->input->post('expense_category_id');
        $data['description'] = $this->input->post('description');
        $data['payment_type'] = 'expense';
        $data['method'] = $this->input->post('method');
        $data['amount'] = $this->input->post('amount');
        $data['timestamp'] = strtotime($this->input->post('timestamp'));
        $this->db->where('payment_id', $param2);
        $this->db->update('payment', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/expense', 'refresh');
    }
	if($this->input->post('operation') =='selection'){
		$expence_category_id = $this->input->post('expence_category_id') ;
		redirect(base_url() . 'index.php?admin/expense/'.$expence_category_id, 'refresh');
	}
    if ($param1 == 'delete') {
        $this->db->where('payment_id', $param2);
        $this->db->delete('payment');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/expense', 'refresh');
    }

    $page_data['page_name'] = 'expense';
    $page_data['expence_category_id'] = $param1;
    $page_data['page_title'] = get_phrase('expenses');
    $this->load->view('backend/index', $page_data);
}

function expense_category($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $this->db->insert('expense_category', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/expense_category');
    }
    if ($param1 == 'edit') {
        $data['name'] = $this->input->post('name');
        $this->db->where('expense_category_id', $param2);
        $this->db->update('expense_category', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/expense_category');
    }
    if ($param1 == 'delete') {
        $this->db->where('expense_category_id', $param2);
        $this->db->delete('expense_category');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/expense_category');
    }

    $page_data['page_name'] = 'expense_category';
    $page_data['page_title'] = get_phrase('expense_category');
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGE LIBRARY / BOOKS******************* */

function book($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
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
        redirect(base_url() . 'index.php?admin/book', 'refresh');
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
        redirect(base_url() . 'index.php?admin/book', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('book', array(
                    'book_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('book_id', $param2);
        $this->db->delete('book');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/book', 'refresh');
    }
    $page_data['books'] = $this->db->get('book')->result_array();
    $page_data['page_name'] = 'book';
    $page_data['page_title'] = get_phrase('manage_library_books');
    $this->load->view('backend/index', $page_data);
}

/* * ********MANAGE TRANSPORT / VEHICLES / ROUTES******************* */

function transport($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] 					= $this->input->post('name');
        $data['transport_route_id'] 	= $this->input->post('transport_route_id');
        $data['vehicle_id'] 			= $this->input->post('vehicle_id');
        $data['number_of_vehicle'] 		= $this->input->post('number_of_vehicle');
        $data['description'] 			= $this->input->post('description');
        $data['route_fare'] 			= $this->input->post('route_fare');
        $this->db->insert('transport', $data);
        if($this->session->userdata('redir_page')){
			$this->session->set_userdata(array('rdirect' =>'yes' ));
		}
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/transport', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] 					= $this->input->post('name');
        $data['transport_route_id'] 	= $this->input->post('transport_route_id');
        $data['vehicle_id'] 			= $this->input->post('vehicle_id');
        $data['number_of_vehicle'] 		= $this->input->post('number_of_vehicle');
        $data['description'] 			= $this->input->post('description');
        $data['route_fare'] 			= $this->input->post('route_fare');

        $this->db->where('transport_id', $param2);
        $this->db->update('transport', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/transport', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('transport', array(
                    'transport_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('transport_id', $param2);
        $this->db->delete('transport');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/transport', 'refresh');
    }
    if($param1 == 'student_add'){
		$this->session->set_userdata(array('redir_page' =>$param1 ));
	}
    $page_data['transports'] = $this->db->get('transport')->result_array();
    $page_data['page_name'] = 'transport';
    $page_data['page_title'] = get_phrase('manage_transport');
    $this->load->view('backend/index', $page_data);
     if($this->session->userdata('rdirect') =='yes'){
		redirect(base_url() . 'index.php?admin/'.$this->session->userdata('redir_page'), 'refresh');
	}
}



/* * *MANAGE TRANSPORT ROUTES* */

function transport_route($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $this->db->insert('transport_route', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/transport_route', 'refresh');
    }
   
    if ($param1 == 'delete') {
        $this->db->where('transport_route_id', $param2);
        $this->db->delete('transport_route');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/transport_route', 'refresh');
    }
    $page_data['transport_routes'] = $this->db->get('transport_route')->result_array();
    $page_data['page_name'] = 'transport_route';
    $page_data['page_title'] = get_phrase('manage_transport_route');
    $this->load->view('backend/index', $page_data);
}


/* * *MANAGE VEHICLE INFORMATION * */

function vehicle($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] 					= $this->input->post('name');
        $data['vehicle_no'] 			= $this->input->post('vehicle_no');
        $data['vehicle_model'] 			= $this->input->post('vehicle_model');
        $data['year_made'] 				= $this->input->post('year_made');
        $data['driver_name'] 			= $this->input->post('driver_name');
        $data['driver_license']		 	= $this->input->post('driver_license');
        $data['driver_contact']	 		= $this->input->post('driver_contact');
        $data['status'] 				= $this->input->post('status');
        $data['description'] 			= $this->input->post('description');
        $this->db->insert('vehicle', $data);
        $vehicle_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/vehicle_image/' . $vehicle_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/vehicle/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] 						= $this->input->post('name');
        $data['vehicle_no'] 				= $this->input->post('vehicle_no');
        $data['vehicle_model'] 				= $this->input->post('vehicle_model');
        $data['year_made'] 					= $this->input->post('year_made');
        $data['driver_name'] 				= $this->input->post('driver_name');
        $data['driver_license'] 			= $this->input->post('driver_license');
        $data['driver_contact'] 			= $this->input->post('driver_contact');
        $data['status'] 					= $this->input->post('status');
        $data['description'] = $this->input->post('description');
		
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/vehicle_image/' . $param2 . '.jpg');
          $this->db->where('vehicle_id', $param2);
        $this->db->update('vehicle', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/vehicle', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('vehicle', array(
                    'vehicle_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('vehicle_id', $param2);
        $this->db->delete('vehicle');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/vehicle/', 'refresh');
    }
    $page_data['vehicles'] = $this->db->get('vehicle')->result_array();
    $page_data['page_name'] = 'vehicle';
    $page_data['page_title'] = get_phrase('manage_vehicle');
    $this->load->view('backend/index', $page_data);
}


/* * ********MANAGE BOOK PUBLISHER ******************* */

function publisher($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['publisher_name'] = $this->input->post('publisher_name');
        $data['description'] = $this->input->post('description');
        $this->db->insert('publisher', $data);
        $this->session->set_flashdata('flash_message', get_phrase('publisher_added_successfully'));
        redirect(base_url() . 'index.php?admin/publisher', 'refresh');
    }
   
    if ($param1 == 'delete') {
        $this->db->where('publisher_id', $param2);
        $this->db->delete('publisher');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/publisher', 'refresh');
    }
    $page_data['publishers'] = $this->db->get('publisher')->result_array();
    $page_data['page_name'] = 'publisher';
    $page_data['page_title'] = get_phrase('manage_publisher');
    $this->load->view('backend/index', $page_data);
}


/* * ********MANAGE BOOK CATEGORY ******************* */

function book_category($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $this->db->insert('book_category', $data);
        $this->session->set_flashdata('flash_message', get_phrase('book_category_added_successfully'));
        redirect(base_url() . 'index.php?admin/book_category', 'refresh');
    }
   
    if ($param1 == 'delete') {
        $this->db->where('book_category_id', $param2);
        $this->db->delete('book_category');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/book_category', 'refresh');
    }
    $page_data['book_categorys'] = $this->db->get('book_category')->result_array();
    $page_data['page_name'] = 'book_category';
    $page_data['page_title'] = get_phrase('manage_book_category');
    $this->load->view('backend/index', $page_data);
}


/* * ********MANAGE BOOK AUTHOR ******************* */

function author($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $this->db->insert('author', $data);
        $this->session->set_flashdata('flash_message', get_phrase('author_added_successfully'));
        redirect(base_url() . 'index.php?admin/author', 'refresh');
    }
   
    if ($param1 == 'delete') {
        $this->db->where('author_id', $param2);
        $this->db->delete('author');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/author', 'refresh');
    }
    $page_data['authors'] = $this->db->get('author')->result_array();
    $page_data['page_name'] = 'author';
    $page_data['page_title'] = get_phrase('manage_authors');
    $this->load->view('backend/index', $page_data);
}


/* * ********MANAGE DORMITORY / HOSTELS / ROOMS ******************* */

function dormitory($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
   
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['hostel_room_id'] = $this->input->post('hostel_room_id');
        $data['hostel_category_id'] = $this->input->post('hostel_category_id');
        $data['capacity'] = $this->input->post('capacity');
        $data['address'] = $this->input->post('address');
        $data['description'] = $this->input->post('description');
        $this->db->insert('dormitory', $data);
        if($this->session->userdata('redir_page')){
			$this->session->set_userdata(array('rdirect' =>'yes' ));
		}
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
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
        redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('dormitory', array(
                    'dormitory_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('dormitory_id', $param2);
        $this->db->delete('dormitory');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
    }
    if($param1 == 'student_add'){
		$this->session->set_userdata(array('redir_page' =>$param1 ));
	}
    $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
    $page_data['page_name'] = 'dormitory';
    $page_data['page_title'] = get_phrase('manage_dormitory');
    $this->load->view('backend/index', $page_data);
     if($this->session->userdata('rdirect') =='yes'){
		redirect(base_url() . 'index.php?admin/'.$this->session->userdata('redir_page'), 'refresh');
	}
}


/* * *MANAGE HOSTEL CATEGPRY* */

function hostel_category($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $this->db->insert('hostel_category', $data);
        $this->session->set_flashdata('flash_message', get_phrase('category_added_successfully'));
        redirect(base_url() . 'index.php?admin/hostel_category', 'refresh');
    }
   
    if ($param1 == 'delete') {
        $this->db->where('hostel_category_id', $param2);
        $this->db->delete('hostel_category');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/hostel_category', 'refresh');
    }
    $page_data['hostel_categorys'] = $this->db->get('hostel_category')->result_array();
    $page_data['page_name'] = 'hostel_category';
    $page_data['page_title'] = get_phrase('manage_hostel_category');
    $this->load->view('backend/index', $page_data);
}


/* * *MANAGE ROOM TYPE PAGE* */

function room_type($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $this->db->insert('room_type', $data);
        $this->session->set_flashdata('flash_message', get_phrase('room_type_added_successfully'));
        redirect(base_url() . 'index.php?admin/room_type', 'refresh');
    }
   
    if ($param1 == 'delete') {
        $this->db->where('room_type_id', $param2);
        $this->db->delete('room_type');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/room_type', 'refresh');
    }
    $page_data['room_types'] = $this->db->get('room_type')->result_array();
    $page_data['page_name'] = 'room_type';
    $page_data['page_title'] = get_phrase('manage_room_type');
    $this->load->view('backend/index', $page_data);
}

/* * *MANAGE HOSTEL ROOM PAGE* */

	function hostel_room($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] 		= $this->input->post('name');
		$data['room_type_id'] 	= $this->input->post('room_type_id');
        $data['num_bed'] 		= $this->input->post('num_bed');
        $data['cost_bed']	 	= $this->input->post('cost_bed');
		$data['description'] 	= $this->input->post('description');
        $this->db->insert('hostel_room', $data);
        $this->session->set_flashdata('flash_message', get_phrase('hostel_room_added_successfully'));
        redirect(base_url() . 'index.php?admin/hostel_room', 'refresh');
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
        redirect(base_url() . 'index.php?admin/hostel_room', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('hostel_room', array(
                    'hostel_room_id' => $param2
                ))->result_array();
    }

    if ($param1 == 'delete') {
        $this->db->where('hostel_room_id', $param2);
        $this->db->delete('hostel_room');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/hostel_room', 'refresh');
    }
    $page_data['hostel_rooms'] = $this->db->get('hostel_room')->result_array();
    $page_data['page_name'] = 'hostel_room';
    $page_data['page_title'] = get_phrase('manage_hostel_room');
    $this->load->view('backend/index', $page_data);
}


/* * *MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD* */

function noticeboard($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($param1 == 'create') {
        $data['notice_title'] = $this->input->post('notice_title');
        $data['notice'] = $this->input->post('notice');
        $data['location'] = $this->input->post('location');
        $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
        $this->db->insert('noticeboard', $data);

        $check_sms_send = $this->input->post('check_sms');

        if ($check_sms_send == 1) {
            // sms sending configurations

            $parents = $this->db->get('parent')->result_array();
            $students = $this->db->get('student')->result_array();
            $teachers = $this->db->get('teacher')->result_array();
            $date = $this->input->post('create_timestamp');
            $message = $data['notice_title'] . ' ';
            $message .= get_phrase('on') . ' ' . $date;
            foreach ($parents as $row) {
                $reciever_phone = $row['phone'];
                $this->sms_model->send_sms($message, $reciever_phone);
            }
            foreach ($students as $row) {
                $reciever_phone = $row['phone'];
                $this->sms_model->send_sms($message, $reciever_phone);
            }
            foreach ($teachers as $row) {
                $reciever_phone = $row['phone'];
                $this->sms_model->send_sms($message, $reciever_phone);
            }
        }

        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['notice_title'] = $this->input->post('notice_title');
        $data['notice'] = $this->input->post('notice');
		$data['location'] = $this->input->post('location');
        $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
        $this->db->where('notice_id', $param2);
        $this->db->update('noticeboard', $data);

        $check_sms_send = $this->input->post('check_sms');

        if ($check_sms_send == 1) {
            // sms sending configurations

            $parents = $this->db->get('parent')->result_array();
            $students = $this->db->get('student')->result_array();
            $teachers = $this->db->get('teacher')->result_array();
            $date = $this->input->post('create_timestamp');
            $message = $data['notice_title'] . ' ';
            $message .= get_phrase('on') . ' ' . $date;
            foreach ($parents as $row) {
                $reciever_phone = $row['phone'];
                $this->sms_model->send_sms($message, $reciever_phone);
            }
            foreach ($students as $row) {
                $reciever_phone = $row['phone'];
                $this->sms_model->send_sms($message, $reciever_phone);
            }
            foreach ($teachers as $row) {
                $reciever_phone = $row['phone'];
                $this->sms_model->send_sms($message, $reciever_phone);
            }
        }

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                    'notice_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('notice_id', $param2);
        $this->db->delete('noticeboard');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
    }
    $page_data['page_name'] = 'noticeboard';
    $page_data['page_title'] = get_phrase('manage_noticeboard');
    $page_data['notices'] = $this->db->get('noticeboard')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* private messaging */

function message($param1 = 'message_home', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($param1 == 'send_new') {
        $message_thread_code = $this->crud_model->send_new_private_message();
        $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
        redirect(base_url() . 'index.php?admin/message/message_read/' . $message_thread_code, 'refresh');
    }

    if ($param1 == 'send_reply') {
        $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
        $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
        redirect(base_url() . 'index.php?admin/message/message_read/' . $param2, 'refresh');
    }

    if ($param1 == 'message_read') {
        $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
        $this->crud_model->mark_thread_messages_read($param2);
    }

    $page_data['message_inner_page_name'] = $param1;
    $page_data['page_name'] = 'message';
    $page_data['page_title'] = get_phrase('private_messaging');
    $this->load->view('backend/index', $page_data);
}

/* * ***SITE/SYSTEM SETTINGS******** */

function system_settings($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');

    if ($param1 == 'do_update') {

        $data['description'] = $this->input->post('system_name');
        $this->db->where('type', 'system_name');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_title');
        $this->db->where('type', 'system_title');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('address');
        $this->db->where('type', 'address');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('phone');
        $this->db->where('type', 'phone');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('paypal_email');
        $this->db->where('type', 'paypal_email');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('currency');
        $this->db->where('type', 'currency');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_email');
        $this->db->where('type', 'system_email');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_name');
        $this->db->where('type', 'system_name');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('language');
        $this->db->where('type', 'language');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('text_align');
        $this->db->where('type', 'text_align');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('running_session');
        $this->db->where('type', 'session');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('tawkto');
        $this->db->where('type', 'tawkto');
        $this->db->update('settings', $data);
		
	    $data['description'] = $this->input->post('system_footer');
        $this->db->where('type', 'footer');
        $this->db->update('settings', $data);

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/system_settings', 'refresh');
    }
    if ($param1 == 'upload_logo') {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(base_url() . 'index.php?admin/system_settings', 'refresh');
    }
    if ($param1 == 'change_skin') {
        $data['description'] = $param2;
        $this->db->where('type', 'skin_colour');
        $this->db->update('settings', $data);
        $this->session->set_flashdata('flash_message', get_phrase('theme_selected'));
        redirect(base_url() . 'index.php?admin/system_settings', 'refresh');
    }
    $page_data['page_name'] = 'system_settings';
    $page_data['page_title'] = get_phrase('system_settings');
    $page_data['settings'] = $this->db->get('settings')->result_array();
    $this->load->view('backend/index', $page_data);
}


/* * *** UPDATE PRODUCT **** */

function update($task = '', $purchase_code = '') {

    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    // Create update directory.
    $dir = 'update';
    if (!is_dir($dir))
        mkdir($dir, 0777, true);

    $zipped_file_name = $_FILES["file_name"]["name"];
    $path = 'update/' . $zipped_file_name;

    move_uploaded_file($_FILES["file_name"]["tmp_name"], $path);

    // Unzip uploaded update file and remove zip file.
    $zip = new ZipArchive;
    $res = $zip->open($path);
    if ($res === TRUE) {
        $zip->extractTo('update');
        $zip->close();
        unlink($path);
    }

    $unzipped_file_name = substr($zipped_file_name, 0, -4);
    $str = file_get_contents('./update/' . $unzipped_file_name . '/update_config.json');
    $json = json_decode($str, true);



    // Run php modifications
    require './update/' . $unzipped_file_name . '/update_script.php';

    // Create new directories.
    if (!empty($json['directory'])) {
        foreach ($json['directory'] as $directory) {
            if (!is_dir($directory['name']))
                mkdir($directory['name'], 0777, true);
        }
    }

    // Create/Replace new files.
    if (!empty($json['files'])) {
        foreach ($json['files'] as $file)
            copy($file['root_directory'], $file['update_directory']);
    }

    $this->session->set_flashdata('flash_message', get_phrase('product_updated_successfully'));
    redirect(base_url() . 'index.php?admin/system_settings');
}

/* * ***SMS SETTINGS******** */

function sms_settings($param1 = '', $param2 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');
    if ($param1 == 'clickatell') {

        $data['description'] = $this->input->post('clickatell_user');
        $this->db->where('type', 'clickatell_user');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('clickatell_password');
        $this->db->where('type', 'clickatell_password');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('clickatell_api_id');
        $this->db->where('type', 'clickatell_api_id');
        $this->db->update('settings', $data);

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
    }

    if ($param1 == 'twilio') {

        $data['description'] = $this->input->post('twilio_account_sid');
        $this->db->where('type', 'twilio_account_sid');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('twilio_auth_token');
        $this->db->where('type', 'twilio_auth_token');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('twilio_sender_phone_number');
        $this->db->where('type', 'twilio_sender_phone_number');
        $this->db->update('settings', $data);

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
    }
	
	if ($param1 == 'smsteams') {

        $data['description'] = $this->input->post('smsteams_username');
        $this->db->where('type', 'smsteams_username');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('smsteams_password');
        $this->db->where('type', 'smsteams_password');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('smsteams_api_id');
        $this->db->where('type', 'smsteams_api_id');
        $this->db->update('settings', $data);

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
    }

    if ($param1 == 'active_service') {

        $data['description'] = $this->input->post('active_sms_service');
        $this->db->where('type', 'active_sms_service');
        $this->db->update('settings', $data);

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
    }

    $page_data['page_name'] = 'sms_settings';
    $page_data['page_title'] = get_phrase('sms_gateway_information');
    $page_data['settings'] = $this->db->get('settings')->result_array();
    $this->load->view('backend/index', $page_data);
}

/* ****LANGUAGE SETTINGS******** */

function manage_language($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');

    if ($param1 == 'edit_phrase') {
        $page_data['edit_profile'] = $param2;
    }
    if ($param1 == 'update_phrase') {
        $language = $param2;
        $total_phrase = $this->input->post('total_phrase');
        for ($i = 1; $i < $total_phrase; $i++) {
            //$data[$language]	=	$this->input->post('phrase').$i;
            $this->db->where('phrase_id', $i);
            $this->db->update('language', array($language => $this->input->post('phrase' . $i)));
        }
        redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/' . $language, 'refresh');
    }
    if ($param1 == 'do_update') {
        $language = $this->input->post('language');
        $data[$language] = $this->input->post('phrase');
        $this->db->where('phrase_id', $param2);
        $this->db->update('language', $data);
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    }
    if ($param1 == 'add_phrase') {
        $data['phrase'] = $this->input->post('phrase');
        $this->db->insert('language', $data);
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    }
    if ($param1 == 'add_language') {
        $language = $this->input->post('language');
        $this->load->dbforge();
        $fields = array(
            $language => array(
                'type' => 'LONGTEXT'
            )
        );
        $this->dbforge->add_column('language', $fields);

        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    }
    if ($param1 == 'delete_language') {
        $language = $param2;
        $this->load->dbforge();
        $this->dbforge->drop_column('language', $language);
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

        redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    }
    $page_data['page_name'] = 'manage_language';
    $page_data['page_title'] = get_phrase('manage_language');
    //$page_data['language_phrases'] = $this->db->get('language')->result_array();
    $this->load->view('backend/index', $page_data);
}


/* * ********MANAGE EMAIL TEMPLATE******************* */

function email_template($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['email_type'] = $this->input->post('email_type');
        $data['subject'] = $this->input->post('subject');
        $data['from_email'] = $this->input->post('from_email');
        $data['from_name'] = $this->input->post('from_name');
        $data['email_content'] = $this->input->post('email_content');
        $data['date'] = $this->input->post('date');
       
        $this->db->insert('email_template', $data);
		$email_template_id = $this->db->insert_id();
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/email_template', 'refresh');
    }
    if ($param1 == 'do_update') {
       $data['email_type'] 			= $this->input->post('email_type');
       $data['subject'] 			= $this->input->post('subject');
       $data['from_email'] 			= $this->input->post('from_email');
       $data['from_name'] 			= $this->input->post('from_name');
       $data['email_content'] 		= $this->input->post('email_content');
       $data['date'] 				= $this->input->post('date');

        $this->db->where('email_template_id', $param2);
        $this->db->update('email_template', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/email_template', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('email_template', array(
                    'email_template_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('email_template_id', $param2);
        $this->db->delete('email_template');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/email_template', 'refresh');
    }
    $page_data['email_templates'] = $this->db->get('email_template')->result_array();
    $page_data['page_name'] = 'email_template';
    $page_data['page_title'] = get_phrase('manage_email_template');
    $this->load->view('backend/index', $page_data);
}


/* * ********MANAGE SIDEBAR ACTIONS ******************* */

function actions($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['action_name'] 		= $this->input->post('action_name');
        $data['display']		 	= $this->input->post('display');
        $data['parent_name'] 		= $this->input->post('parent_name');
        $data['parent_key'] 		= $this->input->post('parent_key');
       
        $this->db->insert('actions', $data);
		$action_id = $this->db->insert_id();
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/actions', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['action_name'] 		= $this->input->post('action_name');
        $data['display']		 	= $this->input->post('display');
        $data['parent_name'] 		= $this->input->post('parent_name');
        $data['parent_key'] 		= $this->input->post('parent_key');

        $this->db->where('action_id', $param2);
        $this->db->update('actions', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/actions', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('actions', array(
                    'action_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('action_id', $param2);
        $this->db->delete('actions');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/actions', 'refresh');
    }
    $page_data['actionss'] = $this->db->get('actions')->result_array();
    $page_data['page_name'] = 'actions';
    $page_data['page_title'] = get_phrase('manage_actions');
    $this->load->view('backend/index', $page_data);
}





/* * ***BACKUP / RESTORE / DELETE DATA PAGE********* */

function backup_restore($operation = '', $type = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($operation == 'create') {
        $this->crud_model->create_backup($type);
    }
    if ($operation == 'restore') {
        $this->crud_model->restore_backup();
        $this->session->set_flashdata('backup_message', 'Backup Restored');
        redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
    }
    if ($operation == 'delete') {
        $this->crud_model->truncate($type);
        $this->session->set_flashdata('backup_message', 'Data removed');
        redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
    }

    $page_data['page_info'] = 'Create backup / restore from backup';
    $page_data['page_name'] = 'backup_restore';
    $page_data['page_title'] = get_phrase('manage_backup_restore');
    $this->load->view('backend/index', $page_data);
}



/* * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

function manage_profile($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');
    if ($param1 == 'update_profile_info') {
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');

        $this->db->where('admin_id', $this->session->userdata('admin_id'));
        $this->db->update('admin', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
        redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
    }
    if ($param1 == 'change_password') {
        $data['password'] = $this->input->post('password');
        $data['new_password'] = $this->input->post('new_password');
        $data['confirm_new_password'] = $this->input->post('confirm_new_password');

        $current_password = $this->db->get_where('admin', array(
                    'admin_id' => $this->session->userdata('admin_id')
                ))->row()->password;
        if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', array(
                'password' => $data['new_password']
            ));
            $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
        } else {
            $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
        }
        redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
    }
    $page_data['page_name'] = 'manage_profile';
    $page_data['page_title'] = get_phrase('manage_profile');
    $page_data['edit_data'] = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->result_array();
    $this->load->view('backend/index', $page_data);
}

/* * ****MANAGE STUDENT PROMOTION** */

function student_promotion($from_class = '', $to_class = '', $from_section = '', $to_section = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
	 if ($_POST) {
        $from_class = $this->input->post('from_class');
        $from_section = $this->input->post('from_section');
        $to_class = $this->input->post('to_class');
        $to_section = $this->input->post('to_section');
        //redirect(base_url() . 'index.php?admin/student_promotion/' . $from_class . '/' . $to_class.'/'. $from_section.'/'.$to_section, 'refresh');
        redirect(base_url() . 'index.php?admin/student_promotion/' . $from_class . '/' . $to_class, 'refresh');
    }
    $page_data['from_class'] = $from_class;
    $page_data['from_section'] = $from_section;
    $page_data['to_class'] = $to_class;
    $page_data['to_section'] = $to_section;
    $page_data['page_name'] = 'student_promotion';
    $page_data['page_title'] = get_phrase('student_promotion');
    $this->load->view('backend/index', $page_data);
}

/* * ****MANAGE ENROLLMENT***** */

function manage_enrollment() {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $from_class = $this->input->post('from_class');
    $to_class = $this->input->post('to_classes');
    //$students = $this->db->get_where('student', array('class_id' => $from_class))->result_array();
    $students = $this->input->post('bulk_id');
   
    foreach ($students as $row) {
        $student_id = $row;
        

        if (isset($to_class)) {
            $verify_data = array('student_id' => $row['student_id'], 'from_class_id' => $from_class, 'to_class_id' => $to_class);
            $query = $this->db->get_where('enroll', $verify_data);
            if ($query->num_rows() < 1) {
                $this->db->insert('enroll', $verify_data);
            } else {
                $this->db->where('student_id', $student_id);
                $this->db->where('from_class_id', $from_class);
                $this->db->where('to_class_id', $to_class);
              //  $this->db->where('from_section_id', $from_sections);
                $this->db->update('enroll', $verify_data);
            }
            $this->db->where('student_id', $student_id);
            $this->db->update('student', array('class_id'=>$to_class));
        }
    }

    $this->session->set_flashdata('flash_message', get_phrase('new_enrollment_successful'));
    redirect(base_url() . 'index.php?admin/student_promotion', 'refresh');

    $page_data['page_name'] = 'student_promotion';
    $page_data['page_title'] = get_phrase('student_promotion');
    $this->load->view('backend/index', $page_data);
}

/* * ****ID CARD FOR STUDENTS** */

function id_card($student_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($this->input->post('hidden') == 'photo_submit') {
        $student_id = $this->input->post('student');
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('photo_added_successfully'));
        redirect(base_url() . 'index.php?admin/id_card/' . $student_id, 'refresh');
    }
    $page_data['student_id'] = $student_id;
    $page_data['page_name'] = 'id_card';
    $page_data['page_title'] = get_phrase('STUDENTS ID CARD');
    $this->load->view('backend/index', $page_data);
}


/* * **MANAGE SWITCH CLASS**** */
function switch_class($param1 = ''){
	if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($this->input->post('operation') == 'selection'){
		$page_data['class_id'] = $this->input->post('class_id');
		if ($page_data['class_id'] > 0 ) {
			redirect(base_url() . 'index.php?admin/switch_class/' . $page_data['class_id'], 'refresh');
		}else {
			$this->session->set_flashdata('info', 'please_select_student');
			redirect(base_url() . 'index.php?admin/switch_class/', 'refresh');
		}
	}    
	 if ($param1 == 'update') {
        
        $class_stu = $this->input->post('student_ids');
        foreach($class_stu as $student_ids){
            if ($this->input->post('class_id1') < 40 && $this->input->post('class_id1') > 28){
		        $data['class_id'] = $this->input->post('class_ids');
                $this->db->where('student_id', $student_ids);
                $this->db->where('class_id', $this->input->post('class_id1'));
                $this->db->update('student', $data);

                $this->db->where('student_id', $student_ids);
                $this->db->where('class_id', $this->input->post('class_id1'));
                $this->db->where('session_year', $this->input->post('session_year'));
                $this->db->update('comments', $data);

                $this->db->where('student_id', $student_ids);
                $this->db->where('class_id', $this->input->post('class_id1'));
                $this->db->where('session_year', $this->input->post('session_year'));
                $this->db->update('comments0', $data);

                $this->db->where('student_id', $student_ids);
                $this->db->where('class_id', $this->input->post('class_id1'));
                $this->db->where('session_year', $this->input->post('session_year'));
                $this->db->update('mark', $data);

                $this->db->where('student_id', $student_ids);
                $this->db->where('class_id', $this->input->post('class_id1'));
                $this->db->where('session_year', $this->input->post('session_year'));
                $this->db->update('mark0', $data);

                $this->db->where('student_id', $student_ids);
                $this->db->where('class_id', $this->input->post('class_id1'));
                $this->db->where('session_year', $this->input->post('session_year'));
                $this->db->update('Remark', $data);

                $this->db->where('student_id', $student_ids);
                $this->db->where('class_id', $this->input->post('class_id1'));
                $this->db->where('session_year', $this->input->post('session_year'));
                $this->db->update('Remark0', $data);

                $this->db->where('student_id', $student_ids);
                $this->db->where('class_id', $this->input->post('class_id1'));
                $this->db->update('class_subject', $data);
            }
        }
        
        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(base_url() . 'index.php?admin/switch_class/', 'refresh');
    }
    $page_data['class_id'] = $param1;
	$page_data['classes'] = $this->db->get('class')->result_array();
    $page_data['page_name'] = 'switch_class';
    $page_data['page_title'] = get_phrase('manage_student_class');
    $this->load->view('backend/index', $page_data);
}


/* * ****MANAGE REPORTS** */

function manage_report($manage_report = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
   
    //$page_data['student_id'] = $student_id;
    $page_data['page_name'] = 'manage_report';
    $page_data['page_title'] = get_phrase('manage_reports');
    $this->load->view('backend/index', $page_data);
}


/* * ****MANAGE DOCUMENTATION** */

function documentation($documentation = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
   
    //$page_data['student_id'] = $student_id;
    $page_data['page_name'] = 'documentation';
    $page_data['page_title'] = get_phrase('documentation');
    $this->load->view('backend/index', $page_data);
}


/* * ****STUDENT CLASS WISE* 

function student_class($student_class = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
   
    //$page_data['student_id'] = $student_id;
    $page_data['page_name'] = 'student_class';
    $page_data['page_title'] = get_phrase('student_class');
    $this->load->view('backend/index', $page_data);
}*/


/* * ****VIEW STUDENT INFORMATION PAGE** */

	function view_student($student_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
		
		
   
	$class_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->class_id;
    $student_name = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
    $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;    
	$page_data['page_name'] = 'view_student';
        $page_data['page_title'] = get_phrase('student_information_page');
        $page_data['student_id'] = $student_id;
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/index', $page_data);
}


/* * ****MANAGE PAYMENT REPORT** */
function payment_report($from = '', $to = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($this->input->post('operation') == 'selection') 
	{
        $page_data['from'] = $this->input->post('from');
        $page_data['to'] = $this->input->post('to');


        if ($page_data['from'] > 0 && $page_data['to'] > 0 ) 
		{
            redirect(base_url() . 'index.php?admin/payment_report/' . $page_data['from'] . '/' . $page_data['to'], 'refresh');
        } 
		else 
		{
            $this->session->set_flashdata('payment_info', 'please_select_date_range_and_status');
            redirect(base_url() . 'index.php?admin/payment_report/', 'refresh');
        }
    }
	
	$page_data['from'] = $from;
    $page_data['to'] = $to;
    $page_data['page_info'] = 'Payment Report';

    $page_data['page_name'] = 'payment_report';
    $page_data['page_title'] = get_phrase('payment_report');
    $this->load->view('backend/index', $page_data);
}


/* * ****MANAGE EXPENSE REPORT** */
function expense_report($from = '', $to = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($this->input->post('operation') == 'selection') 
	{
        $page_data['from'] = $this->input->post('from');
        $page_data['to'] = $this->input->post('to');

        if ($page_data['from'] > 0 && $page_data['to'] > 0 ) 
		{
            redirect(base_url() . 'index.php?admin/expense_report/' . $page_data['from'] . '/' . $page_data['to'], 'refresh');
        } 
		else 
		{
            $this->session->set_flashdata('expense_info', 'please_select_date_range_and_status');
            redirect(base_url() . 'index.php?admin/expense_report/', 'refresh');
        }
    }
	
	$page_data['from'] = $from;
    $page_data['to'] = $to;
    $page_data['page_info'] = 'Expense Report';

    $page_data['page_name'] = 'expense_report';
    $page_data['page_title'] = get_phrase('expense_report');
    $this->load->view('backend/index', $page_data);
}


/* * ****MANAGE SEARCH STUDENT PAGE** */
function search_student($class_id = '', $param2 = '', $sparam3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($this->input->post('operation') == 'selection') 
	{
        $page_data['class_id'] = $this->input->post('class_id');

        if ($page_data['class_id'] > 0 ) 
		{
            redirect(base_url() . 'index.php?admin/search_student/' . $page_data['class_id'], 'refresh');
        } 
		else 
		{
            $this->session->set_flashdata('info', 'please_select_class');
            redirect(base_url() . 'index.php?admin/search_student/', 'refresh');
        }
    }
	
	$page_data['class_id'] = $class_id;
    $page_data['page_info'] = 'search_student';

    $page_data['page_name'] = 'search_student';
    $page_data['page_title'] = get_phrase('issue_library_card_number');
    $this->load->view('backend/index', $page_data);
}


/* * ****MANAGE SEARCH STUDENT PAGE** */
function student_report($class_id = '', $param2 = '', $sparam3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($this->input->post('operation') == 'selection') 
	{
        $page_data['class_id'] = $this->input->post('class_id');

        if ($page_data['class_id'] > 0 ) 
		{
            redirect(base_url() . 'index.php?admin/student_report/' . $page_data['class_id'], 'refresh');
        } 
		else 
		{
            $this->session->set_flashdata('info', 'please_select_class');
            redirect(base_url() . 'index.php?admin/student_report/', 'refresh');
        }
    }
	
	$page_data['class_id'] = $class_id;
    $page_data['page_info'] = 'student_report';

    $page_data['page_name'] = 'student_report';
    $page_data['page_title'] = get_phrase('student_reports');
    $this->load->view('backend/index', $page_data);
}
	

/* * ****MANAGE LOAN REPORT** */
function loan_report($from = '', $to = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($this->input->post('operation') == 'selection') 
	{
        $page_data['from'] = $this->input->post('from');
        $page_data['to'] = $this->input->post('to');

        if ($page_data['from'] > 0 && $page_data['to'] > 0 ) 
		{
            redirect(base_url() . 'index.php?admin/loan_report/' . $page_data['from'] . '/' . $page_data['to'], 'refresh');
        } 
		else 
		{
            $this->session->set_flashdata('expense_info', 'please_select_date_range');
            redirect(base_url() . 'index.php?admin/loan_report/', 'refresh');
        }
    }
	
	$page_data['from'] = $from;
    $page_data['to'] = $to;
    $page_data['page_info'] = 'Expense Report';

    $page_data['page_name'] = 'loan_report';
    $page_data['page_title'] = get_phrase('loan_report');
    $this->load->view('backend/index', $page_data);
}


/* * ****ID CARD FOR TEACHER** */
function teacher_id_card($teacher_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($this->input->post('hidden') == 'photo_submit') {
        $student_id = $this->input->post('teacher');
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('photo_added_successfully'));
        redirect(base_url() . 'index.php?admin/teacher_id_card/' . $student_id, 'refresh');
    }
    $page_data['teacher_id'] = $teacher_id;
    $page_data['page_name'] = 'teacher_id_card';
    $page_data['page_title'] = get_phrase('TEACHERS ID CARD');
    $this->load->view('backend/index', $page_data);
}

/* * ****ID CARD FOR HOSTEL MANAGER** */

function hostel_id_card($hostel_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($this->input->post('hidden') == 'photo_submit') {
        $student_id = $this->input->post('teacher');
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hostel_image/' . $teacher_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('photo_added_successfully'));
        redirect(base_url() . 'index.php?admin/hostel_id_card/' . $student_id, 'refresh');
    }
    $page_data['hostel_id'] = $hostel_id;
    $page_data['page_name'] = 'hostel_id_card';
    $page_data['page_title'] = get_phrase('HOSTEL MANAGERS ID CARD');
    $this->load->view('backend/index', $page_data);
}

/* * ****ID CARD FOR ACCOUNTANT** */

function accountant_id_card($accountant_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($this->input->post('hidden') == 'photo_submit') {
        $student_id = $this->input->post('accountant');
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/accountant_image/' . $accountant_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('photo_added_successfully'));
        redirect(base_url() . 'index.php?admin/accountant_id_card/' . $student_id, 'refresh');
    }
    $page_data['accountant_id'] = $accountant_id;
    $page_data['page_name'] = 'accountant_id_card';
    $page_data['page_title'] = get_phrase('ACCOUNTANTS ID CARD');
    $this->load->view('backend/index', $page_data);
}

/* * ****ID CARD FOR LIBRARIAN** */

function librarian_id_card($librarian_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($this->input->post('hidden') == 'photo_submit') {
        $student_id = $this->input->post('accountant');
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/librarian_image/' . $librarian_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('photo_added_successfully'));
        redirect(base_url() . 'index.php?admin/librarian_id_card/' . $student_id, 'refresh');
    }
    $page_data['page_name'] = 'librarian_id_card';
    $page_data['page_title'] = get_phrase('LIBRARIANS ID CARD');
    $this->load->view('backend/index', $page_data);
}



// function id_card_photo()
// {
//     if ($this->session->userdata('admin_login') != 1)
//         redirect(base_url(), 'refresh');
//     if ($this->input->post('hidden') == 'photo_submit') {
//         // $student_id  =   $this->input->post('student');
//         $student_id = "8";
//         move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/8.jpg');
//         $this->session->set_flashdata('flash_message' , get_phrase('photo_added_successfully'));
//         redirect(base_url() . 'index.php?admin/id_card/'.$student_id, 'refresh');
//     }
// }
// CBT CUSTOMISATION STARTS FROM HERE
function exam_list($class_id, $subject_id, $duration, $date, $session = '', $mode = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');

    if ($mode == 'delete') {
        if ($session == '%null')
            $session = '';
        $sql = "select question_id from question where class_id=" . $class_id . " and subject_id=" . $subject_id . " and duration='" . $duration . "' and date='" . $date . "' and session='" . $session . "'";
        $result = $this->db->query($sql)->result_array();

        $sql = "delete from answer where question_id in (";
        foreach ($result as $row) {
            $in_sql .= "," . $row["question_id"];
        }
        $in_sql = substr($in_sql, 1);
        $sql .= $in_sql . ")";
        $this->db->query($sql);

        $sql = "delete from question where class_id=" . $class_id . " and subject_id=" . $subject_id . " and duration='" . $duration . "' and date='" . $date . "' and session='" . $session . "'";
        $this->db->query($sql);
    }

    $page_data['page_name'] = 'exam_list';
    $page_data['page_title'] = get_phrase('exam_list');

    $query = "select a.*, b.name class_name, c.name subject_name from question a "
            . "inner join class b on a.class_id=b.class_id "
            . "inner join subject c on a.subject_id=c.subject_id "
            . "group by a.class_id, a.subject_id, a.date, a.duration, a.session "
            . "order by a.class_id, a.subject_id, a.date, a.question_id";
    $question_data = $this->db->query($query)->result();
    $page_data['question_data'] = $question_data;
    $this->load->view('backend/index', $page_data);
}

function exam_view($class_id, $subject_id, $duration, $date, $session = '', $mode = '', $question_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');

    $mode1 = $this->input->post('mode1');

    if ($session == '%null') {
        $session = '';
    }
    if ($mode == 'save') {
//        $question_id = $this->input->post('question_id');
        $data = array();
        $data['question'] = $this->input->post('question');
        $data["correct_answers"] = $this->input->post('correct_answers');
        $this->db->where('question_id', $question_id);
        $this->db->update('question', $data);

        $answers = $this->input->post('answers');
        for ($i = 0; $i < sizeof($answers); $i++) {
            $data = array();
            $this->db->where('question_id', $question_id);
            $ascii_A = ord('A');
            $this->db->where('label', chr($ascii_A + $i));
            $data["content"] = $answers[$i];
            $this->db->update('answer', $data);
        }
    } else if ($mode == 'delete') {
        $this->db->where('question_id', $question_id);
        $this->db->delete('question');
    } else if ($mode1 == 'save_exam') {
        $class_id = $this->input->post('class_id');
        $subject_id = $this->input->post('subject_id');
        $duration = $this->input->post('duration');
        $date = date("Y-m-d", strtotime($this->input->post('date')));
        $session = $this->input->post('session');
        $question_count = $this->input->post('question_count');

        $usersession = $this->session->userdata('exam_data');

        $this->db->where('class_id', $usersession['class_id']);
        $this->db->where('subject_id', $usersession['subject_id']);
        $this->db->where('duration', $usersession['duration']);
        $this->db->where('date', $usersession['date']);
        $this->db->where('session', $usersession['session']);
        $this->db->update('question', array('class_id' => $class_id, 'subject_id' => $subject_id, 'duration' => $duration, 'date' => $date, 'session' => $session, 'question_count' => $question_count));
    }

    if ($session == '%null')
        $session = '';
    $sql = "select max(b.label) as max_label from question a "
            . "inner join answer b on a.question_id=b.question_id "
            . "where a.class_id=" . $class_id . " and a.subject_id=" . $subject_id . " and a.session='" . $session . "' and a.duration='" . $duration . "' and a.date='" . $date . "'";
    $result = $this->db->query($sql)->result_array();
    $page_data['max_label'] = $result[0]['max_label'];

    $sql = "select * from question "
            . "where class_id=" . $class_id . " and subject_id=" . $subject_id . " and session='" . $session . "' and duration='" . $duration . "' and date='" . $date . "'";
    $exam_list = $this->db->query($sql)->result_array();
    $exam_data = array();
    $question_count = 0;
    foreach ($exam_list as $row) {
        $exam = array();
        $exam['question_id'] = $row['question_id'];
        $exam['class_id'] = $row['class_id'];
        $exam['subject_id'] = $row['subject_id'];
        $exam['date'] = $row['date'];
        $exam['session'] = $row['session'];
        $exam['duration'] = $row['duration'];
        $exam['question'] = $row['question'];
        $exam['correct_answers'] = $row['correct_answers'];
        $question_count = $row['question_count'];

        $sql = "select * from answer where question_id=" . $row['question_id'] . " order by label";
        $result = $this->db->query($sql)->result_array();
        foreach ($result as $row1) {
            $exam[$row1['label']] = $row1['content'];
        }
        array_push($exam_data, $exam);
    }
    $page_data['class_id'] = $class_id;
    $page_data['subject_id'] = $subject_id;
    $page_data['duration'] = $duration;

    $dates = explode('-', $date);
    $y = $dates[0];
    $m = $dates[1];
    $d = $dates[2];
    $page_data['date'] = $m . '/' . $d . '/' . $y;

    $page_data['session'] = $session;
    $page_data['question_count'] = $question_count;
    $page_data['classes'] = $this->db->get('class')->result_array();
    $page_data['subjects'] = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
    $page_data['exam_data'] = $exam_data;

    $session_data = $page_data;
    $session_data['date'] = $date;

    $page_data['page_name'] = 'exam_view';
    $page_data['page_title'] = get_phrase('view_exam');
    $this->session->set_userdata('exam_data', $session_data);
    $this->load->view('backend/index', $page_data);
}

function exam_add($param1 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    $page_data['error'] = 0;
    if ($param1 == 'error') {
        $page_data['error'] = 1;
    }
    $page_data['page_name'] = 'exam_add';
    $page_data['page_title'] = get_phrase('add_exam');
    $page_data['classes'] = $this->db->get('class')->result_array();
    $page_data['subjects'] = $this->db->get_where('subject', array('class_id' => $param1))->result_array();
    $this->load->view('backend/index', $page_data);
}

function exams($param1 = '') {
    if ($param1 == 'create') {
        $date = date("Y-m-d", strtotime($this->input->post('date')));
        $sql = "select if(count(question_id)>0,true,false) isExam from question where class_id=" . $this->input->post('class_id') . " and subject_id=" . $this->input->post('subject_id') . " and date='$date'";
        $result = $this->db->query($sql)->result_array();
        $isExam = $result[0]['isExam'];
        if (!$isExam) {
            $this->session->set_userdata('exams_header_data', array(
                'class_id' => $this->input->post('class_id'),
                'subject_id' => $this->input->post('subject_id'),
                'date' => $date,
                'session' => $this->input->post('session'),
                'question_count' => $this->input->post('question_count'),
                'duration' => $this->input->post('duration')
            ));
        } else {
            redirect(base_url() . 'index.php?admin/exam_add/error', 'refresh');
        }
    } else if ($param1 == 'add') {
        $date = date("Y-m-d", strtotime($this->input->post('date')));
        $this->session->set_userdata('exams_header_data', array(
            'class_id' => $this->input->post('class_id'),
            'subject_id' => $this->input->post('subject_id'),
            'date' => $date,
            'session' => $this->input->post('session'),
            'question_count' => $this->input->post('question_count'),
            'duration' => $this->input->post('duration')
        ));
    } else if ($param1 == 'save') {
        $data = array();
        $userdatasession = $this->session->userdata('exams_header_data');
        $data["class_id"] = $userdatasession['class_id'];
        $data["subject_id"] = $userdatasession['subject_id'];
        $data["date"] = $userdatasession['date'];
        $data["session"] = $userdatasession['session'];
        $data["question_count"] = $userdatasession['question_count'];
        $data["duration"] = $userdatasession['duration'];
        $data["question"] = $this->input->post('question');
        $data["correct_answers"] = $this->input->post('correct_answers');
        $result = $this->db->query("select max(question_id) max_id from question")->result();
        $question_id = $result[0]->max_id;
        $data["question_id"] = $question_id + 1;
        $this->db->insert('question', $data);
        $answers = $this->input->post('answers');
        for ($i = 0; $i < sizeof($answers); $i++) {
            $data = array();
            $data["question_id"] = $question_id + 1;
            $data["content"] = $answers[$i];
            $ascii_A = ord('A');
            $data["label"] = chr($ascii_A + $i);
            $this->db->insert('answer', $data);
        }
    }

    $page_data['page_name'] = 'exam_create';
    $page_data['page_title'] = get_phrase('add_exam');
    $this->load->view('backend/index', $page_data);
}

function exam_result_list() {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');

    $mode = $this->input->post('mode');
    if ($mode == 'get_list') {
        $class_id = $this->input->post('class_id');
        $subject_id = $this->input->post('subject_id');

        $sql = "select b.class_id, b.name class, a.student_id, a.name student, c.subject_id, c.name subject, d.date, d.duration, d.session, "
                . "d.question_count, sum(if(e.answer=d.correct_answers, 1, 0)) marks from student a "
                . "left join class b on a.class_id=b.class_id "
                . "left join subject c on b.class_id=c.class_id "
                . "left join question d on a.class_id=d.class_id and c.subject_id=d.subject_id "
                . "LEFT JOIN exam_result e ON d.question_id=e.question_id AND a.`student_id`=e.`student_id` "
                . "where a.class_id=" . $class_id . " and c.subject_id=" . $subject_id . " "
                . "GROUP BY a.`student_id`, c.subject_id, d.date, d.duration, d.session "
                . "order by b.class_id, a.student_id, c.subject_id";
        $result = $this->db->query($sql)->result_array();
        exit(json_encode($result));
    }

    $page_data['classes'] = $this->db->get('class')->result_array();
    $page_data['page_name'] = 'exam_result_list';
    $page_data['page_title'] = get_phrase('exam_result');
    $this->load->view('backend/index', $page_data);
}

function exam_result_detail() {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');

    if (!$this->input->post('class_id') || !$this->input->post('subject_id') || !$this->input->post('student_id') || !$this->input->post('date')) {
        redirect(base_url() . 'index.php?admin/exam_result_list', 'refresh');
    }

    $class_id = $this->input->post('class_id');
    $subject_id = $this->input->post('subject_id');
    $student_id = $this->input->post('student_id');
    $duration = $this->input->post('duration');
    $session = $this->input->post('session');
    $date = $this->input->post('date');

    $sql = "select a.*, e.name student,f.name class, g.name subject,b.date, b.question, b.correct_answers, c.content as answer_content, d.content as correct_content, if(c.content=d.content, 1, 0) marks, b.question_count "
            . "from exam_result a "
            . "inner join question b on a.question_id=b.question_id "
            . "inner join answer c on a.question_id=c.question_id and a.answer=c.label "
            . "inner join answer d on b.question_id=d.question_id and b.correct_answers=d.label "
            . "inner join student e on e.student_id=a.student_id "
            . "inner join class f on f.class_id=b.class_id "
            . "inner join subject g on g.subject_id=b.subject_id "
            . "where b.class_id=" . $class_id . " and b.subject_id=" . $subject_id
            . " and b.date='" . $date . "' and b.duration='" . $duration . "' "
            . "and b.session='" . $session . "' and a.student_id=" . $student_id;
    $page_data['detail_list'] = $this->db->query($sql)->result_array();

    $page_data['page_name'] = 'exam_result_detail';
    $page_data['page_title'] = get_phrase('exam_result');
    $this->load->view('backend/index', $page_data);
}

function admin_list() {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    $sql = "select * from admin order by admin_id";
    $page_data['admin_list'] = $this->db->query($sql)->result_array();

    $sql = "select * from actions order by action_id";
    $page_data['actions'] = $this->db->query($sql)->result_array();

    $sql = "select * from admin where admin_id=" . ($this->session->userdata('login_user_id'));
    $info = $this->db->query($sql)->result_array();
    $page_data['admin_info'] = $info[0];

    $page_data['page_name'] = 'admin_list';
    $page_data['page_title'] = get_phrase('admin_list');
    $this->load->view('backend/index', $page_data);
}

function admin_add() {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name'] = 'admin_add';
    $page_data['page_title'] = get_phrase('add_admin');
    $this->load->view('backend/index', $page_data);
}

function admins($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $data['level'] = $this->input->post('level');
        $this->db->insert('admin', $data);
        $admin_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $admin_id . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/admin_add', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $this->db->where('admin_id', $param2);
        $this->db->update('admin', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $param2 . '.jpg');
        $this->crud_model->clear_cache();
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?admin/admin_list/', 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('admin_id', $param2);
        $this->db->delete('admin');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/admin_list', 'refresh');
    }
}

function setPermission() {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');

    $admin_id = $this->input->post('admin_id');
    $action_ids = $this->input->post('action_id');

    if (sizeof($action_ids) > 0) {
        $this->db->where('admin_id', $admin_id);
        $this->db->delete('admin_permission');

        $values = '';
        foreach ($action_ids as $action_id) {
            $values.=",('" . $admin_id . "', '" . $action_id . "')";
        }
        $values = substr($values, 1);
        $sql = "insert into admin_permission(admin_id, action_id) values " . $values;
        $this->db->query($sql);
        redirect(base_url() . 'index.php?admin/admin_list', 'refresh');
    }
} 

function getPermission() {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');

    $admin_id = $this->input->post('admin_id');
    $sql = "select a.*, b.parent_key from admin_permission a"
            . " inner join actions b on a.action_id=b.action_id "
            . " where a.admin_id=" . $admin_id;
    $data = $this->db->query($sql)->result_array();
    echo json_encode($data);
}

}
