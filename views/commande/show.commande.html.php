<?php
$title="Liste des commandes";

?>

<div class="container-fluid px-4">

    <div class="row mt-5">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                    <div class="card-body">Nombre total de ventes</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h1><?=count($commandes)?></h1>
                    </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Produits Physique</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1><?=$phy?></h1>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Produits Virtuelles</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1><?=$virtu?></h1>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">Vente Total</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1><?= $totaux ?> CFA</h1>
                </div>
            </div>
        </div>
    </div>




    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Liste des Commande
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>Référence</th>
                    <th>Libelle</th>
                    <th>Date commande</th>
                    <th>Quantite</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Référence</th>
                    <th>Libelle</th>
                    <th>Date commande</th>
                    <th>Quantite</th>
                    <th>Total</th>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach($commandes as $prod): ?>
                    <tr>
                        <td><?= $prod['ref_commande'] ?></td>
                        <td><?= $prod['libelle_produit'] ?></td>
                        <td><?= $prod['date'] ?></td>
                        <td><?= $prod['quantite'] ?></td>
                        <td><?= $prod['total'] ?></td>
                        
                    </tr>
                    
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
