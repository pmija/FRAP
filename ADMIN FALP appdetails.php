<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <link href="css/montserrat.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php 
    session_start();
    require_once('mysql_connect_FA.php');
    if ($_SESSION['usertype'] == 1||!isset($_SESSION['usertype'])) {

header("Location: http://".$_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF'])."/index.php");

}
     //Test value
    //$_SESSION['idnum']=1141231234;
    $_SESSION['curFALPAmount'] = Null;
    //$message = "MEM ID" . $_SESSION['showFMID'] . " Loan ID " . $_SESSION['showFID'] . " Admin " . $_SESSION['adminidnum'];
    if(isset($_POST['action'])){
        $query = "SELECT AMOUNT FROM LOANS WHERE LOAN_ID =". $_SESSION['showFID'] .";";
        $result = mysqli_query($dbc, $query);

        if($_POST['action'] == "Accept Application"){
            //Change the status into Approved (APP_STATUS =2)
            $query = "UPDATE LOANS SET APP_STATUS = '2', LOAN_STATUS= '2', DATE_APPROVED = NOW(), EMP_ID =". $_SESSION['idnum'] ." WHERE LOAN_ID =" . $_SESSION['showFID'].";";
            $result = mysqli_query($dbc, $query);

           //Insert into transaction table
            $queryTnx = "INSERT INTO TXN_REFERENCE (MEMBER_ID, TXN_TYPE, TXN_DESC, AMOUNT, TXN_DATE, LOAN_REF, EMP_ID, SERVICE_TYPE) 
            VALUES({$_SESSION['showFMID']}, '1', 'FALP Approved', 0, NOW(), {$_SESSION['showFID']}, {$_SESSION['idnum']}, '2'); ";
            $resultTnx = mysqli_query($dbc, $queryTnx);

            $message = "Accepted" . $queryTnx;
        }
        else if($_POST['action'] == "Reject Application"){
            //Change the status into Approved (APP_STATUS =2)
            $query = "UPDATE LOANS SET APP_STATUS = '1', LOAN_STATUS= '1', DATE_APPROVED = NOW(), EMP_ID =". $_SESSION['idnum'] ." WHERE LOAN_ID =" . $_SESSION['showFID'].";";
            $result = mysqli_query($dbc, $query);

           //Insert into transaction table
            $queryTnx = "INSERT INTO TXN_REFERENCE (MEMBER_ID, TXN_TYPE, TXN_DESC, AMOUNT, TXN_DATE, LOAN_REF, EMP_ID, SERVICE_TYPE) 
            VALUES({$_SESSION['showFMID']}, '1', 'FALP Rejected', 0, NOW(), {$_SESSION['showFID']}, {$_SESSION['idnum']}, '2'); ";
            $resultTnx = mysqli_query($dbc, $queryTnx);

            $message = "Rejected";
        }
    }
?>
<body>

    <div id="wrapper">

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            
            <div class="navbar-header"> <!-- Logo -->
                
                <img src="images/I-FA Logo Edited.png" id="ifalogo">
            
            
            <ul class="nav navbar-right top-nav"> <!-- Top Menu Items / Notifications area -->
                
                <li class="dropdown sideicons">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>

                    <ul class="dropdown-menu alert-dropdown">

                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>

                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>

                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>

                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>

                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>

                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="#">View All</a>
                        </li>

                    </ul>

                </li>

                <li class="dropdown sideicons">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Jo, Melton <b class="caret"></b></a>

                    <ul class="dropdown-menu">

                        <li>

                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>

                        </li>

                        <li class="divider"></li>

                        <li>

                            <a href="login.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>

                        </li>

                    </ul>

                </li>

            </ul>
			
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <ul class="nav navbar-nav side-nav">

                    <li id="top">

                        <a href="ADMIN dashboard.php"><i class="fa fa-area-chart" aria-hidden="true"></i> Overview</a>

                    </li>

                    <li>

                        <a href="ADMIN addaccount.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Admin Account</a>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#applications"><i class="fa fa-wpforms" aria-hidden="true"></i>&nbsp;Applications<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="applications" class="collapse">

                            <li>
                                <a href="ADMIN MEMBERSHIP applications.php"><i class="fa fa-id-card-o" aria-hidden="true"></i>&nbsp;&nbsp;Membership Pending Applications</a>
                            </li>

                            <li>
                                <a href="ADMIN FALP applications.php"><i class="fa fa-dollar" aria-hidden="true"></i>&nbsp;&nbsp;FALP Pending Applications</a>
                            </li>

                            <li>
                                <a href="ADMIN BANK applications.php"><i class="fa fa-institution" aria-hidden="true"></i>&nbsp;&nbsp;Bank Loan Pending Applications</a>
                            </li>

                            <li>
                                <a href="ADMIN HEALTHAID applications.php"><i class="fa fa-medkit" aria-hidden="true"></i>&nbsp;&nbsp;Health Aid Pending Applications</a>
                            </li>

                        </ul>

                    </li>

                    <li>

                        <a href="ADMIN LIFETIME addmember.php"><i class="fa fa-id-card-o" aria-hidden="true"></i> Add Lifetime Member</a>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#bankloans"><i class="fa fa-institution" aria-hidden="true"></i>&nbsp;Bank Loans<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="bankloans" class="collapse">

                            <li>
                                <a href="ADMIN BANK addbank.php"><i class="fa fa-institution" aria-hidden="true"></i>&nbsp;&nbsp;Add Partner Bank</a>
                            </li>

                            <li>
                                <a href="ADMIN BANK editbank.php"><i class="fa fa-gears" aria-hidden="true"></i>&nbsp;&nbsp;Enable/Disable Partner Bank</a>
                            </li>

                            <li>
                                <a href="ADMIN BANK addplan.php"><i class="fa fa-dollar" aria-hidden="true"></i>&nbsp;&nbsp;Add Bank Loan Plan</a>
                            </li>

                            <li>
                                <a href="ADMIN BANK editplan.php"><i class="fa fa-gears" aria-hidden="true"></i>&nbsp;&nbsp;Enable/Disable Bank Loan Plan</a>
                            </li>

                        </ul>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#members"><i class="fa fa-group aria-hidden="true"></i>&nbsp;Member Database<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="members" class="collapse">

                            <li>
                                <a href="ADMIN MEMBERS viewmembers.php"><i class="fa fa-group" aria-hidden="true"></i>&nbsp;&nbsp;View All Members</a>
                            </li>

                            <li>
                                <a href="ADMIN MEMBERS viewstatus.php"><i class="fa fa-handshake-o" aria-hidden="true"></i>&nbsp;&nbsp;Member's Services</a>
                            </li>

                        </ul>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#loans"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;On-going Loans<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="loans" class="collapse">

                            <li>
                                <a href="ADMIN FALP viewactive.php"><i class="fa fa-dollar" aria-hidden="true"></i>&nbsp;&nbsp;FALP Loans</a>
                            </li>

                            <li>
                                <a href="ADMIN BANK viewactive.php"><i class="fa fa-institution" aria-hidden="true"></i>&nbsp;&nbsp;Bank Loans</a>
                            </li>

                        </ul>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#dreports"><i class="fa fa-minus" aria-hidden="true"></i>&nbsp;Deduction Reports<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="dreports" class="collapse">

                            <li>
                                <a href="ADMIN DREPORT general.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;General Deductions</a>
                            </li>

                            <li>
                                <a href="ADMIN DREPORT detailed.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Detailed Deductions</a>
                            </li>

                        </ul>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#preports"><i class="fa fa-table" aria-hidden="true"></i>&nbsp;Periodical Reports<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="preports" class="collapse">

                            <li>
                                <a href="ADMIN PREPORT completed.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Completed Loans</a>
                            </li>

                            <li>
                                <a href="ADMIN PREPORT new.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;New Deductions</a>
                            </li>

                        </ul>

                    </li>

                                        <li>

                        <a href="ADMIN MREPORT report.php"><i class="fa fa-table" aria-hidden="true"></i> Monthly Report</a>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#repo"><i class="fa fa-folder-open-o" aria-hidden="true"></i>&nbsp;File Repository<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="repo" class="collapse">

                            <li>
                                <a href="ADMIN FILEREPO.php"><i class="fa fa-files-o" aria-hidden="true"></i>&nbsp;&nbsp;View Documents</a>
                            </li>

                            <li>

                                <a href="ADMIN FILEREPO upload.php"><i class="fa fa-upload" aria-hidden="true"></i> Upload Documents</a>

                            </li>

                        </ul>

                    </li>

                    <li>

                        <a href="ADMIN MANAGE.php"><i class="fa fa-gears" aria-hidden="true"></i> Admin Management</a>

                    </li>

                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            View FALP Loan Details
                        </h1>
                        <?php
                            if(isset($message)){
                                echo"  
                                <div class='alert alert-warning'>
                                    ". $message ."
                                </div>
                                ";
                            }
                        ?>
                    </div>
                    
                </div>
                <!-- alert -->
                <div class="row">
                    <div class="col-lg-12">

                       <div class="row">

                            <div class="col-lg-12">

                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> <!-- SERVER SELF -->

                                    <div class="panel panel-green">

                                        <div class="panel-heading">

                                            <b>Personal Information</b>

                                        </div>

                                        <div class="panel-body"><p>
                                            <?php 
                                                $query = "SELECT FIRSTNAME, LASTNAME, MIDDLENAME FROM MEMBER M WHERE MEMBER_ID = ". $_SESSION['showFMID'] .";";
                                                $result = mysqli_query($dbc, $query);
                                                $row = mysqli_fetch_array($result);
                                            ?>

                                            <b>ID Number:</b><?php echo $_SESSION['showFMID']; ?> <p>
                                            <b>First Name:</b><?php echo $row['FIRSTNAME']; ?> <p>
                                            <b>Last Name:</b><?php echo $row['LASTNAME']; ?> <p>
                                            <b>Middle Name:</b><?php echo $row['MIDDLENAME']; ?> <p>
                                            
                                        </div>

                                    </div>

                                    <div class="panel panel-green">

                                        <div class="panel-heading">

                                            <b>FALP Details</b>

                                        </div>

                                        <div class="panel-body"><p>
                                            <?php 
                                                $query = "SELECT AMOUNT, PAYABLE, PAYMENT_TERMS, PER_PAYMENT FROM LOANS WHERE MEMBER_ID = ". $_SESSION['showFMID'] .";";
                                                $result = mysqli_query($dbc, $query);
                                                $row = mysqli_fetch_array($result);
                                            ?>
                                            <b>Amount to Borrow:</b><?php echo $row['AMOUNT']; ?> <p>
                                            <b>Amount Payable:</b><?php echo $row['PAYABLE']; ?> <p>
                                            <b>Payment Terms:</b><?php echo $row['PAYMENT_TERMS']; ?> <p>
                                            <b>Monthly Deductions:</b><?php echo $row['PER_PAYMENT'] * 2; ?> <p>
                                            <b>Number of Payments:</b><?php echo $row['PAYMENT_TERMS'] * 2; ?> <p>
                                            <b>Per Payment Deduction:</b><?php echo $row['PER_PAYMENT']; ?> <p>

                                        </div>

                                    </div>

                                    <div class="panel panel-primary">

                                        <div class="panel-heading">

                                            <b>Actions</b>

                                        </div>

                                        <div class="panel-body"><p>

                                            <input type="submit" class="btn btn-success" name="action" value="Accept Application">
                                            <input type="submit" class="btn btn-danger" name="action" value="Reject Application">

                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <script>

        $(document).ready(function(){
    
            $('#table').DataTable();

        });

    </script>

</body>

</html>
