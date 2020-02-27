<?php
ob_start();
include "../vendor/autoload.php";
use App\Question\Question;
use App\Session\Session;
$question = new Question();
Session::checkSession();
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
    </body>
    </html>
    <![endif]-->
</head>

<body class="home">
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
                        <li><a href="../index.php">Home</a></li>
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
                        <?php if (isset($_GET["set"]) && $_GET["set"] == "logout"){
                            Session::destroy_sessionFor_other();
                        }  ?>
                        <?php if (!isset($_SESSION["userid"]) || empty($_SESSION["userid"])){   ?>
                            <li><a class="btn btn-default" href="signin.php">Login / Sign Up</a></li>
                        <?php }else{?>
                            <li><a href="my_all_question.php">My All Question</a></li>
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

<!-- Header -->

<br><br><br><br><br><br><br>

<div class="container">
    <div class="row">
        <div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">Ask Your Question</h2>
                </div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $question->setData($_POST);
                }
                ?>

                <div class="panel-body">
                    <form action="" method="post">
                        <div class="row">

                            <h3 class="col-md-12 text-center">
                                <?php
                                echo Session::ErrorMsg();
                                echo Session::SuccessMsg();
                                ?>
                            </h3>

                            <br>
                            <div class="col-sm-3">
                                <select name="cat_id" class="mdb-select form-control">
                                    <option value='total' selected>Select a category</option>
                                    <?php foreach ($question->getCategory() as $key => $value ){ ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                            <br><br><br>
                            <div class="form-group col-sm-12">
                                <label>Please Enter Your Question:</label>
                                <input class="form-control" type="text" name="title" placeholder="Please Enter Your
 Question Title" required>
                                <input type="hidden" name="userid" value="<?php echo Session::get('userid');?>">
                                <input type="hidden" name="username" value="<?php echo Session::get('username');?>">
                            </div>
                        </div>
                        <label>Enter Your Question Details:</label>
                        <textarea class="tinymce form-control" name="body" rows="5" placeholder="Please Enter Your
                        Question Details...." ></textarea><br>
                        <div class="row">
                            <div class="col-sm-12 form-group text-center">
                                <input class="btn btn-default" type="submit" name="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


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
                            Copyright &copy; <?php date('Y'); ?>, mhs. <a href="#" rel="designer">Mominul Hasan</a>
                        </p>
                    </div>
                </div>

            </div> <!-- /row of widgets -->
        </div>
    </div>

</footer>



<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="assets/plugin/tinymce/init-tinymce.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/headroom.min.js"></script>
<script src="assets/js/jQuery.headroom.min.js"></script>
<script src="assets/js/template.js"></script>
</body>
</html>
<?php  ob_end_flush(); ?>