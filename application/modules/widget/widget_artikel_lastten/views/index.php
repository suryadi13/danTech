<div class="row" style="margin-top:<?=$margin_top;?>; margin-bottom:<?=$margin_bottom;?>;"><div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading" style="color:#666666;"><?=strtoupper($nama_wrapper);?></div>
								<div class="panel-body" style="padding:0px 25px 10px 25px;">
<?php
$brow = ceil($banyaknya/2);	
for($i=0;$i<$brow;$i++){
?>
									<div class="row artikeljudul">
											<?php if(isset($daftar[$i]->id_konten)){ ?>
												<div class="col-lg-6 frame"><div class="row" style="padding:5px;">
												<a href="<?=site_url()."read/artikel/".$daftar[$i]->id_konten."/".$daftar[$i]->kat_seo."/".$daftar[$i]->seo?>">
											<div class="col-lg-4" style="padding:0px;">
				                                <div class="thumbnail" style="margin-bottom:0px;">
												<img src="<?=site_url();?><?=$daftar[$i]->thumb;?>" />
												</div>
											</div>
											<div class="col-lg-8">
												<div class="kategori"><?=$daftar[$i]->nama_kategori;?></div>
												<small><?=$daftar[$i]->hari;?>, <?=$daftar[$i]->tanggal;?></small>
												<div class="judul"><?=$daftar[$i]->judul;?></div>
											</div>
												</a>
												</div></div>
											<?php } ?>
											
											<?php if(isset($daftar[($i+$brow)]->id_konten)){ ?>
												<div class="col-lg-6 frame"><div class="row" style="padding:5px;">
												<a href="<?=site_url()."read/artikel/".@$daftar[($i+$brow)]->id_konten."/".@$daftar[($i+$brow)]->kat_seo."/".@$daftar[($i+$brow)]->seo?>">
											<div class="col-lg-4" style="padding:0px;">
				                                <div class="thumbnail" style="margin-bottom:0px;">
												<img src="<?=site_url();?><?=@$daftar[($i+$brow)]->thumb;?>" />
												</div>
											</div>
											<div class="col-lg-8">
												<div class="kategori"><?=$daftar[($i+$brow)]->nama_kategori;?></div>
												<small><?=@$daftar[($i+$brow)]->hari;?>, <?=@$daftar[($i+$brow)]->tanggal;?></small>
												<div class="judul"><?=@$daftar[($i+$brow)]->judul;?></div>
											</div>
												</a>
												</div></div>
											<?php } ?>
									</div>
<?php
}
?>
								</div><!--/.panel-body-->
							</div><!--/.panel-->
</div></div>
<style>
.artikeljudul {	  border-bottom:1px dotted #ccc;	}
.artikeljudul .frame small,.artikeljudul .frame .judul {	color:#999; 	}
.artikeljudul .kategori {font-size:11px; font-weight:800;	}
.artikeljudul .frame :hover {	color:#00F; text-decoration:none;	}
.artikeljudul .frame :hover small {	color:#000;	}
.artikeljudul .frame :hover .judul {	color:#FF0000;	}
</style>