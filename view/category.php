<?php
ob_start();
include "../vendor/autoload.php";
use App\Database\Database;
use App\Question\Question;
use App\Answers\Answers;
use App\Users\Users;
use App\Session\Session;
use App\Timer\Timer;
$question = new Question();
$answers = new Answers();
$users = new Users();
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
                        <?php
                        $path = $_SERVER["SCRIPT_FILENAME"];
                        $CurreentPage = basename($path, '.php');
                        ?>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li <?php if ($CurreentPage == 'category'){echo 'class="active"';} ?>
                                role="presentation" class="dropdown">
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

                <form action="search.php" method="post" role="search">
                    <input type="search" class="form-control" placeholder="Search"><br>
                    <button class="btn btn-default" name="search" type="submit">Search</button>
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

        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
            <?php
                if (!isset($_GET["categoryId"])){
                    header("Location: ../index.php");
                }else{
                $id = $_GET["categoryId"];
                $query = "SELECT * FROM category WHERE id= '$id'";
                $stmt = Database::Prepare($query);
                $stmt->execute();
                $data =  $stmt->fetchAll();

                foreach ($data as $catName){
            ?>
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h4><?php echo"All Questions About " . $catName['name'];?></h4>
                </div>
            </div>
            <?php } } ?>

    <?php
    if (!isset($_GET["categoryId"])){
        header("Location: ../index.php");
    }else{
        $id = $_GET["categoryId"];
        $query = "SELECT * FROM question WHERE cat_id = '$id'";
        $stmt = Database::Prepare($query);
        $stmt->execute();
        $data =  $stmt->fetchAll();

        foreach ($data as $cat_data) {


    ?>
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <?php echo $cat_data['title'];?>
                </div>

                <div class="panel-body">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                        <?php
                            $userId = $cat_data['user_id'];
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
                                <?php echo $question->textShorten($cat_data['body']) ;?>
                                <nav aria-label="...">
                                <nav aria-label="...">
                                    <ul class="pager">
                                        <li class="next"><a href="details.php?detailId=<?php echo urlencode($cat_data['id']); ?>">Answer <span class="glyphicon  glyphicon-hand-right"  aria-hidden="true"></span></a></li>
                                    </ul>
                                </nav>
                            </span>
                    </div>
                    <div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        $id = $cat_data["cat_id"];
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
                        $time = $cat_data["created_at"];
                        $time = strtotime("$time");
                        echo $timer->_ago($time);
                        ?>
                        ago
                        <?php
                        $i=0;
                        foreach ($answers->getAllAnswers($cat_data["id"]) as  $value) {
                            $i++;
                        }
                        ?>
                        | <span class="glyphicon glyphicon-comment"></span> <?php echo " " . $i; ?> Answer
                    </div>
                </div>
            </div>

            <?php   } } ?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        <?php if (!Session::get("userid")){ ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">Login</h2>
                </div>
                <div class="panel-body">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $users->login($_POST);
                    }
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Enter Your Password" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-default btn-xs" name="submit">Login</button>
                    </form>
                    <a class="btn btn-action" href="signup.php">Join</a>
                </div>
                <div>
                    <h3>
                        <?php
                        echo Session::SuccessMsg();
                        echo Session::ErrorMsg();
                        ?>
                    </h3>
                </div>
            </div>
        </div>
<?php } ?>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">Site Stats</h2>
                </div>
                <?php
                $i = 0;
                foreach ($question->getAllQuestions() as $key => $value){
                    $i++;
                }
                ?>
                <?php
                $a = 0;
                foreach ($answers->getTotal_of_Answers() as $key => $value){
                    $a++;
                }
                ?>
                <div class="panel-body text-center">
                    <span class="glyphicon  glyphicon-question-sign"></span> Total Questions <span class="badge"><?php echo $i; ?></span><br><br>
                    <span class="glyphicon  glyphicon-ok-circle"></span> Total Answers <span class="badge"><?php echo $a; ?></span>

                </div>
            </div>
        <?php if (isset($_SESSION["userid"]) || !empty($_SESSION["userid"])){   ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title text-center"><a href="my_all_question.php">My Asking Questions</a></h2>
                </div>
                <div class="panel-body">
                    <ol>
                        <?php
                        $num = 0;
                        foreach ($question->get_myAllQuestions(Session::get('userid')) as $key => $value){
                            $num++;
                            if ($num == 3){
                                break;
                            }
                            ?>
                            <li><?php echo $value["title"]; ?></li>
                        <?php } ?>
                    </ol>
                    <ul class="pager">
                        <li class="next">
                            <?php
                            if ($num > 2){
                                ?>
                                <a href="my_all_question.php">More...<span class="glyphicon  glyphicon-hand-right"
                                                                           aria-hidden="true"></span></a>
                            <?php }elseif ($num == 0){
                                echo "<h5>You dont have any question.</h5>";
                            } ?>
                        </li>
                    </ul>
                </div>
            </div>
    <?php } ?>
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