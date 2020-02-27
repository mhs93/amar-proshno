<?php
include "../vendor/autoload.php";
use App\Question\Question;
use App\Session\Session;
$question = new Question();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">

    <title>amrproshno.com</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top headroom" style="background-color: black" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-header">
                        <!-- Button for smallest screens -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="../index.php">AmarProshno</a>

                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav pull-right">
                            <?php
                            $path = $_SERVER["SCRIPT_FILENAME"];
                            $CurreentPage = basename($path, '.php');
                            ?>
                            <li class="active"><a href="../index.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Category <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" style="background-color: black">
                                    <?php foreach ($question->getCategory() as $key => $value ){ ?>
                                        <li><a class="active" href="category.php?categoryId=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></li>
                                    <?php  }  ?>
                                </ul>
                            </li>

                            <li><a href="contact.php">Contact</a></li>
                            <?php if (isset($_GET["set"]) && $_GET["set"] == "logout"){
                                Session::destroy_sessionFor_other();
                            }  ?>
                            <?php if (!isset($_SESSION["userid"]) || empty($_SESSION["userid"])){   ?>
                                <li><a class="btn btn-default" href="signin.php">Login / Sign Up</a></li>
                            <?php }else{?>
                                <li><a href="profile.php">My Profile</a></li>
                                <li><a class="btn btn-default" href="?set=logout">Logout</a></li>
                            <?php } ?>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.navbar -->

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="../index.php">Home</a></li>
			<li class="active">About</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-sm-9 maincontent">
				<header class="page-header">
					<h1 class="page-title">Contact us</h1>
				</header>
				
				<p>
					We’d love to hear from you. Interested in working together? Fill out the form below with some info about your project and I will get back to you as soon as I can. Please allow a couple days for me to respond.
				</p>
				<br>
					<form>
						<div class="row">
							<div class="col-sm-4">
								<input class="form-control" type="text" placeholder="Name">
							</div>
							<div class="col-sm-4">
								<input class="form-control" type="text" placeholder="Email">
							</div>
							<div class="col-sm-4">
								<input class="form-control" type="text" placeholder="Phone">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<textarea placeholder="Type your message here..." class="form-control" rows="9"></textarea>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-6">
								<label class="checkbox"><input type="checkbox"> Sign up for newsletter</label>
							</div>
							<div class="col-sm-6 text-right">
								<input class="btn btn-action" type="submit" value="Send message">
							</div>
						</div>
					</form>

			</article>
			<!-- /Article -->
			
			<!-- Sidebar -->
			<aside class="col-sm-3 sidebar sidebar-right">

				<div class="widget">
					<h4>Address</h4>
					<address>
                        Jatrabari, Dhaka, 1204
					</address>
					<h4>Phone:</h4>
					<address>
						+8801911543307
					</address>
				</div>

			</aside>
			<!-- /Sidebar -->

		</div>
	</div>	<!-- /container -->
	
	<section class="container-full top-space">
		<div id="map"></div>
	</section>

    <footer id="footer" class="top-space">

        <div class="footer1">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 widget">
                        <h3 class="widget-title">Contact</h3>
                        <div class="widget-body">
                            <p>+8801671343973<br>
                                <a href="mailto:#">mominulhasan93@gmail.com</a><br>
                                <br>
                                Ray Shaheb Bazar, Dhaka, 1100
                            </p>
                        </div>
                    </div>

                    <div class="col-md-3 widget">
                        <h3 class="widget-title">Follow Me</h3>
                        <div class="widget-body">
                            <p class="follow-me-icons">
                                <a href="https://twitter.com/mominulhasan93"><i class="fa fa-twitter fa-2"></i></a>
                                <a href="https://github.com/mhs93"><i class="fa fa-github fa-2"></i></a>
                                <a href="https://www.facebook.com/mominul.hasan.14"><i class="fa fa-facebook fa-2"></i></a>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 widget">
                        <h3 class="widget-title">Text widget</h3>
                        <div class="widget-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, dolores, quibusdam architecto voluptatem amet fugiat nesciunt placeat provident cumque accusamus itaque voluptate modi quidem dolore optio velit hic iusto vero praesentium repellat commodi ad id expedita cupiditate repellendus possimus unde?</p>
                        </div>
                    </div>

                </div> <!-- /row of widgets -->
            </div>
        </div>


        <div class="footer2">
            <div class="container">
                <div class="row">

                    <div class="col-md-6 widget">
                        <div class="widget-body">
                            <p class="simplenav">
                                <a href="#">Home</a> |
                                <a href="view/about.php">About</a> |
                                <a href="view/contact.php">Contact</a> |
                                <b><a href="view/signup.php">Sign up</a></b>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 widget">
                        <div class="widget-body">
                            <p class="text-right">
                                Copyright &copy; <?php date('Y'); ?>, mhs. <a href="#" rel="designer">Mhs</a>
                            </p>
                        </div>
                    </div>

                </div> <!-- /row of widgets -->
            </div>
        </div>

    </footer>





    <!-- JavaScript libs are placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/headroom.min.js"></script>
    <script src="assets/js/jQuery.headroom.min.js"></script>
    <script src="assets/js/template.js"></script>
</body>
</html>