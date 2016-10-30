<div class="table-responsive">
<table class="table table-striped table-hover">
<thead>
<tr>
<th style="width:35px;">No.</th>
<th style="width:30px;">AKSI</th>
<th style="width:150px;">NAMA WIDGET <?=strtoupper($posisi);?></th>
<th style="width:100px;">JENIS WIDGET</th>
<th style="width:300px;">OPSI</th>
</tr>
</thead>
<tbody>
<?php
$isi_asli="";
$key=0;
foreach($wrapper->widget AS $key=>$val){
?>
<tr>
<td><?=($key+1);?></td>
<td valign=top style='padding:3px 0px 0px 0px;'>
	<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
		<ul class="dropdown-menu" role="menu">
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="loadForm2('formeditwidget','<?=$posisi;?>',<?=$key;?>,'<?=$ini_kanal->id_kanal;?>','<?=$val->id_widget;?>');"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="loadForm2('formhapuswidget','<?=$posisi;?>',<?=$key;?>,'<?=$ini_kanal->id_kanal;?>','<?=$val->id_widget;?>');"><i class="fa fa-trash fa-fw"></i> Hapus</a></li>
			<?php if($key!=0) { ?>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="urutan('<?=$ini_kanal->id_kanal;?>','<?=$posisi;?>','<?=($key+1);?>','<?=($key);?>');"><i class="fa fa-upload fa-fw"></i> Naik urutan</a></li>
			<?php } ?>
			<?php if($key!=count($wrapper->widget)-1) { ?>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="urutan('<?=$ini_kanal->id_kanal;?>','<?=$posisi;?>','<?=($key+1);?>','<?=($key+2);?>');"><i class="fa fa-download fa-fw"></i> Turun urutan</a></li>
			<?php } ?>
		</ul>
	</div>
</td>
<td><?=$val->nama_wrapper;?></td>
<td>
<?php
if($val->custom=="ya"){
echo '<div class="btn btn-warning btn-xs" onclick="loadFormCW(\''.$ini_kanal->path_kanal.'\',\''.$posisi.'\',\''.$key.'\');">'.$val->nama_widget.'</div>';
} else {
echo $val->nama_widget;
}
?>
</td>
<td>
<?php
foreach($val->opsi AS $key2=>$val2){
	echo $val2->label." : ".$val2->nilai."; ";
}
?>
</td>
</tr>
<?php
$isi_asli=$isi_asli."<div id='asli_".$posisi."_".$ini_kanal->id_kanal."_".($key+1)."'>".json_encode($val)."</div>";
}
?>
<tr>
<td colspan=2>&nbsp;</td>
<td colspan=7><div class="btn btn-primary btn-xs" onclick="loadForm2('formtambahwidget','<?=$posisi;?>','<?=($key+1);?>','<?=$ini_kanal->id_kanal;?>');"><i class="fa fa-plus fa-fw"></i> Tambah Widget <?=ucfirst($posisi);?></div></td>
</tr>
</tbody>
</table>
</div><!-- table-responsive --->
<div style="display:none;">
<div id="asli_<?=$posisi;?>_<?=$ini_kanal->id_kanal;?>"><?=$isi_asli;?></div>
<div id="jumlah_<?=$posisi;?>_<?=$ini_kanal->id_kanal;?>"><?=($key+2);?></div>
</div>
