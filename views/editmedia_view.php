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
  <div class="container mb-5 mt-3">
    <div class="row mx-auto justify-content-center loginPanel">
        <div class="col-12 col-md-8">
          <h1>Edit Media Panel</h1>
          <br />
          <?php
          if($error != ''): ?>
          <span class="p-3 bg-danger text-white has-error" ><?= $error ?></span>
          <?php endif; ?>
          <br />
          <br />
          <form method="POST" action="">
            <input type="hidden" name="csrf" value="<?= $token ?>">
            <div class="form-group">
                <label for="title">Media Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $media->m_name ?>" >
                <?php
                if($erroTitle != ''): ?>
                <span class="text-danger has-error" ><?= $erroTitle ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="year">Media Year</label>
                <input type="text" class="form-control" id="year" name="year" value="<?= $media->m_year ?>" >
                <?php
                if($erroYear != ''): ?>
                <span class="text-danger has-error" ><?= $erroYear ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group" id="isbngroup">
                <label for="isbn">Book ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?= $media->m_isbn ?>" maxlength="13" aria-describedby="isbnhelp">
                <small id="isbnhelp" class="form-text text-muted">ISBN valid format: min 10 max 13 (only number)</small>
                <?php
                if($erroBook != ''): ?>
                <span class="text-danger has-error" ><?= $erroBook ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="genre">Media Genre</label>
                <select class="form-control selectpicker" multiple data-live-search="true" id="genre" name="genre[]">
                  <?php foreach($genreList as $genre): ?>
                  <option value="<?= $genre['genreId'] ?>" <?php if(in_array($genre['genreName'], $media->m_genre)) {echo 'selected';} ?>><?= $genre['genreName'] ?></option>
                  <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="saga">Media Saga</label>
                <select class="form-control selectpicker" data-live-search="true" id="saga" name="saga">
                    <option value=""></option>
                    <?php foreach($sagaList as $saga): ?>
                    <option value="<?= $saga['sagaId'] ?>" <?php if($media->m_saga === $saga['sagaName']) {echo 'selected';} ?>><?= $saga['sagaName'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="type">Media Type</label>
                <select class="form-control selectpicker" data-live-search="true" id="type" name="type">
                    <?php foreach($typeList as $type): ?>
                    <option value="<?= $type['typeId'] ?>" <?php if($media->m_type === $type['typeName']) {echo 'selected';} ?>><?= $type['typeName'] ?></option>
                    <?php endforeach; ?>
                </select>
                <?php
                if($erroType != ''): ?>
                <span class="text-danger has-error" ><?= $erroType ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="valid">Valid</label>
                <select class="form-control selectpicker" data-live-search="true" id="valid" name="valid">
                
                    <option value="0" <?= ($media->m_valid == 0) ?  'selected' : '' ?>>Not valid</option>
                    <option value="1" <?= ($media->m_valid == 1) ?  'selected' : '' ?>>Valid</option>
                    
                </select>
            </div>

            <div class="form-group">
                <label for="valid">Image pick</label>
                <input type="text" class="form-control" id="imageName" name="image" value="" maxlength="13" aria-describedby="image">
                <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalimage">
                  Click to launch Image Gallery...
                </button>
                
            </div>
              
            <div class="row justify-content-between mt-5">
              <div class="col-4">
                <button type="button" class="btn btn-secondary"  onClick="document.location.href='media'">Cancel</button>
              </div>
              <div class="col-4">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
    
          </form>
        </div>
    </div>
  </div>




  <!-- Modal -->
<div class="modal fade" id="modalimage" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="ModalLabel">Image Gallery</h4>
      </div>
      <div class="modal-body">

          <!-- images -->
          <div class="row">
            <?php foreach ($images as $image): ?>
            
              <div class="col-3 my-2">
                <input type="image" src="assets/files/<?= $image->file_chemin ?>"   class="img-icon">
              </div>
                        
            <?php endforeach ; ?>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->

<?php include_once 'views/includes/footer.php'?>

<script>
<?php
if (isset($_GET['success']))
{
  echo '$(window).on("load",function(){
    $("#modalUpdateSuccess").modal("show");
});';
} else if(isset($_GET['error']))
{
  echo '$(window).on("load",function(){
    $("#modalUpdateError").modal("show");
});';
} else if(isset($_GET['invalidtoken']))
{
  echo '$(window).on("load",function(){
    $("#modalTokenError").modal("show");
});';
}
?>
</script>

<script>
$(".img-icon").click(function(){

    var imageName = $(this).attr('src');
    $("#imageName").val(imageName.substring(imageName.lastIndexOf('/')+1));
    $('#modalimage').modal('hide') ;
})
</script>

</body>
</html>