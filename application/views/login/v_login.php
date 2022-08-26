<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sistem Informasi Rekam Medis RS Wijaya Kusuma Lumajang</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glassy Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/login/css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/login/css/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 

<!-- //css files -->
<!-- web-fonts -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet">
<!-- //web-fonts -->

<style type="text/css">
.background{
    background: url("<?php echo base_url() ?>assets/login/images/backe.jpg") center center;
    background-repeat: no-repeat;    
    background-position: center center;    
    background-attachment: fixed; 
    -webkit-background-size: 100%, cover;    
    -moz-background-size: 100%, cover;    
    -o-background-size: 100%, cover;    
    background-size: 100%, cover;
}
</style>
</head>
<body class="background">
        <!--header-->
        <div class="header-w3l">
            <h1>RUMAH SAKIT WIJAYA KUSUMA LUMAJANG</h1>
        </div>
        <!--//header-->
        <!--main-->
        <div class="main-w3layouts-agileinfo">
               <!--form-stars-here-->
                        <div class="wthree-form">
                            <h2>Login Sistem Rekam Medis</h2>
                            <?php echo $this->session->flashdata('msg'); ?>
                            <form action="<?php echo base_url(); ?>index/aksi_login" method="post">
                                <div class="form-sub-w3">
                                    <input type="text" name="user" placeholder="Username " required="" autofocus />
                                <div class="icon-w3">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                </div>
                                <div class="form-sub-w3">
                                    <input type="password" name="pass" placeholder="Password" required="" />
                                <div class="icon-w3">
                                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                </div>
                                </div> 
                                <div class="clear"></div>
                                <div class="submit-agileits">
                                    <input type="submit" value="Login">
                                </div>
                            </form>

                        </div>
                <!--//form-ends-here-->

        </div>
        <!--//main-->
        <!--footer-->
        <div class="footer">
            <p>&copy; Sistem Administrasi Rekam Medis Rumah Sakit Wijaya Kusuma Lumajang</p>
        </div>
        <!--//footer-->
</body>
</html>