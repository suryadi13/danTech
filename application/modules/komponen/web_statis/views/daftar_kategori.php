			<div class="panel panel-primary" style="margin-top:10px;">
				<div class="panel-heading">Rubrik lainnya</div>
				<div class="panel-body">
<?php
	foreach($kategori as $key=>$val){
		if($val->status==""){
			echo "<a class='btn btn-primary link' href='".site_url()."all/".$val->komponen."/".$val->id_kategori."/1/".$val->seo."'>".$val->nama_kategori."</a>";
		} else {
			echo "<div class='btn btn-default active'>".$val->nama_kategori."</div>";
		}
	}
?>
				</div><!--//panel-body-->
			</div><!--//panel-->
