<?php
include "../vendor/autoload.php";
use App\Database\Database;
use App\Question\Question;
use App\Session\Session;
use App\Utility\Utility;
use App\Users\Users;
$utillity = new Utility();
$question = new Question();
$users = new Users();
Session::checkSession();
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

<header id="head" class="secondary"></header>

<!-- container -->
<div class="container">

    <ol class="breadcrumb">
        <li><a href="../index.php">Home</a></li>
        <li><a href="change_password.php">Change Password</a></li>
        <li class="active">About</li>
    </ol>
<br><br>
    <div class="row">
        <div id="portfolio" class="container-fluid>
            <div class="row">
                <?php
                $editId = Session::get("userid");
                if (isset($editId)){
                $sql = "SELECT * FROM users WHERE id='$editId' ";
                $stmt = Database::Prepare($sql);
                $stmt->execute();
                $data =  $stmt->fetchAll();
                foreach ($data as $value){
                }
                ?>
                <div class="col-sm-5 text-center">

                    <h3 class="text-center">Change Your Profile Picture</h3>
                    <br>
                    <?php
                    $userId = Session::get("userid");
                    $query = "SELECT * FROM users WHERE id= '$userId'";
                    $stmt = Database::Prepare($query);
                    $stmt->execute();
                    $data =  $stmt->fetchAll();
                    foreach ($data as $userDetails){
                        ?>
                        <img src="<?php echo $userDetails['image']; ?>" class="img-circle center-block" alt="Cinque Terre"
                             width="370"
                             height="320">
                    <?php } ?>
                    <br>
                    <?php
                        if (isset($_POST["submit"])) {
                            $permited = array('jpg', 'jpeg', 'png', 'gif');
                            $file_name = $_FILES['image']['name'];
                            $file_size = $_FILES['image']['size'];
                            $file_temp = $_FILES['image']['tmp_name'];

                            $div = explode('.', $file_name);
                            $file_ext = strtolower(end($div));
                            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                            $uploaded_image = "assets/uploads/" . $unique_image;

                            if (!empty($file_name)) {
                                if
                                ($file_size > 1048567
                                ) {
                                    echo "<span style='color: #ac2925'>Image Size should be less then 1MB! </span>";
                                } elseif (in_array($file_ext, $permited) === false) {
                                    echo "<span style='color: #ac2925'>You can upload only:-" . implode(', ', $permited) . "</span>";
                                } else {
                                    move_uploaded_file($file_temp, $uploaded_image);

                                    $sql = "UPDATE users SET image=:image WHERE id=:id";
                                    $stmt = Database::Prepare($sql);
                                    $stmt->bindParam(':image', $uploaded_image);
                                    $stmt->bindParam(':id', $userId);
                                    $status = $stmt->execute();
                                    if ($status) {
                                        echo "<script>window.location = 'profile.php';</script>";
                                    } else {
                                        echo "<h4 style='color: #ac2925'>Profile picture updates failed</h4>";
                                    }
                                }
                            }
                        }

                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <br><br>
                        <input class="form-control" type="file" name="image">
                        <br>
                        <input type="submit" name="submit" class="btn btn-default center-block" value="Save">
                    </form>
                </div>
                <div class="col-sm-offset-2 col-sm-5">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["profile"])) {
                        $first_name = $_POST["first_name"];
                        $last_name = $_POST["last_name"];
                        if (empty($first_name) || empty($last_name)){
                            echo "<span>Please submit your first name and last name.</span>";
                        }else{
                            $users->updateName($_POST);
                        }
                    }
                    ?>
                    <br>
                    <form action="" method="post">
                        <label>First Name:</label>
                        <input class="form-control" type="text" id="name" name="first_name" value="<?php echo $value["first_name"]; ?>" ><br>
                        <label>Last Name:</label>
                        <input class="form-control" type="text" id="name" name="last_name" value="<?php echo $value["last_name"]; ?>" required><br>
                        <input type="hidden" name="userid" value="<?php echo Session::get('userid');?>">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <button class="btn btn-default" name="profile" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>	<!-- /container -->


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