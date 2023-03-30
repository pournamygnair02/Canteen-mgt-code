<?php
include("connection/connect.php");

$u_id=34;


												$sql="SELECT tbl1.*,tbl2.* FROM users_orders AS tbl1 INNER JOIN dishes AS tbl2 ON tbl1.d_id=tbl2.d_id WHERE o_id=434";
												$query=mysqli_query($db,$sql);
															$i=1;	
																	while($rows=mysqli_fetch_array($query))
																		{
                                                                            echo $rows["title"];
                                                                        }
                                                                    

?>