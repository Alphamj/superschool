
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

            <!-- HOSTEL MANAGER -->
            <li class="<?php if ($page_name == 'hostel') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/hostel_list">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('view_managers'); ?></span>
                </a>
            </li>

            <!-- HOSTEL INFORMATION -->
            <li class="<?php
            if ($page_name == 'dormitory' ||
                    $page_name == 'hostel_category' ||
					$page_name == 'room_type' ||
                    $page_name == 'hostel_room' )
                echo 'opened active';
            ?> ">
                <a href="#">
                     <i class="entypo-home"></i>
                    <span><?php echo get_phrase('hostel_information'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <!-- LIBRARY -->
            <li class="<?php if ($page_name == 'dormitory') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/dormitory">
                    <span><?php echo get_phrase('manage_hostel'); ?></span>
                </a>
            </li>
                    <li class="<?php if ($page_name == 'hostel_category') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/hostel_category">
                            <span><?php echo get_phrase('hostel_category'); ?></span>
                        </a>
                    </li>
					
					<li class="<?php if ($page_name == 'room_type') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/room_type">
                            <span><?php echo get_phrase('room_type'); ?></span>
                        </a>
                    </li>
					
					<li class="<?php if ($page_name == 'hostel_room') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/hostel_room">
                            <span><?php echo get_phrase('hostel_room'); ?></span>
                        </a>
                    </li>
                </ul>
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
            </li>
			
			
            <!-- HOLIDAYS -->
            <li class="<?php if ($page_name == 'holiday') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/holiday">
                    <i class="entypo-home"></i>
                    <span><?php echo get_phrase('view_holidays'); ?></span>
                </a>
            </li>

            <!-- TODAYS THOUGHT -->
            <li class="<?php if ($page_name == 'todays_thought') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/todays_thought">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('moral_talk'); ?></span>
                </a>
            </li>


          
			
            <!-- TODAYS THOUGHT -->
            <li class="<?php if ($page_name == 'news') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/news">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('view_news'); ?></span>
                </a>
            </li>





            <!-- TRANSPORT -->
            <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/transport">
                    <i class="entypo-flight"></i>
                    <span><?php echo get_phrase('transportation'); ?></span>
                </a>
            </li>

            
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
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('personal_details'); ?></span>
                </a>
            </li>

        </ul>

    </div>
</div>