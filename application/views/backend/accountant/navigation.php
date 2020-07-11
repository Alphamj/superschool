
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


            <!-- ACCOUNTANT -->
            <li class="<?php if ($page_name == 'accountant') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/accountant_list">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('all_accountants'); ?></span>
                </a>
            </li>




            <!-- HOLIDAYS -->
            <li class="<?php if ($page_name == 'holiday') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/holiday">
                    <i class="entypo-home"></i>
                    <span><?php echo get_phrase('view_holidays'); ?></span>
                </a>
            </li>
			
			
			 <!-- ACCOUNTING -->
            <li class="<?php
            if ($page_name == 'income' ||
                    $page_name == 'student_payment'||
                    $page_name == 'invoice')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('fee_collection'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li class="<?php if ($page_name == 'student_payment') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_payment">
                            <span><?php echo get_phrase('collect_fees'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'income') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/income">
                            <span><?php echo get_phrase('fees_payments'); ?></span>
                        </a>
                    </li>
					
					 <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/invoice">
                            <span><?php echo get_phrase('manage_invoice'); ?></span>
                        </a>
                    </li>
                    
                </ul>
            </li>

          
            <!-- TODAYS THOUGHT -->
            <li class="<?php if ($page_name == 'todays_thought') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/todays_thought">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('moral_talk'); ?></span>
                </a>
            </li>
			
			 <!-- EXPENSES -->
            <li class="<?php
            if ($page_name == 'expense' ||
                    $page_name == 'expense_category' )
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('expenses'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li class="<?php if ($page_name == 'expense') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/expense">
                            <span><?php echo get_phrase('expense'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'expense_category') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/expense_category">
                            <span><?php echo get_phrase('expense_category'); ?></span>
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