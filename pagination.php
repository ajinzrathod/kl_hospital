<?php
$res_my_query=mysqli_query($conn2,$my_pagination_query);
$countthe=mysqli_num_rows($res_my_query);
?>

<div class="panel-footer">
	<div class="row">
		<div class="col-md-12">
			<h3>
				Total Count <span class="label label-info"><?php echo $countthe; ?></span></h3>
			</div>
			<div class="col-md-12">
				<ul class="pagination pagination-lg pull-right">
					<?php
					if($countthe>$recordsPerPage){
						$anscount=$countthe/$recordsPerPage;
						$anscount=floor($anscount);
						if($countthe%$recordsPerPage!=0){
							$anscount=$anscount+1; 
						}
						$ii=0;
						$currentFileName =  basename($_SERVER['PHP_SELF']);
						while($ii!=$anscount){
							$jj=$ii+1;
							if($pageno1==$jj){

								// if that class is active, show blue color
								echo '<li class="active"><a class="page-link" href="'.$currentFileName.'?pageno='.$jj.'">'.++$ii.'</a></li>';
							}
							else{ 
								echo '<li class=""><a class="page-link" href="'.$currentFileName.'?pageno='.$jj.'">'.++$ii.'</a></li>';
							}
						}
					}
					?>

				</ul>
			</div>
		</div>
	</div>
</div>