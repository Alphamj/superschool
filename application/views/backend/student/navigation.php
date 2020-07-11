
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



            <!-- TEACHER -->
            <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/teacher_list">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('view_teacher'); ?></span>
                </a>
            </li>
			
			
			 <!-- VIEW CLASS MATE -->
            <li class="<?php if ($page_name == 'class_mate') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/class_mate">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('view_class_mate'); ?></span>
                </a>
            </li>



            <!-- SUBJECT -->
            <li class="<?php if ($page_name == 'subject') echo ' active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/subject">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('view_subject'); ?></span>
                </a>
            </li>

            <!-- CLASS ROUTINE -->
            <li class="<?php if ($page_name == 'class_routine') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/class_routine">
                    <i class="entypo-target"></i>
                    <span><?php echo get_phrase('time_table'); ?></span>
                </a>
            </li>

            <!-- STUDY MATERIAL -->
            <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/study_material">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('study_material'); ?></span>
                </a>
            </li>


            <li class="<?php if ($page_name == 'exam_first' || $page_name == 'exam_second' || $page_name == 'exam_site') echo 'active'; ?> ">
                <?php if ($this->session->userdata('cur_exam_data')) { ?>
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/exam_site">                
                        <i class="entypo-book"></i>
                        <span><?php echo get_phrase('online_exam'); ?></span>
                    </a>
                <?php } else { ?>
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/exam/first">                
                        <i class="entypo-book"></i>
                        <span><?php echo get_phrase('online_exam'); ?></span>
                    </a>
                <?php } ?>
            </li>


            <li class="<?php if ($page_name == 'exam_review' || $page_name == 'exam_result_detail') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/exam_review">
                    <span><i class="entypo-book"></i> <?php echo get_phrase('view_exam_results'); ?></span>
                </a>
            </li>

            <!-- Exam marks -->
            <li class="<?php if ($page_name == 'media') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/media/<?php echo $this->session->userdata('login_user_id'); ?>">
                    <i class="entypo-camera"></i>
                    <span><?php echo get_phrase('view_media'); ?></span>
                </a>
            </li>		

            <!-- TODAYS THOUGHT -->
            <li class="<?php if ($page_name == 'news') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/news">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('view_news'); ?></span>
                </a>
            </li>


            <!-- Exam marks -->
            
            <li class="<?php
                if ($page_name == 'student_marksheet' ||
                        $page_name == 'midterm_result')
                    echo 'opened active';
                ?> ">
                <a href="#">
                    <i class="entypo-graduation-cap"></i>
                    <span><?php echo get_phrase('report_cards'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li class="<?php if ($page_name == 'midterm_result') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/midterm_result">
                            <span><?php echo 'Mid Term Report'; ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'student_marksheet') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_marksheet/">
                            <span><?php echo 'End of Term Report'; ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- PAYMENT -->
            <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/invoice">
                    <i class="entypo-credit-card"></i>
                    <span><?php echo get_phrase('make_payment'); ?></span>
                </a>
            </li>

            <!-- TODAYS THOUGHT -->
            <li class="<?php if ($page_name == 'todays_thought') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/todays_thought">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('moral_talk'); ?></span>
                </a>
            </li>


            <!-- LIBRARY -->
            <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/book">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('view_library'); ?></span>
                </a>
            </li>

            <!-- TRANSPORT -->
            <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/transport">
                    <i class="entypo-flight"></i>
                    <span><?php echo get_phrase('transportation'); ?></span>
                </a>
            </li>


            <!-- TODAYS THOUGHT -->
            <li class="<?php if ($page_name == 'holiday') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/holiday">
                    <i class="entypo-home"></i>
                    <span><?php echo get_phrase('view_holiday'); ?></span>
                </a>
            </li>
			
			
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

          

            <!-- TODAYS THOUGHT -->
            <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/assignment">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('assignments'); ?></span>
                </a>
            </li>

            <!-- TODAYS THOUGHT -->
            <li class="<?php if ($page_name == 'help_link') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/help_link">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('helpful_link'); ?></span>
                </a>
            </li>

            <!-- TODAYS THOUGHT -->
            <li class="<?php if ($page_name == 'help_desk') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/help_desk">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('help_desks'); ?></span>
                </a>
            </li>


            <!-- ACCOUNT -->
            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/manage_profile">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('personal_details'); ?></span>
                </a>
            </li>

        </ul>
    </div>
</div>
