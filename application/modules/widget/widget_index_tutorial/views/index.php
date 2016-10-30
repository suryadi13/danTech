<div class="container">
	<div class='row' style="margin-top:<?=$margin_top;?>;">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?=strtoupper($nama_wrapper);?></div>
				<div class='panel-body' style="padding:5px;">
								<?php
									foreach($daftar as $key=>$val){
								?>
									<div class="col-lg-3" style="padding:5px;">
									<div class="panel panel-info" style="margin-bottom:5px;">
									<div class="panel-heading"><b><?=strtoupper($val->nama_kategori);?></b></div>
									<div class='panel-body' style="padding:5px;">
																				<?php
																					foreach($val->isi as $key2=>$val2){
																						echo '<a href="'.base_url().'read/artikel/'.$val2->id_konten.'/'.$val->kat_seo.'/'.$val2->seo.'"><div>'.$val2->judul.'</div></a>';
																					}
																				?>
									</div>
									<!--//panel-body-->
									</div>
									<!--//panel-->
									</div>
									<!--//col-lg-4-->
								<?php
										}
								?>
				</div>
				<!--//panel-body-->
			</div>
			<!--//panel-->
		</div>
		<!--//col-->
	</div>
	<!--//row-->
</div>
<!--//container-->