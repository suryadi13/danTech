<?php
date_default_timezone_set('Asia/Jakarta');
$hh = array(); $hh['Sun']="Minggu"; $hh['Mon']="Senin"; $hh['Tue']="Selasa"; $hh['Wed']="Rabu"; $hh['Thu']="Kamis"; $hh['Fri']="Jum'at"; $hh['Sat']="Sabtu";

function recKanal($nav,$idk) {
    foreach ($nav as $key=>$val) {
		$cls = ($val->path_kanal==$idk)?" active":"";
		if(isset($val->anak)){
			echo '<li class="dropdown '.$cls.'"><a href="#"  class="dropdown-toggle" data-toggle="dropdown">'.$val->nama_kanal.' <b class="caret"></b></a><ul class="dropdown-menu">';
			recKanal($val->anak,$idk);
			echo '</ul></li>';
		} else {
			echo '<li class="'.$cls.'"><a href="'.site_url().'kanal/'.$val->path_kanal.'">'.$val->nama_kanal.'</a></li>';
		} // end anak
    } // end foreach
} // end recKanal
?>
    <div class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0px;border-top:1px solid #eee;">
      <div class="container">
        <div class="navbar-header"  style="clear:both;">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div style="padding:15px 0px 0px 0px;"><?=$hh[date('D')];?>, <?=date('d-m-Y');?></div>
        </div><!--/.navbar-header -->
        <div class="navbar-collapse collapse">
		<ul class="nav navbar-nav navbar-right">
		<li class="<?=($id_kanal==$default->id_kanal)?"active":"";?>"><a href="<?=site_url();?>"><?=$default->nama_kanal;?></a></li>
		<?php recKanal($kanal,$pkanal); ?>
		</ul>
        </div><!--/.navbar-collapse -->
      </div><!--/.container-->
    </div><!--/.navbar -->
