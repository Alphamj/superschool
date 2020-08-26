<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }
     //added on 6 june 2018 sandeep
    function get_type_fullname_by_id($type, $type_id = '', $field = 'name') {
        $data_stu =  $this->db->get_where($type, array($type . '_id' => $type_id))->result_array();
        return  $data_stu[0]['name'].' '.$data_stu[0]['surname'];
    }
     //added on 11 june 2018 sandeep
    function get_absent_student() {
	 	$sql = "SELECT count(*) as total FROM `attendance` where status ='0' and MONTH(date) ='".date('m')."'";
         $rows = $this->db->query($sql)->result_array();
        return $rows[0]['total'];
    }
    //added on 11 june 2018 sandeep
    function get_present_student() {
	 	$sql = "SELECT count(*) as total FROM `attendance` where status ='1' and MONTH(date) ='".date('m')."'";
         $rows = $this->db->query($sql)->result_array();
        return $rows[0]['total'];
    }
    //added on 11 june 2018 sandeep
    function get_expence_reports() {
	 	$sql = "SELECT * FROM `expense_category`";
        $rows = $this->db->query($sql)->result_array();
        $cat_name ='';
        foreach( $rows as $result){
			$cat_name .= '"'.$result["name"].'",';
		}
		return  rtrim($cat_name,',');
        
    }
     //added on 21 june 2018 sandeep payment
    function get_expence_reports1() {
	 	$sql = "SELECT ec.name,SUM(p.amount) as total_amount FROM `expense_category` ec, payment p where p.expense_category_id =ec.expense_category_id group by ec.expense_category_id";
        $rows = $this->db->query($sql)->result_array();
        $cat_name ='';
        foreach( $rows as $result){
			$cat_name .= '{value:'.$result["total_amount"].',name: "'.$result["name"].'"},';
		}
		return  rtrim($cat_name,',');
     }
    
    //added on 4 june 2018 sandeep
     function get_type_name_by_id1($type, $type_id = '', $field = 'name') {
        return  $this->db->get_where($type, array($type . '_id' => $type_id))->result_array();
        
    }
    
     function get_subject_name_by_ids($type, $type_id = '', $field = 'name') {
        return  $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
        
    }
    function get_subject_name_by_idss($type, $type_id = '', $field = 'name') {
        return  $this->db->get($type)->row()->$field;
        
    }
    

////////STUDENT/////////////
    function get_students($class_id) {
        $query = $this->db->get_where('student', array('class_id' => $class_id));
        return $query->result_array();
    }
    //code added on 28 may 2018 sandeep
    function get_students_section($class_id,$section_id) {
        $query = $this->db->get_where('student', array('class_id' => $class_id,'section_id'=>$section_id));
        return $query->result_array();
    }

    function get_student_info($student_id) {
        $query = $this->db->get_where('student', array('student_id' => $student_id));
        return $query->result_array();
    }

    function new_student_list() {
        $data = array();
        $sql = "select * from student order by student_id desc limit 0, 7";
        $rows = $this->db->query($sql)->result_array();
        foreach ($rows as $row) {
            $key = $row['student_id'];
            $face_file = 'uploads/student_image/' . $row['student_id'] . '.jpg';
            if (!file_exists($face_file)) {
                $face_file = 'uploads/default_avatar.jpg';
            }
            $row["face_file"] = base_url() . $face_file;

            array_push($data, $row);
        }
        return $data;
    }

/////////TEACHER/////////////
    function get_teachers() {
        $query = $this->db->get('teacher');
        return $query->result_array();
    }

    function get_teacher_name($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_teacher_info($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        return $query->result_array();
    }

//////////SUBJECT/////////////
    function get_subjects() {
        $query = $this->db->get('subject');
        return $query->result_array();
    }

    function get_subject_info($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subjects_by_class($class_id) {
        $query = $this->db->get_where('subject', array('class_id' => $class_id));
        return $query->result_array();
    }
    //code added on 4 june 2018 sandeep
    function get_subjects_by_class1($class_id) {
        $query = $this->db->get_where('class_subject', array('class_id' => $class_id));
        return $query->result_array();
    }
    function get_subjects_by_class01() {
        $query = $this->db->get('nursery_subject');
        return $query->result_array();
    }

    function get_subjects_by_class2($class_id,$student_id,$teacher_id) {
        $query = $this->db->get_where('class_subject', array('class_id' => $class_id, 'student_id' => $student_id, 'teacher_id' => $teacher_id));
        return $query->result_array();
    }

    function get_subjects_by_class3($class_id,$teacher_id) {
        $query = $this->db->get_where('class_subject', array('class_id' => $class_id, 'teacher_id' => $teacher_id));
        return $query->result_array();
    }

    function get_subjects_by_class4($class_id,$student_id) {
        $query = $this->db->get_where('class_subject', array('class_id' => $class_id, 'student_id' => $student_id));
        return $query->result_array();
    }
    function get_subjects_by_class5($class_id) {
        $query = $this->db->get_where('nursery_student_marks', array('class_id' => $class_id));
        return $query->result_array();
    }
    
    //code added on 30 june 2018 sandeep
     function get_subjects_nursery_class1($class_id) {
        $this->db->select('t1.subject_id, t1.name')
				->from('class_subject as t2')
				->join('subject as t1', 't1.subject_id = t2.subject_id')
				->where('t2.class_id',$class_id);
		$query = $this->db->get();
        return $query->result_array();
    }
    //code added on 29 june 2018 sandeep
     function get_nursery_student_question($session_year) {
        $query = $this->db->get_where('nursery_student_question', array('session_year' => $session_year));
        return $query->result_array();
    }

    function get_subject_name_by_id($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
        return $query->name;
    }

////////////CLASS///////////
    function get_class_name($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_class_name_numeric($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name_numeric'];
    }

    function get_classes() {
        $query = $this->db->get('class');
        return $query->result_array();
    }

    function get_class_info($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        return $query->result_array();
    }

//////////EXAMS/////////////
    function get_exams() {
        $query = $this->db->get('exam');
        return $query->result_array();
    }

    function get_exam_info($exam_id) {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

//////////GRADES/////////////
    function get_grades() {
        $query = $this->db->get('grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id) {
        $query = $this->db->get_where('grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }

    function get_obtained_marks($exam_id, $class_id, $subject_id, $student_id) {
        $marks = $this->db->get_where('mark', array(
                    'subject_id' => $subject_id,
                    'exam_id' => $exam_id,
                    'class_id' => $class_id,
                    'student_id' => $student_id))->result_array();

        foreach ($marks as $row) {
            echo $row['mark_obtained'];
        }
    }

    function get_highest_marks($exam_id, $class_id, $subject_id) {
        $this->db->where('exam_id', $exam_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('subject_id', $subject_id);
        $this->db->select_max('mark_obtained');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach ($highest_marks as $row) {
            echo $row['mark_obtained'];
        }
    }

    function get_grade($mark_obtained) {
        $query = $this->db->get('grade');
        $grades = $query->result_array();
        foreach ($grades as $row) {
            if ($mark_obtained >= $row['mark_from'] && $mark_obtained <= $row['mark_upto'])
                return $row;
        }
    }

    function create_log($data) {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }

    function get_system_settings() {
        $query = $this->db->get('settings');
        return $query->result_array();
    }

////////BACKUP RESTORE/////////
    function create_backup($type) {
        $this->load->dbutil();


        $options = array(
            'format' => 'txt', // gzip, zip, txt
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"               // Newline character used in backup file
        );


        if ($type == 'all') {
            $tables = array('');
            $file_name = 'system_backup';
        } else {
            $tables = array('tables' => array($type));
            $file_name = 'backup_' . $type;
        }

        $backup = & $this->dbutil->backup(array_merge($options, $tables));


        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }

/////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
    function restore_backup() {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
        $this->load->dbutil();


        $prefs = array(
            'filepath' => 'uploads/backup.sql',
            'delete_after_upload' => TRUE,
            'delimiter' => ';'
        );
        $restore = & $this->dbutil->restore($prefs);
        unlink($prefs['filepath']);
    }

/////////DELETE DATA FROM TABLES///////////////
    function truncate($type) {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('mark');
            $this->db->truncate('teacher');
            $this->db->truncate('subject');
            $this->db->truncate('class');
            $this->db->truncate('exam');
            $this->db->truncate('grade');
        } else {
            $this->db->truncate($type);
        }
    }

////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }
    //function added on 28 may 2018 sandeep
////////user files//////////
    function get_user_image_url($type = '', $id = '') {
		$this->db->select($type);
		$this->db->from('student');
		$this->db->where('student_id',$id);
		
		$query=$this->db->get();
		$result =  $query->row_array();
		return $result[$type];
    }

 ////////STUDY MATERIAL//////////
    function save_study_material_info()
    {
        $data['timestamp']      = strtotime($this->input->post('timestamp'));
        $data['title'] 		= $this->input->post('title');
        $data['description']    = $this->input->post('description');
        $data['file_name'] 	= $_FILES["file_name"]["name"];
        $data['file_type'] 	= $this->input->post('file_type');
        $data['class_id'] 	= $this->input->post('class_id');
        $data['teacher_id'] 	= $this->input->post('teacher_id');
        
        $this->db->insert('document',$data);
        
        $document_id            = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
    }
    
    function select_study_material_info()
    {
        $this->db->order_by("timestamp", "desc");
        return $this->db->get('document')->result_array(); 
    }
    
    function select_study_material_info_for_student()
    {
        $student_id = $this->session->userdata('student_id');
        $class_id   = $this->db->get_where('student', array('student_id' => $student_id))->row()->class_id;
        $this->db->order_by("timestamp", "desc");
        return $this->db->get_where('document', array('class_id' => $class_id))->result_array();
    }
    
    function update_study_material_info($document_id)
    {
        $data['timestamp']      = strtotime($this->input->post('timestamp'));
        $data['title'] 		= $this->input->post('title');
        $data['description']    = $this->input->post('description');
        $data['class_id'] 	= $this->input->post('class_id');
        
        $this->db->where('document_id',$document_id);
        $this->db->update('document',$data);
    }
    
    function delete_study_material_info($document_id)
    {
        $this->db->where('document_id',$document_id);
        $this->db->delete('document');
    }

////////private message//////
    function send_new_private_message() {
        $message = $this->input->post('message');
        $timestamp = strtotime(date("Y-m-d H:i:s"));

        $reciever = $this->input->post('reciever');
        $sender = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

//check if the thread between those 2 users exists, if not create new thread
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();

        if ($num1 == 0 && $num2 == 0) {
            $message_thread_code = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender'] = $sender;
            $data_message_thread['reciever'] = $reciever;
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
        if ($num2 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;


        $data_message['message_thread_code'] = $message_thread_code;
        $data_message['message'] = $message;
        $data_message['sender'] = $sender;
        $data_message['timestamp'] = $timestamp;
        $this->db->insert('message', $data_message);

// notify email to email reciever
//$this->email_model->notify_email('new_message_notification', $this->db->insert_id());

        return $message_thread_code;
    }

    function send_reply_message($message_thread_code) {
        $message = $this->input->post('message');
        $timestamp = strtotime(date("Y-m-d H:i:s"));
        $sender = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');


        $data_message['message_thread_code'] = $message_thread_code;
        $data_message['message'] = $message;
        $data_message['sender'] = $sender;
        $data_message['timestamp'] = $timestamp;
        $this->db->insert('message', $data_message);

// notify email to email reciever
//$this->email_model->notify_email('new_message_notification', $this->db->insert_id());
    }

    function mark_thread_messages_read($message_thread_code) {
// mark read only the oponnent messages of this thread, not currently logged in user's sent messages
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }

    function count_unread_message_of_thread($message_thread_code) {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }

    function count_unread_message_of_curuser() {
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $sql = "select count(a.message_id) counts from message a "
                . " inner join message_thread b on a.message_thread_code=b.message_thread_code "
                . " where b.reciever='" . $current_user . "' and a.read_status=0";
        $row = $this->db->query($sql)->row_array();
        return $row["counts"];
    }

    function unread_message_of_curuser() {
        $data = array();
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $sql = "select a.*  from message a "
                . " inner join message_thread b on a.message_thread_code=b.message_thread_code "
                . " where b.reciever='" . $current_user . "' and a.read_status=0";
        $rows = $this->db->query($sql)->result_array();
        foreach ($rows as $row) {
            $sender = explode('-', $row['sender']);
            $sender_type = $sender[0];
            $sender_id = $sender[1];

            $sql = "select name from " . $sender_type . " where " . $sender_type . "_id=" . $sender_id;
            $result = $this->db->query($sql)->row_array();
            $row["sender_name"] = $result["name"];

            $key = $row['sender'];
            $face_file = 'uploads/' . $sender_type . '_image/' . $sender_id . '.jpg';
            if (!file_exists($face_file)) {
                $face_file = 'uploads/default_avatar.jpg';
            }
            $row["face_file"] = base_url() . $face_file;

//            $cur_time = date('Y-m-d H:i:s', time());
//            $send_time =date('Y-m-d H:i:s', $row["timestamp"]);
//            echo $cur_time;
//            $diff = date_diff($cur_time, $send_time);
            $ago = '';
            $sec = time() - $row["timestamp"];
            $year = (int) ($sec / 31556926);
            $month = (int) ($sec / 2592000);
            $day = (int) ($sec / 86400);
            $hou = (int) ($sec / 3600);
            $min = (int) ($sec / 60);
            if ($year > 0) {
                $ago = $year . ' year(s)';
            } else if ($month > 0) {
                $ago = $month . ' month(s)';
            } else if ($day > 0) {
                $ago = $day . ' day(s)';
            } else if ($hou > 0) {
                $ago = $hou . ' hour(s)';
            } else if ($min > 0) {
                $ago = $min . ' minute(s)';
            } else {
                $ago = $sec . ' second(s)';
            }

            $row["ago"] = $ago;

            array_push($data, $row);
        }
        return $data;
    }
	//function added on 28-06-18 sandeep
	function student_session_get($class_id,$session,$student_idss,$current_year =''){
		if($current_year){
			$students	=	$this->crud_model->get_students($class_id); 
             foreach($students as $row2): ?>
               <option class="student_id" value="<?php echo $row2['student_id'];?>" <?php if($student_idss ==$row2['student_id']){ echo'selected';} ?>><?php echo $row2['name'].' '.$row2['surname'];?>
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
				<option value="<?php echo $students_id; ?>" <?php if($student_idss ==$students_id){ echo'selected';} ?>><?php echo $students_name.' '.$surname; ?></option>
			<?php	}
		}

	}
	//function added on 28-06-18 sandeep
	
	function get_student_classes($student_id){
		$this->db->distinct();
		$this->db->select('t1.class_id, t1.name')
				->from('mark as t2')
				->where('t2.student_id', $student_id)
				
				->join('class as t1', 't1.class_id = t2.class_id', 'LEFT');
		$query = $this->db->get();
		$query_array = $query->result_array();
		return $query_array;
    }
    
    function get_student_classes0($student_id){
		$this->db->distinct();
		$this->db->select('t1.class_id, t1.name')
				->from('mark0 as t2')
				->where('t2.student_id', $student_id)
				
				->join('class as t1', 't1.class_id = t2.class_id', 'LEFT');
		$query = $this->db->get();
		$query_array = $query->result_array();
		return $query_array;
	}
	//function added on 28-06-18 sandeep
	
	function get_student_classes_parent($student_ids = array()){
		if($student_ids){
			$this->db->distinct();
			$this->db->select('t1.class_id, t1.name')
					->from('mark as t2')
					->join('class as t1', 't1.class_id = t2.class_id')
					->where_in('t2.student_id',$student_ids);
			$query = $this->db->get();
			$query_array = $query->result_array();
		}else{ $query_array =  array();}
		return $query_array;
	}
	
	
	// function for get marks position sandeep
	function get_positions($class_id,$student_id,$exam_id,$sessoin_id){
		$query_array2 =array(); 
		
        if ($class_id > 19 && $class_id < 23 ){
            //$this->db->distinct();
		    $this->db->select('total_average');
		    $this->db->where('class_id', 101); 
		    $this->db->where('exam_id', $exam_id); 
		    $this->db->where('session_year', $sessoin_id); 
		    $this->db->order_by("total_average", "desc");
		    $query_array = $this->db->get('average')->result_array();
        }
        elseif ($class_id > 22 && $class_id < 26 ){
            //$this->db->distinct();
		    $this->db->select('total_average');
		    $this->db->where('class_id', 102); 
		    $this->db->where('exam_id', $exam_id); 
		    $this->db->where('session_year', $sessoin_id); 
		    $this->db->order_by("total_average", "desc");
		    $query_array = $this->db->get('average')->result_array();
        }
        elseif ($class_id > 25 && $class_id < 29 ){
            //$this->db->distinct();
		    $this->db->select('total_average');
		    $this->db->where('class_id', 103); 
		    $this->db->where('exam_id', $exam_id); 
		    $this->db->where('session_year', $sessoin_id); 
		    $this->db->order_by("total_average", "desc");
		    $query_array = $this->db->get('average')->result_array();
        }
        elseif ($class_id > 28 && $class_id < 32 ){
            //$this->db->distinct();
		    $this->db->select('total_average');
		    $this->db->where('class_id', 111); 
		    $this->db->where('exam_id', $exam_id); 
		    $this->db->where('session_year', $sessoin_id); 
		    $this->db->order_by("total_average", "desc");
		    $query_array = $this->db->get('average')->result_array();
        }
        elseif ($class_id > 31 && $class_id < 35 ){
            //$this->db->distinct();
		    $this->db->select('total_average');
		    $this->db->where('class_id', 112); 
		    $this->db->where('exam_id', $exam_id); 
		    $this->db->where('session_year', $sessoin_id); 
		    $this->db->order_by("total_average", "desc");
		    $query_array = $this->db->get('average')->result_array();
        }
        elseif ($class_id > 34 && $class_id < 38 ){
            //$this->db->distinct();
		    $this->db->select('total_average');
		    $this->db->where('class_id', 113); 
		    $this->db->where('exam_id', $exam_id); 
		    $this->db->where('session_year', $sessoin_id); 
		    $this->db->order_by("total_average", "desc");
		    $query_array = $this->db->get('average')->result_array();
        }
		
		foreach($query_array as $result){
			$query_array2[] = $result['total_average'];
        }
        if ($class_id > 19 && $class_id < 23 ){
            $marks = $this->db->get_where('average' , array('class_id' => 101, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=> $sessoin_id))->result_array();
         }
         elseif ($class_id > 22 && $class_id < 26 ){
            $marks = $this->db->get_where('average' , array('class_id' => 102, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=> $sessoin_id))->result_array();
         }
         elseif ($class_id > 25 && $class_id < 29 ){
            $marks = $this->db->get_where('average' , array('class_id' => 103, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=> $sessoin_id))->result_array();
         }
         elseif ($class_id > 28 && $class_id < 32 ){
            $marks = $this->db->get_where('average' , array('class_id' => 111, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=> $sessoin_id))->result_array();
         }
         elseif ($class_id > 31 && $class_id < 35 ){
            $marks = $this->db->get_where('average' , array('class_id' => 112, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=> $sessoin_id))->result_array();
         }
         elseif ($class_id > 34 && $class_id < 38 ){
            $marks = $this->db->get_where('average' , array('class_id' => 113, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=> $sessoin_id))->result_array();
         }
		$total_mark = trim($marks[0]['total_average']);
		if($total_mark > 0){
            $positions = array_search($total_mark,$query_array2)+1;
            $next = $query_array2;
            $final_position='';
            return $final_position = $positions.date('S',mktime(1,1,1,1,( (($positions>=10)+($positions>=20)+($positions==0))*10 + $positions%10) ));
        
            //if($positions ==1){
		    //		$final_position = '1st';
		    //	}else if($positions ==2){
		    //		$final_position = '2nd';
		    //	}else if($positions==3){
		    //		$final_position = '3rd';
		    //	}else{
		    //	$final_position = $positions.'th';	
		    //	}
		}else{
			$final_position='';
		}
        return $final_position;
        
    }

    function get_positions0($class_id,$student_id,$exam_id,$sessoin_id){
		$query_array2 =array(); 
		
        if ($class_id > 19 && $class_id < 23 ){
            //$this->db->distinct();
		    $this->db->select('total_average');
		    $this->db->where('class_id', 101); 
		    $this->db->where('exam_id', $exam_id); 
		    $this->db->where('session_year', $sessoin_id); 
		    $this->db->order_by("total_average", "desc");
		    $query_array = $this->db->get('average0')->result_array();
        }
        elseif ($class_id > 22 && $class_id < 26 ){
            //$this->db->distinct();
		    $this->db->select('total_average');
		    $this->db->where('class_id', 102); 
		    $this->db->where('exam_id', $exam_id); 
		    $this->db->where('session_year', $sessoin_id); 
		    $this->db->order_by("total_average", "desc");
		    $query_array = $this->db->get('average0')->result_array();
        }
        elseif ($class_id > 25 && $class_id < 29 ){
            //$this->db->distinct();
		    $this->db->select('total_average');
		    $this->db->where('class_id', 103); 
		    $this->db->where('exam_id', $exam_id); 
		    $this->db->where('session_year', $sessoin_id); 
		    $this->db->order_by("total_average", "desc");
		    $query_array = $this->db->get('average0')->result_array();
        }
        elseif ($class_id > 28 && $class_id < 32 ){
            //$this->db->distinct();
		    $this->db->select('total_average');
		    $this->db->where('class_id', 111); 
		    $this->db->where('exam_id', $exam_id); 
		    $this->db->where('session_year', $sessoin_id); 
		    $this->db->order_by("total_average", "desc");
		    $query_array = $this->db->get('average0')->result_array();
        }
        elseif ($class_id > 31 && $class_id < 35 ){
            //$this->db->distinct();
		    $this->db->select('total_average');
		    $this->db->where('class_id', 112); 
		    $this->db->where('exam_id', $exam_id); 
		    $this->db->where('session_year', $sessoin_id); 
		    $this->db->order_by("total_average", "desc");
		    $query_array = $this->db->get('average0')->result_array();
        }
        elseif ($class_id > 34 && $class_id < 38 ){
            //$this->db->distinct();
		    $this->db->select('total_average');
		    $this->db->where('class_id', 113); 
		    $this->db->where('exam_id', $exam_id); 
		    $this->db->where('session_year', $sessoin_id); 
		    $this->db->order_by("total_average", "desc");
		    $query_array = $this->db->get('average0')->result_array();
        }
		
		foreach($query_array as $result){
			$query_array2[] = $result['total_average'];
        }
        if ($class_id > 19 && $class_id < 23 ){
            $marks = $this->db->get_where('average0' , array('class_id' => 101, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=> $sessoin_id))->result_array();
         }
         elseif ($class_id > 22 && $class_id < 26 ){
            $marks = $this->db->get_where('average0' , array('class_id' => 102, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=> $sessoin_id))->result_array();
         }
         elseif ($class_id > 25 && $class_id < 29 ){
            $marks = $this->db->get_where('average0' , array('class_id' => 103, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=> $sessoin_id))->result_array();
         }
         elseif ($class_id > 28 && $class_id < 32 ){
            $marks = $this->db->get_where('average0' , array('class_id' => 111, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=> $sessoin_id))->result_array();
         }
         elseif ($class_id > 31 && $class_id < 35 ){
            $marks = $this->db->get_where('average0' , array('class_id' => 112, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=> $sessoin_id))->result_array();
         }
         elseif ($class_id > 34 && $class_id < 38 ){
            $marks = $this->db->get_where('average0' , array('class_id' => 113, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=> $sessoin_id))->result_array();
         }
		$total_mark = trim($marks[0]['total_average']);
		if($total_mark >0){
			$positions=   array_search($total_mark,$query_array2)+1;
            $final_position='';
            return $final_position = $positions.date('S',mktime(1,1,1,1,( (($positions>=10)+($positions>=20)+($positions==0))*10 + $positions%10) ));
        //if($positions ==1){
		//		$final_position = '1st';
		//	}else if($positions ==2){
		//		$final_position = '2nd';
		//	}else if($positions==3){
		//		$final_position = '3rd';
		//	}else{
		//	$final_position = $positions.'th';	
		//	}
		}else{
			$final_position='';
		}
        return $final_position;
        
    }
    
    
    function get_class_vacation_daten($class_id,$exam_id,$session_id){
		$this->db->distinct();
		$this->db->select('vacation_date,resumption_date')
				->from('nursery_student_marks')
				->where('class_id',$class_id)
				->where('exam_id',$exam_id)
				->where('vacation_date !=','')
				->where('session_year',$session_id);
		$query = $this->db->get();
		$query_array = $query->result_array();
        return $query_array;
    }

    //function added on 30-06-18 sandeep
	function get_class_vacation_datep($class_id,$exam_id,$session_id){
		$this->db->distinct();
		$this->db->select('vacation_date,resumption_date')
				->from('mark_pri')
				->where('class_id',$class_id)
				->where('exam_id',$exam_id)
				->where('vacation_date !=','')
				->where('session_year',$session_id);
		$query = $this->db->get();
		$query_array = $query->result_array();
		return $query_array;
    }
        
	//function added on 30-06-18 sandeep
	function get_class_vacation_date($class_id,$exam_id,$session_id){
		$this->db->distinct();
		$this->db->select('vacation_date,resumption_date')
				->from('mark')
				->where('class_id',$class_id)
				->where('exam_id',$exam_id)
				->where('vacation_date !=','')
				->where('session_year',$session_id);
		$query = $this->db->get();
		$query_array = $query->result_array();
		return $query_array;
    }
    
    function get_class_vacation_date0($class_id,$exam_id,$session_id){
		$this->db->distinct();
		$this->db->select('vacation_date,resumption_date')
				->from('mark0')
				->where('class_id',$class_id)
				->where('exam_id',$exam_id)
				->where('vacation_date !=','')
				->where('session_year',$session_id);
		$query = $this->db->get();
		$query_array = $query->result_array();
		return $query_array;
		
    }
    
    function get_class_vacation_date0_pri($class_id,$exam_id,$session_id){
		$this->db->distinct();
		$this->db->select('vacation_date,resumption_date')
				->from('mark0')
				->where('class_id',$class_id)
				->where('exam_id',$exam_id)
				->where('vacation_date !=','')
				->where('session_year',$session_id);
		$query = $this->db->get();
		$query_array = $query->result_array();
		return $query_array;
		
    }
    
    function get_class_vacation_date0_nur($class_id,$exam_id,$session_id){
		$this->db->distinct();
		$this->db->select('vacation_date,resumption_date')
				->from('mark0')
				->where('class_id',$class_id)
				->where('exam_id',$exam_id)
				->where('vacation_date !=','')
				->where('session_year',$session_id);
		$query = $this->db->get();
		$query_array = $query->result_array();
		return $query_array;
		
	}
	//function added on 30-06-18 sandeep
	function sbj_total_marks($class_id,$exam_id,$session_id){
		$stm=0;
		$this->db->select('subject_total_marks')
				->from('mark')
				->where('class_id',$class_id)
				->where('exam_id',$exam_id)
				->where('session_year',$session_id);
		$query = $this->db->get();
        $query_array = $query->result_array();
        
        foreach($query_array as $marks){
            $stm += $marks['mark_total'];
        }

		return ($stm);
		
    }
    
    function get_subject_average($class_id,$exam_id,$sessoin_id){
		$this->db->select('subject_id')
				->from('mark')
				->where('class_id',$class_id)
				->where('exam_id',$exam_id)
                ->where('session_year',$sessoin_id);
		$query = $this->db->get();
		$query_array = $query->result_array();
		
        $tsub = count($query_array);
        $tmark = 0;
        $average = 0;
        foreach($query_array as $mak){
            $tmark += $mak;
        }
        $average = $tmark / $tsub;
		return ($average);
		
    }
    
	//function added on 30-06-18 sandeep
	function get_class_average($class_id,$exam_id,$session_id){
		$student_average=0;
		$this->db->select('subject_total_marks')
				->from('mark')
				->where('class_id',$class_id)
				->where('exam_id',$exam_id)
				->where('session_year',$session_id)
				->group_by('student_id');
		$query = $this->db->get();
		$query_array = $query->result_array();
		
		$total_subjects = count($query_array);
		$student_total_marks='';
		if($total_subjects > 0){
			foreach($query_array as $marks){
				$student_total_marks += $marks['subject_total_marks'];
			}
			$student_average = $student_total_marks/$total_subjects;
		}
		return round($student_average,2);
		
	}
	
	//function added on 30 june 2018 sandeep
	function get_subjects_nursery_questions($subject_id,$class_id,$exam_id,$session_id){
		$this->db->select('question_id,question')
				->from('nursery_student_question')
				->where('class_id',$class_id)
				->where('exam_id',$exam_id)
				->where('subject_id',$subject_id)
				->where('session_year',$session_id);
				
		$query = $this->db->get();
		return $query_array = $query->result_array();
	}
}