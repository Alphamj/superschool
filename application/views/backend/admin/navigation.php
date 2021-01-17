<?php
if ($this->session->userdata('admin_login') != 1)
    redirect('login', 'refresh');
$sql = "select a.*, b.display, b.parent_name from admin_permission a "
        . " inner join actions b on a.action_id=b.action_id "
        . " where a.admin_id=" . $this->session->userdata('login_user_id');
$permissions = $this->db->query($sql)->result_array();
$perm_arr = array();
$parent_arr = array();
foreach ($permissions as $perm) {
    array_push($perm_arr, $perm['display']);
    array_push($parent_arr, $perm['parent_name']);
}

$perm_arr = json_encode($perm_arr);
$parent_arr = json_encode($parent_arr);
//print_r($permissions);

$sql = "select * from admin where admin_id=" . ($this->session->userdata('login_user_id'));
$info = $this->db->query($sql)->result_array();
$admin_info = $info[0];
$admin_level = $admin_info['level'];
?>

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu hide">
    <div class="menu_section">

        <ul id="main-menu" class="nav side-menu">
            <!-- DASHBOARD -->
            <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                    <span><?php echo get_phrase('home'); ?></span>
                </a>
            </li>

            <li class="<?php if ($page_name == 'event') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/event">
                    <i class="entypo-book"></i>
                    <span><?php echo 'Event'; ?></span>
                </a>
            </li>
			
			  <!-- ACADEMICS -->
            <li class="<?php
            if ($page_name == 'session' ||
                    $page_name == 'enquiry_setting'||
                    $page_name == 'enquiry'||
                    $page_name == 'club'||
                    $page_name == 'circular'||
                    $page_name == 'task_manager'||
                    $page_name == 'help_link'||
                    $page_name == 'help_desk'||
                    $page_name == 'holiday'||
                    $page_name == 'todays_thought'||
                    $page_name == 'academic_syllabus')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-flow-tree"></i>
                    <span><?php echo get_phrase('academics'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
				
                    <!-- SESSION -->
            <li class="<?php if ($page_name == 'session') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/session">
                    <span><?php echo get_phrase('manage_session'); ?></span>
                </a>
            </li>
					
                    <!-- ENQUIRY TABLE INFO 
            <li class="<?php //if ($page_name == 'enquiry_setting') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/enquiry_setting">
                    <span><?php //echo get_phrase('enquiry_category'); ?></span>
                </a>
            </li>-->
			
			 <!-- ENQUIRY TABLE INFO 
            <li class="<?php //if ($page_name == 'enquiry') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/enquiry">
                    <span><?php //echo get_phrase('view_enquiries'); ?></span>
                </a>
            </li>-->
				
				 <!-- CLUB 
            <li class="<?php //if ($page_name == 'club') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/club">
                    <span><?php //echo get_phrase('school_clubs'); ?></span>
                </a>
            </li>-->

            <!-- CIRCULAR MANAGER 
            <li class="<?php //if ($page_name == 'circular') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/circular">
                <?php //echo get_phrase('manage_circular'); ?></span>
                </a>
            </li>-->

            <!-- TASK MANAGER -->
            <li class="<?php if ($page_name == 'task_manager') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/task_manager">
                 <?php echo get_phrase('task_manager'); ?></span>
                </a>
            </li>
			
			 <!-- HOLIDAYS -->
            <li class="<?php if ($page_name == 'holiday') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/holiday">
                    <span><?php echo get_phrase('manage_holiday'); ?></span>
                </a>
            </li>

            <!-- TODAYS THOUGHT -->
            <li class="<?php if ($page_name == 'todays_thought') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/todays_thought">
                    <span><?php echo get_phrase('moral_talk'); ?></span>
                </a>
            </li>
			
			 <!-- ENQUIRY TABLE INFO -->
            <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/academic_syllabus">
                    <span><?php echo get_phrase('academic_syllabus'); ?></span>
                </a>
            </li>
			
			
            <!-- HELP LINKS 
            <li class="<?php //if ($page_name == 'help_link') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/help_link">
                    <span><?php //echo get_phrase('manage_help_link'); ?></span>
                </a>
            </li>-->

            <!-- HELP DESK 
            <li class="<?php //if ($page_name == 'help_desk') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/help_desk">
                    <span><?php //echo get_phrase('manage_help_desks'); ?></span>
                </a>
            </li>-->
					
                </ul>
            </li>
			
		
		 <!-- SCHOOL STAFF -->
            <li class="<?php
            if ($page_name == 'teacher' ||
                    $page_name == 'librarian'||
                    $page_name == 'accountant'||
                    $page_name == 'subject_teacher'||
                    $page_name == 'head'||
                    $page_name == 'hostel')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('manage_staff'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
			
                      <!-- SUBJECT TEACHER -->
            <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/teacher">
                    <span><?php echo get_phrase('subject_teacher'); ?></span>
                </a>
            </li>

                      <!-- HEADS -->
            <li class="<?php if ($page_name == 'head') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/head">
                    <span><?php echo get_phrase('head'); ?></span>
                </a>
            </li>
					
                    <!-- LIBRARIAN 
            <li class="<?php //if ($page_name == 'librarian') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/librarian">
                    <span><?php //echo get_phrase('librarians'); ?></span>
                </a>
            </li>-->
			
			 <!-- ACCOUNTANT -->
            <li class="<?php if ($page_name == 'accountant') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/accountant">
                    <span><?php echo get_phrase('accountants'); ?></span>
                </a>
            </li>

            <!-- HOSTEL MANAGER 
            <li class="<?php //if ($page_name == 'hostel') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/hostel">
                    <span><?php //echo get_phrase('hostel_manager'); ?></span>
                </a>
            </li>-->

					
					
                </ul>
            </li>
			
			
           
            <!-- STUDENT -->
            <li class="<?php
            if ($page_name == 'student_add' ||
                    $page_name == 'switch_class' ||
                    $page_name == 'student_information' ||
                    $page_name == 'view_student' ||
                    $page_name == 'student_promotion')
                echo 'opened active has-sub';
            ?> ">
                <a href="#">
                    <i class="entypo-graduation-cap"></i>
                    <span><?php echo get_phrase('manage_students'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <!-- STUDENT ADMISSION -->
                    <li class="<?php if ($page_name == 'student_add') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/student_add">
                            <span><?php echo get_phrase('admission_form'); ?></span>
                        </a>
                    </li>
					
					 <li class="<?php if ($page_name == 'student_information' || $page_name == 'student_information' || $page_name == 'view_student') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/student_information">
                            <span><?php echo get_phrase('list_students'); ?></span>
                        </a>
                    </li>

                    <!-- STUDENT INFORMATION
                    <li class="<?php if ($page_name == 'student_information' || $page_name == 'student_marksheet') echo 'opened active'; ?> ">
                        <a href="#">
                            <span><?php echo get_phrase('student_details'); ?></span><span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <?php
                           // $classes = $this->db->get('class')->result_array();
                           // foreach ($classes as $row):
                                ?>
                                <li class="<?php if ($page_name == 'student_information' && $page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">
                                    <a href="<?php echo base_url(); ?>index.php?admin/student_information/<?php echo $row['class_id']; ?>">
                                        <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                    </a>
                                </li>
                            <?php //endforeach; ?>
                        </ul>
                    </li> -->

                    <!-- STUDENT PROMOTION -->
                    <li class="<?php if ($page_name == 'student_promotion') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/student_promotion">
                            <span><?php echo get_phrase('promote_students'); ?></span>
                        </a>
                    </li>
                    <!-- SWITCH CLASS -->
                    <li class="<?php if ($page_name == 'switch_class') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/switch_class">
                            <span><?php echo get_phrase('switch_class'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>  
			
			
			 <!-- DAILY ATTENDANCE -->
            <li class="<?php
            if ($page_name == 'manage_attendance' ||
                    $page_name == 'attendance_report')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('manage_attendance'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/manage_attendance/<?php echo date("d/m/Y"); ?>">
                            <span><?php echo get_phrase('student_attendance'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'attendance_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/attendance_report">
                            <span><?php echo get_phrase('attendance_report'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
			
			
			 <!-- DOWNLOAD PAGE -->
			   <!-- code comment on 4 june 2018 sandeep -->
            <!--
            <li class="<?php
            //if ($page_name == 'assignment' ||
                    //$page_name == 'study_material')
                //echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="fa fa-download"></i>
                    <span><?php //echo get_phrase('download_page'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                   
            <li class="<?php //if ($page_name == 'assignment') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/assignment">
                    <span><?php //echo get_phrase('assignments'); ?></span>
                </a>
            </li>
         
            	<li class="<?php //if ($page_name == 'study_material') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/study_material">
                    <span><?php //echo get_phrase('study_materials'); ?></span>
                </a>
            </li>
                </ul>
            </li> -->
			
            <!-- PARENTS -->
            <li class="<?php if ($page_name == 'parent') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/parent">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('manage_parents'); ?></span>
                </a>
            </li>

            <!-- ALUMNI -->
            <!-- code comment on 4 june 2018 sandeep 
            
            <li class="<?php //if ($page_name == 'alumni') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/alumni">
                    <i class="entypo-users"></i>
                    <span><?php //echo get_phrase('manage_alumni'); ?></span>
                </a>
            </li>-->
			 
            <!-- MEDIA -->
               <!-- code comment on 4 june 2018 sandeep -->
            <!--
            <li class="<?php //if ($page_name == 'media') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/media">
                    <i class="entypo-target"></i>
                    <span><?php //echo get_phrase('manage_media'); ?></span>
                </a>
            </li>-->

            <!-- LOAN PAGE -->
              <!-- code comment on 4 june 2018 sandeep -->
            <!--
            <li class="<?php
            /*if ($page_name == 'loan_applicant' ||
                    $page_name == 'loan_approval')
                echo 'opened active';*/
            ?> ">
                <a href="#">
                    <i class="entypo-flow-tree"></i>
                    <span><?php //echo get_phrase('manage_loan'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li class="<?php //if ($page_name == 'loan_applicant') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/loan_applicant">
                            <span><?php //echo get_phrase('loan_applicant'); ?></span>
                        </a>
                    </li>
                    <li class="<?php //if ($page_name == 'loan_approval') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/loan_approval">
                            <span><?php //echo get_phrase('loan_approval'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>-->
  <!-- code comment on 4 june 2018 sandeep -->
            <!--
            <li class="<?php
            /*if ($page_name == 'teacher_id_card' ||
                    $page_name == 'hostel_id_card' ||
                    $page_name == 'id_card' ||
                    $page_name == 'accountant_id_card' ||
                    $page_name == 'librarian_id_card')
                echo 'opened active';*/
            ?> ">
                <a href="#">
                    <i class="entypo-book"></i>
                    <span><?php //echo get_phrase('generate_ID_cards'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li class="<?php //if ($page_name == 'teacher_id_card') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/teacher_id_card">
                            <span> <?php //echo get_phrase('teacher_ID_card'); ?></span>
                        </a>
                    </li>

                    <li class="<?php //if ($page_name == 'id_card') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/id_card">
                            <span><?php //echo get_phrase('student_ID_card'); ?></span>
                        </a>
                    </li>
                    <li class="<?php //if ($page_name == 'hostel_id_card') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/hostel_id_card">
                            <span><?php //echo get_phrase('hostel_ID_card'); ?></span>
                        </a>
                    </li>
                    <li class="<?php //if ($page_name == 'accountant_id_card') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/accountant_id_card">
                            <span><?php //echo get_phrase('accountant_ID_card'); ?></span>
                        </a>
                    </li>
                    <li class="<?php //if ($page_name == 'librarian_id_card') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/librarian_id_card">
                            <span><?php //echo get_phrase('librarian_ID_card'); ?></span>
                        </a>
                    </li>
                </ul>
            </li> -->
				
            <!-- CLASS -->
            <li class="<?php
            if ($page_name == 'class' ||
                    $page_name == 'section' ||
                    $page_name == 'class_routine')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-flow-tree"></i>
                    <span><?php echo get_phrase('class_information'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li class="<?php if ($page_name == 'class') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/classes">
                            <span><?php echo get_phrase('manage_classes'); ?></span>
                        </a>
                    </li>
                    <!--<li class="<?php //if ($page_name == 'section') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/section">
                            <span><?php //echo get_phrase('manage_sections'); ?></span>
                        </a>
                    </li>
					
					<li class="<?php //if ($page_name == 'class_routine') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/class_routine">
                             <span><?php //echo get_phrase('class_timetable'); ?></span>
                        </a>
                    </li> -->  
                </ul>
            </li>

            <!-- SUBJECT -->
            <li class="<?php 
            if ($page_name == 'subject' ||
                    $page_name == 'student_subject' ||
                    $page_name == 'nursery_subject' ||
                    $page_name == 'nursery_subject1' ||
                    $page_name == 'nursery_subject2' ||
                    $page_name == 'nursery_subject3' ||
                    $page_name == 'nursery_subject_2' ||
                    $page_name == 'nursery_subject1_2' ||
                    $page_name == 'nursery_subject2_2' ||
                    $page_name == 'nursery_subject3_2' ||
                    $page_name == 'class_subject' ||
                    $page_name == 'modify_subject' ||
                    $page_name == 'subject_template')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('manage_subjects'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                
                
             <ul class="nav child_menu">
				 
                        <li class="<?php if ($page_name == 'subject') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?admin/subject/">
                                <span><?php echo get_phrase('manage_subjects'); ?></span>
                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'student_subject') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?admin/student_subject/">
                                <span><?php echo get_phrase('student_subjects');?></span>
                            </a>
                        </li>
                        <li class="<?php if ($page_name == 'nursery_subject3') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?admin/nursery_subject3/">
                                <span><?php echo get_phrase('toddler_term_1'); ?></span>
                            </a>
                        </li>
                        <li class="<?php if ($page_name == 'nursery_subject3_2') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?admin/nursery_subject3_2/">
                                <span><?php echo get_phrase('toddler_term_2'); ?></span>
                            </a>
                        </li>
                        <li class="<?php if ($page_name == 'nursery_subject') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?admin/nursery_subject/">
                                <span><?php echo get_phrase('nursery_1_term_1'); ?></span>
                            </a>
                        </li>
                        <li class="<?php if ($page_name == 'nursery_subject_2') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?admin/nursery_subject_2/">
                                <span><?php echo get_phrase('nursery_1_term_2'); ?></span>
                            </a>
                        </li>
                        <li class="<?php if ($page_name == 'nursery_subject1') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?admin/nursery_subject1/">
                                <span><?php echo get_phrase('nursery_2_term_1'); ?></span>
                            </a>
                        </li>
                        <li class="<?php if ($page_name == 'nursery_subject12_') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?admin/nursery_subject1_2/">
                                <span><?php echo get_phrase('nursery_2_term_2'); ?></span>
                            </a>
                        </li>
                        <li class="<?php if ($page_name == 'nursery_subject2') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?admin/nursery_subject2/">
                                <span><?php echo get_phrase('nursery_3_term_1'); ?></span>
                            </a>
                        </li>
                        <li class="<?php if ($page_name == 'nursery_subject2_2') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?admin/nursery_subject2_2/">
                                <span><?php echo get_phrase('nursery_3_term_2'); ?></span>
                            </a>
                        </li>
						<li class="<?php if ($page_name == 'class_subject') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?admin/class_subject/">
                                <span><?php echo get_phrase('class_subject'); ?></span>
                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'modify_subject_jss') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?admin/modify_subject_jss/">
                                <span><?php echo get_phrase('modify_subject_jss'); ?></span>
                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'modify_subject') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?admin/modify_subject/">
                                <span><?php echo get_phrase('modify_subject_sss'); ?></span>
                            </a>
                        </li>
                        
						<!--<li class="<?php //if ($page_name == 'subject_template') echo 'active'; ?>">
                            <a href="<?php //echo base_url(); ?>index.php?admin/subject_template/">
                                <span><?php //echo get_phrase('add_subject_template'); ?></span>
                            </a>
                        </li>-->
						
                    <?php //endforeach; ?>
					
					   
                </ul>
            </li>

            <!-- DAILY ATTENDANCE -->
            <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/manage_attendance/<?php echo date("d/m/Y"); ?>">
                    <i class="entypo-chart-area"></i>
                    <span><?php echo get_phrase('daily_attendances'); ?></span>
                </a>
    
            </li> 



            <!-- EXAMS -->
              <!-- code comment on 4 june 2018 sandeep -->
            <!--
            <li class="<?php
            /*if ($page_name == 'exam_list' ||
                    $page_name == 'exam_add' ||
                    $page_name == 'exam_view' ||
                    $page_name == 'exam_result_list')
                echo 'opened active';*/
            ?> ">
                <a href="#">
                    <i class="entypo-graduation-cap"></i>
                    <span><?php //echo get_phrase('manage_CBT'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">

                    <li class="<?php //if ($page_name == 'exam_add') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/exam_add">
                            <span><?php //echo get_phrase('add_exams'); ?></span>
                        </a>
                    </li>  

                    <li class="<?php //if ($page_name == 'exam_list' || $page_name == 'exam_view') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/exam_list">
                            <span><?php //echo get_phrase('list_exams'); ?></span>
                        </a>
                    </li>

                    <li class="<?php //if ($page_name == 'exam_result_list') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/exam_result_list">
                            <span><?php //echo get_phrase('view_result'); ?></span>
                        </a>
                    </li>    

                </ul>
            </li>-->


            <!-- EXAMS 
            <li class="<?php
            /*if ($page_name == 'exam' ||
                    $page_name == 'grade' ||
                    $page_name == 'examquestion')
                echo 'opened active';*/
            ?> ">
                <a href="#">
                    <i class="entypo-graduation-cap"></i>
                    <span><?php //echo get_phrase('manage_exams'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li class="<?php //if ($page_name == 'examquestion') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/examquestion">
                            <span><?php //echo get_phrase('exam_questions'); ?></span>
                        </a>
                    </li>
                    <li class="<?php //if ($page_name == 'exam') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/exam">
                            <span><?php //echo get_phrase('list_exams'); ?></span>
                        </a>
                    </li>
                    <li class="<?php //if ($page_name == 'grade') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/grade">
                            <span><?php //echo get_phrase('exam_grades'); ?></span>
                        </a>
                    </li>
                   
                </ul>
            </li>-->
			
			
			 <!-- REPORT CARD -->
            <li class="<?php
            if ($page_name == 'marks0' ||
                    $page_name == 'tabulation_sheet_midterm' ||
                    $page_name == 'marks'||
                    $page_name == 'tabulation_sheet'||
                    $page_name == 'MIT score_sheet' ||
                    $page_name == 'EOT score_sheet')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('report_cards'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                     <!-- NOTICEBOARD -->
                    <li class="<?php if ($page_name == 'marks0') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/marks0">
                            <span><?php echo 'Mid Term Scores'; ?></span>
                        </a>
                    </li>
                    <!-- new code for mid term report -->
                    <li class="<?php if ($page_name == 'tabulation_sheet_midterm') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/tabulation_sheet_midterm">
                            <span>Generate Mid Term Report</span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'marks') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/marks">
                            <span><?php echo get_phrase('end_of_term_scores'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'tabulation_sheet') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/tabulation_sheet">
                            <span><?php echo get_phrase('generate_EOT_report_card'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'EOT score_sheet') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/score_sheet">
                            <span><?php echo get_phrase('EOT score_sheet'); ?></span>
                        </a>
                    </li>
					<li class="<?php if ($page_name == 'MIT score_sheet') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/score_sheet0">
                            <span><?php echo get_phrase('MIT score_sheet'); ?></span>
                        </a>
                    </li>
					 <!--<li class="<?php //if ($page_name == 'nursery_student_question') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/nursery_student_question">
                            <span><?php //echo get_phrase('enter_nursery_student_question'); ?></span>
                        </a>
                    </li>
                    <li class="<?php //if ($page_name == 'exam_marks_sms') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/exam_marks_sms">
                            <span><?php //echo get_phrase('send_scores_by_sms'); ?></span>
                        </a>
                    </li>-->
                    
                </ul>
            </li>

           
            <!-- PAYMENT 
            <li class="<?php //if ($page_name == 'invoice') echo 'active';?> ">
                <a href="<?php //echo base_url();?>index.php?admin/invoice">
                    <i class="entypo-credit-card"></i>
                    <span><?php //echo get_phrase('payment');?></span>
                </a>
            </li>-->

            <!-- ACCOUNTING -->
            <li class="<?php
            if ($page_name == 'income' ||
                    $page_name == 'student_payment'||
                    $page_name == 'invoice')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-vcard"></i>
                    <span><?php echo get_phrase('fee_collection'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li class="<?php if ($page_name == 'student_payment') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/student_payment">
                            <span><?php echo get_phrase('collect_fees'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'income') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/income">
                            <span><?php echo get_phrase('fees_payments'); ?></span>
                        </a>
                    </li>
					
					 <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/invoice">
                            <span><?php echo get_phrase('manage_invoice'); ?></span>
                        </a>
                    </li>
                    
                </ul>
            </li>



			 <!-- EXPENSES 
            <li class="<?php
            /*if ($page_name == 'expense' ||
                    $page_name == 'expense_category' )
                echo 'opened active';*/
            ?> ">
                <a href="#">
                    <i class="entypo-vcard"></i>
                    <span><?php //echo get_phrase('expenses'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li class="<?php //if ($page_name == 'expense') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/expense">
                            <span><?php //echo get_phrase('expense'); ?></span>
                        </a>
                    </li>
                    <li class="<?php //if ($page_name == 'expense_category') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/expense_category">
                            <span><?php //echo get_phrase('expense_category'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>-->
			
			 <!-- LIBRARY INFORMATION -->
            <li class="<?php
            if ($page_name == 'book' ||
                    $page_name == 'publisher' ||
					$page_name == 'search_student' ||
					$page_name == 'book_category' ||
                    $page_name == 'author' )
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('manage_library'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <!-- LIBRARY -->
            <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/book">
                    <span><?php echo get_phrase('master_data'); ?></span>
                </a>
            </li>
                    <li class="<?php if ($page_name == 'publisher') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/publisher">
                            <span><?php echo get_phrase('book_publisher'); ?></span>
                        </a>
                    </li>
					
					<li class="<?php if ($page_name == 'book_category') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/book_category">
                            <span><?php echo get_phrase('book_category'); ?></span>
                        </a>
                    </li>
					
					<li class="<?php if ($page_name == 'author') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/author">
                            <span><?php echo get_phrase('book_author'); ?></span>
                        </a>
                    </li>
					<li class="<?php if ($page_name == 'search_student') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/search_student">
                            <span><?php echo get_phrase('register_student'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>

			
			 <!-- HOSTEL INFORMATION 
            <li class="<?php
            /*if ($page_name == 'dormitory' ||
                    $page_name == 'hostel_category' ||
					$page_name == 'room_type' ||
                    $page_name == 'hostel_room' )
                echo 'opened active';*/
            ?> ">
                <a href="#">
                     <i class="entypo-home"></i>
                    <span><?php //echo get_phrase('hostel_information'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
            <li class="<?php ////if ($page_name == 'dormitory') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/dormitory">
                    <span><?php //echo get_phrase('manage_hostel'); ?></span>
                </a>
            </li>
                    <li class="<?php //if ($page_name == 'hostel_category') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/hostel_category">
                            <span><?php //echo get_phrase('hostel_category'); ?></span>
                        </a>
                    </li>
					
					<li class="<?php //if ($page_name == 'room_type') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/room_type">
                            <span><?php //echo get_phrase('room_type'); ?></span>
                        </a>
                    </li>
					
					<li class="<?php //if ($page_name == 'hostel_room') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/hostel_room">
                            <span><?php //echo get_phrase('hostel_room'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>-->
			
			
			 <!-- COMMUNICATIONS -->
            <li class="<?php
            if ($page_name == 'noticeboard' ||
                    $page_name == 'message')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('communications'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
            <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/noticeboard">
                    <span><?php echo get_phrase('manage_events'); ?></span>
                </a>
            </li>
            <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/message">
                    <span><?php echo get_phrase('private_messages'); ?></span>
                </a>
            </li>
                </ul>
            </li>
			
			
			 <!-- TRANSPORTATION CONTROLLER INFORMATION  
            <li class="<?php
            /*if ($page_name == 'transport' ||
                    $page_name == 'transport_route' ||
                    $page_name == 'vehicle' )
                echo 'opened active';*/
            ?> ">
                <a href="#">
                    <i class="entypo-flight"></i>
                    <span><?php //echo get_phrase('transportation'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
            <li class="<?php //if ($page_name == 'transport') echo 'active'; ?> ">
                <a href="<?php //echo base_url(); ?>index.php?admin/transport">
                    <span><?php //echo get_phrase('transports'); ?></span>
                </a>
            </li>
                    <li class="<?php //if ($page_name == 'transport_route') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/transport_route">
                            <span><?php //echo get_phrase('transport_route'); ?></span>
                        </a>
                    </li>
					
					 <li class="<?php //if ($page_name == 'vehicle') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/vehicle">
                            <span><?php //echo get_phrase('manage_vehicle'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>-->


            <!-- SETTINGS -->
            <li class="<?php
            if ($page_name == 'system_settings' ||
                    $page_name == 'email_template' ||
                    $page_name == 'backup_restore' ||
                    $page_name == 'actions' ||
                    $page_name == 'manage_language' ||
                    $page_name == 'sms_settings')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span><?php echo get_phrase('system_setting'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
                            <span><?php echo get_phrase('general_settings'); ?></span>
                        </a>
                    </li>
					 <!--<li class="<?php //if ($page_name == 'actions') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/actions">
                            <span><?php //echo get_phrase('manage_sidebar'); ?></span>
                        </a>
                    </li>
                    <li class="<?php //if ($page_name == 'sms_settings') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/sms_settings">
                            <span><?php //echo get_phrase('manage_sms_api'); ?></span>
                        </a>
                    </li>
					 <li class="<?php //if ($page_name == 'backup_restore') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/backup_restore">
                            <span><?php //echo get_phrase('manage_database'); ?></span>
                        </a>
                    </li>
					 <li class="<?php //if ($page_name == 'email_template') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/email_template">
                            <span><?php //echo get_phrase('email_template'); ?></span>
                        </a>
                    </li>
                    <li class="<?php //if ($page_name == 'manage_language') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/manage_language">
                            <span><?php //echo get_phrase('languages'); ?></span>
                        </a>
                    </li>-->
                </ul>
            </li>
			
			
			<!-- REPORTS 
            <li class="<?php
           /* if ($page_name == 'manage_report' ||
                    $page_name == 'student_report' ||
                    $page_name == 'payment_report' ||
                    $page_name == 'expense_report' ||
                    $page_name == 'loan_report' ||
					$page_name == 'documentation' )
                echo 'opened active';*/
            ?> <?php //if ($page_name == 'manage_report' ) echo 'active'; ?>">
                <a href="<?php //echo base_url(); ?>index.php?admin/manage_report">
                    <i class="fa fa-bar-chart-o"></i>
                    <span><?php //echo get_phrase('generate_reports'); ?></span>--><!--<span class="fa fa-chevron-down"></span>
                </a>-->
                    <!-- code comment on 4 june 2018 sandeep -->
            <!--
                <ul class="nav child_menu">
                    <li class="<?php //if ($page_name == 'manage_report' || $page_name == 'student_report' || $page_name == 'payment_report' || $page_name == 'expense_report' || $page_name == 'loan_report') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/manage_report">
                            <span><?php //echo get_phrase('manage_reports'); ?></span>
                        </a>
                    </li>
                  
                    <li class="<?php //if ($page_name == 'documentation') echo 'active'; ?> ">
                        <a href="<?php //echo base_url(); ?>index.php?admin/documentation">
                            <span><?php //echo get_phrase('view_documentation'); ?></span>
                        </a>
                    </li>
                </ul> 
            </li>-->





            <!-- FRNTEND PAGE -->
            <li class="<?php
            if ($page_name == 'banar' ||
                    $page_name == 'front_end' ||
                    $page_name == 'testimony' ||
                    $page_name == 'gallery' ||
                    $page_name == 'news')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-flow-tree"></i>
                    <span><?php echo get_phrase('front_end_settings'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li class="<?php if ($page_name == 'banar') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/banar">
                            <span><?php echo get_phrase('manage_banners'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'front_end') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/front_end">
                            <span><?php echo get_phrase('system_information'); ?></span>
                        </a>
                    </li>
					
					<li class="<?php if ($page_name == 'gallery') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/gallery">
                            <span><?php echo get_phrase('manage_gallery'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'news') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/news">
                            <span><?php echo get_phrase('news_settings'); ?></span>
                        </a>
                    </li>
					
					<li class="<?php if ($page_name == 'testimony') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/testimony">
                            <span><?php echo get_phrase('manage_testimony'); ?></span>
                        </a>
                    </li>

                </ul>
            </li>

            <!-- ACCOUNT -->
            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/manage_profile">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('personal_details'); ?></span>
                </a>
            </li>

            <?php if ($admin_info['level'] == 1): ?>
                <li class="<?php
                if ($page_name == 'admin_list' ||
                        $page_name == 'admin_add')
                    echo 'opened active';
                ?> ">
                    <a href="#">
                        <i class="entypo-users"></i>
                        <span><?php echo get_phrase('role_managements'); ?></span><span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <li class="<?php if ($page_name == 'admin_list') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>index.php?admin/admin_list">
                                <span><?php echo get_phrase('admin_list'); ?></span>
                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'admin_add') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>index.php?admin/admin_add">
                                <span><?php echo get_phrase('new_admin'); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>                
    </div>
</div>

<script>
    var perm_arr = <?php echo $perm_arr; ?>;
    var parent_arr = <?php echo $parent_arr; ?>;
    var admin_level = <?php echo $admin_level; ?>;
    $('#sidebar-menu .menu_section >ul>li, #sidebar-menu .menu_section >ul>li>ul>li').each(function () {
        var perm = $(this).find('span').html();
        if (admin_level > 1 && $.inArray(perm, perm_arr) < 0 && $.inArray(perm, parent_arr) < 0 && perm != 'dashboard') {
            if ($(this).parents('li').find('span').html() != 'Subjects') {
                $(this).remove();
            }
        }

    });
    $('#sidebar-menu').removeClass('hide');
</script>

