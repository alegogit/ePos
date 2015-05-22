<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$this->config->item('title')?></title>   
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/icon.ico" />
 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script>
window.setTimeout(function() {
  $("#output").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 3000);
</script>
 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css"/>
<?php
	echo "
		<style>
			body{background: #eee url('".base_url()."assets/images/resto.png');}
		</style>
	";
?>
<style>
html,body{
    position: relative;
    height: 100%;
}
            
.login-container{
    position: relative;
    width: 300px;
    margin: 80px auto;
    padding: 20px 40px 40px;
    text-align: center;
    border: 1px solid #ccc;
    box-shadow:
        0 0 1px rgba(0, 0, 0, 0.3),
        0 3px 7px rgba(0, 0, 0, 0.3),
        inset 0 1px rgba(255,255,255,1),
        inset 0 -3px 2px rgba(0,0,0,0.25);
    border-radius: 5px;
    background: linear-gradient(#ffffff, #eeefef 75%);
}

#output{
  margin-bottom: 10px;
  color: rgb(228, 105, 105);
}

#output.alert-success{
    color: rgb(25, 204, 25);
}

#output.alert-danger{
    background: rgb(228, 105, 105);
}


.login-container::before,.login-container::after{
    content: "";
    position: absolute;
    width: 100%;height: 100%;
    top: 3.5px;left: 0;
    background: #fff;
    z-index: -1;
    -webkit-transform: rotateZ(4deg);
    -moz-transform: rotateZ(4deg);
    -ms-transform: rotateZ(4deg);
    border: 1px solid #ccc;

}

.login-container::after{
    top: 5px;
    z-index: -2;
    -webkit-transform: rotateZ(-2deg);
     -moz-transform: rotateZ(-2deg);
      -ms-transform: rotateZ(-2deg);

}

.form-box input{
    width: 100%;
    padding: 10px;
    height:40px;
    border: 1px solid #ccc;
    transition:0.2s ease-in-out;     
    box-shadow: 1px 0 0 rgba(255, 255, 255, 0.7);
}

.form-box input:focus{
    outline: 0;
    background: #f7f7f7;
}

.form-box input[type="text"]{
    border-radius: 5px;
}

.form-box input[type="password"]{
    border-radius: 5px;
}

.form-box button.login{
    margin-top:15px;
    padding: 10px 20px;
}

.animated {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

.profile-img
{
    width: 100px;
    margin: 0 auto 10px;
    display: block;
    margin-top: 10px;
    margin-bottom: 30px;
}
.mt10
{
    margin-top: 10px;
}           
</style>  

<?php
  if($this->config->item('env')=="prod"){
    //$this->load->library('cookies');  
    //$this->cookies->clearAll(); 
?>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-62705312-4', 'auto');
ga('send', 'pageview');
</script>
<?php
  }
?>
  
</head>
 
<body>
 
<div class="container"> 
	<div class="login-container"> 
    <img class="profile-img grayscale" src="<?php echo base_url(); ?>assets/images/logo3d.png" alt="ePOS">  
    <div class="form-box">
    <?php 
	   echo validation_errors(); 
	   $attributes = array('class' => 'form-signin', 'id' => 'myform', 'role' => 'form');
	   echo form_open('forgot', $attributes); 
	  ?>     
      <div class="form-group">
        <div class="input-group"> 
          <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>     
          <input type="text" class="form-control" name="email" id="email" placeholder="Email" required autofocus>  
        </div> 
      </div>
      <input name="login" type="submit" value="Reset Your Password" class="btn btn-lg btn-primary btn-block" />
      <a href="<?=base_url()?>" class="pull-right mt10">Back Home </a><span class="clearfix"></span>
    <?=form_close()?>
    </div>
  </div>
</div> 
</body>
</html>