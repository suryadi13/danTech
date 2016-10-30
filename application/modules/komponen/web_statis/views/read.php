<?php
$konten->isi_konten=str_replace("thumbs_","",$konten->isi_konten);		
$konten->isi_konten=str_replace('src="assets','src="'.base_url().'assets',$konten->isi_konten);		
?>
<?php
//echo $cGambar;
?>
			<div class="row"><div class="col-lg-12" style="padding-bottom:20px;">
            	 <h2><?=@$konten->judul;?> !!!</h2>
                 <span class="datepost"><?php echo @$konten->hari.", ".@$konten->tanggal;?></span>
				 <?=@$konten->isi_konten;?>
			</div></div>
<?php
//echo $cLampiran;
//echo $cKomentar;
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
