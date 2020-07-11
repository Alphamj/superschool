<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		<?php
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
		$tawkto = $this->db->get_where('settings', array('type' => 'tawkto'))->row()->description;
        $system_email = $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;
        $phone = $this->db->get_where('settings', array('type' => 'phone'))->row()->description;
        $address = $this->db->get_where('settings', array('type' => 'address'))->row()->description;
        $footer = $this->db->get_where('settings', array('type' => 'footer'))->row()->description;
        $system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
		
        ?>
		

        <title><?php echo get_phrase('welcome'); ?> | <?php echo $system_title; ?></title>
	<!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>landing/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bx-Slider StyleSheet CSS -->
    <link href="<?php echo base_url(); ?>landing/css/jquery.bxslider.css" rel="stylesheet"> 
    <!-- Font Awesome StyleSheet CSS -->
    <link href="<?php echo base_url(); ?>landing/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>landing/css/svg-style.css" rel="stylesheet">
    <!-- Pretty Photo CSS -->
    <link href="<?php echo base_url(); ?>landing/css/prettyPhoto.css" rel="stylesheet">
    <!-- Widget CSS -->
    <link href="<?php echo base_url(); ?>landing/css/widget.css" rel="stylesheet">
    <!-- DL Menu CSS -->
	<link href="<?php echo base_url(); ?>landing/js/dl-menu/component.css" rel="stylesheet">
    <!-- Typography CSS -->
    <link href="<?php echo base_url(); ?>landing/css/typography.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link href="<?php echo base_url(); ?>landing/css/animate.css" rel="stylesheet">
    <!-- Owl Carousel CSS -->
    <link href="<?php echo base_url(); ?>landing/css/owl.carousel.css" rel="stylesheet">
    <!-- Shortcodes CSS -->
    <link href="<?php echo base_url(); ?>landing/css/shortcodes.css" rel="stylesheet">
	<!-- Custom Main StyleSheet CSS -->
    <link href="<?php echo base_url(); ?>landing/style.css" rel="stylesheet">
    <!-- Color CSS -->
    <link href="<?php echo base_url(); ?>landing/css/color.css" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="<?php echo base_url(); ?>landing/css/responsive.css" rel="stylesheet">


<style>
#video-laptop {
    position: relative;
    padding-top: 24px;
    padding-bottom: 70.5%;
    height: 0;}
 
#video-laptop iframe {
    box-sizing: border-box;
    background: url(landing/images/video.png) center center no-repeat;
    background-size: contain;
    padding: 11.9% 11.5% 14.8%;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;}
</style>

  </head>

  <body>


<!--Wrapper Start-->  
<div class="ct_wrapper">
	
    <!--Header Wrap Start-->
    <header>
    	<!--Top Strip Wrap Start-->
        <div class="top_strip">
        	<div class="container">
                <div class="top_location_wrap">
                    <p><i class="fa fa-map-marker"></i><?php echo $address; ?></p>
                </div>
                <div class="top_ui_element">
                    <ul>
                        <li><i class="fa fa-envelope"></i><a href="#"><?php echo $system_email; ?></a></li>
                        <li><i class="fa fa-phone"></i><?php echo $phone; ?>&nbsp;&nbsp;<a href="<?php echo base_url(); ?>index.php?login"><button type="button" class="btn btn-success btn-flat btn-sm">Login</button></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Top Strip Wrap End-->
        
        <!--Navigation Wrap Start-->
        <div class="logo_nav_outer_wrap">
        	<div class="container">
                <div class="logo_wrap">
  						<a href="<?php echo base_url(); ?>" class="logo">
                        <img src="uploads/logo.png" width="225" height="36" alt="" />
                   	 	</a>                
						</div>
               <!-- <div class="top_cart_wrap">
                	<i class="fa fa-cart-arrow-down"></i>
                </div>
                <div class="top_search_wrap">
                	<i class="fa fa-search search-fld"></i>
                    <div class="search-wrapper-area">
                        <form class="search-area">
                            <input type="text" placeholder="search here"/>
                            <input type="submit" value="Go"/>
                        </form>
                    </div>
                </div>-->
                <nav class="main_navigation">
                    <ul>
                        <li><a href="<?php echo base_url(); ?>">Home<span>MAIN PAGE</span></a></li>
                        <li><a href="<?php echo base_url(); ?>index.php?welcome/about">About<span>ABOUT US</span></a></li>
                        <li><a href="<?php echo base_url(); ?>index.php?welcome/admission">Admission<span>ADMISSION</span></a></li>
                        <li><a href="<?php echo base_url(); ?>index.php?welcome/teacher">Teachers<span>INSTURCTORS</span></a></li>
                        <li><a href="<?php echo base_url(); ?>index.php?welcome/news">News<span>OUR NEWS</span></a></li>
                        <li><a href="<?php echo base_url(); ?>index.php?welcome/gallery">Gallery<span>PHOTO GALLERY</span></a></li>
						<li><a href="<?php echo base_url(); ?>index.php?welcome/enquiry">Enquiry<span>SUBMIT FORM</span></a></li>
                        <li><a href="<?php echo base_url(); ?>index.php?welcome/contact">Contact<span>Contact Us</span></a></li>
                    </ul>
                </nav>
                <!--DL Menu Start-->
                <div id="kode-responsive-navigation" class="dl-menuwrapper">
                    <button class="dl-trigger">Open Menu</button>
                    <ul class="dl-menu">
                        <li class="active"><a href="<?php echo base_url(); ?>index.php?welcome/index">Home</a></li>
                        <li class="menu-item kode-parent-menu"><a href="<?php echo base_url(); ?>index.php?welcome/about">about us</a></li>
                        <li class="menu-item kode-parent-menu"><a href="<?php echo base_url(); ?>index.php?welcome/admission">Admission</a></li>
                        <li class="menu-item kode-parent-menu"><a href="<?php echo base_url(); ?>index.php?welcome/teacher">Teachers</a></li>
						<li class="menu-item kode-parent-menu"><a href="<?php echo base_url(); ?>index.php?welcome/news">News</a></li>
						<li class="menu-item kode-parent-menu"><a href="<?php echo base_url(); ?>index.php?welcome/gallery">Gallery</a></li>
                        <li class="menu-item kode-parent-menu"><a href="<?php echo base_url(); ?>index.php?welcome/enquiry">Enquiry</a></li>
                        <li class="menu-item kode-parent-menu"><a href="<?php echo base_url(); ?>index.php?welcome/contact">Contact Us</a></li>
                    </ul>
                </div>
                <!--DL Menu END-->
            </div>
        </div>
        <!--Navigation Wrap End-->
    </header>
    <!--Header Wrap End-->
    
    <!--Banner Wrap Start-->
    <div class="banner_outer_wrap">
    	<ul class="main_slider">
        						<?php 
                                $banars	=	$this->db->get('banar' )->result_array();
                                foreach($banars as $row):?>
			<li>
            	<img src="<?php echo base_url(); ?>uploads/banner_image/<?php echo $row['file_name'];?>" alt="">
                <div class="ct_banner_caption">
                	<h4 class="fadeInDown">welcome TO <span><?php echo $system_title; ?></span></h4>
                    <span class="fadeInDown"><?php echo $row['b_text_one'];?></span>
                    <h2 class="fadeInDown"><?php echo $row['b_text_two'];?></h2>
                    <a class="active fadeInDown" href="<?php echo base_url(); ?>index.php?welcome/enquiry">ENQUIRY</a>
                    <a class="fadeInDown" href="<?php echo base_url(); ?>index.php?welcome/teacher">OUR TEACHERS</a>
                </div>
            </li>
			 <?php endforeach;?>


        </ul>
    </div>
    <!--Banner Wrap End-->
    
    <!--Content Wrap Start-->
    <div class="ct_content_wrap">
        <!--Get Started Wrap Start-->
        <section>
        	<div class="container">
            	<div class="get_started_outer_wrap">
            		<div class="row">
                        <div class="col-md-6">
                            <div class="get_started_content_wrap ct_blog_detail_des_list">
                                <h3>BRIEF INFORMATION ABOUT <?php echo $system_name; ?></h3>
                                <p align="justify"><?php $about_us = $this->db->get_where('front_end', array('type' => 'about_us'))->row()->description; ?>
								<?php echo $about_us; ?></p>
                                
                            </div>
                        </div>
                    
                        <div class="col-md-6">

                            <div class="responsive-video" id="video-laptop">
                                <?php $front_end = $this->db->get_where('front_end', array('type' => 'youtube'))->row()->description; ?>
								<?php echo $front_end; ?>
                            </div>
                        </div>
                	</div>
                </div>
                
                <div class="row">
                	<div class="col-md-4 col-sm-6">
                    	<div class="get_started_services">
                        	<div class="get_started_icon">
                            	<i class="fa fa-paper-plane-o"></i>
                            </div>
                            <div class="get_icon_des">
                            	<h5>Our Vission</h5>
                                <p align="justify"> <?php $vission = $this->db->get_where('front_end', array('type' => 'vission'))->row()->description; ?>
								<?php echo $vission; ?></p>
                                <a href="#">View More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                    	<div class="get_started_services">
                        	<div class="get_started_icon">
                            	<i class="fa fa-bookmark-o"></i>
                            </div>
                            <div class="get_icon_des">
                            	<h5>Our Mission</h5>
                                <p align="justify"><?php $mission = $this->db->get_where('front_end', array('type' => 'mission'))->row()->description; ?>
								<?php echo $mission; ?></p>
                                <a href="#">View More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                    	<div class="get_started_services">
                        	<div class="get_started_icon">
                            	<i class="fa fa-book"></i>
                            </div>
                            <div class="get_icon_des">
                            	<h5>Our Goal</h5>
                                <p align="justify"><?php $goal = $this->db->get_where('front_end', array('type' => 'goal'))->row()->description; ?>
								<?php echo $goal; ?></p>
                                <a href="#">View More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!--Get Started Wrap End-->
        
        <!--Courses By Subject Wrap Start-->
        <section class="ct_courses_subject_bg">
        	
			<div class="container">
            	<!--Heading Style 1 Wrap Start-->
                <div class="ct_heading_1_wrap ct_white_hdg">
                	<h3>Courses By Subject</h3>
					<span><img src="landing/images/hdg-01.png" alt=""></span>
                </div>
                <!--Heading Style 1 Wrap End-->
                
                <!--Courses Subject List Wrap Start-->
                <div class="courses_subject_carousel owl-carousel">
				
				
								<?php 
                                $subjects	=	$this->db->get('subject' )->result_array();
                                foreach($subjects as $row):?>
                	<div class="item">
                        <div class="course_subject_wrap ct_bg_2">
                            <i class="fa fa-book"></i>
                            <div class="course_subject_des">
                                <p><span><?php echo $row['name'];?></span><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
          
				   
                </div>
                <!--Courses Subject List Wrap End-->
            </div>
        </section>
        <!--Courses By Subject Wrap End-->
        
        <!--Most Popular Courses Wrap Start-->
        <section>
        	<div class="container">
            	<!--Heading Style 1 Wrap Start-->
                <div class="ct_heading_1_wrap">
                	<h3>Our News</h3>
					<?php $news = $this->db->get_where('front_end', array('type' => 'news'))->row()->description; ?>
                    <p><?php echo $news; ?></p>
					<span><img src="landing/images/hdg-01.png" alt=""></span>
                </div>
                <!--Heading Style 1 Wrap End-->
                
                <!--Most Popular Course List Wrap Start-->
                <div class="most_popular_courses owl-carousel">
								<?php 
                                $news	=	$this->db->get('news' )->result_array();
                                foreach($news as $row):
								?>
                	<div class="item">
					
					
								
                    	<div class="ct_course_list_wrap">
                        	<figure>
            					<img src="<?php echo base_url(); ?>uploads/news_image/<?php echo $row['file_name'];?>" width="360" height="360" alt="">
                                <figcaption class="course_list_img_des">
                                	<div class="ct_course_review">
                                    	<span>Information Status</span>
                                        <ul>
                                        	<li>
                                            	<a href="#"><i class="fa fa-star"></i></a>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ct_zoom_effect"></div>
                                    <div class="ct_course_link">
                                    	<a href="<?php echo base_url();?>index.php?welcome/news_content/<?php echo $row['news_id'];?>">View Detail</a>
                                    </div>
                                </figcaption>
                            </figure>
                            <div class="popular_course_des">
                            	<h5><a href="<?php echo base_url();?>index.php?welcome/news_content/<?php echo $row['news_id'];?>"><?php echo $row['news_title'];?></a></h5>
                                <p align="justify"><?php echo $row['short_content'];?></p>
                                <div class="ct_course_meta">
                                	<div class="course_author">
                                    	<i class="fa fa-user"></i><a href="#"><?php echo $row['uploader'];?></a>
                                    </div>
                                    <ul>
                                        <li><i class="fa fa-calendar"></i><a href="#"><?php echo $row['date'];?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
   <?php endforeach;?>
                
            </div>
        </section>
        <!--Most Popular Courses Wrap End-->
        
    
	<!--Register Now Wrap Start-->
        <section class="ct_register_bg">
        	<div class="container">
            	<div class="row">
                	<div class="col-md-12">
                    	<div class="ct_hreg_wrap">
                        	<div class="register_top_detail">
                                <h2 align="center">Register Now</h2>
                                <p align="center">	<?php $reg = $this->db->get_where('front_end', array('type' => 'reg'))->row()->description; ?>
														<?php echo $reg; ?>
								</p>
                            </div>
								<a href="<?php echo base_url();?>index.php?welcome/admission/">Register Now</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!--Register Now Wrap End-->
	
	
        <!--Map Wrap End-->
        <br><br><br><br><br><br><br><br><br>
        <!--Our Teacher Wrap Start-->
        <section class="teacher_bg">
        	<div class="container">
            	<!--Heading Style 1 Wrap Start-->
                <div class="ct_heading_1_wrap">
                	<h3>Our Teachers</h3>
				<?php $teacher = $this->db->get_where('front_end', array('type' => 'teacher'))->row()->description; ?>
                    <p><?php echo $teacher; ?></p>
					<span><img src="landing/images/hdg-01.png" alt=""></span>
                </div>
                <!--Heading Style 1 Wrap End-->
                
                <!--Teacher List Wrap Start-->
                <div class="row">
				
								<?php 
                                $teachers	=	$this->db->get('teacher' )->result_array();
                                foreach($teachers as $row):?>
                	<div class="col-md-3 col-sm-6">
                    	<div class="ct_teacher_outer_wrap">
                        	<figure>
                            	<img src="<?php echo $this->crud_model->get_image_url('teacher',$row['teacher_id']);?>"/>
                            </figure>
                            <div class="ct_teacher_wrap">
                            	<h5><a href="#"><?php echo $row['name'];?></a></h5>
                                <span><?php echo $row['qualification'];?></span>
                                <ul>
                                	<li><a href="<?php echo $row['facebook'];?>"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="<?php echo $row['twitter'];?>"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="<?php echo $row['googleplus'];?>"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="<?php echo $row['linkedin'];?>"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
					<?php endforeach; ?>
                    
                    
                </div>
                <!--Teacher List Wrap End-->
                
            </div>
        </section>
        <!--Our Teacher Wrap End-->
        
        <!--Figures & Facts Wrap Start-->
        <section class="ct_facts_bg">
            <ul>
                <li>
                    <i class="icon-avatar"></i>
                    <h2 class="counter"><?php echo $this->db->count_all('teacher'); ?></h2>
                    <span>Certified Teachers</span>
                </li>
                <li>
                    <i class="icon-command"></i>
                    <h2 class="counter"><?php echo $this->db->count_all('student'); ?></h2>
                    <span>Students Enrolled</span>
                </li>
                <li>
                    <i class="icon-open-book"></i>
                    <h2 class="counter"><?php echo $this->db->count_all('alumni'); ?></h2>
                    <span>Passing to Universities</span>
                </li>
                <li>
                    <i class="icon-pulse"></i>
                    <h2 class="counter"><?php echo $this->db->count_all('parent'); ?></h2>
                    <span>Satisfied Parents</span>
                </li>
            </ul>
        </section>
        <!--Figures & Facts Wrap End-->
        
        <!--Our Events Wrap Start-->
        <section class="event_bg">
        	<div class="container">
            	<!--Heading Style 1 Wrap Start-->
                <div class="ct_heading_1_wrap">
                	<h3>Our Events</h3>
					<?php $event = $this->db->get_where('front_end', array('type' => 'event'))->row()->description; ?>
                    <p><?php echo $event; ?></p>
					<span><img src="landing/images/hdg-01.png" alt=""></span>
                </div>
                <!--Heading Style 1 Wrap End-->
                
                <!--Event List Wrap Start-->
                    <div class="col-md-12">
                    	<div class="row">
						
								<?php 
                                $events	=	$this->db->get('noticeboard' )->result_array();
                                foreach($events as $row):?>
								
                        	<div class="col-md-3">
                            	<div class="sub_event_wrap" style="background-image:url(landing/extra-images/event.jpg);">
                                	<h6><a href="#"><?php echo $row ['notice_title']; ?></a></h6>
                                    <span><i class="fa fa-map-marker"></i><?php echo $row ['location']; ?></span>
                                    <span><i class="fa fa-calendar"></i><?php echo date('d M,Y', $row['create_timestamp']);?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            
                           
                        </div>
                    </div>
                    
                </div>
                <!--Event List Wrap End-->
                
            </div>
        </section>
        <!--Our Events Wrap End-->
        
        <!--Testimonial Wrap Start-->
        <section class="ct_testimonial_bg">
        	<div class="container">
            	<!--Heading Style 1 Wrap Start-->
                <div class="ct_heading_1_wrap ct_white_hdg">
                	<h3>Testimonials</h3>
						<?php $testimonies = $this->db->get_where('front_end', array('type' => 'testimonies'))->row()->description; ?>
                    <p><?php echo $testimonies; ?></p>                    
					<span><img src="landing/images/hdg-01.png" alt=""></span>
                </div>
                <!--Heading Style 1 Wrap End-->
                
                <!--Testimonial List Wrap Start-->
                <div class="testimonial_carousel owl-carousel">
				<?php 
                                $testimonys	=	$this->db->get('testimony' )->result_array();
                                foreach($testimonys as $row):?>
                	<div class="item">
                    	<div class="testimonial_wrap">
                        	<figure>
                            	<img src="landing/images/testimony.png" width="86" height="86" alt="">
                            </figure>
                            <p><?php echo $row ['content']; ?></p>
						<span><b><?php echo $row ['name']; ?></b>, <?php echo $row ['position']; ?></span>
                        </div>
                    </div>
                   <?php endforeach;?>
                   
                   
                <!--Testimonial List Wrap End-->
                
            </div>
        </section>
        <!--Testimonial Wrap End-->
        
        <!--Learn More Wrap Start-->
        <div class="ct_learn_more_bg">
        	<div class="container">
            	<div class="ct_learn_more">
                	<h4>We provide universal access to the world’s best <span>education.</span></h4>
                    <a href="<?php echo base_url(); ?>index.php?welcome/enquiry">Learn More</a>
                </div>
            </div>
        </div>
        <!--Learn More Wrap End-->
        
        <!--Latest News Wrap Start-->
        <section class="ct_blog_simple_bg">
        	<div class="container">
            	<!--Heading Style 1 Wrap Start-->
                <div class="ct_heading_1_wrap">
                	<h3>More News</h3>
					<?php $news = $this->db->get_where('front_end', array('type' => 'news'))->row()->description; ?>
                    <p><?php echo $news; ?></p>                                  
					<span><img src="landing/images/hdg-01.png" alt=""></span>
                </div>
                <!--Heading Style 1 Wrap End-->
                
                <!--Latest News Wrap Start-->
                <div class="row">
				
								<?php 
                                $news	=	$this->db->get('news' )->result_array();
                                foreach($news as $row):
								?>
                	<div class="col-md-4">
                    	<div class="ct_news_wrap">
                        	<span><?php echo $row ['date']; ?></span>
                            <h8><a href="#"><p align="justify"><?php echo $row ['short_content']; ?></p>
                            <div class="news_img">
            					<img src="<?php echo base_url(); ?>uploads/news_image/<?php echo $row['file_name'];?>" width="30" height="30" alt="">
                            	<label><?php echo $row ['uploader']; ?></label>
                            </div>
                        </div>
                    </div>
                   <?php endforeach;?>
                    
					
                </div>
                <!--Latest News Wrap End-->
            </div>
        </section>
        <!--Latest News Wrap End-->
    </div>
    <!--Content Wrap End-->
    
    <!--Footer Wrap Start-->
    <footer>
    	<!--NewsLetter Wrap Start
        <div class="ct_newsletter_wrap">
        	<div class="container">
            	<div class="newletter_des">
                	<!--<h5>Subscribe Our Weekly Newsletter</h5>
                    <form>
                    	<label class="fa fa-envelope-o"></label>
                    	<input type="text" placeholder="Enter Your Email">
                        <button>Signup</button>
                    </form>
                </div>
            </div>
        </div>
        <!--NewsLetter Wrap End-->
        
        <!--Footer Col Wrap Start-->
        <div class="ct_footer_bg">
        	<div class="container">
            	<div class="row">
                	<div class="col-md-3 col-sm-6">
                    	<div class="footer_col_1 widget">
						<a href="<?php echo base_url(); ?>" class="logo">
                        <img src="uploads/logo.png" width="225" height="36" alt="" />
                   	 	</a>  
						<p align="justify"><?php $footer_text = $this->db->get_where('front_end', array('type' => 'footer_text'))->row()->description; ?>
						<?php echo $footer_text; ?>
						</p>
                            <span>Email : <?php echo $system_email; ?></span>
                            <div class="foo_get_qoute">
                            	<a href="<?php echo base_url(); ?>index.php?welcome/contact">GET A Touch</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6">
                    	<div class="foo_col_2 widget">
                        	<h5>More Pages</h5>
                            <ul>
                            	<li><a href="<?php echo base_url(); ?>index.php?welcome/contact">Contact Us</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php?welcome/teacher">View Teachers</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php?welcome/course">School Subject</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php?welcome/gallery">School Gallery</a></li>
                            </ul>
                        </div>
                    </div>
                    
                     <div class="col-md-3 col-sm-6">
                    	<div class="foo_col_2 widget">
                        	<h5>Quick Links</h5>
                            <ul>
                            	<li><a href="<?php echo base_url(); ?>index.php?welcome/about">About Us</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php?welcome/teacher">Our Teachers</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php?welcome/news">Latest News</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php?welcome/gallery">Our Gallery</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php?welcome/enquiry">Enquiry Now</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6">
                    	<div class="foo_col_4 widget">
                        	<h5>Opening Hours</h5>
                            <ul>
                            	<li>Monday to Friday 9:00am to 5:00pm</li>
                                <li>Saturday 9:00am to 4:00pm</li>
                                <li></li>
                                <li>Sunday: CLOSED</li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--Footer Col Wrap End-->
        
        <!--Footer Copyright Wrap Start-->
        <div class="ct_copyright_bg">
        	<div class="container">
            	<div class="row">
                	<div class="col-md-6">
                    	<div class="copyright_text">
                        	Built with <a class="fa fa-heart" href="#"></a> from <a href="#"><?php echo $footer; ?></a>. All right reserved
                        </div>
                    </div>
                    <div class="col-md-6">
                    	<div class="copyright_social_icon">
                        	<ul>
                            	<li><a href="<?php $instagram = $this->db->get_where('front_end', array('type' => 'instagram'))->row()->description; ?>
								<?php echo $instagram; ?>"><i class="fa fa-pinterest"></i></a></li>
								
                            	<li><a href="<?php $linkedin = $this->db->get_where('front_end', array('type' => 'linkedin'))->row()->description; ?>
								<?php echo $linkedin; ?>"><i class="fa fa-linkedin"></i></a></li>
								
                            	<li><a href="<?php $twitter = $this->db->get_where('front_end', array('type' => 'twitter'))->row()->description; ?>
								<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a></li>
								
                            	<li><a href="<?php $facebook = $this->db->get_where('front_end', array('type' => 'facebook'))->row()->description; ?>
								<?php echo $facebook; ?>"><i class="fa fa-facebook"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Footer Copyright Wrap End-->
        <div class="back_to_top">
            <a href="#"><i class="fa fa-angle-up"></i></a>
        </div>
    </footer>
    <!--Footer Wrap End-->

</div>
<!--Wrapper End-->

    <!--Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>landing/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>landing/js/bootstrap.min.js"></script>
    <!--Bx-Slider JavaScript-->
	<script src="<?php echo base_url(); ?>landing/js/jquery.bxslider.min.js"></script>
    <!--Dl Menu Script-->
	<script src="<?php echo base_url(); ?>landing/js/dl-menu/modernizr.custom.js"></script>
	<script src="<?php echo base_url(); ?>landing/js/dl-menu/jquery.dlmenu.js"></script>
    <!--Owl Carousel JavaScript-->
	<script src="<?php echo base_url(); ?>landing/js/owl.carousel.js"></script>
    <!--Time Counter Javascript-->
    <script src="<?php echo base_url(); ?>landing/js/jquery.downCount.js"></script>
    <!--Pretty Photo Javascript-->
    <script src="<?php echo base_url(); ?>landing/js/jquery.prettyPhoto.js"></script>
    <!--Way Points Javascript-->
    <script src="<?php echo base_url(); ?>landing/js/waypoints-min.js"></script>
    <!--Custom JavaScript-->
	<script src="<?php echo base_url(); ?>landing/js/custom.js"></script>
	
  	<?php echo $tawkto; ?>

  </body>
</html>
