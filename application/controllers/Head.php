<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *	Author 			: Optimum Linkup Software
 *	date			: 27 June, 2017
 *	Website			:http://optimumlinkupsoftware.com/school
 *	Email			:info@optimumlinkupsoftware.com
 */


class Head extends CI_Controller
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
    
    /***default functin, redirects to login page if no head logged in yet***/
    public function index()
    {
        if ($this->session->userdata('head_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('head_login') == 1)
            redirect(base_url() . 'index.php?head/dashboard', 'refresh');
    }
    
    /***HEAD DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('head_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('head_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    
    /*ENTRY OF A NEW STUDENT*/
    
    
    /****MANAGE STUDENTS CLASSWISE*****/
    function student_add()
	{
		if ($this->session->userdata('head_login') != 1)
            redirect(base_url(), 'refresh');
			
		$page_data['page_name']  = 'student_add';
		$page_data['page_title'] = get_phrase('add_student');
		$this->load->view('backend/index', $page_data);
	}
	
	function student_information($class_id = '') {
       if ($this->session->userdata('head_login') != 1)
            redirect(base_url(), 'refresh');
			
			 if ($this->input->post('operation') == 'selection') 
	{
        $page_data['class_id'] = $this->input->post('class_id');

        if ($page_data['class_id'] > 0 ) 
		{
            redirect(base_url() . 'index.php?head/student_information/' . $page_data['class_id'], 'refresh');
        } 
		else 
		{
            $this->session->set_flashdata('info', 'please_select_class');
            redirect(base_url() . 'index.php?head/student_information/', 'refresh');
        }
    }
	
	 $page_data['page_name'] = 'student_information';
        $page_data['page_title'] = get_phrase('student_information') . " - " . get_phrase('class') . " : " .
                $this->crud_model->get_class_name($class_id);
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/index', $page_data);
    }

	
	function student_marksheet($student_id = '') {
        if ($this->session->userdata('head_login') != 1)
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
        if ($this->session->userdata('head_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('student' , array('student_id' => $student_id))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/head/student_marksheet_print_view', $page_data);
    }
	
    function student($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect('login', 'refresh');
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
    
	
	
	/* * ****VIEW STUDENT INFORMATION PAGE** */

	function view_student($student_id = '') {
    if ($this->session->userdata('head_login') != 1)
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
	
    /****MANAGE TEACHERS*****/
    function teacher_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('teacher_list');
        $this->load->view('backend/index', $page_data);
    }
	
	
	
	// ACADEMIC SYLLABUS
    function academic_syllabus($class_id = '')
    {
       if ($this->session->userdata('head_login') != 1)
            redirect(base_url(), 'refresh');
			
        if ($this->input->post('operation') == 'selection') 
	{
        $page_data['class_id'] = $this->input->post('class_id');

        if ($page_data['class_id'] > 0 ) 
		{
            redirect(base_url() . 'index.php?head/academic_syllabus/' . $page_data['class_id'], 'refresh');
        } 
		else 
		{
            $this->session->set_flashdata('info', 'please_select_class');
            redirect(base_url() . 'index.php?head/academic_syllabus/', 'refresh');
        }
    }
	
	 $page_data['page_name'] = 'academic_syllabus';
        $page_data['page_title'] = get_phrase('academic_syllabus') . " - " . get_phrase('class') . " : " .
                $this->crud_model->get_class_name($class_id);
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function download_academic_syllabus($academic_syllabus_code)
    {
        $file_name = $this->db->get_where('academic_syllabus', array(
            'academic_syllabus_code' => $academic_syllabus_code
        ))->row()->file_name;
        $this->load->helper('download');
        $data = file_get_contents("uploads/syllabus/" . $file_name);
        $name = $file_name;

        force_download($name, $data);
    }
    
    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect(base_url(), 'refresh');

        $teacherid = $this->session->userdata('teacher_id'); // view

        $this->db->distinct();
        $this->db->select('class_id')
                    ->from('class')
                    ->where('teacher_id', $teacherid);
        $query = $this->db->get();
            $query_array = $query->result_array();
        if(count($query_array)==1 && $teacherid>0)
        {
            $dataup['class_id']    = $query_array['0']['class_id'];
            $this->db->where('teacher_id', $teacherid);
            $this->db->update('subject', $dataup);
            //echo $query_array['0']['class_id']; die;
        }

		$page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('backend/index', $page_data);
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
	 function nursery_student_question($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('head_login') != 1)
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
                redirect(base_url() . 'index.php?head/nursery_student_question/', 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?head/nursery_student_question/', 'refresh');
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
            redirect(base_url() . 'index.php?head/nursery_student_question/', 'refresh');
        }
        if($param1 =='delete'){
			$this->db->where('question_id',$param2);
			$this->db->delete('nursery_student_question');
			$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?head/nursery_student_question/', 'refresh');
		}
       
		$page_data['page_name'] = 'nursery_student_question';
		$page_data['page_title'] = get_phrase('nursery_student_question');
        $this->load->view('backend/index', $page_data);
    }
    
   /****MANAGE EXAM MARKS*****/

   // MID TERM
   function marks0($exam_id = '', $class_id = '', $student_id = '')
   {
       if ($this->session->userdata('head_login') != 1)
           redirect(base_url(), 'refresh');
       
       if ($this->input->post('operation') == 'selection') {
           $page_data['exam_id']    = $this->input->post('exam_id');
           $page_data['class_id']   = $this->input->post('class_id');
           $page_data['student_id'] = $this->input->post('student_id');
           
           if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0) {
               redirect(base_url() . 'index.php?head/marks0/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
           } else {
               $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
               redirect(base_url() . 'index.php?head/marks0/', 'refresh');
           }
       }
       if ($this->input->post('operation') == 'update') {
           $subjects = $this->db->get_where('class_subject' , array('class_id' => $class_id))->result_array();
           $session_year = $this->input->post('session_year');
           $student_id = $this->input->post('student_id');
           $strand = $this->db->get('strand')->result_array();
           $total_subs = '';
           $ca1 = 0;
            $ca2 = 0;
            $cat = 0;

            foreach($strand as $rows){
                //$dataa['ca_1']      = $this->input->post('ca_1s_' . $rows['strand_id']);
                //$dataa['ca_2']      = $this->input->post('ca_2s_' . $rows['strand_id']);
                //$dataa['ca_marks']      = $this->input->post('ca_markss_' . $rows['strand_id']);
                //$dataa['remark']      = $this->input->post('remarks_' . $rows['strand_id']);

                $ca1 += $this->input->post('ca_1s_' . $rows['strand_id']);
                $ca2 += $this->input->post('ca_2s_' . $rows['strand_id']);
                $cat += $this->input->post('ca_markss_' . $rows['strand_id']);
                  
                //$this->db->where('strands_id', $this->input->post('strands_id_' . $rows['strand_id']));
                //$this->db->where('session_year', $session_year);
                //$this->db->update('strands0', $dataa);
                }
           foreach($subjects as $row) {
               if($this->input->post('class_types') == 'primary'){
                    //$data['ca_1']      = $this->input->post('ca_1_' . $row['subject_id']);
                    //$data['ca_2']      = $this->input->post('ca_2_' . $row['subject_id']);
                    //$data['ca_marks']      = $this->input->post('ca_marks_' . $row['subject_id']);
                    //$data['remark']      = $this->input->post('remark_' . $row['subject_id']);

                    foreach($strand as $rows){
                        //$dataa['ca_1']      = $this->input->post('ca_1s_' . $rows['strand_id']);
                        //$dataa['ca_2']      = $this->input->post('ca_2s_' . $rows['strand_id']);
                        //$dataa['ca_marks']      = $this->input->post('ca_markss_' . $rows['strand_id']);
                        //$dataa['remark']      = $this->input->post('remarks_' . $rows['strand_id']);
    
                        
                        //$this->db->where('student_id', $student_id);
                        //$this->db->where('class_id', $class_id);
                        //$this->db->where('exam_id', $exam_id);
                        //$this->db->where('strands_id', $this->input->post('strands_id_' . $rows['strand_id']));
                        //$this->db->where('session_year', $session_year);
                        //$this->db->update('strands0', $dataa);
                    }
               
                   // Comments for primary
                   //$data0['TeacherName']  = $this->input->post('TeacherName');

                   //$this->db->where('class_id', $class_id);
                   //$this->db->where('student_id', $student_id);
                   //$this->db->where('exam_id', $exam_id);
                   //$this->db->where('session_year', $session_year);
                   //$this->db->update('comments0', $data0);
                   
               }
               else if($this->input->post('class_types') == 'nursery'){                     
                   
               }
               else{
                   //$data['ca_marks']      = $this->input->post('ca_marks_' . $row['subject_id']);
                   //$data['mark_obtained']      = $this->input->post('mark_obtained_' . $row['subject_id']);
                   //$data['mark_total']      = $this->input->post('mark_total_' . $row['subject_id']);
               
                   //code added on 31 may sandeep
                   //$data['effort_marks']      = $this->input->post('effort_marks_' . $row['subject_id']);
                   //$data['attitude_marks']      = $this->input->post('attitude_marks_' . $row['subject_id']);
                   //$data['attentiveness_mark']      = $this->input->post('attentiveness_mark_' . $row['subject_id']);
                   //$data['assignment_marks']      = $this->input->post('assignment_marks_' . $row['subject_id']);
                   //$data['interest_marks']      = $this->input->post('interest_marks_' . $row['subject_id']);
                   //$data['willingness_marks']      = $this->input->post('willingness_marks_' . $row['subject_id']);
                   //$data['teacher']      = $this->input->post('teacher_' . $row['subject_id']);

                   $tot =$data['ca_marks'] +$data['mark_obtained'];
                   $total_subs += $tot;

                   // comments for secondary
                   $data0['VPName']  = $this->input->post('VPName');
                   $data0['VPComment']  = $this->input->post('VPComment');
                   $data0['TeacherNames']  = $this->input->post('TeacherNames');
                   $data0['TeacherComments']  = $this->input->post('TeacherComments');


                   $this->db->where('class_id', $class_id);
                   $this->db->where('student_id', $student_id);
                   $this->db->where('exam_id', $exam_id);
                   $this->db->where('session_year', $session_year);
                   $this->db->update('comments0', $data0);
               }
               if($this->input->post('class_types') != 'nursery'){            
                   //$this->db->where('mark_id', $this->input->post('mark_id_' . $row['subject_id']));
                   //$this->db->where('student_id', $student_id);
                   //$this->db->where('class_id', $class_id);
                   //$this->db->where('session_year', $session_year);
                   //$this->db->update('mark0', $data);

                }
                
                if($this->input->post('class_types') == 'primary'){

                    $eng = $this->db->get_where('mark0', array('class_id' => $class_id, 'student_id' => $student_id,
                                                                'exam_id' => $exam_id, 'session_year' => $session_year))->result_array();

                    //$place['ca_1'] = round(($ca1/3),1);
                    //$place['ca_2'] = round(($ca2/6),1);
                    //$ca_marks = (round(($ca1/3),1))+(round(($ca2/6),1));
                    //$place['ca_marks'] = round($ca_marks,1);

                    //$this->db->where('class_id', $class_id);
                    //$this->db->where('student_id', $student_id);
					//$this->db->where('exam_id', $exam_id);
                    //$this->db->where('session_year', $session_year);
                    //$this->db->where('subject_id', $eng[0]['subject_id']);
                    //$this->db->update('mark0', $place);
               }
           }
           if($this->input->post('class_types') == 'nursery 3'){ 
                //$datas['effort_marks']      = $this->input->post('literacy');
                //$datas['attitude_marks']      = $this->input->post('numeracy');
                //$datas['attentiveness_mark']      = $this->input->post('kutw');
                //$datas['assignment_marks']      = $this->input->post('phse');
                //$datas['interest_marks']      = $this->input->post('rhyme');
                //$datas['willingness_marks']      = $this->input->post('creative');
                //$datas['science']      = $this->input->post('science');
                //$datas['hand_writing']      = $this->input->post('hand_writing');
                
                //$this->db->where('class_id', $class_id);
                //$this->db->where('student_id', $student_id);
				//$this->db->where('exam_id', $exam_id);
				//$this->db->where('session_year', $session_year);
                //$this->db->update('mark0', $datas);

                
            }

            if($this->input->post('class_types') == 'nursery 2'){ 
                //$datas['effort_marks']      = $this->input->post('literacy');
                //$datas['attitude_marks']      = $this->input->post('numeracy');
                //$datas['attentiveness_mark']      = $this->input->post('kutw');
                //$datas['assignment_marks']      = $this->input->post('phse');
                //$datas['interest_marks']      = $this->input->post('rhyme');
                //$datas['willingness_marks']      = $this->input->post('creative');
                //$datas['hand_writing']      = $this->input->post('hand_writing');
                //$datas['work_habbit']      = $this->input->post('work_habbit');
                
                //$this->db->where('class_id', $class_id);
                //$this->db->where('student_id', $student_id);
				//$this->db->where('exam_id', $exam_id);
				//$this->db->where('session_year', $session_year);
                //$this->db->update('mark0', $datas);

            }

            if($this->input->post('class_types') == 'nursery 1'){ 
                //$datas['effort_marks']      = $this->input->post('literacy');
                //$datas['attitude_marks']      = $this->input->post('numeracy');
                //$datas['attentiveness_mark']      = $this->input->post('kutw');
                //$datas['assignment_marks']      = $this->input->post('phse');
                //$datas['interest_marks']      = $this->input->post('rhyme');
                //$datas['willingness_marks']      = $this->input->post('creative');
                //$datas['work_habbit']      = $this->input->post('work_habbit');
                //$datas['comm_skills']      = $this->input->post('comm_skills');
                //$datas['gms']      = $this->input->post('gms');
                //$datas['fms']      = $this->input->post('fms');
                
                
                //$this->db->where('class_id', $class_id);
                //$this->db->where('student_id', $student_id);
				//$this->db->where('exam_id', $exam_id);
				//$this->db->where('session_year', $session_year);
                //$this->db->update('mark0', $datas);

            }

            if($this->input->post('class_types') == 'toddler'){ 
                //$datas['attitude_marks']      = $this->input->post('numeracy');
                //$datas['attentiveness_mark']      = $this->input->post('kutw');
                //$datas['assignment_marks']      = $this->input->post('phse');
                //$datas['interest_marks']      = $this->input->post('rhyme');
                //$datas['social_skills']      = $this->input->post('social_skills');
                //$datas['comm_skills']      = $this->input->post('comm_skills');
                //$datas['gms']      = $this->input->post('gms');
                //$datas['fms']      = $this->input->post('fms');
                
                
                //$this->db->where('class_id', $class_id);
                //$this->db->where('student_id', $student_id);
				//$this->db->where('exam_id', $exam_id);
				//$this->db->where('session_year', $session_year);
                //$this->db->update('mark0', $datas);
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

            if($this->input->post('class_types') != 'nursery 3' && $this->input->post('class_types') != 'nursery 2' 
                && $this->input->post('class_types') != 'nursery 1' && $this->input->post('class_types') != 'toddler'){ 
				$data3['subject_total_marks'] = round($total_subs,2);
				$this->db->where('student_id', $student_id);
				$this->db->where('class_id', $class_id);
				$this->db->where('exam_id', $exam_id);
				$this->db->where('session_year', $session_year);
				$this->db->update('mark0', $data3);
            }
           
           //code for update vacation date
           $data4['resumption_date'] = $this->input->post('resumption_date');
           $data4['vacation_date'] = $this->input->post('vacation_date');
           $this->db->where('class_id', $class_id);
           $this->db->where('exam_id', $exam_id);
           $this->db->where('session_year', $session_year);
           $this->db->update('mark0', $data4);
           

           //code for update vacation date
           $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
           redirect(base_url() . 'index.php?head/marks0/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
       }
       $page_data['exam_id']    = $exam_id;
       $page_data['class_id']   = $class_id;
       $page_data['student_id'] = $student_id;
       $page_data['subject_id'] = $section_id;
       $page_data['page_info'] = 'Exam marks';
       
       $page_data['page_name']  = 'marks0';
       $page_data['page_title'] = get_phrase('manage_exam_marks');
       $this->load->view('backend/index', $page_data);
   }
   
   // END OF TERM MARKS //
   function marks($exam_id = '', $class_id = '', $student_id = '')
   {
       if ($this->session->userdata('head_login') != 1)
           redirect(base_url(), 'refresh');
       
       if ($this->input->post('operation') == 'selection') {
           $page_data['exam_id']    = $this->input->post('exam_id');
           $page_data['class_id']   = $this->input->post('class_id');
           $page_data['student_id'] = $this->input->post('student_id');
           
           if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0) {
               redirect(base_url() . 'index.php?head/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
           } else {
               $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
               redirect(base_url() . 'index.php?head/marks/', 'refresh');
           }
       }
       if ($this->input->post('operation') == 'update') {
           $subjects = $this->db->get_where('class_subject' , array('class_id' => $class_id))->result_array();
           $session_year = $this->input->post('session_year');
           $student_id = $this->input->post('student_id');

           foreach($subjects as $row) {
               if($this->input->post('class_types') == 'primary'){
                   
                   // Comments for primary
                   $data0['HeadTeacherName']  = $this->input->post('HeadTeacherName');
                   $data0['HeadTeacherComment']  = $this->input->post('HeadTeacherComment');
                   $data0['TeacherName']  = $this->input->post('TeacherName');
                    $data0['TeacherComment']  = $this->input->post('TeacherComment');

                   $this->db->where('class_id', $class_id);
                   $this->db->where('student_id', $student_id);
                   $this->db->where('exam_id', $exam_id);
                   $this->db->where('session_year', $session_year);
                   $this->db->update('comments', $data0);
                   
               }else if($this->input->post('class_types') == 'nursery'){ 

                   
               }else{
                   
                   // comments for secondary
                   $data0['VPName']  = $this->input->post('VPName');
                   $data0['VPComment']  = $this->input->post('VPComment');
                   $data0['TeacherNames']  = $this->input->post('TeacherNames');
                    $data0['TeacherComments']  = $this->input->post('TeacherComments');

                   $this->db->where('class_id', $class_id);
                   $this->db->where('student_id', $student_id);
                   $this->db->where('exam_id', $exam_id);
                   $this->db->where('session_year', $session_year);
                   $this->db->update('comments', $data0);

               }
           }
           if($this->input->post('class_types') == 'nursery'){ 

               // Comments for nursery
               $data0['HeadTeacherName']  = $this->input->post('HeadTeacherName');
               $data0['HeadTeacherComment']  = $this->input->post('HeadTeacherComment');
               $data0['TeacherName']  = $this->input->post('TeacherName');
               $data0['TeacherComment']  = $this->input->post('TeacherComment');

               $this->db->where('class_id', $class_id);
               $this->db->where('student_id', $student_id);
               $this->db->where('exam_id', $exam_id);
               $this->db->where('session_year', $session_year);
               $this->db->update('comments', $data0);
           }

           if($this->input->post('class_types') != 'nursery'){
           //code for update vacation date
           $data4['resumption_date'] = $this->input->post('resumption_date');
           $data4['vacation_date'] = $this->input->post('vacation_date');
           $this->db->where('class_id', $class_id);
           $this->db->where('exam_id', $exam_id);
           $this->db->where('session_year', $session_year);
           $this->db->update('mark', $data4);}
           //code for update vacation date
           $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
           redirect(base_url() . 'index.php?head/marks/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
       }
       $page_data['exam_id']    = $exam_id;
       $page_data['class_id']   = $class_id;
       $page_data['student_id'] = $student_id;
       $page_data['subject_id'] = $section_id;
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
            redirect(base_url() . 'index.php?head/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
        } else {
            $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
            redirect(base_url() . 'index.php?head/marks/', 'refresh');
        }
    }

    function manage_marks0()
    {  
        $page_data['exam_id']    = $this->input->post('exam_id');
        $page_data['class_id']   = $this->input->post('class_id');
        $page_data['student_id'] = $this->input->post('student_id');
        if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0) {
            redirect(base_url() . 'index.php?head/marks0/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
        } else {
            $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
            redirect(base_url() . 'index.php?head/marks0/', 'refresh');
        }
    }
    
    // TABULATION SHEET
	function tabulation_sheet($class_id = '', $exam_id = '', $student_id = '', $sessoin_id = '') {
		if ($this->session->userdata('head_login') != 1)
			redirect(base_url(), 'refresh');

		if ($this->input->post('operation') == 'selection') {
			$page_data['exam_id'] = $this->input->post('exam_id');
			$page_data['class_id'] = $this->input->post('class_id');
			$page_data['student_id'] = $this->input->post('student_id');
			$page_data['sessoin_id'] = $this->input->post('session_year');
	
			if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0 ) {
				redirect(base_url() . 'index.php?head/tabulation_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' . $page_data['student_id'].'/'.$page_data['sessoin_id'], 'refresh');
			} else {
				$this->session->set_flashdata('mark_message', 'Choose class and exam');
				redirect(base_url() . 'index.php?head/tabulation_sheet/', 'refresh');
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
	//function added on 28-06-18 sandeep
	function tabulation_sheet_print_view($class_id, $exam_id,$sessoin_id) {
		if ($this->session->userdata('head_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['class_id'] = $class_id;
		$page_data['exam_id'] = $exam_id;
		$page_data['sessoin_id'] = $sessoin_id;
		$this->load->view('backend/head/tabulation_sheet_print_view', $page_data);
    }

    //SCORESHEET
    function score_sheet($class_id = '', $exam_id = '', $sessoin_id = '') {
    	if ($this->session->userdata('head_login') != 1)
			redirect(base_url(), 'refresh');

		if ($this->input->post('operation') == 'selection') {
			$page_data['exam_id'] = $this->input->post('exam_id');
			$page_data['class_id'] = $this->input->post('class_id');
			$page_data['sessoin_id'] = $this->input->post('session_year');
	
			if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
				redirect(base_url() . 'index.php?head/score_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' .$page_data['sessoin_id'], 'refresh');
			} else {
				$this->session->set_flashdata('mark_message', 'Choose class and exam');
				redirect(base_url() . 'index.php?head/score_sheet/', 'refresh');
			}
		}
		$page_data['exam_id'] = $exam_id;
		$page_data['class_id'] = $class_id;
		$page_data['sessoin_id'] = $sessoin_id;
		$page_data['page_info'] = 'Exam marks';
	
		$page_data['page_name'] = 'score_sheet';
		$page_data['page_title'] = get_phrase('score_sheet');
		$this->load->view('backend/index', $page_data);
	}

	//function added on 28-06-18 sandeep
	function tabulation_sheet_print_view_control($class_id, $exam_id,$sessoin_id) {
		if ($this->session->userdata('head_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['class_id'] = $class_id;
		$page_data['exam_id'] = $exam_id;
		$page_data['sessoin_id'] = $sessoin_id;
		redirect(base_url() . 'index.php?head/tabulation_sheet_print_view/' . $page_data['class_id'] . '/' . $page_data['exam_id'].'/'.$page_data['sessoin_id'], 'refresh');
	}
	
	// added on 28-06-2018 sandeep

	function tabulation_sheet_print_view_single($class_id, $exam_id,$sessoin_id,$student_id){
		if ($this->session->userdata('head_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['class_id'] = $class_id;
		$page_data['exam_id'] = $exam_id;
		$page_data['sessoin_id'] = $sessoin_id;
		$page_data['student_id'] = $student_id;
		$this->load->view('backend/head/tabulation_sheet_print_view_single', $page_data);
	}

	function tabulation_sheet_print_single_control($class_id, $exam_id,$sessoin_id,$student_id){
		if ($this->session->userdata('head_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['class_id'] = $class_id;
		$page_data['exam_id'] = $exam_id;
		$page_data['sessoin_id'] = $sessoin_id;
		$page_data['student_id'] = $student_id;
		redirect(base_url() . 'index.php?head/tabulation_sheet_print_view_single/' . $page_data['class_id'] . '/' . $page_data['exam_id'].'/'.$page_data['sessoin_id'].'/'.$student_id, 'refresh');
    }

// TABULATION SHEET MIDTERM

function tabulation_sheet_midterm($class_id = '', $exam_id = '', $student_id = '', $sessoin_id = '') {
    if ($this->session->userdata('head_login') != 1)
        redirect(base_url(), 'refresh');

    if ($this->input->post('operation') == 'selection') {
        $page_data['exam_id'] = $this->input->post('exam_id');
        $page_data['class_id'] = $this->input->post('class_id');
        $page_data['student_id'] = $this->input->post('student_id');
        $page_data['sessoin_id'] = $this->input->post('session_year');

        if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0 ) {
            redirect(base_url() . 'index.php?head/tabulation_sheet_midterm/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' . $page_data['student_id'].'/'.$page_data['sessoin_id'], 'refresh');
        } else {
            $this->session->set_flashdata('mark_message', 'Choose class and exam');
            redirect(base_url() . 'index.php?head/tabulation_sheet_midterm/', 'refresh');
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

function tabulation_sheet_midterm_print_view($class_id, $exam_id,$sessoin_id) {
    if ($this->session->userdata('head_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $this->load->view('backend/head/tabulation_sheet_midterm_print_view', $page_data);
}

function tabulation_sheet_midterm_print_view_control($class_id, $exam_id,$sessoin_id) {
    if ($this->session->userdata('head_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    redirect(base_url() . 'index.php?head/tabulation_sheet_midterm_print_view/' . $page_data['class_id'] . '/' . $page_data['exam_id'].'/'.$page_data['sessoin_id'], 'refresh');
}

function tabulation_sheet_midterm_print_view_single($class_id, $exam_id,$sessoin_id,$student_id){
     if ($this->session->userdata('head_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $page_data['student_id'] = $student_id;
    $this->load->view('backend/head/tabulation_sheet_midterm_print_view_single', $page_data);
}

function tabulation_sheet_midterm_print_single_control($class_id, $exam_id,$sessoin_id,$student_id){
    if ($this->session->userdata('head_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $page_data['student_id'] = $student_id;
    redirect(base_url() . 'index.php?head/tabulation_sheet_midterm_print_view_single/' . $page_data['class_id'] . '/' . $page_data['exam_id'].'/'.$page_data['sessoin_id'].'/'.$student_id, 'refresh');
}
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?head/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?head/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');
            
            $this->db->where('head_id', $this->session->userdata('head_id'));
            $this->db->update('head', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $this->session->userdata('head_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?head/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('head', array(
                'head_id' => $this->session->userdata('head_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('head_id', $this->session->userdata('head_id'));
                $this->db->update('head', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?head/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('head', array(
            'head_id' => $this->session->userdata('head_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['class_id']   = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('time_start');
            $data['time_end']   = $this->input->post('time_end');
            $data['day']        = $this->input->post('day');
            $this->db->insert('class_routine', $data);
            redirect(base_url() . 'index.php?head/class_routine/', 'refresh');
        }
        if ($param1 == 'edit' && $param2 == 'do_update') {
            $data['class_id']   = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('time_start');
            $data['time_end']   = $this->input->post('time_end');
            $data['day']        = $this->input->post('day');
            
            $this->db->where('class_routine_id', $param3);
            $this->db->update('class_routine', $data);
            redirect(base_url() . 'index.php?head/class_routine/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                'class_routine_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_schedule_id', $param2);
            $this->db->delete('class_schedule');
            redirect(base_url() . 'index.php?head/class_routine/', 'refresh');
        }
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = get_phrase('manage_class_routine');
        $this->load->view('backend/index', $page_data);
    }
	
	/****** DAILY ATTENDANCE *****************/
    function manage_attendance($date='',$month='',$year='',$class_id='')
    {
        if($this->session->userdata('head_login')!=1)redirect('login' , 'refresh');

        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        
         if ($_POST) {
        // Loop all the students of $class_id
        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
        foreach ($students as $row) {
            $attendance_status = $this->input->post('status_' . $row['student_id']);
            $full_date = $year . "-" . $month . "-" . $date;
            $this->db->where('student_id', $row['student_id']);
            $this->db->where('date', $full_date);

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
        redirect(base_url() . 'index.php?head/manage_attendance/' . $date . '/' . $month . '/' . $year . '/' . $class_id . '/' . $section_id, 'refresh');
    }
    $page_data['date'] = $date;
    $page_data['month'] = $month;
    $page_data['year'] = $year;
    $page_data['class_id'] = $class_id;
    $page_data['section_id'] = $section_id;
    $page_data['page_name'] = 'manage_attendance';
    $page_data['page_title'] = get_phrase('manage_daily_attendance');
    $this->load->view('backend/index', $page_data);
}

	
	
    function attendance_selector() {
    $date = $this->input->post('timestamp');
    $date = date_create($date);
    $date = date_format($date, "d/m/Y");
    redirect(base_url() . 'index.php?head/manage_attendance/' . $date . '/' . $this->input->post('class_id') . '/' . $this->input->post('section_id'), 'refresh');
}

function attendance_report_view() {
    redirect(base_url() . 'index.php?head/attendance_report/' . $this->input->post('class_id') . '/' . $this->input->post('section_id') . '/' . $this->input->post('month') . '/' . $this->input->post('year'), 'refresh');
}
    
    
    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);
        
    }
	
	
	 /**********MANAGE HOLIDAY ********************/
    function holiday($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['holidays']      = $this->db->get('holiday')->result_array();
        $page_data['page_name']  = 'holiday';
        $page_data['page_title'] = get_phrase('manage_holidays');
        $this->load->view('backend/index', $page_data);
        
    }
	
	
	 /**********MANAGE todays_thought ********************/
    function todays_thought($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['todays_thoughts']      = $this->db->get('todays_thought')->result_array();
        $page_data['page_name']  = 'todays_thought';
        $page_data['page_title'] = get_phrase('manage_todays_thought');
        $this->load->view('backend/index', $page_data);
        
    }
	


/**********MANAGE LOAN APPLICATIONS *******************/
    function loan_applicant($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
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
            redirect(base_url() . 'index.php?head/loan_applicant' , 'refresh');
        }
		
        $page_data['page_name']  = 'loan_applicant';
        $page_data['page_title'] = get_phrase('loan_application');
        $page_data['loan_applicants']  = $this->db->get('loan')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	
	
	/**********MANAGE LOAN APPLICATIONS *******************/
    function loan_approval($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect('login', 'refresh');
       
		
        $page_data['page_name']  = 'loan_approval';
        $page_data['page_title'] = get_phrase('view_approval');
        $page_data['loan_approvals']  = $this->db->get('loan')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	
	
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);
        
    }
	
	
	
	/**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function assignment($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect('login', 'refresh');
			
        if ($param1 == 'create') {
		
		    $data['timestamp']     = $this->input->post('timestamp');
            $data['title']         = $this->input->post('title');
            $data['description']     = $this->input->post('description');
			$data['file_name'] 	= $_FILES["file_name"]["name"];
            $data['class_id']       = $this->input->post('class_id');
            $data['teacher_id']       = $this->input->post('teacher_id');
            $data['file_type']       = $this->input->post('file_type');
            $this->db->insert('assignment', $data);
            $assignment_id = $this->db->insert_id();
			
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/assignment/" . $_FILES["file_name"]["name"]);
            redirect(base_url() . 'index.php?head/assignment' , 'refresh');
        }
		if ($param1 == 'do_update') {
             $data['timestamp']     = $this->input->post('timestamp');
            $data['title']         = $this->input->post('title');
            $data['description']     = $this->input->post('description');
            $data['class_id']       = $this->input->post('class_id');
            $data['file_type']       = $this->input->post('file_type');
            
            $this->db->where('assignment_id', $param2);
            $this->db->update('assignment', $data);
			 $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?head/assignment/'.$data['assignment_id'], 'refresh');
			}
			
       if ($param1 == 'delete') {
            $this->db->where('assignment_id' , $param2);
            $this->db->delete('assignment');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?head/assignment' , 'refresh');
        }
		
        $page_data['page_name']  = 'assignment';
        $page_data['page_title'] = get_phrase('manage_assignment');
        $page_data['assignments']  = $this->db->get('assignment')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	
	
	
	
	/**********MANAGE AASIGNMENTS *******************/
    function examquestion($param1 = '', $param2 = '' , $param3 = '')
    {
      if ($this->session->userdata('head_login') != 1)
            redirect('login', 'refresh');
			
        if ($param1 == 'create') {
		
		    $data['timestamp']     = $this->input->post('timestamp');
            $data['teacher_id']         = $this->input->post('teacher_id');
            $data['subject_id']         = $this->input->post('subject_id');
            $data['description']     = $this->input->post('description');
			$data['file_name'] 	= $_FILES["file_name"]["name"];
            $data['class_id']       = $this->input->post('class_id');
            $data['file_type']       = $this->input->post('file_type');
	        $data['status']         = $this->input->post('status');
            $this->db->insert('examquestion', $data);
            $examquestion_id = $this->db->insert_id();
			
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/examquestion/" . $_FILES["file_name"]["name"]);
            redirect(base_url() . 'index.php?head/examquestion' , 'refresh');
        }
		if ($param1 == 'do_update') {
             $data['timestamp']     = $this->input->post('timestamp');
            $data['subject_id']         = $this->input->post('subject_id');
            $data['description']     = $this->input->post('description');
            $data['class_id']       = $this->input->post('class_id');

            
            $this->db->where('examquestion_id', $param2);
            $this->db->update('examquestion', $data);
			 $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?head/examquestion'.$data['examquestion_id'], 'refresh');
			}
			
       if ($param1 == 'delete') {
            $this->db->where('examquestion_id' , $param2);
            $this->db->delete('examquestion');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?head/examquestion' , 'refresh');
        }
		
        $page_data['page_name']  = 'examquestion';
        $page_data['page_title'] = get_phrase('manage_examquestion');
        $page_data['examquestions']  = $this->db->get('examquestion')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	
	
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function news($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['newss'] = $this->db->get('news')->result_array();
        $page_data['page_name']  = 'news';
        $page_data['page_title'] = get_phrase('manage_news');
        $this->load->view('backend/index', $page_data);
        
    }
    
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);
            redirect(base_url() . 'index.php?head/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);
            $this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
            redirect(base_url() . 'index.php?head/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            redirect(base_url() . 'index.php?head/noticeboard/', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
	
	
	/****MANAGE HELPFUL LINK*****/
    function help_link($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect(base_url(), 'refresh');
			
        if ($param1 == 'create') {
            
			$data['title']         = $this->input->post('title');
            $data['link'] 			= $this->input->post('link');
            $data['class_id'] 		= $this->input->post('class_id');
            
            $this->db->insert('help_link', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?head/help_link', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['title']         = $this->input->post('title');
            $data['link'] = $this->input->post('link');
			$data['class_id'] 		= $this->input->post('class_id');
            
            $this->db->where('helplink_id', $param2);
            $this->db->update('help_link', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?head/help_link', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('help_link', array(
                'helplink_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('helplink_id', $param2);
            $this->db->delete('help_link');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?head/help_link', 'refresh');
        }
        $page_data['help_links']    = $this->db->get('help_link')->result_array();
        $page_data['page_name']  = 'help_link';
        $page_data['page_title'] = get_phrase('manage_help_link');
        $this->load->view('backend/index', $page_data);
    }
	
	
    
    /**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function document($do = '', $document_id = '')
    {
        if ($this->session->userdata('head_login') != 1)
            redirect('login', 'refresh');
        if ($do == 'upload') {
            move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/document/" . $_FILES["userfile"]["name"]);
            $data['document_name'] = $this->input->post('document_name');
            $data['file_name']     = $_FILES["userfile"]["name"];
            $data['file_size']     = $_FILES["userfile"]["size"];
            $this->db->insert('document', $data);
            redirect(base_url() . 'head/manage_document', 'refresh');
        }
        if ($do == 'delete') {
            $this->db->where('document_id', $document_id);
            $this->db->delete('document');
            redirect(base_url() . 'head/manage_document', 'refresh');
        }
        $page_data['page_name']  = 'manage_document';
        $page_data['page_title'] = get_phrase('manage_documents');
        $page_data['documents']  = $this->db->get('document')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /*********MANAGE STUDY MATERIAL************/
    function study_material($task = "", $document_id = "")
    {
        if ($this->session->userdata('head_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
                
        if ($task == "create")
        {
            $this->crud_model->save_study_material_info();
            $this->session->set_flashdata('flash_message' , get_phrase('study_material_info_saved_successfuly'));
            redirect(base_url() . 'index.php?head/study_material' , 'refresh');
        }
        
        if ($task == "update")
        {
            $this->crud_model->update_study_material_info($document_id);
            $this->session->set_flashdata('flash_message' , get_phrase('study_material_info_updated_successfuly'));
            redirect(base_url() . 'index.php?head/study_material' , 'refresh');
        }
        
        if ($task == "delete")
        {
            $this->crud_model->delete_study_material_info($document_id);
            redirect(base_url() . 'index.php?head/study_material');
        }
        
        $data['study_material_info']    = $this->crud_model->select_study_material_info();
        $data['page_name']              = 'study_material';
        $data['page_title']             = get_phrase('study_material');
        $this->load->view('backend/index', $data);
    }
    
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('head_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?head/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?head/message/message_read/' . $param2, 'refresh');
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
