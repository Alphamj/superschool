<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *	Author 			: Optimum Linkup Software
 *	date			: 27 June, 2017
 *	Website			:http://optimumlinkupsoftware.com/school
 *	Email			:info@optimumlinkupsoftware.com
 */


class Teacher extends CI_Controller
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
    
    /***default functin, redirects to login page if no teacher logged in yet***/
    public function index()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php?teacher/dashboard', 'refresh');
    }
    
    /***TEACHER DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('teacher_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    
    /*ENTRY OF A NEW STUDENT*/
    
    
    /****MANAGE STUDENTS CLASSWISE*****/
    function student_add()
	{
		if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
			
		$page_data['page_name']  = 'student_add';
		$page_data['page_title'] = get_phrase('add_student');
		$this->load->view('backend/index', $page_data);
	}
	
	function student_information($class_id = '') {
       if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
			
			 if ($this->input->post('operation') == 'selection') 
	{
        $page_data['class_id'] = $this->input->post('class_id');

        if ($page_data['class_id'] > 0 ) 
		{
            redirect(base_url() . 'index.php?teacher/student_information/' . $page_data['class_id'], 'refresh');
        } 
		else 
		{
            $this->session->set_flashdata('info', 'please_select_class');
            redirect(base_url() . 'index.php?teacher/student_information/', 'refresh');
        }
    }
	
	 $page_data['page_name'] = 'student_information';
        $page_data['page_title'] = get_phrase('student_information') . " - " . get_phrase('class') . " : " .
                $this->crud_model->get_class_name($class_id);
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/index', $page_data);
    }

	
	function student_marksheet($student_id = '') {
        if ($this->session->userdata('teacher_login') != 1)
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
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('student' , array('student_id' => $student_id))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/teacher/student_marksheet_print_view', $page_data);
    }
	
    function student($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
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
    if ($this->session->userdata('teacher_login') != 1)
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
        if ($this->session->userdata('teacher_login') != 1)
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
       if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
			
        if ($this->input->post('operation') == 'selection') 
	{
        $page_data['class_id'] = $this->input->post('class_id');

        if ($page_data['class_id'] > 0 ) 
		{
            redirect(base_url() . 'index.php?teacher/academic_syllabus/' . $page_data['class_id'], 'refresh');
        } 
		else 
		{
            $this->session->set_flashdata('info', 'please_select_class');
            redirect(base_url() . 'index.php?teacher/academic_syllabus/', 'refresh');
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
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        $teacherid = $this->session->userdata('teacher_id');

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
        if ($this->session->userdata('teacher_login') != 1)
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
                redirect(base_url() . 'index.php?teacher/nursery_student_question/', 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?teacher/nursery_student_question/', 'refresh');
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
            redirect(base_url() . 'index.php?teacher/nursery_student_question/', 'refresh');
        }
        if($param1 =='delete'){
			$this->db->where('question_id',$param2);
			$this->db->delete('nursery_student_question');
			$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?teacher/nursery_student_question/', 'refresh');
		}
       
		$page_data['page_name'] = 'nursery_student_question';
		$page_data['page_title'] = get_phrase('nursery_student_question');
        $this->load->view('backend/index', $page_data);
    }
    
   /****MANAGE EXAM MARKS*****/

   // MID TERM
   function marks0($exam_id = '', $class_id = '', $student_id = '')
   {
       if ($this->session->userdata('teacher_login') != 1)
           redirect(base_url(), 'refresh');
       
       if ($this->input->post('operation') == 'selection') {
           $page_data['exam_id']    = $this->input->post('exam_id');
           $page_data['class_id']   = $this->input->post('class_id');
           $page_data['student_id'] = $this->input->post('student_id');
           
           if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0) {
               redirect(base_url() . 'index.php?teacher/marks0/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
           } else {
               $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
               redirect(base_url() . 'index.php?teacher/marks0/', 'refresh');
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
                    
                    /*foreach($strand as $rows){
                        $dataa['ca_1']      = $this->input->post('ca_1s_' . $rows['strand_id']);
                        $dataa['ca_2']      = $this->input->post('ca_2s_' . $rows['strand_id']);
                        $dataa['ca_marks']      = $this->input->post('ca_markss_' . $rows['strand_id']);
                        
                        
                        $this->db->where('strands_id', $this->input->post('strands_id_' . $rows['strand_id']));
                        $this->db->where('session_year', $session_year);
                        $this->db->update('strands0', $dataa);
                    }*/
               
                   // Comments for primary
                   $data0['TeacherName']  = $this->input->post('TeacherName');
                   $data0['Attendances']  = $this->input->post('Attendances');
                   $data0['teach_sign'] = $this->input->post('teach_sign');

                   $this->db->where('class_id', $class_id);
                   $this->db->where('student_id', $student_id);
                   $this->db->where('exam_id', $exam_id);
                   $this->db->where('session_year', $session_year);
                   $this->db->update('comments0', $data0);
                   
               }
               else if($this->input->post('class_types') == 'nursery'){                     
                   
               }
               else{
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
                   if ($this->input->post('TeacherNames') != ''){
                    $data_s['TeacherNames']  = $this->input->post('TeacherNames');
                    $data_s['VPName']  = $this->input->post('VPName');
                    $data_s['TeacherComments']  = $this->input->post('TeacherComments');
                    $data_s['VPComment']  = $this->input->post('VPComment');
                    $data_s['Attendances']  = $this->input->post('Attendances');
                    $data_s['teach_sign'] = $this->input->post('teach_sign');
                    $data_s['head_sign'] = $this->input->post('head_sign');
 
                    $this->db->where('class_id', $class_id);
                    $this->db->where('student_id', $student_id);
                    $this->db->where('exam_id', $exam_id);
                    $this->db->where('session_year', $session_year);
                    $this->db->update('comments0', $data_s);}
               }
               if($this->input->post('class_types') != 'nursery' && $this->input->post('class_types') != 'primary'){            
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
             $data0['teach_sign'] = $this->input->post('teach_sign');

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
           redirect(base_url() . 'index.php?teacher/marks0/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
       }
       $page_data['exam_id']    = $exam_id;
       $page_data['class_id']   = $class_id;
       $page_data['student_id'] = $student_id;
       //$page_data['subject_id'] = $section_id;
       $page_data['page_info'] = 'Exam marks';
       
       $page_data['page_name']  = 'marks0';
       $page_data['page_title'] = get_phrase('manage_exam_marks');
       $this->load->view('backend/index', $page_data);
   }

   // END OF TERM MARKS //
   function marks($exam_id = '', $class_id = '', $student_id = '')
   {
       if ($this->session->userdata('teacher_login') != 1)
           redirect(base_url(), 'refresh');
       
       if ($this->input->post('operation') == 'selection') {
           $page_data['exam_id']    = $this->input->post('exam_id');
           $page_data['class_id']   = $this->input->post('class_id');
           $page_data['student_id'] = $this->input->post('student_id');
           
           if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0) {
               redirect(base_url() . 'index.php?teacher/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
           } else {
               $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
               redirect(base_url() . 'index.php?teacher/marks/', 'refresh');
           }
       }
       if ($this->input->post('operation') == 'update') {
           $subjects = $this->db->get_where('class_subject' , array('class_id' => $class_id))->result_array();
           $session_year = $this->input->post('session_year');
           $student_id = $this->input->post('student_id');
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
                   $data_p['TeacherName']  = $this->input->post('TeacherName');
                   $data_p['TeacherComment']  = $this->input->post('TeacherComment');
                   $data_p['HeadTeacherName']  = $this->input->post('HeadTeacherName');
                   $data_p['HeadTeacherComment']  = $this->input->post('HeadTeacherComment');
                   $data_p['Attendance']  = $this->input->post('Attendance');
                   $data_p['teach_sign'] = $this->input->post('teach_sign');
                    $data_p['head_sign'] = $this->input->post('head_sign');

                   $this->db->where('class_id', $class_id);
                   $this->db->where('student_id', $student_id);
                   $this->db->where('exam_id', $exam_id);
                   $this->db->where('session_year', $session_year);
                   $this->db->update('comments', $data_p);
                   
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
                    

                   if ($this->input->post('TeacherNames') != ''){
                   // comments for secondary
                   $data_s['TeacherNames']  = $this->input->post('TeacherNames');
                   $data_s['VPName']  = $this->input->post('VPName');
                   $data_s['TeacherComments']  = $this->input->post('TeacherComments');
                    $data_s['VPComment']  = $this->input->post('VPComment');
                   $data_s['Attendances']  = $this->input->post('Attendances');
                   $data_s['teach_sign'] = $this->input->post('teach_sign');
                    $data_s['head_sign'] = $this->input->post('head_sign');

                   $this->db->where('class_id', $class_id);
                   $this->db->where('student_id', $student_id);
                   $this->db->where('exam_id', $exam_id);
                   $this->db->where('session_year', $session_year);
                   $this->db->update('comments', $data_s);

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
                   $this->db->update('Remark', $data_R);}

               }
               if($this->input->post('class_types') != 'nursery' && $this->input->post('class_types') != 'primary'){            
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

               $data2['language']  = $this->input->post('language');
               $data2['social']  = $this->input->post('social');
               $data2['knowledge']  = $this->input->post('knowledge');
               $data2['language1']  = $this->input->post('language1');
               $data2['social100']  = $this->input->post('social100');
               $data2['knowledge200']  = $this->input->post('knowledge200');
               $data2['social101']     = $this->input->post('social101');
               $data2['knowledge201']  = $this->input->post('knowledge201');
               $data2['language2']  = $this->input->post('language2');
               $data2['social102']  = $this->input->post('social102');
               $data2['knowledge202']  = $this->input->post('knowledge202');
               $data2['language3']  = $this->input->post('language3');
               $data2['social103']  = $this->input->post('social103');
               $data2['knowledge203']  = $this->input->post('knowledge203');
               $data2['language4']  = $this->input->post('language4');
               $data2['social104']  = $this->input->post('social104');
               $data2['knowledge204']  = $this->input->post('knowledge204');
               $data2['language5']  = $this->input->post('language5');
               $data2['social105']  = $this->input->post('social105');
               $data2['knowledge205']  = $this->input->post('knowledge205');
               $data2['language6']  = $this->input->post('language6');
               $data2['social106']  = $this->input->post('social106');
               $data2['knowledge206']  = $this->input->post('knowledge206');
               $data2['language7']  = $this->input->post('language7');
               $data2['social107']  = $this->input->post('social107');
               $data2['knowledge207']  = $this->input->post('knowledge207');
               $data2['language8']  = $this->input->post('language8');
               $data2['social108']  = $this->input->post('social108');
               $data2['knowledge208']  = $this->input->post('knowledge208');
               $data2['language9']  = $this->input->post('language9');
               $data2['social109']  = $this->input->post('social109');
               $data2['knowledge209']  = $this->input->post('knowledge209');
               $data2['language10']  = $this->input->post('language10');
               $data2['social110']  = $this->input->post('social110');
               $data2['knowledge210']  = $this->input->post('knowledge210');
               $data2['language11']  = $this->input->post('language11');
               $data2['social111']  = $this->input->post('social111');
               $data2['knowledge211']  = $this->input->post('knowledge211');
               $data2['language12']  = $this->input->post('language12');
               $data2['social112']  = $this->input->post('social112');
               $data2['knowledge212']  = $this->input->post('knowledge212');
               $data2['language13']  = $this->input->post('language13');
               $data2['social113']  = $this->input->post('social113');
               $data2['knowledge213']  = $this->input->post('knowledge213');
               $data2['language14']  = $this->input->post('language14');
               $data2['social114']  = $this->input->post('social114');
               $data2['knowledge214']  = $this->input->post('knowledge214');
               $data2['language15']  = $this->input->post('language15');
               $data2['social115']  = $this->input->post('social115');
               $data2['knowledge215']  = $this->input->post('knowledge215');
               $data2['language16']  = $this->input->post('language16');
               $data2['social116']  = $this->input->post('social116');
               $data2['knowledge216']  = $this->input->post('knowledge216');
               $data2['language17']  = $this->input->post('language17');
               $data2['social117']  = $this->input->post('social117');
               $data2['knowledge217']  = $this->input->post('knowledge217');
               $data2['language18']  = $this->input->post('language18');
               $data2['social118']  = $this->input->post('social118');
               $data2['knowledge218']  = $this->input->post('knowledge218');
               $data2['language19']  = $this->input->post('language19');
               $data2['social119']  = $this->input->post('social119');
               $data2['knowledge219']  = $this->input->post('knowledge219');
               $data2['language20']  = $this->input->post('language20');
               $data2['social120']  = $this->input->post('social120');
               $data2['knowledge220']  = $this->input->post('knowledge220');
               $data2['language21']  = $this->input->post('language21');
               $data2['social121']  = $this->input->post('social121');
               $data2['knowledge221']  = $this->input->post('knowledge221');
               $data2['language22']  = $this->input->post('language22');
               $data2['social122']  = $this->input->post('social122');
               $data2['knowledge222']  = $this->input->post('knowledge222');
               $data2['language23']  = $this->input->post('language23');
               $data2['social123']  = $this->input->post('social123');
               $data2['knowledge223']  = $this->input->post('knowledge223');
               $data2['language24']  = $this->input->post('language24');
               $data2['social124']  = $this->input->post('social124');
               $data2['knowledge224']  = $this->input->post('knowledge224');
               $data2['language25']  = $this->input->post('language25');
               $data2['social125']  = $this->input->post('social125');
               $data2['knowledge225']  = $this->input->post('knowledge225');
               $data2['language26']  = $this->input->post('language26');
               $data2['social126']  = $this->input->post('social126');
               $data2['knowledge226']  = $this->input->post('knowledge226');
               $data2['language27']  = $this->input->post('language27');
               $data2['social127']  = $this->input->post('social127');
               $data2['knowledge227']  = $this->input->post('knowledge227');
               $data2['language28']  = $this->input->post('language28');
               $data2['social128']  = $this->input->post('social128');
               $data2['knowledge228']  = $this->input->post('knowledge228');
               $data2['language29']  = $this->input->post('language29');
               $data2['social129']  = $this->input->post('social129');
               $data2['knowledge229']  = $this->input->post('knowledge229');
               $data2['language30']  = $this->input->post('language30');
               $data2['social130']  = $this->input->post('social130');
               $data2['knowledge230']  = $this->input->post('knowledge230');
               $data2['language31']  = $this->input->post('language31');
               $data2['social131']  = $this->input->post('social131');
               $data2['knowledge231']  = $this->input->post('knowledge231');
               $data2['language32']  = $this->input->post('language32');
               $data2['social132']  = $this->input->post('social132');
               $data2['knowledge232']  = $this->input->post('knowledge232');
               $data2['language33']  = $this->input->post('language33');
               $data2['social133']  = $this->input->post('social133');
               $data2['knowledge233']  = $this->input->post('knowledge233');
               $data2['language34']  = $this->input->post('language34');
               $data2['social134']  = $this->input->post('social134');
               $data2['knowledge234']  = $this->input->post('knowledge234');
               $data2['language35']  = $this->input->post('language35');
               $data2['social135']  = $this->input->post('social135');
               $data2['knowledge235']  = $this->input->post('knowledge235');
               $data2['language36']  = $this->input->post('language36');
               $data2['social136']  = $this->input->post('social136');
               $data2['knowledge236']  = $this->input->post('knowledge236');
               $data2['language37']  = $this->input->post('language37');
               $data2['social137']  = $this->input->post('social137');
               $data2['knowledge237']  = $this->input->post('knowledge237');
               $data2['language38']  = $this->input->post('language38');
               $data2['social138']  = $this->input->post('social138');
               $data2['knowledge238']  = $this->input->post('knowledge238');
               $data2['language39']  = $this->input->post('language39');
               $data2['social139']  = $this->input->post('social139');
               $data2['knowledge239']  = $this->input->post('knowledge239');
               $data2['language40']  = $this->input->post('language40');
               $data2['social140']  = $this->input->post('social140');
               $data2['knowledge240']  = $this->input->post('knowledge240');
               $data2['resumption_date'] = $this->input->post('resumption_date');
               $data2['vacation_date'] = $this->input->post('vacation_date');
               
               
               $this->db->where('student_id', $student_id);
               $this->db->where('class_id', $class_id);
               $this->db->where('exam_id', $exam_id);
               $this->db->where('session_year', $session_year);
               $this->db->update('nursery_student_marks', $data2);}

               // Comments for nursery
                $data_n['TeacherName']  = $this->input->post('TeacherName');
                $data_n['TeacherComment']  = $this->input->post('TeacherComment');
                $data_n['HeadTeacherName']  = $this->input->post('HeadTeacherName');
                $data_n['HeadTeacherComment']  = $this->input->post('HeadTeacherComment');
                $data_n['Attendance']  = $this->input->post('Attendance');
                $data_n['teach_sign'] = $this->input->post('teach_sign');
                $data_n['head_sign'] = $this->input->post('head_sign');

               $this->db->where('class_id', $class_id);
               $this->db->where('student_id', $student_id);
               $this->db->where('exam_id', $exam_id);
               $this->db->where('session_year', $session_year);
               $this->db->update('comments', $data_n);

            if($this->input->post('class_types') == 'primary'){
                //code for update vacation date
                $datapr['resumption_date'] = $this->input->post('resumption_date');
                $datapr['vacation_date'] = $this->input->post('vacation_date');
                $this->db->where('class_id', $class_id);
                $this->db->where('exam_id', $exam_id);
                $this->db->where('session_year', $session_year);
                $this->db->update('mark_pri', $datapr);
            }

            if($this->input->post('class_types') != 'nursery' && $this->input->post('class_types') == 'primary'){
                //code for update vacation date
                $data4['resumption_date'] = $this->input->post('resumption_date');
                $data4['vacation_date'] = $this->input->post('vacation_date');
                $this->db->where('class_id', $class_id);
                $this->db->where('exam_id', $exam_id);
                $this->db->where('session_year', $session_year);
                $this->db->update('mark', $data4);
            }

           $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
           redirect(base_url() . 'index.php?teacher/marks/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
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
            redirect(base_url() . 'index.php?teacher/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
        } else {
            $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
            redirect(base_url() . 'index.php?teacher/marks/', 'refresh');
        }
    }

    function manage_marks0()
    {  
        $page_data['exam_id']    = $this->input->post('exam_id');
        $page_data['class_id']   = $this->input->post('class_id');
        $page_data['student_id'] = $this->input->post('student_id');
        if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0) {
            redirect(base_url() . 'index.php?teacher/marks0/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
        } else {
            $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
            redirect(base_url() . 'index.php?teacher/marks0/', 'refresh');
        }
    }
    
    // TABULATION SHEET
	function tabulation_sheet($class_id = '', $exam_id = '', $student_id = '', $sessoin_id = '') {
		if ($this->session->userdata('teacher_login') != 1)
			redirect(base_url(), 'refresh');

		if ($this->input->post('operation') == 'selection') {
			$page_data['exam_id'] = $this->input->post('exam_id');
			$page_data['class_id'] = $this->input->post('class_id');
			$page_data['student_id'] = $this->input->post('student_id');
			$page_data['sessoin_id'] = $this->input->post('session_year');
	
			if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0 ) {
				redirect(base_url() . 'index.php?teacher/tabulation_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' . $page_data['student_id'].'/'.$page_data['sessoin_id'], 'refresh');
			} else {
				$this->session->set_flashdata('mark_message', 'Choose class and exam');
				redirect(base_url() . 'index.php?teacher/tabulation_sheet/', 'refresh');
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
			if ($class_id > 39 && $class_id < 47){
			    $this->db->distinct();
                $this->db->select('t1.student_id, t1.name,t1.surname')
			    		->from('nursery_student_marks as t2')
			    		->where('t2.class_id', $class_id)
			    		->where('t2.session_year', $session)
			    		->join('student as t1', 't1.student_id = t2.student_id', 'LEFT');
			    $query = $this->db->get();
                $query_array = $query->result_array();}
                
            if ($class_id > 0 && $class_id < 20){
                $this->db->distinct();
                $this->db->select('t1.student_id, t1.name,t1.surname')
					->from('mark_pri as t2')
					->where('t2.class_id', $class_id)
					->where('t2.session_year', $session)
					->join('student as t1', 't1.student_id = t2.student_id', 'LEFT');
			    $query = $this->db->get();
			    $query_array = $query->result_array();}
            
            if ($class_id > 19 && $class_id < 40){
                $this->db->distinct();
                $this->db->select('t1.student_id, t1.name,t1.surname')
					->from('mark as t2')
					->where('t2.class_id', $class_id)
					->where('t2.session_year', $session)
					->join('student as t1', 't1.student_id = t2.student_id', 'LEFT');
			    $query = $this->db->get();
			    $query_array = $query->result_array();
            }
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
		if ($this->session->userdata('teacher_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['class_id'] = $class_id;
		$page_data['exam_id'] = $exam_id;
		$page_data['sessoin_id'] = $sessoin_id;
		$this->load->view('backend/teacher/tabulation_sheet_print_view', $page_data);
    }

    //MIT SCORESHEET
    function score_sheet0($class_id = '', $exam_id = '', $sessoin_id = '') {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id'] = $this->input->post('exam_id');
            $page_data['class_id'] = $this->input->post('class_id');
            $page_data['sessoin_id'] = $this->input->post('session_year');

            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
                redirect(base_url() . 'index.php?teacher/score_sheet0/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' .$page_data['sessoin_id'], 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose class and exam');
                redirect(base_url() . 'index.php?teacher/score_sheet0/', 'refresh');
            }
        }
        $page_data['exam_id'] = $exam_id;
        $page_data['class_id'] = $class_id;
        $page_data['sessoin_id'] = $sessoin_id;
        $page_data['page_info'] = 'BROADSHEET';

        $page_data['page_name'] = 'score_sheet0';
        $page_data['page_title'] = get_phrase('score_sheet0');
        $this->load->view('backend/index', $page_data);
    }
    //EOT SCORESHEET
    function score_sheet($class_id = '', $exam_id = '', $sessoin_id = '') {
    	if ($this->session->userdata('teacher_login') != 1)
			redirect(base_url(), 'refresh');

		if ($this->input->post('operation') == 'selection') {
			$page_data['exam_id'] = $this->input->post('exam_id');
			$page_data['class_id'] = $this->input->post('class_id');
			$page_data['sessoin_id'] = $this->input->post('session_year');
	
			if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
				redirect(base_url() . 'index.php?teacher/score_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' .$page_data['sessoin_id'], 'refresh');
			} else {
				$this->session->set_flashdata('mark_message', 'Choose class and exam');
				redirect(base_url() . 'index.php?teacher/score_sheet/', 'refresh');
			}
		}
		$page_data['exam_id'] = $exam_id;
		$page_data['class_id'] = $class_id;
		$page_data['sessoin_id'] = $sessoin_id;
		$page_data['page_info'] = 'BROADSHEET';
	
		$page_data['page_name'] = 'score_sheet';
		$page_data['page_title'] = get_phrase('score_sheet');
		$this->load->view('backend/index', $page_data);
	}

	//function added on 28-06-18 sandeep
	function tabulation_sheet_print_view_control($class_id, $exam_id,$sessoin_id) {
		if ($this->session->userdata('teacher_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['class_id'] = $class_id;
		$page_data['exam_id'] = $exam_id;
		$page_data['sessoin_id'] = $sessoin_id;
		redirect(base_url() . 'index.php?teacher/tabulation_sheet_print_view/' . $page_data['class_id'] . '/' . $page_data['exam_id'].'/'.$page_data['sessoin_id'], 'refresh');
	}
	
	// added on 28-06-2018 sandeep

	function tabulation_sheet_print_view_single($class_id, $exam_id,$sessoin_id,$student_id){
		if ($this->session->userdata('teacher_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['class_id'] = $class_id;
		$page_data['exam_id'] = $exam_id;
		$page_data['sessoin_id'] = $sessoin_id;
		$page_data['student_id'] = $student_id;
		$this->load->view('backend/teacher/tabulation_sheet_print_view_single', $page_data);
	}

	function tabulation_sheet_print_single_control($class_id, $exam_id,$sessoin_id,$student_id){
		if ($this->session->userdata('teacher_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['class_id'] = $class_id;
		$page_data['exam_id'] = $exam_id;
		$page_data['sessoin_id'] = $sessoin_id;
		$page_data['student_id'] = $student_id;
		redirect(base_url() . 'index.php?teacher/tabulation_sheet_print_view_single/' . $page_data['class_id'] . '/' . $page_data['exam_id'].'/'.$page_data['sessoin_id'].'/'.$student_id, 'refresh');
    }

// TABULATION SHEET MIDTERM

function tabulation_sheet_midterm($class_id = '', $exam_id = '', $student_id = '', $sessoin_id = '') {
    if ($this->session->userdata('teacher_login') != 1)
        redirect(base_url(), 'refresh');

    if ($this->input->post('operation') == 'selection') {
        $page_data['exam_id'] = $this->input->post('exam_id');
        $page_data['class_id'] = $this->input->post('class_id');
        $page_data['student_id'] = $this->input->post('student_id');
        $page_data['sessoin_id'] = $this->input->post('session_year');

        if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0 ) {
            redirect(base_url() . 'index.php?teacher/tabulation_sheet_midterm/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' . $page_data['student_id'].'/'.$page_data['sessoin_id'], 'refresh');
        } else {
            $this->session->set_flashdata('mark_message', 'Choose class and exam');
            redirect(base_url() . 'index.php?teacher/tabulation_sheet_midterm/', 'refresh');
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
    if ($this->session->userdata('teacher_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $this->load->view('backend/teacher/tabulation_sheet_midterm_print_view', $page_data);
}

function tabulation_sheet_midterm_print_view_control($class_id, $exam_id,$sessoin_id) {
    if ($this->session->userdata('teacher_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    redirect(base_url() . 'index.php?teacher/tabulation_sheet_midterm_print_view/' . $page_data['class_id'] . '/' . $page_data['exam_id'].'/'.$page_data['sessoin_id'], 'refresh');
}

function tabulation_sheet_midterm_print_view_single($class_id, $exam_id,$sessoin_id,$student_id){
     if ($this->session->userdata('teacher_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $page_data['student_id'] = $student_id;
    $this->load->view('backend/teacher/tabulation_sheet_midterm_print_view_single', $page_data);
}

function tabulation_sheet_midterm_print_single_control($class_id, $exam_id,$sessoin_id,$student_id){
    if ($this->session->userdata('teacher_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['sessoin_id'] = $sessoin_id;
    $page_data['student_id'] = $student_id;
    redirect(base_url() . 'index.php?teacher/tabulation_sheet_midterm_print_view_single/' . $page_data['class_id'] . '/' . $page_data['exam_id'].'/'.$page_data['sessoin_id'].'/'.$student_id, 'refresh');
}
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?teacher/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?teacher/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
    
/* * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

function manage_profile($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('teacher_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');
    if ($param1 == 'update_profile_info') {
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');

        $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
        $this->db->update('teacher', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $this->session->userdata('teacher_id') . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
        redirect(base_url() . 'index.php?teacher/manage_profile/', 'refresh');
    }
    if ($param1 == 'change_password') {
        $data['password'] = $this->input->post('password');
        $data['new_password'] = $this->input->post('new_password');
        $data['confirm_new_password'] = $this->input->post('confirm_new_password');

        $current_password = $this->db->get_where('teacher', array(
                    'teacher_id' => $this->session->userdata('teacher_id')
                ))->row()->password;
        if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
            $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
            $this->db->update('teacher', array(
                'password' => $data['new_password']
            ));
            $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
        } else {
            $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
        }
        redirect(base_url() . 'index.php?teacher/manage_profile/', 'refresh');
    }
    $page_data['page_name'] = 'manage_profile';
    $page_data['page_title'] = get_phrase('manage_profile');
    $page_data['edit_data'] = $this->db->get_where('teacher', array(
                'teacher_id' => $this->session->userdata('teacher_id')
            ))->result_array();
    $this->load->view('backend/index', $page_data);
}    
    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['class_id']   = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('time_start');
            $data['time_end']   = $this->input->post('time_end');
            $data['day']        = $this->input->post('day');
            $this->db->insert('class_routine', $data);
            redirect(base_url() . 'index.php?teacher/class_routine/', 'refresh');
        }
        if ($param1 == 'edit' && $param2 == 'do_update') {
            $data['class_id']   = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('time_start');
            $data['time_end']   = $this->input->post('time_end');
            $data['day']        = $this->input->post('day');
            
            $this->db->where('class_routine_id', $param3);
            $this->db->update('class_routine', $data);
            redirect(base_url() . 'index.php?teacher/class_routine/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                'class_routine_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_schedule_id', $param2);
            $this->db->delete('class_schedule');
            redirect(base_url() . 'index.php?teacher/class_routine/', 'refresh');
        }
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = get_phrase('manage_class_routine');
        $this->load->view('backend/index', $page_data);
    }
	
	/****** DAILY ATTENDANCE *****************/
    function manage_attendance($date='',$month='',$year='',$class_id='',$exam_id='')
    {
        if($this->session->userdata('teacher_login')!=1)redirect('login' , 'refresh');

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
        //$exam_id = $this->input->post('exam_id');
        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?teacher/manage_attendance/' . $date . '/' . $month . '/' . $year . '/' . $class_id . '/' . $exam_id, 'refresh');
    }
    $page_data['date'] = $date;
    $page_data['month'] = $month;
    $page_data['year'] = $year;
    $page_data['class_id'] = $class_id;
    $page_data['exam_id'] = $exam_id;
    $page_data['page_name'] = 'manage_attendance';
    $page_data['page_title'] = get_phrase('manage_daily_attendance');
    $this->load->view('backend/index', $page_data);
}

	
	
    function attendance_selector() {
    $date = $this->input->post('timestamp');
    $date = date_create($date);
    $date = date_format($date, "d/m/Y");
    redirect(base_url() . 'index.php?teacher/manage_attendance/' . $date . '/' . $this->input->post('class_id') . '/' . $this->input->post('exam_id'),'refresh');
}

function attendance_report_view() {
    redirect(base_url() . 'index.php?teacher/attendance_report/' . $this->input->post('class_id') . '/' . $this->input->post('section_id') . '/' . $this->input->post('month') . '/' . $this->input->post('year'), 'refresh');
}
    
    
    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);
        
    }
	
	
	 /**********MANAGE HOLIDAY ********************/
    function holiday($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['holidays']      = $this->db->get('holiday')->result_array();
        $page_data['page_name']  = 'holiday';
        $page_data['page_title'] = get_phrase('manage_holidays');
        $this->load->view('backend/index', $page_data);
        
    }
	
	
	 /**********MANAGE todays_thought ********************/
    function todays_thought($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
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
            redirect(base_url() . 'index.php?teacher/loan_applicant' , 'refresh');
        }
		
        $page_data['page_name']  = 'loan_applicant';
        $page_data['page_title'] = get_phrase('loan_application');
        $page_data['loan_applicants']  = $this->db->get('loan')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	
	
	/**********MANAGE LOAN APPLICATIONS *******************/
    function loan_approval($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
       
		
        $page_data['page_name']  = 'loan_approval';
        $page_data['page_title'] = get_phrase('view_approval');
        $page_data['loan_approvals']  = $this->db->get('loan')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	
	
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);
        
    }
	
	
	
	/**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function assignment($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
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
            //$assignment_id = $this->db->insert_id();
			
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/assignment/" . $_FILES["file_name"]["name"]);
            redirect(base_url() . 'index.php?teacher/assignment' , 'refresh');
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
            redirect(base_url() . 'index.php?teacher/assignment/'.$data['assignment_id'], 'refresh');
			}
			
       if ($param1 == 'delete') {
            $this->db->where('assignment_id' , $param2);
            $this->db->delete('assignment');
            $file = $this->db->get_where('assignment',array('assignment_id' => $param2))->result_array();
            
            unlink("uploads/assignment/".$file[0]['filename']);
            $this->session->set_flashdata('flash_message' , get_phrase('file_deleted'));
            redirect(base_url() . 'index.php?teacher/assignment' , 'refresh');
        }
		
        $page_data['page_name']  = 'assignment';
        $page_data['page_title'] = get_phrase('manage_assignment');
        $page_data['assignments']  = $this->db->get('assignment')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	
	
	
	
	/**********MANAGE AASIGNMENTS *******************/
    function examquestion($param1 = '', $param2 = '' , $param3 = '')
    {
      if ($this->session->userdata('teacher_login') != 1)
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
            redirect(base_url() . 'index.php?teacher/examquestion' , 'refresh');
        }
		if ($param1 == 'do_update') {
             $data['timestamp']     = $this->input->post('timestamp');
            $data['subject_id']         = $this->input->post('subject_id');
            $data['description']     = $this->input->post('description');
            $data['class_id']       = $this->input->post('class_id');

            
            $this->db->where('examquestion_id', $param2);
            $this->db->update('examquestion', $data);
			 $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?teacher/examquestion'.$data['examquestion_id'], 'refresh');
			}
			
       if ($param1 == 'delete') {
            $this->db->where('examquestion_id' , $param2);
            $this->db->delete('examquestion');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?teacher/examquestion' , 'refresh');
        }
		
        $page_data['page_name']  = 'examquestion';
        $page_data['page_title'] = get_phrase('manage_examquestion');
        $page_data['examquestions']  = $this->db->get('examquestion')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	
	
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function news($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['newss'] = $this->db->get('news')->result_array();
        $page_data['page_name']  = 'news';
        $page_data['page_title'] = get_phrase('manage_news');
        $this->load->view('backend/index', $page_data);
        
    }
    
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);
            redirect(base_url() . 'index.php?teacher/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);
            $this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
            redirect(base_url() . 'index.php?teacher/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            redirect(base_url() . 'index.php?teacher/noticeboard/', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
	
	
	/****MANAGE HELPFUL LINK*****/
    function help_link($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
			
        if ($param1 == 'create') {
            
			$data['title']         = $this->input->post('title');
            $data['link'] 			= $this->input->post('link');
            $data['class_id'] 		= $this->input->post('class_id');
            
            $this->db->insert('help_link', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?teacher/help_link', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['title']         = $this->input->post('title');
            $data['link'] = $this->input->post('link');
			$data['class_id'] 		= $this->input->post('class_id');
            
            $this->db->where('helplink_id', $param2);
            $this->db->update('help_link', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?teacher/help_link', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('help_link', array(
                'helplink_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('helplink_id', $param2);
            $this->db->delete('help_link');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?teacher/help_link', 'refresh');
        }
        $page_data['help_links']    = $this->db->get('help_link')->result_array();
        $page_data['page_name']  = 'help_link';
        $page_data['page_title'] = get_phrase('manage_help_link');
        $this->load->view('backend/index', $page_data);
    }
	
	
    
    /**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function document($do = '', $document_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        if ($do == 'upload') {
            move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/document/" . $_FILES["userfile"]["name"]);
            $data['document_name'] = $this->input->post('document_name');
            $data['file_name']     = $_FILES["userfile"]["name"];
            $data['file_size']     = $_FILES["userfile"]["size"];
            $this->db->insert('document', $data);
            redirect(base_url() . 'teacher/manage_document', 'refresh');
        }
        if ($do == 'delete') {
            $this->db->where('document_id', $document_id);
            $this->db->delete('document');
            redirect(base_url() . 'teacher/manage_document', 'refresh');
        }
        $page_data['page_name']  = 'manage_document';
        $page_data['page_title'] = get_phrase('manage_documents');
        $page_data['documents']  = $this->db->get('document')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /*********MANAGE STUDY MATERIAL************/
    function study_material($task = "", $document_id = "")
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
                
        if ($task == "create")
        {
            $this->crud_model->save_study_material_info();
            $this->session->set_flashdata('flash_message' , get_phrase('study_material_info_saved_successfuly'));
            redirect(base_url() . 'index.php?teacher/study_material' , 'refresh');
        }
        
        if ($task == "update")
        {
            $this->crud_model->update_study_material_info($document_id);
            $this->session->set_flashdata('flash_message' , get_phrase('study_material_info_updated_successfuly'));
            redirect(base_url() . 'index.php?teacher/study_material' , 'refresh');
        }
        
        if ($task == "delete")
        {
            $this->crud_model->delete_study_material_info($document_id);
            $files = $this->db->get_where('document',array('document_id' => $document_id))->result_array();
            foreach ($files as $file) {
            unlink("uploads/document/".$file["filename"]);}
            redirect(base_url() . 'index.php?teacher/study_material');
        }
        
        $data['study_material_info']    = $this->crud_model->select_study_material_info();
        $data['page_name']              = 'study_material';
        $data['page_title']             = get_phrase('study_material');
        $this->load->view('backend/index', $data);
    }
    
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('teacher_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?teacher/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?teacher/message/message_read/' . $param2, 'refresh');
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