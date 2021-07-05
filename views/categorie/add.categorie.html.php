<?php
$title="ajouter  catégories";
use gestion\lib\Session;

if (Session::keyExist("array_error")){
    //recupeeration des erreur de la session dans la variable local
    $array_error = Session::getSession("array_error");
    //dd($array_error);
    Session::destroyKey("array_error");
}
?>



<div class="container mt-5">
    <button class="btn btn-success col-12"><h1 class="text-center "> AJouter une catégorie</h1> </button>
<form method="post" action="<?php path('categorie/addCategorie')?>">
    <?php if(isset($array_error['libelle'])): ?>
        <div class="alert alert-danger my-2 " role="alert">
            <strong><?=$array_error['libelle']?></strong>
        </div>
    <?php endif ?>
  <div class="form-group row mt-3" >
  <?php $form->label("Référence","col-sm-2 col-form-label") ?>
    <div class="col-sm-10">
    <input type="text"  class="form-control" name="ref" value="<?=$ref?>"readonly>
    </div>
  </div>
    <?php if(isset($array_error['libelleE'])): ?>
        <div class="alert alert-danger my-2 " role="alert">
            <strong><?=$array_error['libelleE']?></strong>
        </div>
    <?php endif ?>
  <div class="form-group row">
    <?php $form->label("Libellé","col-sm-2 col-form-label") ?>
       <div class="col-sm-10">
    <?php $form->input("Libelle","form-control","text") ?>
    </div>
  </div>
    <div class="form-group row">
        <?php $form->label("Status","col-sm-2 col-form-label") ?>
        <div class="col-sm-10">
    <select class="form-control custom-select" name="status">
        <?php $form->option("active","active") ?>
        <?php $form->option("inactive","inactive") ?>
    </select>
        </div>
    </div>
  
  
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
  </div>
</form>

</div>

