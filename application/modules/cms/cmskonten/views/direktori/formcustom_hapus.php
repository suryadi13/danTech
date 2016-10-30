				<tr style="display:none;"><td colspan=4><input type=hidden name="custom" value="direktori"></td></tr>
<?php
			foreach($jj AS $key=>$val){
?>
				<tr>
				<td>Label <span class="no_label"><?=($key+1);?></span></td>
				<td colspan="3"><div class="ipt_text" style="width:400px;"><b><?=$val->judul_appe;?></b></div></td>
				</tr>
<?php
			}
?>
