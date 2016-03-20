
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.ico"); ?>" />
    <title>Sistem Informasi Leasing BPKB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url("assets") ?>/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    body{padding-top:20px;}    </style>
   
<script src="<?php echo base_url("assets") ?>/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets") ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <script src="<?php echo base_url("assets") ?>/js/md5.js"></script>
   
    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
         /* var iframe_height = parseInt($('html').height()); 
          window.parent.postMessage( iframe_height, 'http://bootsnipp.com');*/
		  $("#fm-login").submit(function(){
			  vuser = $("#username").val();
			  vpass = $.md5($("#password").val());
		  	  $.ajax({
				url : '<?php echo site_url("login/ceklogin"); ?>',
				type : 'post',
				dataType : 'json',
				data : { username: vuser, password : vpass },
				success : function(obj){
					//console.log(obj.error);
					if(obj.error==false){
						location.href=('<?php echo site_url("pilih"); ?>');
					}
					else {
						$("#salah").show();
					}
				}
				  
				});
			  
			  return false;
		  });
		  
        });
    </script>
</head>
<body>
	<div class="container">
    <div class="row" style="height:100px">
    </div>
    
    
    <div class="row">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-primary">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">LOGIN APLIKASI</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form method="post" id="fm-login" accept-charset="UTF-8" role="form">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input id="username" class="form-control" placeholder="Username" name="username" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="" id="password">
			    		</div>
			    		 
			    		<input class="btn btn-lg btn-success btn-block" 
                        type="submit" value="Login">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
    
  <div class="row">
  <div id="salah" class="col-md-4 col-md-offset-4" style="display:none">
            <div class="alert alert-danger" role="alert">
            	<strong>Gagal</strong> Username dan password salah
            </div>
        </div>
    </div>
    
</div>	<script type="text/javascript">
		</script>
</body>
</html>
