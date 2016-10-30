<table class="table table-striped" style="margin-bottom:5px;">
        <tr height="25">
          <td style="padding:3px 0px 0px 0px;">
		  <div class="btn btn-warning btn-xs" onclick="batalX();"><i class="fa fa-fast-backward fa-fw"></i></div>
		  <?=$path;?>
		  </td>
		  </tr>
</table>
<div class="table-responsive" style="padding-top:0px;">
<table class="table table-striped" style="margin-bottom:0px;">
	<tbody>
<?php
if(empty($isi)){	echo "<tr><td colspan=4 align=center>Tidak ada file</td></tr>";	} else {
foreach($isi AS $key=>$val){
?>
        <tr height="25">
          <td style="padding:0px 0px 0px 3px;"><a href="<?=site_url().$path.$val->judul_appe;?>" target="_blank"><?=$val->judul_appe;?></a></td>
          <td style="padding:0px;"><input type='text' class='form-control' value='<?=site_url().$path.$val->judul_appe;?>' style="padding-top:4px;height:23px;"></td>
        </tr>
<?php
}	}
?>
	</tbody>
</table>
</div>