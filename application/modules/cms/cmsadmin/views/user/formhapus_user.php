<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-danger">
			<div class="panel-heading">FORM HAPUS PENGGUNA</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="20%">Nama Pengguna</td>
          <td colspan="3"><div class=ipt_text style="width:250px;"><b><?=$hslquery[0]->nama_user;?></b></div></td>
        </tr>
        <tr>
          <td>Username</td>
          <td colspan="3"><div class=ipt_text style="width:250px;"><b><?=$hslquery[0]->username;?></b></div></td>
        </tr>
        <tr>
          <td>Grup Pengguna</td>
          <td colspan="3"><div class=ipt_text style="width:250px;"><b>
			<?php
			foreach($hslqueryb as $key=>$val){
				if($val->group_id==$hslquery[0]->group_id){
					echo "$val->group_name";
				}
			}
			?>  
		  </b></div></td>
        </tr>
       <tr >
          <td>&nbsp;</td>
          <td colspan="3">
				<input type="hidden" name='user_id' id='user_id' value='<?=$user_id;?>'>
				<div onclick="simpan();" class='btn btn-danger btn-sm' id="btAct"><i class="fa fa-trash fa-fw"></i> Hapus</div>
				<div onclick="batal();" class='btn btn-default btn-sm'><i class="fa fa-close fa-fw"></i> Batal...</div>
			</td>
        </tr>
</table>
		</div>
	</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function simpan(){
			var user_id = $("#user_id").val();
			$.ajax({
				type:"POST",
				url:"<?=base_url();?>cmsadmin/user/hapus_aksi/",
				data:{	"user_id":user_id	},
				beforeSend:function(){	
						$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
				},
				success:function(data){
			gridpagingA("end");
			batal();
				},//tutup::success
				dataType:"html"
			});//tutup ajax
	} //tutup::simpan
</script>
