<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome to FRAP!</title>

    <link href="css/montserrat.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<?php 

    session_start();

    if (isset($_POST['submit'])) {

        $message = NULL;

        if (empty($_POST['idnum'])) {

            $_SESSION['idnum'] = NULL;
            $message.='<p>You forgot to enter your username!';

        }

        else {
            $_SESSION['idnum'] = $_POST['idnum'];
        }

        if (empty($_POST['password'])) {

            $_SESSION['password'] = NULL;
            $message.='<p>You forgot to enter your username!';

        }

        else {
            $_SESSION['password'] = $_POST['password'];
        }
 
        if (!isset($message)) {

                $idnum = $_SESSION['idnum'];
                $password = $_SESSION['password'];

                require_once('mysql_connect_FA.php');
                $queryMem = "SELECT MEMBER_ID, PASSWORD FROM MEMBER_ACCOUNT WHERE MEMBER_ID = '{$idnum}' AND PASSWORD = PASSWORD('{$password}')";
                $resultMem = mysqli_query($dbc, $queryMem);
                $rowMem = mysqli_fetch_array($resultMem);

                $queryEmp = "SELECT MEMBER_ID, PASSWORD, APP_STATUS_ID FROM EMPLOYEE WHERE MEMBER_ID = '{$idnum}' AND PASSWORD = PASSWORD('{$password}')";
                $resultEmp = mysqli_query($dbc, $queryEmp);
                $rowEmp = mysqli_fetch_array($resultEmp);

                if ($rowMem['MEMBER_ID'] == $_SESSION['idnum']) {

                    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/MEMBER dashboard.php");
                    $_SESSION['usertype'] = "2";

                }

                else if ($rowEmp['MEMBER_ID'] == $_SESSION['idnum'] && $rowEmp['APP_STATUS_ID'] == 2) {

                    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/admin homepage.php");
                    $_SESSION['usertype'] = "1";

                }

        }

    }

?>

<body>

    <div id="wrappersignup">

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <div class="navbar-header">

                <img src="images/I-FA Logo Edited.png" id="ifalogo">

            </div>

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                
                <div class="row"> <!-- Image -->

                    <div class="col-lg-3 col-1"> <!-- For center alignment -->

                    </div>

                    <div class="col-lg-6 col-2"> <!-- The center of the page -->

                        <img src="images/ifalogo normal.png" id="falogonorm">

                    </div>

                    <div class="col-lg-3 col-3"> <!-- For center alignment -->             

                    </div>
                   
                </div>
                

                <div class="row"> <!-- Fields -->

                    <div class="col-lg-3 col-1"> <!-- For center alignment -->


                    </div>

                    <div class="col-lg-6 col-2"> <!-- The center of the page -->

                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="loginform">

                            <div>
                                <label id="emaillabel">ID Number</label>
                                <input type="text" id="emaillogin" class="form-control" placeholder="e.g. 11700000" name="idnum">
                            </div>

                            <div>
                                <label id="passlabel">Password</label>
                                <input type="password" id="passlogin" class="form-control" placeholder="Password" name="password">
                            </div>

                            <div id="loginsubmitbutton">

                                <input type="submit" value="Log In" class="btn btn-success" name="submit">

                            </div>

                        </form>

                        <div id="signupdiv">

                            <p id="noacc">No account yet?</p>
                
                            <a href="FA membership.php" id="loginsignupbutton" class="btn btn-default" role="button">Apply Here!</a>

                        </div>

                    </div>

                    <div class="col-lg-3 col-3"> <!-- For center alignment -->


                    </div>

                </div>

                <div class="row"> <!-- Extra Row -->

                    <div class="col-lg-4 col-1"> <!-- For center alignment -->


                    </div>

                    <div class="col-lg-4 col-2"> <!-- The center of the page -->

                        

                    </div>

                    <div class="col-lg-4 col-3"> <!-- For center alignment -->


                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>