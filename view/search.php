<?php
ob_start();
include "../vendor/autoload.php";
use App\Database\Database;
use App\Question\Question;
use App\Answers\Answers;
use App\Session\Session;
use App\Timer\Timer;
$question = new Question();
$answers = new Answers();
$timer = new Timer();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"    content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">

    <title>amarproshno.com</title>

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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.navbar -->

<!-- Header -->

<header id="head">
    <div class="container">
        <div class="row height">
            <h1 class="text-center col-md-8"><b>Search Your Question....</b></h1>
            <div class="form-group col-md-8">

                <form action="" method="post" role="search">
                    <input type="search" name="search" class="form-control" placeholder="Search"><br>
                    <button class="btn btn-default" name="submit" type="submit">Search</button>
                </form>
            </div>
            <div class="col-md-4">
                <a href="my_question.php"><button class="btn btn-action" type="submit">Enter Your
                        Question</button></a>
            </div>

        </div>
    </div>
</header>
<br><br>

<div class="container">
    <div class="row">

        <div class="col-md-12">
            <?php
            if (!isset($_POST["search"]) || $_POST["search"] == NULL){
                header("Location: ../index.php");
            } else {

            $search = $_POST["search"];
            $query = "SELECT * FROM question WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
            $stmt = Database::Prepare($query);
            $stmt->execute();
            $data =  $stmt->fetchAll();
            if ($data){

            foreach ($data as $search_data) {
            ?>

                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <?php echo $search_data['title'];?>
                        </div>

                        <div class="panel-body">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                            <?php
                            $userId = $search_data['user_id'];
                            $query = "SELECT * FROM users WHERE id= '$userId'";
                            $stmt = Database::Prepare($query);
                            $stmt->execute();
                            $data =  $stmt->fetchAll();

                            foreach ($data as $userDetails){
                            ?>
                                <label class="label">
                                    <a style="color: #000000;" href="view_profile.php?userProfile=<?php echo $userDetails['id'];?>">
                                        <img style="border: solid 1px #91A67F; padding: 3px; border-radius: 5px;"
                                             src="<?php echo $userDetails['image'];?>">
                                        <p><?php echo $userDetails['username'];?></p>
                                    </a>
                                </label>
                            <?php } ?>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
                            <span style="font-size: 16px;">
                                <?php echo $question->textShorten($search_data['body'], 570);?>
                                <nav aria-label="...">
                                    <ul class="pager">
                                        <li class="next"><a href="details.php?detailId=<?php echo $search_data['id']; ?>">Answer <span class="glyphicon  glyphicon-hand-right"  aria-hidden="true"></span></a></li>
                                    </ul>
                                </nav>
                            </span>
                            </div>
                            <div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php
                                $id = $search_data["cat_id"];
                                $query = "SELECT * FROM category WHERE id= '$id'";
                                $stmt = Database::Prepare($query);
                                $stmt->execute();
                                $data =  $stmt->fetchAll();

                                foreach ($data as $catName){
                                    ?>
                                    <span class="glyphicon  glyphicon-th-list"></span> In <a href="category.php?categoryId=<?php echo $catName['id'];?>"><?php echo $catName['name'];?></a>
                                <?php } ?>
                                | <span class="glyphicon  glyphicon-time"></span>
                                <?php
                                $time = $search_data["created_at"];
                                $time = strtotime("$time");
                                echo $timer->_ago($time);
                                ?>
                                ago
                                <?php
                                $i=0;
                                foreach ($answers->getAllAnswers($search_data["id"]) as  $value) {
                                    $i++;
                                }
                                ?>
                                | <span class="glyphicon glyphicon-comment"></span> <?php echo " " . $i; ?> Answer
                            </div>
                        </div>
                    </div>

                <?php   } } else{
                echo "<h2>No Data Available In THis Category.</h2>";
            }}?>
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
<?php ob_end_flush(); ?>