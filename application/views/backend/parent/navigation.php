<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">

        <ul id="main-menu" class="nav side-menu">
            <!-- add class "multiple-expanded" to allow multiple submenus to open -->
            <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


            <!-- DASHBOARD -->
            <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?parents/dashboard">
                    <i class="entypo-home"></i>
                    <span><?php echo get_phrase('home'); ?></span>
                </a>
            </li>



            <!-- TEACHER -->
            <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?parents/teacher_list">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('view_teacher'); ?></span>
                </a>
            </li>


          <!-- VIEW MARKS -->
            <li class="<?php
                if ($page_name == 'search_student' ||
                        $page_name == 'midterm_result')
                    echo 'opened active';
                ?> ">
                <a href="#">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('report_cards'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li class="<?php if ($page_name == 'midterm_result') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?parents/midterm_result">
                            <span><?php echo 'Mid Term Report'; ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'search_student') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?parents/search_student">
                            <span><?php echo 'End of Term Report'; ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- CLASS ROUTINE -->
            <li class="<?php if ($page_name == 'class_routine') echo 'opened active'; ?> ">
                <a href="#">
                    <i class="entypo-target"></i>
                    <span><?php echo get_phrase('time_table'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <?php
                    $children_of_parent = $this->db->get_where('student', array(
                                'parent_id' => $this->session->userdata('parent_id')
                            ))->result_array();
                    foreach ($children_of_parent as $row):
                        ?>
                        <li class="<?php if ($page_name == 'class_routine') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>index.php?parents/class_routine/<?php echo $row['student_id']; ?>">
                                <span> <?php echo $row['name']; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
			
			
			

            <!-- HELP LINKS -->
            <li class="<?php if ($page_name == 'news') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?parents/news">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('view_news'); ?></span>
                </a>
            </li>

<!-- EXAMS 
            <li class="<?php if ($page_name == 'marks') echo 'opened active'; ?> ">
                <a href="#">
                    <i class="entypo-graduation-cap"></i>
                    <span><?php echo get_phrase('exam_marks'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <?php
                    foreach ($children_of_parent as $row):
                        ?>
                        <li class="<?php if ($page_name == 'marks') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>index.php?parents/marks/<?php echo $row['student_id']; ?>">
                                <span> <?php echo $row['name']; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
-->
            <!-- PAYMENT -->
            <li class="<?php if ($page_name == 'invoice') echo 'opened active'; ?> ">
                <a href="#">
                    <i class="entypo-credit-card"></i>
                    <span><?php echo get_phrase('student_payments'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <?php
                    foreach ($children_of_parent as $row):
                        ?>
                        <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>index.php?parents/invoice/<?php echo $row['student_id']; ?>">
                                <span> <?php echo $row['name']; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>

            <!-- HELP LINKS -->
            <li class="<?php if ($page_name == 'help_link') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?parents/help_link">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('helpful_links'); ?></span>
                </a>
            </li>

            <!-- HELP DESK -->
            <li class="<?php if ($page_name == 'help_desk') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?parents/help_desk">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('help_desks'); ?></span>
                </a>
            </li>


            <!-- LIBRARY -->
            <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?parents/book">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('view_library'); ?></span>
                </a>
            </li>

            <!-- TRANSPORT -->
            <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?parents/transport">
                    <i class="entypo-flight"></i>
                    <span><?php echo get_phrase('transportation'); ?></span>
                </a>
            </li>

            <!-- HOLIDAYS -->
            <li class="<?php if ($page_name == 'holiday') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?parents/holiday">
                    <i class="entypo-home"></i>
                    <span><?php echo get_phrase('view_holidays'); ?></span>
                </a>
            </li>

            <!-- TODAYS THOUGHT -->
            <li class="<?php if ($page_name == 'todays_thought') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?parents/todays_thought">
                    <i class="fa fa-book"></i>
                    <span><?php echo get_phrase('view_moral_talk'); ?></span>
                </a>
            </li>
			
			
			 <!-- COMMUNICATIONS -->
            <li class="<?php
            if ($page_name == 'noticeboard' ||
                    $page_name == 'message')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span><?php echo get_phrase('communications'); ?></span><span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                     <!-- NOTICEBOARD -->
            <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?parents/noticeboard">
                    <span><?php echo get_phrase('manage_events'); ?></span>
                </a>
            </li>

            <!-- MESSAGE -->
            <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?parents/message">
                    <span><?php echo get_phrase('private_messages'); ?></span>
                </a>
            </li>
                </ul>
            </li>

            <!-- ACCOUNT -->
            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?parents/manage_profile">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('Update_details'); ?></span>
                </a>
            </li>

        </ul>
    </div>

</div>