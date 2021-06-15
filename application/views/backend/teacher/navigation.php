
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">

        <ul id="main-menu" class="nav side-menu">
            <!-- add class "multiple-expanded" to allow multiple submenus to open -->
            <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


            <!-- DASHBOARD -->
            <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/dashboard">
                    <i class="entypo-home"></i>
                    <span><?php echo get_phrase('home'); ?></span>
                </a>
            </li>
			
			 <!-- STUDENT -->
            <li class="<?php
            if ($page_name == 'class_routine'||
			    $page_name == 'help_link'||
			    $page_name == 'academic_syllabus'||
			    $page_name == 'holiday'||
			    $page_name == 'todays_thought'||
			    $page_name == 'news'
				)
                echo 'opened active has-sub';
            ?> ">
                <a href="#">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('academics'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                      <!-- CLASS ROUTINE -->
            	<li class="<?php if ($page_name == 'class_routine') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/class_routine">
                    <span><?php echo get_phrase('time_table'); ?></span>
                </a>
            	</li>
				
				 <!-- TODAYS THOUGHT -->
               <li class="<?php if ($page_name == 'help_link') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/help_link">
                    <span><?php echo get_phrase('helpful_link'); ?></span>
                </a>
                </li>
				
				 <!-- TODAYS THOUGHT -->
            	<li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/academic_syllabus">
                    <span><?php echo get_phrase('download_syllabus'); ?></span>
                </a>
				</li>
				
				
				 <!-- HOLIDAYS -->
            	<li class="<?php if ($page_name == 'holiday') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/holiday">
                    <span><?php echo get_phrase('view_holidays'); ?></span>
                </a>
            	</li>

            <!-- TODAYS THOUGHT -->
            	<li class="<?php if ($page_name == 'todays_thought') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/todays_thought">
                    <span><?php echo get_phrase('moral_talk'); ?></span>
                </a>
            	</li>
				
				   <!-- TODAYS THOUGHT -->
            <li class="<?php if ($page_name == 'news') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/news">
                    <span><?php echo get_phrase('all_news'); ?></span>
                </a>
            </li>
				
                </ul>
            </li>
			

           <!-- STUDENT -->
            <li class="<?php
            if ($page_name == 'student_information'||
			    $page_name == 'view_student')
                echo 'opened active has-sub';
            ?> ">
                <a href="#">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('manage_students'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <!-- STUDENT ADMISSION -->
                    <li class="<?php if ($page_name == 'student_information' || $page_name == 'view_student') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_information">
                            <span> <?php echo get_phrase('list_students'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- TEACHER -->
            <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/teacher_list">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('view_teachers'); ?></span>
                </a>
            </li>

            <!-- SUBJECT -->
            <?php /*
            <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> ">
                <a href="#">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('view_subjects'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                        <li class="<?php if ($page_name == 'subject' ) echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/subject">
                                <span><?php echo get_phrase('my_subjects'); ?></span>
                            </a>
                        </li>
                </ul>
            </li> */ ?>

            <!-- STUDY MATERIAL -->
            <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/study_material">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('study_material'); ?></span>
                </a>
            </li>

            <?php /*
            <!-- MANAGE EXAM QUESTIONS -->
            <li class="<?php if ($page_name == 'examquestion') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/examquestion">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('exam_questions'); ?></span>
                </a>
            </li> 

            
            <!-- LOAN APPLICATION -->
            <li class="<?php if ($page_name == 'loan_applicant') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/loan_applicant">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('loan_application'); ?></span>
                </a>
            </li> 


            <!-- LOAN APPROVAL -->

            <li class="<?php if ($page_name == 'loan_approval') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/loan_approval/<?php echo $this->session->userdata('login_user_id'); ?>">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('approval_status'); ?></span>
                </a>
            </li> */ ?>

            <!-- TODAYS THOUGHT -->
            <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/assignment">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('assignments'); ?></span>
                </a>
            </li>

            <!-- DAILY ATTENDANCE -->
            <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/manage_attendance/<?php echo date("d/m/Y"); ?>">
                    <i class="entypo-chart-area"></i>
                    <span><?php echo get_phrase('daily_attendance'); ?></span>
                </a>

            </li>
            <!-- EXAMS -->
            <li class="<?php
            if ($page_name == 'exam' ||
                    $page_name == 'marks0' ||
                    $page_name == 'tabulation_sheet_midterm' ||
                    $page_name == 'tabulation_sheet' ||
                    $page_name == 'grade' ||
                    $page_name == 'score_sheet0' ||
                    $page_name == 'score_sheet' ||
                    $page_name == 'marks')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-graduation-cap"></i>
                    <span><?php echo get_phrase('student_marks'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
					<!-- <li class="<?php //if ($page_name == 'nursery_student_question') echo 'active'; ?>">
                        <a href="<?php // echo base_url(); ?>index.php?<?php //echo $account_type; ?>/nursery_student_question">
                            <span>Enter Nursery Student Question</span>
                        </a>
                    </li> --> 
                    <li class="<?php if ($page_name == 'marks0') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/marks0">
                            <span><?php echo 'Mid term scores'; ?></span>
                        </a>
                    </li>
                     <li class="<?php if ($page_name == 'tabulation_sheet_midterm') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/tabulation_sheet_midterm">
                            <span><?php echo 'Generate midterm report'; ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'marks') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/marks">
                            <span><?php echo get_phrase('enter_student_scores'); ?></span>
                        </a>
                    </li>
                     <li class="<?php if ($page_name == 'tabulation_sheet') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/tabulation_sheet">
                            <span><?php echo get_phrase('generate_report_card'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'score_sheet') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/score_sheet0">
                            <span><?php echo 'Mid-Term score sheet' ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'score_sheet') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/score_sheet">
                            <span><?php echo 'EOT score sheet' ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <?php /*
            <!-- LIBRARY -->
            <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/book">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('book_information'); ?></span>
                </a>
            </li>

            <!-- TRANSPORT -->
            <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/transport">
                    <i class="entypo-flight"></i>
                    <span><?php echo get_phrase('transportation'); ?></span>
                </a>
            </li> */?>
			
			 <!-- COMMUNICATIONS -->
            <li class="<?php
            if ($page_name == 'noticeboard' ||
                    $page_name == 'message')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-mail"></i>
                    <span><?php echo get_phrase('communications'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                     <!-- NOTICEBOARD -->
            <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/noticeboard">
                    <span><?php echo get_phrase('manage_events'); ?></span>
                </a>
            </li>

            <!-- MESSAGE -->
            <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/message">
                    <span><?php echo get_phrase('private_messages'); ?></span>
                </a>
            </li>
                </ul>
            </li>

            <!-- ACCOUNT -->
            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/manage_profile">
                    <i class="entypo-lock"></i>
                    <span><?php echo get_phrase('personal_details'); ?></span>
                </a>
            </li>

        </ul>

    </div>
</div>
