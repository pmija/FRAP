<?php
session_start();
 if ($_SESSION['usertype'] == 1||!isset($_SESSION['usertype'])) {

        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
            
    }
require('fpdf/fpdf.php');

class PDF extends FPDF
{
	var $row = 0;
// Page header
function Header()
{
    // Logo
    $this->Image('FA Logo.jpg',0,10,20);
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Move to the right
	$this->Cell(15);
	 $this->Cell(30,10,'Faculty Association,Inc.',0,0,'C');
	 $this->Ln(5);
	 $this->Cell(19);
	 $this->SetFont('Arial','',10);
	$this->Cell(30,10,'De La Salle University - Manila',0,0,'C');
    $this->Cell(80);
    // Title
   
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-20);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,5,'Page '.$this->PageNo().' of {nb}',0,0,'C');
	$this->ln();
	 $this->SetFont('Arial','',8);
	$this->Cell(0,5,'FACULTY ASSOCIATION',0,1,'C');
	$this->Cell(0,5,'2401 Taft Avenue, Malate, Manila Philippines',0,1,'C');
	$this->Cell(0,5,'(632) 524-4611 Ext. 332',0,1,'C');
}


}
if(isset($_SESSION['date'])){
     $date = $_SESSION['date'];
        $day = substr($date,0,strpos($date," "));
        $month = substr($date,strpos($date," ")+1,strpos($date,"-")-strpos($date," ")-1);
        $year = substr($date,strpos($date,"-")+1);

            if($month=="1"){
                $month = "January";
            }
            else if($month=="2"){
                $month = "February";
            }
            else if($month=="3"){
                $month = "March";
            }
            else if($month=="4"){
                $month = "April";
            }
            else if($month=="5"){
                $month = "May";
            }
            else if($month=="6"){
                $month = "June";
            }
            else if($month=="7"){
                $month = "July";
            }
            else if($month=="8"){
                $month = "August";
            }
            else if($month=="9"){
                $month = "September";
            }
            else if($month=="10"){
                $month = "October";
            }
            else if($month=="11"){
                $month = "November";
            }
            else if($month=="12"){
                $month = "December";
            }
        }
// Instanciation of inherited class
$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',10);
$pdf->Cell(0	,5,"Detailed Overall Deductions"	,0,1,'C');

$pdf->SetFont('Times','',10);
if($_SESSION['date']!="0")
    $pdf->Cell(0    ,5,"For ".$day." ".$month." ".$year ,0,1,'C');
$pdf->Cell(0	,5,"Generated by Melton at ".date("m/d/Y")." ".date("h:i:sa")	,0,1,'C');
$pdf->ln();
$pdf->SetFont('Times','B',10);
$pdf->Cell(25);
$pdf->Cell(20,5,''	,'L,T,R',0);
$pdf->Cell(50	,5,' '	,'L,T,R',0);
$pdf->Cell(30	,5,''	,'L,T,R',0);
$pdf->Cell(25	,5,'','L,T,R',0);
$pdf->Cell(25	,5,''	,'L,T,R',0);
$pdf->Cell(25	,5,''	,'L,T,R',0);

$pdf->Cell(30	,5,'Total Salary '	,'L,T,R',0,'R');
$pdf->ln();
$pdf->Cell(25);
$pdf->Cell(20,5,'ID Number '	,'L,B,R',0,'C');
$pdf->Cell(50	,5,'Full Name'	,'L,B,R',0,'L');
$pdf->Cell(30	,5,'Membership Fee'	,'L,B,R',0,'R');
$pdf->Cell(25	,5,'FALP','L,B,R',0,'R');
$pdf->Cell(25	,5,'Bank Loan'	,'L,B,R',0,'R');
$pdf->Cell(25	,5,'Health Aid'	,'L,B,R',0,'R');

$pdf->Cell(30	,5,'Deduction'	,'L,B,R',0,'R');
$pdf->ln();
$pdf->SetFont('Times','',10);
require_once('mysql_connect_FA.php');
$flag=0;
if($_SESSION['date'] != "0"){
        $date = $_SESSION['date'];
        $day = substr($date,0,strpos($date," "));
        $month = substr($date,(strpos($date," ")+1),strpos($date,"-")-strpos($date," ")-1);
        $year = substr($date,strpos($date,"-")+1);
        $query="SELECT m.member_ID as 'ID', firstname as 'FIRST',lastname as 'LAST',middlename as 'MIDDLE',DEPT_NAME,mf.amount  as 'MFee',ha.amount as 'HAFee',f.amount as 'FFee',b.amount as 'BFee'
from member m
join ref_department d
on m.dept_id = d.dept_id
left join (SELECT sum(amount) as 'Amount',member_id from txn_reference join (SELECT max(txn_date) as 'Date' from txn_reference where txn_type = 2) latest where SERVICE_TYPE = 1 AND $month = Month(txn_date) AND $year = Year(txn_date) AND $day = DAY(txn_date) group by member_id) mf
on m.MEMBER_ID = mf.member_id
left join (SELECT sum(amount) as 'Amount',member_id from txn_reference join (SELECT max(txn_date) as 'Date' from txn_reference where txn_type = 2) latest where SERVICE_TYPE = 2 AND $month = Month(txn_date) AND $year = Year(txn_date) AND $day = DAY(txn_date) group by member_id) ha
on m.MEMBER_ID = ha.member_id
left join (SELECT sum(amount) as 'Amount',member_id from txn_reference join (SELECT max(txn_date) as 'Date' from txn_reference where txn_type = 2) latest where SERVICE_TYPE = 3 AND $month = Month(txn_date) AND $year = Year(txn_date) AND $day = DAY(txn_date) group by member_id) f
on m.MEMBER_ID = f.member_id
left join (SELECT sum(amount) as 'Amount',member_id from txn_reference join (SELECT max(txn_date) as 'Date' from txn_reference where txn_type = 2) latest where SERVICE_TYPE = 4 AND $month = Month(txn_date) AND $year = Year(txn_date) AND $day = DAY(txn_date) group by member_id) b
on m.MEMBER_ID = b.member_id
join txn_reference t
        on t.MEMBER_ID = m.MEMBER_ID
        where TXN_TYPE =2 and $month = Month(txn_date) AND $year = Year(txn_date) AND $day = DAY(txn_date)
group by m.member_ID";
    }
    else{
        $query="SELECT m.member_ID as 'ID', firstname as 'FIRST',lastname as 'LAST',middlename as 'MIDDLE',DEPT_NAME,mf.amount  as 'MFee',ha.amount as 'HAFee',f.amount as 'FFee',b.amount as 'BFee'
from member m
join ref_department d
on m.dept_id = d.dept_id
left join (SELECT sum(amount) as 'Amount',member_id from txn_reference join (SELECT max(txn_date) as 'Date' from txn_reference where txn_type = 2) latest where SERVICE_TYPE = 1 AND DATE(TXN_DATE) = latest.Date group by member_id) mf
on m.MEMBER_ID = mf.member_id
left join (SELECT sum(amount) as 'Amount',member_id from txn_reference join (SELECT max(txn_date) as 'Date' from txn_reference where txn_type = 2) latest where SERVICE_TYPE = 2 AND DATE(TXN_DATE) = latest.Date group by member_id) ha
on m.MEMBER_ID = ha.member_id
left join (SELECT sum(amount) as 'Amount',member_id from txn_reference join (SELECT max(txn_date) as 'Date' from txn_reference where txn_type = 2) latest where SERVICE_TYPE = 3 AND DATE(TXN_DATE) = latest.Date group by member_id) f
on m.MEMBER_ID = f.member_id
left join (SELECT sum(amount) as 'Amount',member_id from txn_reference join (SELECT max(txn_date) as 'Date' from txn_reference where txn_type = 2) latest where SERVICE_TYPE = 4 AND DATE(TXN_DATE) = latest.Date group by member_id) b
on m.MEMBER_ID = b.member_id
join txn_reference t
on t.member_id = m.member_id
join (SELECT max(txn_date) as 'Date' from txn_reference where txn_type = 2) latest
where latest.Date = date(TXN_DATE)
group by m.member_ID";
    }
	
$result=mysqli_query($dbc,$query);


while($row=mysqli_fetch_assoc($result)){
$last = $row['LAST'];
$first = $row['FIRST'];
$middle = $row['MIDDLE'];

$falp =	0;
$bank = 0;
$health = 0;
$mfee = (float)$row['MFee'];



$pdf->Cell(25);
$pdf->Cell(20,5,$row['ID']	,'L,B,R',0,'C');
$pdf->Cell(50	,5,"$last, $first $middle"	,'L,B,R',0,'L');

$pdf->Cell(30	,5,sprintf("%.2f",$mfee)	,'L,B,R',0,'R');
$total= 0.00;	
if(!empty($row['FFee'])){
	$falp =	(float)$row['FFee'];
	$pdf->Cell(25	,5,sprintf("%.2f",$falp),'L,B,R',0,'R');
}
else
	$pdf->Cell(25	,5,'0.00','L,B,R',0,'R');

if(!empty($row['BFee'])){
	$bank = (float)$row['BFee'];
	$pdf->Cell(25	,5,sprintf("%.2f",$bank)	,'L,B,R',0,'R');
}
else
	$pdf->Cell(25	,5,'0.00'	,'L,B,R',0,'R');
if(!empty($row['HAFee'])){
	$health =(float)$row['HAFee'];
	$pdf->Cell(25	,5,'100.00'	,'L,B,R',0,'R');
}
else
	$pdf->Cell(25	,5,'0.00'	,'L,B,R',0,'R');




$total = (float)$mfee+(float)$bank+(float)$falp+(float)$health;


$total = sprintf("%.2f",$total);

$pdf->Cell(30	,5,"$total"	,'L,B,R',0,'R');
$pdf->ln();



}

$pdf->SetFont('Times','B',12);


$pdf->Cell(0	,5,"--END OF REPORT--"	,0,0,'C');
$pdf->Output();
?>