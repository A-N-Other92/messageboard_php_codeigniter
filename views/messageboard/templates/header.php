<title><?php echo $pagename  ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<style>
 
       body {background-color: gray;}
 
      .row-red {background-color: red;}
 
      .row-blue {background-color: blue;}
 
      .button-text-black {color: black;}
 
      .no-padding {padding: 0px;}
 
      .cellpad5 {padding: 5px 5px 5px 5px;}
   
      .pag ul li a  {background-color: gray; color: black;} 
 
 
      a:link    {text-decoration: none; color: black;}
      a:visited {text-decoration: none; color: black;}
      .underline a:hover   {text-decoration: underline; color: black; font-style: italic;}
 
  
 
</style>


<div class="container-fluid">

 <div class="row row-red">
         <div class="col-md-4 no-padding"><a href="<?php echo base_url('index.php/messageboard'); ?>"><button type="button" class="btn btn-danger btn-lg btn-block button-text-black"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> The message board</button></a></div>
         <div class="col-md-4 "></div>
     <!--  <div class="col-md-4 ">ccc</div> -->

         <?php  if($pagename != "Register") {
                   if(empty($_SESSION['loggedin'])) {
                      echo '<div class="col-md-2 no-padding"><a href="' . base_url('index.php/messageboard/register') . '"><button type="button" class="btn btn-danger btn-lg btn-block button-text-black"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Register</button></a></div>';
                   }
                   if(isset($_SESSION['loggedin'])) {
                      echo '<div class="col-md-2 no-padding">' . $_SESSION['loggedin']['name'] . ' is logged in </div>';
                   }
                }
                else {
                   echo '<div class="col-md-2 no-padding"></div>';
                }  // end of pagename if
         ?>
 
         <?php  if($pagename != "Login") {
                   if(empty($_SESSION['loggedin'])) {
                      echo '<div class="col-md-2 no-padding"><a href="' . base_url('index.php/messageboard/login') . '" ><button type="button" class="btn btn-danger btn-lg btn-block button-text-black"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Login</button></a></div>';
                   }
                   if(isset($_SESSION['loggedin'])) {
                      echo '<div class="col-md-2 no-padding"><a href="' . base_url('index.php/messageboard/logout') . '"><button type="button" class="btn btn-danger btn-lg btn-block button-text-black"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</button></a></div>';
                   }
                }  // end of pagename if
         ?>



 </div>


 