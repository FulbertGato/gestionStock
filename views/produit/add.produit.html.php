<?php

use gestion\lib\Session;

$title='ajout Produit';
$array_error=[];
if (Session::keyExist("array_error")){
    //recupeeration des erreur de la session dans la variable local
    $array_error = Session::getSession("array_error");
   //dd($array_error);
    Session::destroyKey("array_error");
}
?>
<div class="container mt-5">
    <button class="btn btn-success col-12"><h1 class="text-center "> AJouter un produit</h1> </button>
<form action="<?php path('produit/addProduit');?>", method="post">
    <?php if(isset($array_error)): ?>
        <div class="alert alert-danger my-2 " role="alert">
            <strong>Vérifiez vos saisie</strong>
        </div>
    <?php endif ?>
    <div class="form-row mt-3">
        <div class="form-group col-md-6">
            <?php $form->label("libellé","col-sm-2 col-form-label") ?>
            <?php $form->input("libelle","form-control","text") ?>
        </div>
        <div class="form-group col-md-6">
            <?php $form->label("Référence","col-sm-2 col-form-label") ?>
            <input type="text"  class="form-control" name="ref" value="<?=$ref?>"readonly>
        </div>
    </div>

    <div class="form-row">

        <div class="form-group col-md-5">
            <?php $form->label("Categorie") ?>
            <select class="form-control custom-select" name="categorie_id">
                <?php $form->option("Selectionnez une catégorie","0") ?>
                <?php foreach ($categories as $cat):?>
                <?php $form->option($cat['libelle_categorie'],$cat['id_categorie']) ?>
                <?php endforeach;?>
            </select>
        </div>

        <div class="form-group col-md-3">
            <?php $form->label("Categorie") ?>
            <select class="form-control custom-select" name="type">
                   <?php $form->option("Selectionnez une type","nulle") ?>
                    <?php $form->option("produits physique","physique") ?>
                   <?php $form->option("produits virtuelle","virtuelle") ?>

            </select>
        </div>

        <div class="form-group col-md-2">
            <?php $form->label("Prix") ?>
            <?php $form->input("prix","form-control","number") ?>
        </div>

        <div class="form-group col-md-2">
            <?php $form->label("Stock") ?>
            <?php $form->input("stock","form-control","number") ?>

        </div>
    </div>
    <button  type="submit" class="btn btn-primary col-12"><h1 class="text-center "> AJouter un produit</h1> </button>

</form>
</div>