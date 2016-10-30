			<div class="row" style="margin-top:10px;"><div class="col-lg-12"><ol class="breadcrumb"><?=$jkanal;?></ol></div></div>
			<div class="row"><div class="col-lg-12">
				<b><?=strtoupper(@$konten->nama_kategori);?></b>
			</div></div>
<?php
echo $cGambar;
?>
			<div class="row"><div class="col-lg-12" style="padding-bottom:20px;">
            	 <h2><?=@$konten->judul;?></h2>
				 <?php
				 foreach($pilihan AS $key=>$val){
				 ?>
				 <?=$val->judul_appe;?> - <?=$val->nilai;?><br/>
				 <?php
				 }
				 ?>
			</div></div>
<?php
echo $cLampiran;
echo $cKomentar;
?>
