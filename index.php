<?php
define('INCLUDE_CHECK',true);
require 'connect.php';
require 'functions.php';
// Those two files can be included only if INCLUDE_CHECK is defined
session_name('tzLogin');
// Starting the session
session_set_cookie_params(2*7*24*60*60);
// Making the cookie live for 2 weeks
session_start();
if($_SESSION['id'] && !isset($_COOKIE['tzRemember']) && !$_SESSION['rememberMe'])
{
    // If you are logged in, but you don't have the tzRemember cookie (browser restart)
    // and you have not checked the rememberMe checkbox:
    $_SESSION = array();
    session_destroy();
    // Destroy the session
}
if(isset($_GET['logoff']))
{
    $_SESSION = array();
    session_destroy();
    
    header("Location: index.php");
    exit;
}
if($_POST['submit']=='Login')
{
    // Checking whether the Login form has been submitted   
    $err = array();
    // Will hold our errors
    if(!$_POST['username'] || !$_POST['password'])
        $err[] = 'All the fields must be filled in!';
    if(!count($err))
    {
        $_POST['username'] = mysql_real_escape_string($_POST['username']);
        $_POST['password'] = mysql_real_escape_string($_POST['password']);
        $_POST['rememberMe'] = (int)$_POST['rememberMe'];
        // Escaping all input data
        $row = @mysql_fetch_assoc(mysql_query("SELECT * FROM user WHERE username ='".$_POST['username']."' AND password ='".$_POST['password']."' "));
        if($row['username'])
        {
            // If everything is OK login
            $_SESSION['username']=$row['username'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['rememberMe'] = $_POST['rememberMe'];
            // Store some data in the session
            setcookie('tzRemember',$_POST['rememberMe']);
        }
        else $err[]='Wrong username and/or password!';
    }
    if($err)
    $_SESSION['msg']['login-err'] = implode('<br />',$err);
    // Save the error messages in the session
    header("Location: index.php");
    exit;
}
?>
<!-- Author: Michael Milstead / Mode87.com
	 for Untame.net
	 Bootstrap Tutorial, 2013
-->
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Juan Luis Tellez</title>
	<meta name="description" content="Bootstrap Tab + Fixed Sidebar Tutorial with HTML5 / CSS3 / JavaScript">
	<meta name="author" content="Untame.net">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="assets/bootstrap.min.js"></script>

	<link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
	<style type="text/css">
		body { margin: 50px 0; background: url(photos/INFO_TECH.jpg); }
		.well { background-color: #fff; }

		.fixme { position: fixed; }
		/* Landscape phone to portrait tablet */
		@media (max-width: 767px) {
			.fixme { width: 100%; position: static; }
		}
	</style>
<script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
        }
    </script>
</head>

<body>

	<!-- Section #1 -->
<div class="container">
	<div class="row tabbable">
		<div class="span3 fixme" style="margin: 20px;
        -webkit-box-shadow: -1px 6px 39px 0px rgba(0,0,0,1);
-moz-box-shadow: -1px 6px 39px 0px rgba(0,0,0,1);
box-shadow: -1px 6px 39px 0px rgba(0,0,0,1);
border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 0px solid #000000;

background: rgba(242,246,248,1);
background: -moz-linear-gradient(left, rgba(242,246,248,1) 0%, rgba(183,199,209,1) 0%, rgba(181,198,208,1) 0%, rgba(195,209,217,0.88) 13%, rgba(195,209,217,0.77) 24%, rgba(195,209,217,0.72) 38%, rgba(216,225,231,0.51) 99%, rgba(224,239,249,0.51) 100%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(242,246,248,1)), color-stop(0%, rgba(183,199,209,1)), color-stop(0%, rgba(181,198,208,1)), color-stop(13%, rgba(195,209,217,0.88)), color-stop(24%, rgba(195,209,217,0.77)), color-stop(38%, rgba(195,209,217,0.72)), color-stop(99%, rgba(216,225,231,0.51)), color-stop(100%, rgba(224,239,249,0.51)));
background: -webkit-linear-gradient(left, rgba(242,246,248,1) 0%, rgba(183,199,209,1) 0%, rgba(181,198,208,1) 0%, rgba(195,209,217,0.88) 13%, rgba(195,209,217,0.77) 24%, rgba(195,209,217,0.72) 38%, rgba(216,225,231,0.51) 99%, rgba(224,239,249,0.51) 100%);
background: -o-linear-gradient(left, rgba(242,246,248,1) 0%, rgba(183,199,209,1) 0%, rgba(181,198,208,1) 0%, rgba(195,209,217,0.88) 13%, rgba(195,209,217,0.77) 24%, rgba(195,209,217,0.72) 38%, rgba(216,225,231,0.51) 99%, rgba(224,239,249,0.51) 100%);
background: -ms-linear-gradient(left, rgba(242,246,248,1) 0%, rgba(183,199,209,1) 0%, rgba(181,198,208,1) 0%, rgba(195,209,217,0.88) 13%, rgba(195,209,217,0.77) 24%, rgba(195,209,217,0.72) 38%, rgba(216,225,231,0.51) 99%, rgba(224,239,249,0.51) 100%);
background: linear-gradient(to right, rgba(242,246,248,1) 0%, rgba(183,199,209,1) 0%, rgba(181,198,208,1) 0%, rgba(195,209,217,0.88) 13%, rgba(195,209,217,0.77) 24%, rgba(195,209,217,0.72) 38%, rgba(216,225,231,0.51) 99%, rgba(224,239,249,0.51) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f6f8', endColorstr='#e0eff9', GradientType=1 );" >
    

			  <h1 align="center"><img src="photos/foto.ico" width="100" style="margin: 1px;
        -webkit-box-shadow: -1px 6px 39px 0px rgba(0,0,0,1);
-moz-box-shadow: -1px 6px 39px 0px rgba(0,0,0,1);
box-shadow: -1px 6px 39px 0px rgba(0,0,0,1);
border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 0px solid #000000;"></h1>
			<hr>
			    <h4 style="margin: 20px;
        -webkit-box-shadow: -1px 6px 39px 0px rgba(0,0,0,1);
-moz-box-shadow: -1px 6px 39px 0px rgba(0,0,0,1);
box-shadow: -1px 6px 39px 0px rgba(0,0,0,1);
border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 0px solid #000000;" align="center"> Navegador</h4>

			  <ul class="nav nav-pills nav-stacked" style="margin: 10px; alignment-adjust: ">
                <li class="active"><a href="#blog" data-toggle="tab">curriculum </a></li>
                <li><a href="#ingles" data-toggle="tab">Curriculum  Ingl&eacutes</a></li>
                <li><a href="#photos" data-toggle="tab">Code</a></li>
                <li><a href="#misc" data-toggle="tab">Github <?=$_SESSION['username'] ;?></a>
                    <hr>
                   <form action="" method="post">
                   <input id="name" name="username" placeholder="username" type="text">
                   <input id="password" name="password" placeholder="**********" type="password">
                   <label><input name="rememberMe" id="rememberMe" type="checkbox" checked="checked" value="1" /> &nbsp;Remember me</label>
                   <input type="submit" name="submit" value="Login" class="btn btn-success" />
                   <a href="?logoff"><input type="button" name="submit" value="Salir" class="btn btn-danger" /></a>
                   <button type="submit" class="btn btn-warning"  onclick="javascript:printDiv('blog')">Print</button>
                   <span><?php echo $error; ?></span>
                   </form>
                   </li>    
            </ul>
		</div>
		
		 <div class="span8 well pull-right" style="  margin-top: 10px;
        -webkit-box-shadow: -1px 6px 39px 0px rgba(0,0,0,1);
-moz-box-shadow: -1px 6px 39px 0px rgba(0,0,0,1);
box-shadow: -1px 6px 39px 0px rgba(0,0,0,1);
border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;

background: rgba(242,246,248,1);
background: -moz-linear-gradient(left, rgba(242,246,248,1) 0%, rgba(183,199,209,1) 0%, rgba(181,198,208,1) 0%, rgba(195,209,217,0.88) 13%, rgba(195,209,217,0.77) 24%, rgba(195,209,217,0.72) 38%, rgba(216,225,231,0.51) 99%, rgba(224,239,249,0.51) 100%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(242,246,248,1)), color-stop(0%, rgba(183,199,209,1)), color-stop(0%, rgba(181,198,208,1)), color-stop(13%, rgba(195,209,217,0.88)), color-stop(24%, rgba(195,209,217,0.77)), color-stop(38%, rgba(195,209,217,0.72)), color-stop(99%, rgba(216,225,231,0.51)), color-stop(100%, rgba(224,239,249,0.51)));
background: -webkit-linear-gradient(left, rgba(242,246,248,1) 0%, rgba(183,199,209,1) 0%, rgba(181,198,208,1) 0%, rgba(195,209,217,0.88) 13%, rgba(195,209,217,0.77) 24%, rgba(195,209,217,0.72) 38%, rgba(216,225,231,0.51) 99%, rgba(224,239,249,0.51) 100%);
background: -o-linear-gradient(left, rgba(242,246,248,1) 0%, rgba(183,199,209,1) 0%, rgba(181,198,208,1) 0%, rgba(195,209,217,0.88) 13%, rgba(195,209,217,0.77) 24%, rgba(195,209,217,0.72) 38%, rgba(216,225,231,0.51) 99%, rgba(224,239,249,0.51) 100%);
background: -ms-linear-gradient(left, rgba(242,246,248,1) 0%, rgba(183,199,209,1) 0%, rgba(181,198,208,1) 0%, rgba(195,209,217,0.88) 13%, rgba(195,209,217,0.77) 24%, rgba(195,209,217,0.72) 38%, rgba(216,225,231,0.51) 99%, rgba(224,239,249,0.51) 100%);
background: linear-gradient(to right, rgba(242,246,248,1) 0%, rgba(183,199,209,1) 0%, rgba(181,198,208,1) 0%, rgba(195,209,217,0.88) 13%, rgba(195,209,217,0.77) 24%, rgba(195,209,217,0.72) 38%, rgba(216,225,231,0.51) 99%, rgba(224,239,249,0.51) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f6f8', endColorstr='#e0eff9', GradientType=1 );" >
			<div class="tab-content">
				<div id="blog" class="tab-pane active">
				        
      <?php if( $_SESSION['username'] == 'juanluis') {   
include 'connect.php'; if (isset($_POST['update']))    { //header("location: index_2.php"); 
  "DESC".$desc_ESP = $_POST['article-body_ESP'];
  "DESC".$desc_ENG = $_POST['article-body_ENG'];
  "ID".$id = $_POST['id'];
$today = date("Y-m-d H");
$ip = $_SERVER['REMOTE_ADDR'];
$user = $_SESSION['username'];;
 $update_query = "UPDATE `resume` SET `ESP`='".$desc_ESP."', `ENG`='".$desc_ENG."' WHERE `id`='$id'";
         $result = mysql_query($update_query) or die("SQL Error 1: " . mysql_error());
          $result;    }
          ?> 
						
						
						<table border="0"  align="center" class="table table-condensed table-hover" >
  <tr>
</tr>
<? 
$queEmp = "SELECT * FROM RESUME"; 
$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);
   while ($reg = mysql_fetch_array($resEmp)) { ?>
<tr>
    <script src="ckeditor/ckeditor.js"></script>
    <link href="ckeditor/sample/sample.css" rel="stylesheet">
    <style>

        /* Style the CKEditor element to look like a textfield */
        .cke_textarea_inline
        {
            padding: 10px;
            height: 200px;
            overflow: auto;
            border: 0px solid gray;
            -webkit-appearance: textfield;        }
  </style>
 <form method="POST" name="form" id="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
 <td style="width: 800px;">
      <textarea class="form-control" cols="180" rows="20" name="article-body_ESP" id="texto<?=$reg["id"]; ?>"  /><?=$reg['ESP'];?></textarea>
       <textarea class="" cols="180" rows="20" name="article-body_ENG" style="background-color: #79ad7b;" id="texto<?=$reg["id"]; ?>+1"  /><?=$reg['ENG'];?></textarea>
      <input type="hidden" name="id" value="<?=$reg["id"]; ?>" />
       <button type="submit" name="update" class="btn btn-success">Actualizar</button>
      </td>


<script>
        CKEDITOR.replace( 'texto<?=$reg["id"]; ?>', {
    fullPage: true,
    allowedContent: true
});
    </script>
  
  <script>
        CKEDITOR.replace( 'texto<?=$reg["id"]; ?>+1', {
    fullPage: true,
    allowedContent: true
});
    </script>
    
</form>
  </tr>
  <? }  ?>
 
</table>
						    
						    
						    <? } else { ?>
<table border="0"  align="center"  class="table table-condensed table-hover">
  <tr>
</tr>
<? 
$queEmp = "SELECT * FROM RESUME"; 
$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);
   while ($reg = mysql_fetch_array($resEmp)) { ?>
<tr>
    <style>
        /* Style the CKEditor element to look like a textfield */
        .cke_textarea_inline
            padding: 10px;
            height: 200px;
            overflow: auto;
            border: 1px solid gray;
            -webkit-appearance: textfield;        
  </style>
 <form method="get" name="form" id="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
 <td style="width: 800px;">
      <?=$reg['ESP'];?>
      </td>
  </tr>
  <? }  ?>
  </table>
  <? } ?>
  
  
  
  
	    		</div>
	    		
	    		
	    		<!--*****************INGLES--------******************--->
	    		<div id="ingles" class="tab-pane">
                   <table border="0"  align="center"  class="table table-condensed table-hover">
  <tr>
</tr>
<? 
$queEmp = "SELECT * FROM RESUME"; 
$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);
   while ($reg = mysql_fetch_array($resEmp)) { ?>
<tr>
    <style>
        /* Style the CKEditor element to look like a textfield */
        .cke_textarea_inline
            padding: 10px;
            height: 200px;
            overflow: auto;
            border: 1px solid gray;
            -webkit-appearance: textfield;        
  </style>
 <form method="get" name="form" id="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
 <td style="width: 800px;">
      <?=$reg['ENG'];?>
      </td>
  </tr>
  <? }  ?>
  </table>
  
                </div>
                
                
                
	    		
				<div id="photos" class="tab-pane">
					<h1>Photos</h1>
					<hr>
					<img src="photos/japan/03.jpg">
					<img src="photos/japan/04.jpg">
					<img src="photos/japan/09.jpg">
					<img src="photos/japan/11.jpg">
					<img src="photos/japan/12.jpg">
					<img src="photos/japan/13.jpg">
				</div>
	    		<div id="misc" class="tab-pane">
	    			<h1>Miscellaneous Stuff</h1>
	    			<hr>

						<div class="btn-toolbar">
						    <button class="btn btn-primary">New User</button>
						    <button class="btn">Import</button>
						    <button class="btn">Export</button>
						</div>
						<div class="well">
						    <table class="table">
						      <thead>
						        <tr>
						          <th>#</th>
						          <th>First Name</th>
						          <th>Last Name</th>
						          <th>Username</th>
						          <th style="width: 36px;"></th>
						        </tr>
						      </thead>
						      <tbody>
						        <tr>
						          <td>1</td>
						          <td>Mark</td>
						          <td>Tompson</td>
						          <td>the_mark7</td>
						          <td>
						              <a href="user.html"><i class="icon-pencil"></i></a>
						              <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
						          </td>
						        </tr>
						        <tr>
						          <td>2</td>
						          <td>Ashley</td>
						          <td>Jacobs</td>
						          <td>ash11927</td>
						          <td>
						              <a href="user.html"><i class="icon-pencil"></i></a>
						              <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
						          </td>
						        </tr>
						        <tr>
						          <td>3</td>
						          <td>Audrey</td>
						          <td>Ann</td>
						          <td>audann84</td>
						          <td>
						              <a href="user.html"><i class="icon-pencil"></i></a>
						              <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
						          </td>
						        </tr>
						        <tr>
						          <td>4</td>
						          <td>John</td>
						          <td>Robinson</td>
						          <td>jr5527</td>
						          <td>
						              <a href="user.html"><i class="icon-pencil"></i></a>
						              <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
						          </td>
						        </tr>
						        <tr>
						          <td>5</td>
						          <td>Aaron</td>
						          <td>Butler</td>
						          <td>aaron_butler</td>
						          <td>
						              <a href="user.html"><i class="icon-pencil"></i></a>
						              <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
						          </td>
						        </tr>
						        <tr>
						          <td>6</td>
						          <td>Chris</td>
						          <td>Albert</td>
						          <td>cab79</td>
						          <td>
						              <a href="user.html"><i class="icon-pencil"></i></a>
						              <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
						          </td>
						        </tr>
						      </tbody>
						    </table>
						</div>
						<div class="pagination">
						    <ul>
						        <li><a href="#">Prev</a></li>
						        <li><a href="#">1</a></li>
						        <li><a href="#">2</a></li>
						        <li><a href="#">3</a></li>
						        <li><a href="#">4</a></li>
						        <li><a href="#">Next</a></li>
						    </ul>
						</div>
						<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						    <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						        <h3 id="myModalLabel">Delete Confirmation</h3>
						    </div>
						    <div class="modal-body">
						        <p class="error-text">Are you sure you want to delete the user?</p>
						    </div>
						    <div class="modal-footer">
						        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
						        <button class="btn btn-danger" data-dismiss="modal">Delete</button>
						    </div>
						</div>

	    			 <form class="form-horizontal">
						    <fieldset>
						        <div class="control-group">
						            <label class="control-label">Full Name</label>
						            <div class="controls">
						                <input id="full-name" name="full-name" type="text" placeholder="full name"
						                class="input-xlarge">
						                <p class="help-block"></p>
						            </div>
						        </div>
						        <!-- address-line1 input-->
						        <div class="control-group">
						            <label class="control-label">Address Line 1</label>
						            <div class="controls">
						                <input id="address-line1" name="address-line1" type="text" placeholder="address line 1"
						                class="input-xlarge">
						                <p class="help-block">Street address, P.O. box, company name, c/o</p>
						            </div>
						        </div>
						        <!-- address-line2 input-->
						        <div class="control-group">
						            <label class="control-label">Address Line 2</label>
						            <div class="controls">
						                <input id="address-line2" name="address-line2" type="text" placeholder="address line 2"
						                class="input-xlarge">
						                <p class="help-block">Apartment, suite , unit, building, floor, etc.</p>
						            </div>
						        </div>
						        <!-- city input-->
						        <div class="control-group">
						            <label class="control-label">City / Town</label>
						            <div class="controls">
						                <input id="city" name="city" type="text" placeholder="city" class="input-xlarge">
						                <p class="help-block"></p>
						            </div>
						        </div>
						        <!-- region input-->
						        <div class="control-group">
						            <label class="control-label">State / Province / Region</label>
						            <div class="controls">
						                <input id="region" name="region" type="text" placeholder="state / province / region"
						                class="input-xlarge">
						                <p class="help-block"></p>
						            </div>
						        </div>
						        <!-- postal-code input-->
						        <div class="control-group">
						            <label class="control-label">Zip / Postal Code</label>
						            <div class="controls">
						                <input id="postal-code" name="postal-code" type="text" placeholder="zip or postal code"
						                class="input-xlarge">
						                <p class="help-block"></p>
						            </div>
						        </div>
						        <!-- country select -->
						        <div class="control-group">
						            <label class="control-label">Country</label>
						            <div class="controls">
						                <select id="country" name="country" class="input-xlarge">
						                    <option value="" selected="selected">(please select a country)</option>
						                    <option value="AF">Afghanistan</option>
						                    <option value="AL">Albania</option>
						                    <option value="DZ">Algeria</option>
						                    <option value="AS">American Samoa</option>
						                    <option value="AD">Andorra</option>
						                    <option value="AO">Angola</option>
						                    <option value="AI">Anguilla</option>
						                    <option value="AQ">Antarctica</option>
						                </select>
						            </div>
						        </div>
						    </fieldset>
						</form>
	    		</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>   

 <!-- Author: Michael Milstead / Mode87.com
     for Untame.net
     Bootstrap Tutorial, 2013
-->