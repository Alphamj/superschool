<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        $system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
		$tawkto = $this->db->get_where('settings', array('type' => 'tawkto'))->row()->description;
        ?>
        <title><?php echo get_phrase('login'); ?> | <?php echo $system_title; ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Optimum Linkup Universal Concepts" />
        <meta name="author" content="optimumlinkupsoftware.com" />

        <link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
        <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link href="assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/neon-core.css">
        <link rel="stylesheet" href="assets/css/neon-theme.css">
        <link rel="stylesheet" href="assets/css/neon-forms.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="stylesheet" href="assets/css/unicorn-login.css">
        <link rel="stylesheet" href="assets/css/unicorn-login-custom.css">

        <script src="assets/js/jquery-1.11.0.min.js"></script>

        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="assets/images/favicon.png">
		

    </head>
    <body class="page-body login-page login-form-fall" data-url="http://neon.dev">
        <!-- This is needed when you send requests via Ajax -->
        <script type="text/javascript">
            var baseurl = '<?php echo base_url(); ?>';
        </script>

        <div id="container">

            <div id="loginbox">   
                <div id="logo">
                    <a href="<?php echo base_url(); ?>" class="logo">
                        <img src="uploads/logo.png" height="60" alt="" />
                    </a>
                </div>
                
                <div class="login-progressbar-indicator">
                    <h3>33%</h3>
                    <span>checking login information...</span>
                </div>
                <div class="login-progressbar progress">
                    <div class="progress-bar progress-bar-danger"></div>
                </div>
				 
				 <div class="form-login-error">
                <h3>LOGIN INFORMATION: ERROR</h3>
                <p style="color:#FFFFFF">Please enter correct email and password!</p>
            	</div>
           			<form method="post" role="form" id="form_login">
	
                    <div style="font-weight:normal; font-size: 12px; text-align: left;padding:20px;">
                        Welcome to <?php echo $system_name; ?>. To continue, please login using your username and password below.
						
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="email" id="email" placeholder ="Enter Email" autocomplete="off" data-mask="email" />
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder ="Enter Password" autocomplete="off" />
                    </div>

                    <div class="form-actions">
                        <div class="text-right">
                            <a href="<?php echo base_url(); ?>index.php?login/forgot_password" class="flip-link to-recover"><?php echo get_phrase('forgot_your_password'); ?> ?</a>                        
                        </div>
                        <div>
                            <input type="submit" class="btn btn-success form-control " value="Login" />
                        </div>
                    </div>                    
                </form>  
				 <!--<div class="login-bottom-link">
                        <a href="../school/Documentation" target="_blank"><i class="entypo-book"></i>View Documentation</a>
                        <a href="http://optimumlinkupsoftware.com/pricing.php"><i class="entypo-paypal"></i>Buy Now</a>
						<hr>
                </div>-->
				<button class="btn btn-xs btn-blue" id="admin"><i class="entypo-user"></i>Admin</button>
    	            <button class="btn btn-xs btn-orange" id="teacher"><i class="entypo-user"></i>Teacher</button>
    	            <button class="btn btn-xs btn-blue" id="student"><i class="entypo-user"></i>Student</button>
    	            <button class="btn btn-xs btn-orange" id="parent"><i class="entypo-user"></i>Parent</button>
    	            <button class="btn btn-xs btn-blue" id="accountant"><i class="entypo-user"></i>Accountant</button>
    	            <button class="btn btn-xs btn-orange" id="librarian"><i class="entypo-user"></i>Librarian</button>
    		    <button class="btn btn-xs btn-blue" id="recep"><i class="entypo-user"></i>Hostel</button>
    			<hr><br>
            	</div>
			
           
        </div>

       
        <!-- Bottom Scripts -->
        <script src="assets/js/gsap/main-gsap.js"></script>
        <script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/joinable.js"></script>
        <script src="assets/js/resizeable.js"></script>
        <script src="assets/js/neon-api.js"></script>
        <script src="assets/js/jquery.validate.min.js"></script>
        <script src="assets/js/neon-login.js"></script>
        <script src="assets/js/neon-custom.js"></script>
        <script src="assets/js/neon-demo.js"></script>



        <!--Start of Tawk.to Script-->
       <?php echo $tawkto; ?>
        <!--End of Tawk.to Script-->

 <script type="text/javascript">
          /*  $('#admin').click(function () {
                $("input[name=email]").val('admin@admin.com');
                $("input[name=password]").val('admin');
            });
            $('#teacher').click(function () {
                $("input[name=email]").val('teacher@teacher.com');
                $("input[name=password]").val('teacher');
            });
            $('#student').click(function () {
                $("input[name=email]").val('student@student.com');
                $("input[name=password]").val('student');
            });
            $('#parent').click(function () {
                $("input[name=email]").val('parent@parent.com');
                $("input[name=password]").val('parent');
            });
            $('#accountant').click(function () {
                $("input[name=email]").val('accountant@account.com');
                $("input[name=password]").val('accountant');
            });
            $('#librarian').click(function () {
                $("input[name=email]").val('librarian@librarian.com');
                $("input[name=password]").val('librarian');
            });
            $('#recep').click(function () {
                $("input[name=email]").val('hostel@hostel.com');
                $("input[name=password]").val('hostel');
            });*/
        </script>
    </body>
</html>
