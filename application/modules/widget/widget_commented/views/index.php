		<div class="commented panel panel-default" style="margin-top:<?=$margin_top;?>;margin-bottom:<?=$margin_bottom;?>;">
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#terbaru" data-toggle="tab"><i class="fa fa-briefcase"></i> Terbaru</a></li>
                                <li><a href="#terkomentari" data-toggle="tab" id="key_tugas_tambahan"><i class="fa fa-ra"></i> Terkomentari</a></li>
                            </ul>
                            <!-- Tab panes -->
							<div style="padding:10px;" class="tab-content">
								<div id="terbaru" class="tab-pane fade active in">
                  <ul>
	<?php
		foreach($komentar as $key=>$val){
	?>
                    <li><small><?=$val->hari.", ".$val->tanggal;?></small><br /><a href="<?=site_url();?>read/artikel/<?=$val->id_konten;?>/<?=$val->kat_seo;?>/<?=$val->seo;?>"><?=$val->judul;?></a></li>
	<?php
		}
	?>
                  </ul>    
								</div>
								<div id="terkomentari" class="tab-pane fade">
                  <ul>
	<?php
		foreach($populer as $key=>$val){
	?>
                    <li><small><?=$val->hari.", ".$val->tanggal;?></small><br /><a href="<?=site_url();?>read/artikel/<?=$val->id_konten;?>/<?=$val->kat_seo;?>/<?=$val->seo;?>"><?=$val->judul;?></a></li>
	<?php
		}
	?>
                  </ul>    
								</div>
							</div>
						</div>
                        <!-- panel body -->
		</div>
<style>
.commented.panel .panel-body  {	padding:0px;	}
.commented.panel .panel-heading  { border-bottom: 1px dotted #ccc;	}
.commented.panel .panel-body .nav-tabs { background-color:#eee;padding-left:15px;padding-top:5px; }
.commented.panel .panel-body .nav-tabs li a { padding-right: 15px; padding-left: 15px; padding-top:7px; padding-bottom:7px; margin-left:0px;	}
</style>
