<?php
if(!empty($lampiran)){
?>
			<div class="row"><div class="col-lg-12">
				<div class="panel panel-info">
                        <div class="panel-heading"><i class="fa fa-download"></i> Download</div>
                        <div class="panel-body">
			<?php
				$i=1;
				foreach($lampiran AS $key=>$val){
			?>
                    <div style="clear:both;">
						<div style="float:left;width:50px;"><?=$i;?>.</div>
						<div style="float:left;"><a href="<?=base_url();?>assets/media/lampiran/<?=$val->id_konten;?>/<?=$val->foto;?>" target="_blank"><?=$val->judul_appe;?></a></div>
					</div>
			<?php
				$i++;
				}
			?>
						</div>
                        <!-- panel body -->
				</div>
				<!-- panel -->
			</div></div>
<?php
}
?>
