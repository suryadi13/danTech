			<div class="row" style="padding-top:10px;"><div class="col-lg-12"><ol class="breadcrumb"><?=$jkanal;?></ol></div></div>
			<div class="row"><div class="col-lg-12">
				<b><?=strtoupper(@$konten->nama_kategori);?></b>
			</div></div>
<?php
echo $cGambar;
?>
			<div class="row"><div class="col-lg-12" style="padding-bottom:20px;">
            	 <h2><?=@$konten->judul;?></h2>
                 <small><?php echo @$konten->hari_mulai.", ".@$konten->tgl_mulai." s/d ".@$konten->hari_selesai.", ".@$konten->tgl_selesai;	?></small>
				 <div><div style='width:110px;float:left'>Topik</div><div style='width:15px; float:left;'>:</div><div style='display:table'><?=@$konten->isi_konten;?></div></div>
				<div><div style='width:110px;float:left'>Tempat</div><div style='width:15px; float:left;'>:</div><div><?=@$konten->sub_judul;?></div></div>
			</div></div>
<?php
echo $cLampiran;
echo $cKomentar;
?>
