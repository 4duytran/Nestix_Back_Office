<!DOCTYPE html>
<html lang="en">
 <head> 
    <?php 
    include_once '_config/config.php';
    include_once 'views/includes/head.php';
    ?>
    <title>404</title>

  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script> 
  <!-- Meta tag Keywords --> 
  <!-- css files custom for this page 404--> 
  <link href="<?= PATH ?>assets/css/style404.css" rel="stylesheet" type="text/css" media="all" /> 
  <!-- //css files --> 
  <!-- online-fonts --> 
  <link href="//fonts.googleapis.com/css?family=Ropa+Sans:400,400i&amp;subset=latin-ext" rel="stylesheet" /> 
  <!--//online-fonts --> 
 </head> 
 <body> 
  <div class="header"> 
   <h1>It look like your are lost ! OOPS</h1> 
  </div> 
  <div class="w3-main"> 
   <div class="agile-info"> 
    <h3>SORRY</h3> 
    <h2>4<img src="<?= PATH ?>assets/images/confused.gif" alt="image" />4</h2> 
    <p>An error Occurred in the Application And Your Page could not be Served.</p> 
    <a href="<?= PATH ?>home">go back</a> 
   </div> 
  </div>   
 </body>
</html>