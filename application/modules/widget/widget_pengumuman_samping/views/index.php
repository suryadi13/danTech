		<div class="panel panel-primary" style="margin-top:<?=$margin_top;?>;">
						<div class="panel-heading"><i class="fa fa-calendar fa-fw"></i> <?=$nama_wii;?></div>
                        <div class="panel-body">
<?php
foreach($daftar AS $key=>$val){
?>
<div>
<small><?=$val->hari;?>, <?=$val->tanggal;?></small><br/>
<a href="<?=site_url()."read/artikel/".$val->id_konten."/".$val->kat_seo."/".$val->seo?>">
<?=$val->judul;?>
</a>
</div>
<?php
}
?>
						</div><!-- panel body -->
		</div><!-- panel -->
