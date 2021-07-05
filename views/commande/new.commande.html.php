<?php

use gestion\lib\Session;

$title="Passez commande";
//verification des erreur de session
$produitsV = [];
$totaux = 0;
if (isset($_SESSION['produitsV'])){
    //recupeeration des erreur de la session dans la variable local

    $produitsV = $_SESSION['produitsV'];
    //dd($produitsV);


}

?>

<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Liste des Produits
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>Référence</th>
                    <th>Libelle</th>
                    <th>Catégorie</th>
                    <th>Type</th>
                    <th>Prix</th>
                    <th>Stock</th>

                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Référence</th>
                    <th>Libelle</th>
                    <th>Catégorie</th>
                    <th>Type</th>
                    <th>Prix</th>
                    <th>Stock</th>



                </tr>
                </tfoot>
                <tbody>
                <?php foreach($produits as $prod): ?>
                    <tr>
                        <td><?= $prod['ref_produit'] ?></td>
                        <td><?= $prod['libelle_produit'] ?></td>
                        <td><?= $prod['libelle_categorie'] ?></td>
                        <td><?= $prod['type'] ?></td>
                        <td><?= $prod['prix'] ?></td>
                        <td><?= $prod['stock'] ?></td>

                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<button class="btn btn-warning col-12"><h1 class="text-center "> VENDRE UN PRODUIT</h1> </button>
<div class="alert alert-dismissible alert-warning text-align-center ">
    <form action="<?php path('commande/addCommande');?>" method="post" >
        <div class="form-row">

            <div class="form-group col-md-5">

                <?php $form->input("reference","form-control","text") ?>
            </div>

            <div class="form-group col-md-3">
                <?php $form->input("quantite","form-control","number") ?>
            </div>

            <div class="form-group col-md-2">
                <button type="submit"  class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </form>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">REF</th>
            <th scope="col">Libelle</th>
            <th scope="col">Prix</th>
            <th scope="col">Quantite</th>
            <th scope="col">Total</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($produitsV as $prod): ?>
            <tr>
                <th scope="row"><?= $prod['ref_produit'] ?></th>
                <td><?= $prod['libelle_produit'] ?></td>
                <td><?= $prod['prix'] ?></td>
                <td><?= $prod['quantite']?></td>
                <td><?= $prod['quantite']*$prod['prix'] ?></td>
            </tr>

            <?php
                $totaux = $totaux + ($prod['quantite']*$prod['prix']);

            ?>
        <?php endforeach; ?>
<?=$totaux?>
        </tbody>
    </table>

    <?php if(isset($_SESSION['produitsV'])):?>
    <div class="form-row">

            <div class="form-group col-md-6">

            <a href="<?php path('commande/valideCommande'); ?>"><button class="btn btn-success col-6"><h1 class="text-center "> Valider la commande</h1> </button></a>
            </div>

            <div class="form-group col-md-6">
              <a href="<?php path('commande/annulerCommande'); ?>"><button class="btn btn-danger col-6"><h1 class="text-center "> Annuler la commande</h1> </button></a>
            </div>
        </div>
   <?php endif;?>

</div>

