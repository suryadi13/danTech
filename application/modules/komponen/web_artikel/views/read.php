<?php
$konten->isi_konten=str_replace("thumbs_","",$konten->isi_konten);		
$konten->isi_konten=str_replace('src="assets','src="'.base_url().'assets',$konten->isi_konten);		
?>
			<div class="row" style="padding-top:10px;"><div class="col-lg-12"><ol class="breadcrumb"><?=$jkanal;?></ol></div></div>
			<div class="row"><div class="col-lg-12">
				<b><?=strtoupper(@$konten->nama_kategori);?> :: <?php echo @$konten->hari.", ".@$konten->tanggal;?></b>
			</div></div>
<?php
echo $cGambar;
?>
			<div class="row"><div class="col-lg-12" style="padding-bottom:20px;">
            	 <h2 style="margin:0px;padding-top:25px;"><?=@$konten->judul;?></h2>
                 <h4 style="margin:0px;padding-top:5px;padding-bottom:50px;"><?php echo @$konten->sub_judul;?></h4>
				 <?=@$konten->isi_konten;?>
			</div></div>
<?php
echo $cLampiran;
echo $cKomentar;
?>
<style>
.syntaxhighlighter table .container:before {
    display: none !important;
}
</style>

	<script type="text/javascript" src="<?=base_url();?>assets/js/syntaxhighlighter/scripts/shCore.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/syntaxhighlighter/scripts/shBrushJScript.js"></script>
	<link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/js/syntaxhighlighter/styles/shCoreDefault.css"/>
	<script type="text/javascript">SyntaxHighlighter.all();</script>
<script type="text/javascript">
function rmsh(){
	$(".syntaxhighlighter .toolbar").remove();
}
</script>
