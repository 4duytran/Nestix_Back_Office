<!doctype html>
<html lang="en">
  <head>
  <?php include_once 'views/includes/head.php'?>
  <title><?= ucfirst($page) ?></title>
  <style>
    body {
      background-image: url('<?= PATH ?>assets/images/background_login.png');
      background-color: rgba(0,0,0,.9);
    }
  </style>
  </head>
  <body>
  <header>
    <?php include_once 'views/includes/header.php'?>
  </header>
  <div class="container mt-3" style='margin-bottom: 100px;'>
    <div class="row mx-auto justify-content-center loginPanel">
        <div class="col-12 col-md-8">
          <h1>Add New image</h1>
          <br />
          <?php if($errorfile != ''): ?>
          <span class="p-3 bg-danger text-white has-error" ><?= $errorfile ?></span>
          <?php endif; ?>
          <?php if($errorfile == ''): ?>
            <img class="img-fluid" src="<?= isset($destination) ? $destination : '' ?>"/>
          <?php endif; ?>  
          <br />
          <br />
          <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="csrf" value="<?= $token ?>">
            <div class="form-group">
                <input type="file" class="form-control" id="image" name="image" value="" >
                <span class="small" >Max file size : 2 Mo (jpg, png, gif, jpeg)</span>
                <p id="error1" style="display:none; color:#FF0000;">
                Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                </p>
                <p id="error2" style="display:none; color:#FF0000;">
                Maximum File Size Limit is 1MB.
                </p>
            </div>

              
            <div class="row justify-content-between mt-5">
              <div class="col-4">
                <button type="button" class="btn btn-secondary"  onClick="document.location.href='files'">Cancel</button>
              </div>
              <div class="col-4">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
    
          </form>
        </div>
    </div>
  </div>


<?php include_once 'views/includes/footer.php'?>

<script>
<?php
if (!empty($destination))
{
  echo '$(window).on("load",function(){
    $("#modalAddSuccess").modal("show");
});';
} else if($_GET['error'])
{
  echo '$(window).on("load",function(){
    $("#modalAddError").modal("show");
});';
} else if($_GET['invalidtoken'])
{
  echo '$(window).on("load",function(){
    $("#modalTokenError").modal("show");
});';
}
?>
</script>

<script>
    $('button[type="submit"]').prop("disabled", true);
var a=0;
//binds to onchange event of your input field
$('#image').bind('change', function() {
if ($('button:submit').attr('disabled',false)){
 $('button:submit').attr('disabled',true);
 }
var ext = $('#image').val().split('.').pop().toLowerCase();
if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
 $('#error1').slideDown("slow");
 $('#error2').slideUp("slow");
 a=0;
 }else{
 var picsize = (this.files[0].size);
 if (picsize > 2000000){
 $('#error2').slideDown("slow");
 a=0;
 }else{
 a=1;
 $('#error2').slideUp("slow");
 }
 $('#error1').slideUp("slow");
 if (a==1){
 $('button:submit').attr('disabled',false);
 }
}
});
</script>

</body>
</html>