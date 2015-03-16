<?php if($totalPag>0){?>
	<?php if(ceil($total/$totalPag)>1){?>
	<tfoot>
	<tr >
		<td colspan="7">	
			<div id="paging" >
				<ul>
					
					<?php for($i=1; $i<=ceil($total/$numer_reg); $i++){ ?>
						
						<?php 
							$url = $util->getURLparametros();
							if(!strpos($url,"&pag=")===false){
								$url = $util->eliminarParametrosURL($url,"pag")."&";
							}
						?>
					
						<li><a href="<?php echo $url ?>pag=<?php echo $i ?>" <?php if ($pag == $i){?>class="active" <?php }?>><span><?php echo $i ?></span></a></li>							
					<?php }?>
					
				</ul>
			</div>
		</td>
	</tr>
	</tfoot>	
	<?php }?>
<?php }else{?>
	<tfoot>
	<tr>
		<td colspan="7" >	
			<div  id="paging" style="background:#fff; color:#005D8B; font-weight:bold; padding-top:10px; padding-bottom:10px; font-size:15px;" >
				<ul>
					<span>No se han encontrado resultados</span>
				</ul>
			</div>
		</td>
	</tr>
	</tfoot>
<?php }?>