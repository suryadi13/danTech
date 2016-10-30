<?php
if(empty($row)){	echo "<tr><td colspan=8 align=center>TIDAK ADA DATA</td></tr>";	} else {
foreach($row AS $key=>$val){
?>
<tr>
	<td>
		<div class="dropdown">
			<button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
			<ul class="dropdown-menu" role="menu">
				<?php if($key!=0) { ?>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="urutan_foto(<?=$val->id_appe;?>,<?=$val->urutan_appe;?>,<?=$row[($key-1)]->id_appe;?>,<?=$row[($key-1)]->urutan_appe;?>);"><i class="fa fa-upload fa-fw"></i> Naikkan urutan</a></li>
				<?php } ?>
				<?php if($key!=(count($row)-1)) { ?>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="urutan_foto(<?=$val->id_appe;?>,<?=$val->urutan_appe;?>,<?=$row[($key+1)]->id_appe;?>,<?=$row[($key+1)]->urutan_appe;?>);"><i class="fa fa-download fa-fw"></i> Turunkan urutan</a></li>
				<?php } ?>
				<?php if(count($row)!=1) { ?>
				<li class="divider"></li>
				<?php } ?>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="hapus_foto(<?=$val->id_appe;?>);"><i class="fa fa-trash fa-fw"></i> Hapus gambar</a></li>
			</ul>
		</div>
	</td>
	<td id="kolom_foto_<?=$val->id_appe;?>"><img src="<?=base_url().$val->foto;?>" height=80 border=0></td>
	<td><div id='judul_appe_<?=$val->id_appe;?>' onclick="edit_judul_appe(<?=$val->id_appe;?>,'judul_appe');"><?=($val->link=="")?"...":$val->link;?></div></td>
</tr>
<?php
}	}
?>