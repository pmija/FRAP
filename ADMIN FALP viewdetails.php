<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require_once("mysql_connect_FA.php");

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FRAP | Falp Summary</title>

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

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>

                    <ul class="dropdown-menu">

                        <li>

                            <a href="login.html"><i class="fa fa-fw fa-power-off"></i> Log Out</a>

                        </li>

                    </ul>

                </li>

            </ul>
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <ul class="nav navbar-nav side-nav">

                    <li id="top">

                        <a href="ADMIN dashboard.html"><i class="fa fa-area-chart" aria-hidden="true"></i> Overview</a>

                    </li>

                    <li>

                        <a href="ADMIN addaccount.html"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Admin Account</a>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#applications"><i class="fa fa-wpforms" aria-hidden="true"></i>&nbsp;Applications<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="applications" class="collapse">

                            <li>
                                <a href="ADMIN MEMBERSHIP applications.html"><i class="fa fa-id-card-o" aria-hidden="true"></i>&nbsp;&nbsp;Membership Pending Applications</a>
                            </li>

                            <li>
                                <a href="ADMIN FALP applications.html"><i class="fa fa-dollar" aria-hidden="true"></i>&nbsp;&nbsp;FALP Pending Applications</a>
                            </li>

                            <li>
                                <a href="ADMIN BANK applications.html"><i class="fa fa-institution" aria-hidden="true"></i>&nbsp;&nbsp;Bank Loan Pending Applications</a>
                            </li>

                            <li>
                                <a href="ADMIN HEALTHAID applications.html"><i class="fa fa-medkit" aria-hidden="true"></i>&nbsp;&nbsp;Health Aid Pending Applications</a>
                            </li>

                        </ul>

                    </li>

                    <li>

                        <a href="ADMIN LIFETIME addmember.html"><i class="fa fa-id-card-o" aria-hidden="true"></i> Add Lifetime Member</a>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#bankloans"><i class="fa fa-institution" aria-hidden="true"></i>&nbsp;Bank Loans<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="bankloans" class="collapse">

                            <li>
                                <a href="ADMIN BANK addbank.html"><i class="fa fa-institution" aria-hidden="true"></i>&nbsp;&nbsp;Add Partner Bank</a>
                            </li>

                            <li>
                                <a href="ADMIN BANK editbank.html"><i class="fa fa-gears" aria-hidden="true"></i>&nbsp;&nbsp;Enable/Disable Partner Bank</a>
                            </li>

                            <li>
                                <a href="ADMIN BANK addplan.html"><i class="fa fa-dollar" aria-hidden="true"></i>&nbsp;&nbsp;Add Bank Loan Plan</a>
                            </li>

                            <li>
                                <a href="ADMIN BANK editplan.html"><i class="fa fa-gears" aria-hidden="true"></i>&nbsp;&nbsp;Enable/Disable Bank Loan Plan</a>
                            </li>

                        </ul>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#members"><i class="fa fa-group aria-hidden="true"></i>&nbsp;Member Database<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="members" class="collapse">

                            <li>
                                <a href="ADMIN MEMBERS viewmembers.html"><i class="fa fa-group" aria-hidden="true"></i>&nbsp;&nbsp;View All Members</a>
                            </li>

                            <li>
                                <a href="ADMIN MEMBERS viewstatus.html"><i class="fa fa-handshake-o" aria-hidden="true"></i>&nbsp;&nbsp;Member's Services</a>
                            </li>

                        </ul>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#loans"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;On-going Loans<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="loans" class="collapse">

                            <li>
                                <a href="ADMIN FALP viewactive.html"><i class="fa fa-dollar" aria-hidden="true"></i>&nbsp;&nbsp;FALP Loans</a>
                            </li>

                            <li>
                                <a href="ADMIN BANK viewactive.html"><i class="fa fa-institution" aria-hidden="true"></i>&nbsp;&nbsp;Bank Loans</a>
                            </li>

                        </ul>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#dreports"><i class="fa fa-minus" aria-hidden="true"></i>&nbsp;Deduction Reports<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="dreports" class="collapse">

                            <li>
                                <a href="ADMIN DREPORT general.html"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;General Deductions</a>
                            </li>

                            <li>
                                <a href="ADMIN DREPORT detailed.html"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Detailed Deductions</a>
                            </li>

                        </ul>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#preports"><i class="fa fa-table" aria-hidden="true"></i>&nbsp;Periodical Reports<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="preports" class="collapse">

                            <li>
                                <a href="ADMIN PREPORT completed.html"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Completed Loans</a>
                            </li>

                            <li>
                                <a href="ADMIN PREPORT new.html"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;New Deductions</a>
                            </li>

                        </ul>

                    </li>

                                        <li>

                        <a href="ADMIN MREPORT report.html"><i class="fa fa-table" aria-hidden="true"></i> Monthly Report</a>

                    </li>

                    <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#repo"><i class="fa fa-folder-open-o" aria-hidden="true"></i>&nbsp;File Repository<i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="repo" class="collapse">

                            <li>
                                <a href="ADMIN FILEREPO.html"><i class="fa fa-files-o" aria-hidden="true"></i>&nbsp;&nbsp;View Documents</a>
                            </li>

                            <li>

                                <a href="ADMIN FILEREPO upload.html"><i class="fa fa-upload" aria-hidden="true"></i> Upload Documents</a>

                            </li>

                        </ul>

                    </li>

                    <li>

                        <a href="ADMIN MANAGE.html"><i class="fa fa-gears" aria-hidden="true"></i> Admin Management</a>

                    </li>

                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                
                    <div class="col-lg-12">

                        <h1 class="page-header">Patrick Mijares' FALP Loan Summary</h1>
                    
                    </div>

                </div>

                    <div class="row">

                        <div class="col-lg-6">

                            <div class="panel panel-primary">

                                <div class="panel-heading">

                                    <b>Current FALP Loan Plan</b>

                                </div>

                                <div class="panel-body">

                                <table class="table table-bordered" style="width: 100%;">
                                
                                <thread>

                                    <tr>

                                    <td align="center"><b>Description</b></td>
                                    <td align="center"><b>Amount</b></td>

                                    </tr>

                                </thread>

                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM LOANS where LOAN_ID = {$_POST['details']} 
                                                  AND loan_detail_id = 1 AND    loan_status != 3";
                                        $result = mysqli_query($dbc,$query);
                                        $ans = mysqli_fetch_assoc($result);

                                        $query1 = "SELECT l2.STATUS as 'Status' FROM LOANS l1 JOIN LOAN_STATUS l2 ON l1.LOAN_STATUS = l2.STATUS_ID where l1.LOAN_ID = {$_POST['details']} 
                                                  AND l1.loan_detail_id = 1 AND     l1.loan_status != 3";
                                        $result = mysqli_query($dbc,$query1);
                                        $ans1 = mysqli_fetch_assoc($result);
                                    ?>
                                    <tr>

                                    <td>Amount to Borrow</td>
                                    <td>₱ <?php echo $ans['AMOUNT'];?></td>

                                    </tr>

                                    <tr>

                                    <td>Amount Payable</td>
                                    <td>₱ <?php echo $ans['PAYABLE'];?></td>

                                    </tr>

                                    <tr>

                                    <td>Payment Terms</td>
                                    <td><?php echo $ans['PAYMENT_TERMS'];?> months</td>

                                    </tr>

                                    <tr>

                                    <td>Monthly Deduction</td>
                                    <td>₱ <?php echo $ans['PER_PAYMENT'];?></td>

                                    </tr>

                                    <tr>

                                    <td>Number of Payments</td>
                                    <td><?php echo $ans['PAYMENT_TERMS']*2;?> payments</td>

                                    </tr>

                                    <tr>

                                    <td>Per Payment Deduction</td>
                                    <td>₱ <?php echo $ans['PER_PAYMENT'];?></td>

                                    </tr>

                                </tbody>

                                </table>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-6">

                            <div class="panel panel-green">

                                <div class="panel-heading">

                                    <b>Current FALP Loan Summary</b>

                                </div>

                                <div class="panel-body">

                                    <table class="table table-bordered" style="width: 100%;">
                                
                                <thread>

                                    <tr>

                                    <td align="center"><b>Description</b></td>
                                    <td align="center"><b>Amount</b></td>

                                    </tr>

                                </thread>

                                <tbody>

                                     <tr>

                                    <td>Date Approved</td>
                                    <td><?php echo $ans['DATE_APPROVED'];?></td>

                                    </tr>

                                    <tr>

                                    <td>Payments Made</td>
                                    <td><?php echo (int)$ans['PAYMENTS_MADE'];?> Payments</td>

                                    </tr>

                                    <tr>

                                    <td>Payments Left</td>
                                    <td><?php echo $ans['PAYMENT_TERMS'] - $ans['PAYMENTS_MADE'];?> Payments</td>

                                    </tr>

                                    <tr>

                                    <td>Total Amount Paid</td>
                                    <td>₱ <?php echo sprintf("%.2f",(float)$ans['AMOUNT_PAID']);?></td>

                                    </tr>

                                    <tr>

                                    <td>Outstanding Balance</td>
                                    <td>₱ <?php echo sprintf("%.2f",$ans['PAYABLE']-$ans['AMOUNT_PAID']);?></td>

                                    </tr>

                                    <tr>

                                    <td>Status</td>
                                    <td><?php echo $ans1['Status'];?></td>

                                    </tr>

                                </tbody>

                                </table>

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="row">

                        <div class="col-lg-12">

                            <div align="center">
                            <form action = "ADMIN FALP viewactivity.php" method = "POST">
                            <button type = "submit" class="btn btn-success" role="button" value = <?php echo $_POST['details']?> name = "details" >View Payment Activity</button>

                            <a href="ADMIN dashboard.html" class="btn btn-default" role="button">Go Back</a>
                            </form>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-12">

                            &nbsp;

                        </div>

                    </div>

                </div>

                <!-- /.row -->

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
