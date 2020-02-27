<?php
ob_start();
include "../vendor/autoload.php";
use App\Database\Database;
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

    <?php
    if (isset($_GET["edit_ans"])){
        $editId = $_GET["edit_ans"];
        $sql = "SELECT * FROM answers WHERE id='$editId' ";
        $stmt = Database::Prepare($sql);
        $stmt->execute();
        $data =  $stmt->fetchAll();
        foreach ($data as $val){
        }
        ?>

        <div class="container">
            <div class="row">
                <div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title text-center">Update Your Answers</h2>
                        </div>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $body = $_POST["body"];
                            if (!empty($body)){

                                $sql = "UPDATE answers SET ans=:body WHERE id=:id";
                                $stmt = Database::Prepare($sql);
                                $stmt->bindParam(':body', $body);
                                $stmt->bindParam(':id', $editId);
                                $satatus = $stmt->execute();
                                if ($satatus){
                                    ?>
                                    <h3 class="text-center"><span style='color: darkgreen'>Your answer updated
                                            successfully</span></h3>
                                    <?php
                                }else{
                                    ?>
                                    <h3 class="text-center"><span style='color: #ac2925'>Answer update failed!</span></h3>
                                    <?php
                                }
                            }else{
                                ?>
                                <h3 class="text-center"><span style='color: #ac2925'>Field must not be empty!</span></h3>
                                <?php
                            }
                        }
                        ?>

                        <div class="panel-body">
                            <form action="" method="post">

                                <label>Update your answer:</label>
                                <textarea class="tinymce form-control" name="body" rows="5" >
                                <?php echo $val['ans'];?>
                            </textarea><br>
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
    <?php }  ?>

    <div class="footer2">
        <div class="container">
            <div class="row">

                <div class="col-md-6 widget">
                    <div class="widget-body">
                        <p class="simplenav">
                            <a href="#">Home</a> |
                            <a href="about.php">About</a> |
                            <a href="contact.php">Contact</a> |
                            <b><a href="signup.php">Sign up</a></b>
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