<div class='row'>
<div class="col-lg-12">
<div class="panel panel-default">
<div class='panel-heading'><?=strtoupper($wrapper[0]->nama_wrapper);?></div>
<div class="panel-body">
<?php
	$nomor=1;
	foreach($iiii as $key=>$val){
		if($nomor%2==1){ $bgc="even";}else{ $bgc="odd";}
		echo "<a href='".base_url()."all/direktori/".$val->id_kategori."/1/".$val->seo."' class=biasa>";
		echo "<div class='framedaftar ".$bgc."'>";
				echo "<div class='nomor'>".$nomor.".</div>";
				echo "<div class='text'>".$val->nama_kategori."</div>";
		echo "</div>";
		echo "</a>";
		$nomor++;
	}
?>
</div>
<!--//panel-body-->
</div>
<!--//panel-->
</div>
<!--//col-lg-12-->
</div>
<!--//row-->