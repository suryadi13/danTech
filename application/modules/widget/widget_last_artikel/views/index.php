<div class="row" style="margin-top:<?=$margin_top;?>; margin-bottom:<?=$margin_bottom;?>;"><div class="col-lg-12">
<?php
foreach($daftar AS $key=>$val){
?>
<h2><?=$val->judul;?></h2>
<?=$val->isi_konten;?>
<?php
}
?>
</div></div>
