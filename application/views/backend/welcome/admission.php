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
		

        <title><?php echo get_phrase('teacher'); ?> | <?php echo $system_title; ?></title>   <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>landing/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bx-Slider StyleSheet CSS -->
    <link href="<?php echo base_url(); ?>landing/css/jquery.bxslider.css" rel="stylesheet"> 
    <!-- Font Awesome StyleSheet CSS -->
    <link href="<?php echo base_url(); ?>landing/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>landing/css/svg-style.css" rel="stylesheet">
    <!-- Pretty Photo CSS -->
    <link href="<?php echo base_url(); ?>landing/css/prettyPhoto.css" rel="stylesheet">
	<!-- DL Menu CSS -->
	<link href="<?php echo base_url(); ?>landing/js/dl-menu/component.css" rel="stylesheet">
    <!-- Widget CSS -->
    <link href="<?php echo base_url(); ?>landing/css/widget.css" rel="stylesheet">
    <!-- Typography CSS -->
    <link href="<?php echo base_url(); ?>landing/css/typography.css" rel="stylesheet">
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
    <section class="sub_banner_wrap">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-6">
                	<div class="sub_banner_hdg">
                    	<h3>Admission Page</h3>
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="ct_breadcrumb">
                    	<ul>
                        	<li><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li><a href="#">Admission Page</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Banner Wrap End-->
    
    <!--Content Wrap Start-->
    <div class="ct_content_wrap">
    	<section>
        	<div class="container">
				<div class="col-md-8">
				
					<table width="1000" border="0">
  <tr>
    <td colspan="2" bgcolor="#80900">&nbsp;</td>
  </tr>
  <tr>
    <td width="259">Full Name</td>
    <td width="731">&nbsp;</td>
  </tr>
  <tr>
    <td>Parent Name </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>DAte of Birth </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Place Birth</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Mother Tongue</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Religion</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Address</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Nationality</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Previous School Name</td>
    <td>&nbsp;</td>
  </tr>
</table>
<hr>
						<a href="<?php echo base_url(); ?>landing/images/Admission_Form.pdf" target="_blank"><button type="button" class="btn btn-success btn-flat"><i class="fa fa-download"></i>&nbsp;Complete PDF Form</button></a>
						
					
   			</div>
				<!--Aside Bar Wrap Start-->
                    <div class="col-md-4">
                        <aside class="gt_aside_outer_wrap">
                        	<!--Search Bar Wrap Start-->
                           
                            <!--Search Bar Wrap Start-->
                            
                            <!--Category Wrap Start-->
                            <div class="gt_aside_category gt_detail_hdg aside_margin_bottom">
                            	<h5>Categories</h5>
                                <ul>
								<?php 
                                $news	=	$this->db->get('news' )->result_array();
                                foreach($news as $row):
								?>
                                	<li><a href="<?php echo base_url();?>index.php?welcome/news_content/<?php echo $row['news_id'];?>"><?php echo $row['news_title'];?></a></li>
									                    <?php endforeach;?>

                                </ul>
                            </div>
                            <!--Category Wrap Start-->


 							<!--Recent News Wrap Start-->
                            <div class="gt_aside_post_wrap gt_detail_hdg aside_margin_bottom">
                            	<h5>Recent News</h5>
								<?php 
                                $news	=	$this->db->get('news' )->result_array();
                                foreach($news as $row):
								?>
                                <ul>
                                	<li>
                                    	<figure>
            						<img src="<?php echo base_url(); ?>uploads/news_image/<?php echo $row['file_name'];?>" width="81" height="67" alt="">
                                        </figure>
                                        <div class="gt_aside_post_des">
                                        	<h6><a href="<?php echo base_url();?>index.php?welcome/news_content/<?php echo $row['news_id'];?>"><?php echo $row['news_title'];?></a></h6>
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
                                    </li>
                                </ul>
								<?php endforeach;?>
                            </div>
                            <!--Recent News Wrap Start-->
                        </aside>
                    </div>
                    <!--Aside Bar Wrap End-->
            </div>
        </section>
        
    </div>
    <!--Content Wrap End-->
    
    <!--Footer Wrap Start-->
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

        
</div>
<!--Wrapper End-->



    <!--Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>landing/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>landing/js/bootstrap.min.js"></script>
    <!--Bx-Slider JavaScript-->
	<script src="<?php echo base_url(); ?>landing/js/jquery.bxslider.min.js"></script>
    <!--Owl Carousel JavaScript-->
	<script src="<?php echo base_url(); ?>landing/js/owl.carousel.js"></script>
    <!--Time Counter Javascript-->
    <script src="<?php echo base_url(); ?>landing/js/jquery.downCount.js"></script>
    <!--Pretty Photo Javascript-->
    <script src="<?php echo base_url(); ?>landing/js/jquery.prettyPhoto.js"></script>
	<!--Dl Menu Script-->
	<script src="<?php echo base_url(); ?>landing/js/dl-menu/modernizr.custom.js"></script>
	<script src="<?php echo base_url(); ?>landing/js/dl-menu/jquery.dlmenu.js"></script>
    <!--Way Points Javascript-->
    <script src="<?php echo base_url(); ?>landing/js/waypoints-min.js"></script>
    <!--Accordian Javascript-->
    <script src="<?php echo base_url(); ?>landing/js/jquery.accordion.js"></script>
    <!--Custom JavaScript-->
	<script src="<?php echo base_url(); ?>landing/js/custom.js"></script>
	 <?php echo $tawkto; ?>


  </body>
</html>
