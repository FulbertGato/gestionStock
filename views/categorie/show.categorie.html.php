<?php
$title="liste des Categorie";
//dd($produits)
?>
           
                    <div class="container-fluid px-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Liste des Categorie
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Référence</th>
                                            <th>Libelle</th>
                                            <th>Nombre Produits</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Référence</th>
                                            <th>Libelle</th>
                                            <th>Nombre Produits</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                <?php if (isset($categories)) {
                                    foreach($categories as $cat): ?>
                                            <tr>
                                                <td><?= $cat['ref'] ?></td>
                                                <td><?= $cat['libelle_categorie'] ?></td>
                                                <td>
                                                    <?php

                                                    if (isset($produits)) {
                                                        if(!@array_count_values(array_column($produits, 'id_categorie'))[$cat['id_categorie']]){

                                                            echo "0";
                                                        }else{

                                                            echo array_count_values(array_column($produits, 'id_categorie'))[$cat['id_categorie']];
                                                        }
                                                    }


                                                    ?>



                                                </td>
                                                <td>

                                                    <?php if( $cat['status_categorie'] == "active"):?>

                                                    <button class="btn btn-success"><?= $cat['status_categorie'] ?></button>

                                                    <?php else:?>
                                                        <button class="btn btn-warning"><?= $cat['status_categorie'] ?></button>

                                                    <?php endif;?>


                                                </td>

                                                <td>
                                                    <?php if($cat['status_categorie'] == "active"):?>
                                                        <a href="<?php path('categorie/setStatus/'.$cat["id_categorie"]) ?>"><button class="btn btn-warning">desactiver</button></a>
                                                    <?php else:?>
                                                        <a href="<?php path('categorie/setStatus/'.$cat["id_categorie"]) ?>"><button class="btn btn-success">activer</button></a>
                                                    <?php endif;?>
                                                    <button class="btn btn-primary">Modifier</button>
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#<?= $cat['ref'] ?>">supprimer</button>
                                                </td>

                                            </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="<?= $cat['ref'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmer suppression</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Voulez vous vraiment supprimez la categorie :  <?= $cat['libelle_categorie'] ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                        <a href="<?php path('categorie/deleteCategorie/'.$cat["id_categorie"]) ?>"> <button type="button" class="btn btn-primary">Supprimer</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Fin modal -->

                                    <?php endforeach;
                                } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
              