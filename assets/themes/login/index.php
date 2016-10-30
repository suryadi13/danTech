<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title><?=$nama_app;?> | <?=$slogan_app;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=base_url('assets/css/plugins/metisMenu/metisMenu.min.css');?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	.saru{padding-top:40px;display:none;margin-top:4px;}
	</style>

</head>


<body>
<div class="headertt">

	<div class="container">
		<div class=row>
				<div class="col-lg-8">
					<div style="float:left;padding:10px 10px 10px 0px;"><img src="<?=base_url('assets/media/logo_kanal/'.$logo_app);?>" style='width:80px; vertical-align:middle;'></div>
					<div style="float:left;display:table;padding-top:20px; width:64%;">
						<div><h3 style="margin:0px;padding:0px;"><?=$nama_app;?></h3></div>
						<div><?=$slogan_app;?></div>
					</div>
				</div>  <!--col-lg-8--->
				<div class="col-lg-4" style="margin-bottom:0px;padding:20px 15px 0px 0px;vertical-align:bottom; display:none;"></div>
				</div>  <!--col-lg-4--->
		</div> <!--row--->
	</div> <!--container--->

    <div class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0px;border-top:1px solid #eee;">
      <div class="container">
        <div class="navbar-header"  style="clear:both;">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div style="padding:15px 0px 0px 15px;">
		  <?php
		  date_default_timezone_set('Asia/Jakarta');
		$hh = array(); $hh['Sun']="Minggu"; $hh['Mon']="Senin"; $hh['Tue']="Selasa"; $hh['Wed']="Rabu"; $hh['Thu']="Kamis"; $hh['Fri']="Jum'at"; $hh['Sat']="Sabtu";
		  ?> 
		  <?=$hh[date('D')];?>, <?=date('d-m-Y');?>
		  </div>
        </div>
        <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?=site_url();?>">Home</a></li>
				</ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
</div>



</div>
<!--//header-->



    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4" style="padding-top:20px;">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Silahkan Log In</h3>
                    </div>
                    <div class="panel-body">
						<form role="form" id="loginForm" accept-charset="utf-8" method="post" action="<?=site_url();?>login/dologin">
						<input type="hidden" value="ok" name="ok">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Isikan nama pengguna"  name="ibuku_sayang" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Isikan kata sandi" name="sendok" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								<button type="submit" class="btn btn-lg btn-success btn-block" name="Submit">Login</button>
                            </fieldset>
						<div class="row saru">
							<div class="col-lg-12">
							 <input class="form-control" placeholder="Username"  name="user_name" autofocus value="">
							 <input class="form-control" placeholder="Password"  name="user_password" value="">
							</div><!--col-lg-12// -->
						</div><!--row//-->
                        </form>
						<div id="responceArea"></div>
                    </div>
                </div>
            </div>
        </div>

    <!-- jQuery Version 1.11.0 -->
	<script type="text/javascript" src="<?=base_url();?>assets/js/jquery/jquery-1.11.0.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
	<script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
	<script type="text/javascript" src="<?=base_url();?>assets/js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
	<script type="text/javascript" src="<?=base_url();?>assets/js/sb-admin-2.js"></script>


	<script type="text/javascript" src="<?=site_url();?>assets/js/jquery/jquery.form.js"></script>

<noscript>
<meta http-equiv="refresh" content="0; url=<?=site_url('enable_javascript');?>" />
</noscript>

      <hr>

      <footer>
        <p>&copy; BKPP Kota Tangerang 2014</p>
      </footer>
    </div>
</body>
</html>
<script type='text/javascript'>   
userpage =  {
	form:{
		// tambahan 26-04-2012
		ajaxError : function(request,type,errorThrown){
			var message = "There was an error with the AJAX request.\n";
			switch(type){
				case 'timeout':
						message += "The request timed out.";
						break;
				case 'notmodified':
						message += "The request was not modified but was not retrieved from the cache.";
						break;
				case 'parseerror':
						message += "XML/Json format is bad.";
						break;
				default:
						message += "HTTP Error (" + request.status + " " + request.statusText + ").";
			}
						message += "\n";
						alert(message);		
		},
		init: function(settings){
			var options = {
				async: false,
				dataType: 'json',
				type:      'POST',
				success : function(content) {
					var msg;
					if(content.result == 'succes'){
						location.href = '<?=site_url();?>' + content.section;
						msg = '<div id="notification">';
					    msg += '<div class="error">'+content.message+'</div></div>';
					}else{
					    msg = '<div id="notification">';
					    msg += '<div class="error"><strong>Pesan Kesalahan</strong><ol><li>Pastikan username dan password anda benar-benar valid</li><li>'+content.message+'</li></ol></div></div>';
					}
					jQuery('#responceArea').html(msg);
				},
				// error:userpage.form.ajaxError
			}
			jQuery.extend(options,settings);
			jQuery('#loginForm').ajaxForm(options); 
		}
	},
	auth:{
		init:function(){
			 if("<?=$sesi;?>"){
					location.href = '<?=site_url();?>' + '<?=$sesi;?>';
					jQuery('#button').hide();
			 }else{
			 	userpage.form.init(); 	
			 }
		}
	}
}

$(document).ready(function() {  
	userpage.auth.init(); 	
});
</script>
