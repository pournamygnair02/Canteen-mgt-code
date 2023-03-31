<?php
include("../connection/connect.php");
$id=$_POST['id'];

$lt=$_POST['ltype'];
$fd=$_POST['fdte'];
$ld=$_POST['tdte'];
$lr=$_POST['lreason'];
$dte=date('Y-m-d');

$sel="select * from leavetable where st_id='$id'";
										if($res=mysqli_query($db,$sel))
										{
                                            $rowcount=mysqli_num_rows($res);
                                            {
                                                if($rowcount>=10)
                                                {
                                                    header("location:leavestatus.php");
                                                }
                                                else
                                                {
                                                    $sql=mysqli_query($db,"insert into leavetable(st_id,ltype,fdate,tdate,lreason,senddate,status)values('$id','$lt','$fd','$ld','$lr','$dte','pending')");
                                                    header('location:dashboard.php');
                                                }
                                            }
													
										}
										else
										{			      		  
										  




                                        }
?>