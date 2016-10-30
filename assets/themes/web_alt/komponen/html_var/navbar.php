<?php
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
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
      <div class="row">
        <div class="navbar-header"  style="clear:both;">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div><!--/.navbar-header -->
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form" method="POST" action="<?=site_url('login');?>"><button type="submit" class="btn btn-success">Login</button></form>
		<ul class="nav navbar-nav">
		<li class="<?=($id_kanal==$default->id_kanal)?"active":"";?>"><a href="<?=site_url();?>"><?=$default->nama_kanal;?></a></li>
		<?php recKanal($kanal,$pkanal); ?>
		</ul>
        </div><!--/.navbar-collapse -->
      </div><!--/.row-->
      </div><!--/.container-->
    </div><!--/.navbar -->