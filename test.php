<?php 

include("connection/connect.php");
$_SESSION['bill']=1;
$o_id=$_GET['order_id'];
$pickuptime=$_GET['p_time'];
?>


<?php

    $sql="select tbl1.u_id,tbl1.o_id,tbl1.quantity AS totalquantity,tbl1.price AS totalprice,tbl1.pick_time,tbl2.*,tbl3.* FROM users_orders AS tbl1 INNER JOIN dishes AS tbl2 ON tbl1.d_id=tbl2.d_id INNER JOIN users AS tbl3 ON tbl1.u_id=tbl3.u_id where tbl1.o_id='$o_id'"; 
    $res=mysqli_query($db,$sql);//print_r($sql);die;
    $rows[]=mysqli_fetch_array($res);
 //   print_r($rows);die;

require('fpdf/dash.php');
//require_once('fpdf/fpdf.php');
$title='Receipt';
$pdf=new FPDF();
$pdf->AddPage();
// $pdf->SetTitle($title);
$pdf->SetFont('arial','B',15);
$pdf->Cell(135,5,$title,0,0,'c');
$pdf->Line(10,20,200,20);
$pdf->Ln(12);

$pdf->SetFont('arial','',12);
$pdf->Cell(17,20,'#Bill No:',0,0,'c');
$pdf->Cell(125,20,$_SESSION['bill']+=1,0,0,'c');
$pdf->Cell(12,20,'Date :',0,0,'r');
$pdf->Cell(40,20,date("d/m/y"),0,0,'r');


$pdf->Line(10,35,200,35);
$pdf->Ln(10);

$pdf->SetFont('arial','B',12);
$pdf->Cell(20,15,'SR.No:',0,0,'c');
$pdf->Cell(60,15,'Dish Name:',0,0,'c');
$pdf->Cell(40,15,'QTY:',0,0,'c');
$pdf->Cell(40,15,'Price:',0,0,'c');
$pdf->Cell(40,15,'Time:',0,0,'c');
$pdf->Line(10,44,200,44);
$pdf->Ln(10);
$grandtotal=0;
$i=1;
while($rows=mysqli_fetch_array($res))
{
    $pdf->Cell(20,15,$i,0,0,'c');
    $pdf->Cell(63,15,$rows['title'],0,0,'c');
    $pdf->Cell(38,15,$rows['totalquantity'],0,0,'c');
    $pdf->Cell(41,15,$rows['totalprice'],0,0,'c');

    $total=$rows['totalquantity']*$rows['totalprice'];
    $grandtotal= $grandtotal + $total;
    $pdf->Cell(40,15,$rows['pick_time'],0,0,'c');
    $pdf->Ln(10);
    $i++;
}
//$pdf->Line(10,100,200,100);
$pdf->Ln(10);

$pdf->SetFont('arial','B',13);

$pdf->Cell(151,25,'Grand Total:',0,0,'c');
$pdf->Cell(50,25,"Rs. ".$grandtotal,0,0,'c');

// $pdf->SetFont('arial','B',12);
// $pdf->Cell(70,75,'Grand Total',0,0,'c');


$pdf->Output();

?>

