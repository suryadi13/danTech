<div class="table-responsive">
<table class="table table-striped table-hover">
<thead>
<tr>
<th style="width:35px;">No.</th>
<th style="width:35px;">AKSI</th>
<th style="width:120px;">NAMA KATEGORI</th>
<th style="width:90px;">KOMPONEN</th>
<th style="width:150px;">KETERANGAN</th>
</tr>
</thead>
<tbody id=list>
<?php
foreach($kategori AS $key=>$val){
?>
<tr>
<td><?=($key+1);?></td>
<td valign=top style='padding:3px 0px 0px 0px;'>
	<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
		<ul class="dropdown-menu" role="menu">
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="loadForm3('formeditkategori','<?=$val->id_kategori;?>','<?=$id_kanal;?>');"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
			<?php if($val->cek=="kosong"){ ?>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="loadForm3('formhapuskategori','<?=$val->id_kategori;?>','<?=$id_kanal;?>');"><i class="fa fa-trash fa-fw"></i> Hapus</a></li>
			<?php } ?>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="loadForm3('formpindahkategori','<?=$val->id_kategori;?>','<?=$id_kanal;?>');"><i class="fa fa-refresh fa-fw"></i> Pindah kanal</a></li>
			<?php if($key!=0) { ?>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="urutKategori('<?=$val->id_kategori;?>','<?=$kategori[($key-1)]->id_kategori;?>','<?=($key+1);?>','<?=($key);?>','<?=$id_kanal;?>');"><i class="fa fa-upload fa-fw"></i> Naik urutan</a></li>
			<?php } ?>
			<?php if($key!=count($kategori)-1) { ?>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="urutKategori('<?=$val->id_kategori;?>','<?=$kategori[($key+1)]->id_kategori;?>','<?=($key+1);?>','<?=($key+2);?>','<?=$id_kanal;?>');"><i class="fa fa-download fa-fw"></i> Turun urutan</a></li>
			<?php } ?>
		</ul>
	</div>

</td>
<td><?=$val->nama_item;?></td>
<td><?=$val->komponen;?></td>
<td><?=$val->keterangan;?></td>
</tr>
<?php
}
?>
<tr>
<td colspan=2>&nbsp;</td>
<td colspan=7><div class="btn btn-primary btn-xs" onclick="loadForm3('formtambahkategori','xx','<?=$id_kanal;?>');"><i class="fa fa-plus fa-fw"></i> Tambah Kategori</div></td>
</tr>
</tbody>
</table>
</div>
