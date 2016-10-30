			<div class="row" style="padding-top:10px;"><div class="col-lg-12"><ol class="breadcrumb"><?=$jkanal;?></ol></div></div>
			<div class="row"><div class="col-lg-12">
				<b><?=strtoupper(@$konten->nama_kategori);?></b>
			</div></div>
<?php
echo $cGambar;
?>
			<div class="row"><div class="col-lg-12" style="padding-bottom:20px;">
            	 <h2><?=@$konten->judul;?></h2>
				 <br/>
				 <?php
				 foreach($atribut AS $key=>$val){
				 	foreach($atr AS $ky=>$vl){
						if($vl->label==$val->id_appe){
				 ?>
				 <div><div style="width:200px; float:left;"><?=$val->judul_appe;?></div><span>: <?=$vl->nilai;?></span></div>
				<?php
						}
					}
				 }
				 ?>

			</div></div>
<br/><br/>
<?php
echo $cLampiran;
echo $cKomentar;
?>
