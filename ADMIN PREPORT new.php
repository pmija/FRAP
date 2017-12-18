<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require_once('mysql_connect_FA.php');
$flag=0;
if(isset($_POST['print'])){
    $_SESSION['date']=$_POST['date'];
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/generateND.php");
}
if(!isset($_POST['select_date'])){
   
        $query="SELECT m.member_ID as 'ID', firstname as 'First',lastname as 'Last',middlename as 'Middle',t.service_type as 'service_type',t.amount as 'Amount',s.service
        from member m
        
        join txn_reference t
        on t.MEMBER_ID = m.MEMBER_ID
        join service_type s
        on s.SERVICE_ID = t.service_type
        join (SELECT max(txn_date) as 'Date' from txn_reference where txn_type = 2) latest
        where TXN_TYPE =2 and latest.Date = txn_date
        group by m.member_ID";

}
else {
    if($_POST['date'] != "0"){
        $date = $_POST['date'];
        $day = substr($date,0,strpos($date," "));
        $month = substr($date,(strpos($date," ")+1),strpos($date,"-")-strpos($date," ")-1);
        $year = substr($date,strpos($date,"-")+1);
        $query="SELECT m.member_ID as 'ID', firstname as 'First',lastname as 'Last',middlename as 'Middle',t.service_type as 'service_type',t.amount as 'Amount',s.service
        from member m
        
        join txn_reference t
        on t.MEMBER_ID = m.MEMBER_ID
        join service_type s
        on s.SERVICE_ID = t.service_type
        where TXN_TYPE =2 and $month = Month(txn_date) AND $year = Year(txn_date) AND $day = DAY(txn_date)
        group by m.member_ID";
    }
    else{
        $query="SELECT m.member_ID as 'ID', firstname as 'First',lastname as 'Last',middlename as 'Middle',t.service_type as 'service_type',t.amount as 'Amount',s.service
        from member m
        
        join txn_reference t
        on t.MEMBER_ID = m.MEMBER_ID
        join service_type s
        on s.SERVICE_ID = t.service_type
        join (SELECT max(txn_date) as 'Date' from txn_reference where txn_type = 2) latest
        where TXN_TYPE =2 and latest.Date = txn_date
        group by m.member_ID";
    }
}
$result=mysqli_query($dbc,$query);


?>
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

                <div class="row">
                
                    <div class="col-lg-12">

                        <h1 class="page-header">
                           New Deductions for December 15, 2017
                        </h1>
                    
                    </div>
                    
                </div>
                <!-- alert -->

                <div class="row">

                    <div class="col-lg-6">

                        <div class="panel panel-green">

                            <div class="panel-heading">

                                <b>View Report for (Month & Year)</b>

                            </div>

                            <div class="panel-body">

                                <div class="row">

                                    <div class="col-lg-6">

                                   <form action="ADMIN PREPORT new.php" method="POST">

                                        <select class="form-control" name = "date">
                                            <option value = "0">This Current Date</option>  
                                        <?php
                                        $query="SELECT DISTINCT MONTH(txn_date) as 'Month',YEAR(txn_date) as 'Year', DAY(txn_date) as 'Day' from txn_reference
                                            where txn_type = 2
                                            order by txn_date desc";
                                        $result1 = mysqli_query($dbc,$query);

                                        while($ans = mysqli_fetch_assoc($result1)){?>
                                            <option value = "<?php echo $ans['Day']." ".$ans['Month']."-".$ans['Year'];
                                                                
                                                                ?>" <?php if(isset($_POST['date'])){
                                                                    if($_POST['date']== $ans['Day']." ".$ans['Month']."-".$ans['Year']){
                                                                        echo " selected";
                                                                    }
                                                                }?> >
                                                <?php 
                                                $month = "January";
                                                if($ans['Month']=="1"){
                                                    $month = "January";
                                                }
                                                else if($ans['Month']=="2"){
                                                    $month = "February";
                                                }
                                                else if($ans['Month']=="3"){
                                                    $month = "March";
                                                }
                                                else if($ans['Month']=="4"){
                                                    $month = "April";
                                                }
                                                else if($ans['Month']=="5"){
                                                    $month = "May";
                                                }
                                                else if($ans['Month']=="6"){
                                                    $month = "June";
                                                }
                                                else if($ans['Month']=="7"){
                                                    $month = "July";
                                                }
                                                else if($ans['Month']=="8"){
                                                    $month = "August";
                                                }
                                                else if($ans['Month']=="9"){
                                                    $month = "September";
                                                }
                                                else if($ans['Month']=="10"){
                                                    $month = "October";
                                                }
                                                else if($ans['Month']=="11"){
                                                    $month = "November";
                                                }
                                                else if($ans['Month']=="12"){
                                                    $month = "December";
                                                }



                                                echo $ans['Day']." ".$month." ".$ans['Year']?></option>
                                        <?php }?>
                                        </select>

                                   

                                    </div>

                                    <div class="col-lg-3" align="left">

                                        <input type="submit" class="btn btn-success" name="select_date" value="Generate Report">

                                    </div>

                                    <div class="col-lg-3" align="left">

                                        <input type="submit" class="btn btn-default" name="print" value="Print Report">
                                         </form>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12">

                       <div class="row">

                            <div class="col-lg-12">

                                <form action="ADMIN BANK appdetails.html" method="POST"> <!-- SERVER SELF -->

                                <table id="table" class="table table-bordered table-striped">
                                    
                                    <thead>

                                        <tr>

                                        <td align="center" width="250px"><b>ID Number</b></td>
                                        <td align="center"><b>Name</b></td>
                                        <td align="center" width="200px"><b>Loan Type</b></td>
                                        <td align="center" width="200px"><b>Deduction Amount</b></td>
                                        <td align="center" width="200px"><b>Deduction Frequency</b></td>

                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php 
                                        while($ans = mysqli_fetch_assoc($result)){


                                        ?>
                                        <tr>

                                        <td align="center"><?php echo $ans['ID'];?></td>
                                        <td align="center"><?php echo $ans['First']." ".$ans['Middle']." ".$ans['Last'];?></td>
                                        <td align="center"> <?php echo $ans['service'];?></td>
                                        <td align="center"><?php echo sprintf("%.2f",(float)$ans['Amount']);?></td>
                                        <td align="center"><?php if((int)$ans['service_type']<3){
                                            echo "Per Month";

                                        }
                                        else
                                            echo "Per Payday";?></td>

                                        </tr>

                                        <?php }?>

                                    </tbody>

                                </table>

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
