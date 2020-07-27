<!doctype html>
<html lang="en">
  <head>
  <?php include_once 'views/includes/head.php'?>
  <title><?= ucfirst($page) ?></title>
  
  </head>
  <body>
  <header>
    <?php include_once 'views/includes/header.php'?>
  </header>

<?php include_once 'views/includes/footer.php'?>
<script>
$(document).ready(function () {
    $('#search').autocomplete({
        source: 'search',
        minLength: 3, // on indique qu'il faut taper au moins 3 caractères pour afficher l'autocomplétion
        focus: function (event, ui) {
            console.log(ui.item);
            $("#search").val(ui.item.label);
            return false;
        },
        select: function (event, ui) { // lors de la sélection d'une proposition
            console.log(ui.item);
            $('#description').html(ui.item.desc); // on ajoute la description de l'objet dans un bloc
        }
    });
});
</script>
</body>
</html>