<?php
$title="liste des Categorie";
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
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Référence</th>
                                            <th>Libelle</th>
                                            <th>Nombre Produits</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                <?php foreach($categories as $cat): ?>
                                        <tr>
                                            <td><?= $cat['ref'] ?></td>
                                            <td><?= $cat['libelle_categorie'] ?></td>
                                            <td>0</td>
                                        </tr>
                                <?php endforeach; ?>        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
              