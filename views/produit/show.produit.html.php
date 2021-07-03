<?php
$title="Liste des Produits";


?>

<div class="container-fluid px-4">

    <div class="row mt-5">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                    <div class="card-body">Produits disponible</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h1><?=count($produits)-$nbre_pupture?></h1>
                    </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Produits Physique</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1><?= $nbre_physique?></h1>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Produits Virtuelles</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1><?= $nbre_virtuelle?></h1>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Produit en rupture</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1><?= $nbre_pupture?></h1>
                </div>
            </div>
        </div>
    </div>




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
