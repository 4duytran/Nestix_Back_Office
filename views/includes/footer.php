<!-- Modal Delete Success-->
<div class="modal fade" id="modalDeleteSuccess" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">DELETE SUCCESSFULLY</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Well done!</h4>
          <hr>
          <p class="mb-0">Successfully DELETED.</p>
      </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete Error-->
<div class="modal fade" id="modalDeleteError" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">DELETE FAILED</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">Connection sql failed !</h4>
          <hr>
          <p class="mb-0">OOPS ! Something went wrong with sql request.</p>
      </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Update Success-->
<div class="modal fade" id="modalUpdateSuccess" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">UPDATE SUCCESSFULLY</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Well done!</h4>
          <hr>
          <p class="mb-0">Successfully updated.</p>
      </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Update Error-->
<div class="modal fade" id="modalUpdateError" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">UPDATE FAILED</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">Connection sql failed !</h4>
          <hr>
          <p class="mb-0">OOPS ! Something went wrong with sql request.</p>
      </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal ADD Success-->
<div class="modal fade" id="modalAddSuccess" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">ADD SUCCESSFULLY</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Well done!</h4>
          <hr>
          <p class="mb-0">Successfully added.</p>
      </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal ADD Error-->
<div class="modal fade" id="modalAddError" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">ADD FAILED</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">Connection sql failed !</h4>
          <hr>
          <p class="mb-0">OOPS ! Something went wrong with sql request.</p>
      </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Invalid Token-->
<div class="modal fade" id="modalTokenError" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Invalid Token</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="document.location.href='dashboard'">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">Your Token is invalid !</h4>
          <hr>
          <p class="mb-0">OOPS ! Something went wrong with your Token.</p>
      </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" onClick="document.location.href='dashboard'">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->
<div class="push"></div>

<div class="container-fluid footer mt-5"
  <footer>
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="footer-copyright text-center py-3">© 2020 Copyright</div>
              </div>
          </div>
      </div>
  </footer>
</div>

<script src="<?= PATH ?>assets/js/jquery-3.4.1.min.js"></script>
<script src="<?= PATH ?>assets/js/jquery-ui.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.min.js"></script>
<!-- Ajax search -->
<script>
$(document).ready(function () {
    var $url = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
    $('#search').autocomplete({
        source: $url,
        minLength: 3, // on indique qu'il faut taper au moins 3 caractères pour afficher l'autocomplétion
        focus: function (event, ui) {
            console.log(ui.item);
            $("#search").val(ui.item.label);
            return false;
        },
        select: function (event, ui) { // lors de la sélection d'une proposition
            console.log(ui.item);
            // $('#description').html(ui.item.desc); // on ajoute la description de l'objet dans un bloc
        }
    });
});
</script>

<script>
$(document).ready(function(){
    $("#type").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue != 2 ){
                $("#isbngroup").hide();            
            } else{
              $("#isbngroup").show();
            }
        });
    }).change();
});
</script>