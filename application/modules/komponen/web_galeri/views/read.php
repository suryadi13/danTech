			<div class="row" style="padding-top:10px;">
				<div class="col-lg-12"><ol class="breadcrumb"><?=$jkanal;?></ol></div>
				<div class="col-lg-12">
					<b><?=strtoupper(@$konten->nama_kategori);?></b>
					<h2 style="line-height:20px;"><?=@$konten->judul;?></h2>
					<div><?php echo @$konten->hari.", ".@$konten->tanggal;?></div>
					<div style="padding-top:25px;padding-bottom:25px;"><?=@$konten->isi_konten;?></div>
				</div><!--/.col-lg-12-->
			</div><!--/.row-->
<?php
$jj = count($isi);
$refr = ceil(count($isi)/3);
for($i=0;$i<$refr;$i++){
$awal = $i*3;
$akhir = ($i==($refr-1))?count($isi):$awal+3; 
?>
<div class="row">
<?php
for($i2=$awal;$i2<$akhir;$i2++){
?>
<div  class="col-lg-3">
<div class="panel panel-default">
<div class="panel-body">
<a class="group1 thumbnail" href="<?=site_url();?><?=$isi[$i2]->foto;?>" style="margin-bottom:0px;">
<img src="<?=site_url();?><?=$isi[$i2]->foto;?>" alt="<?=$isi[$i2]->judul_appe;?>">
</a>
</div><!--/.panel-body-->
<div class="panel-footer" style="text-align:left;">
<?=$isi[$i2]->judul_appe;?>
</div><!--/.panel-footer-->
</div><!--/.panel-->
</div><!--/.col-lg-3..-->
<?php
}
?>
</div>
<!-- /.row -->
<?php
}
?>

<?php
echo $cLampiran;
echo $cKomentar;
?>
<script type="text/javascript" src="<?=site_url();?>assets/js/colorbox/jquery.colorbox.js"></script>
<link rel="stylesheet" href="<?=site_url();?>assets/js/colorbox/colorbox.css" type="text/css" />

<script>
$(function(){
	$(".group1").colorbox({rel:'group1'});
});
</script>

