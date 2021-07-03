<?php
$title="ajouter  catégories";
use gestion\lib\Session;

if(!Session::keyExist("array_error")){
    
}
?>
<div class="container mt-5">
    <button class="btn btn-success col-12"><h1 class="text-center "> AJouter une catégorie</h1> </button>
<form method="post" action="<?php path('categorie/addCategorie')?>">
  <div class="form-group row mt-3" >
  <?php $form->label("Référence","col-sm-2 col-form-label") ?>
    <div class="col-sm-10">
    <input type="text"  class="form-control" name="ref" value="<?=$ref?>"readonly>
    </div>
  </div>
  <div class="form-group row">
    <?php $form->label("Libellé","col-sm-2 col-form-label") ?>
       <div class="col-sm-10">
    <?php $form->input("Libelle","form-control","text") ?>
    </div>
  </div>
  
  
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
  </div>
</form>

</div>


