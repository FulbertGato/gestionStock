<?php
$title="liste des utilisateurs";
?>
           
                    <div class="container-fluid px-4">
                        
                        
                        
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Liste des utilisateurs
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Email</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Email</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                <?php foreach($users as $user): ?>
                                        <tr>
                                            <td><?= $user['nom'] ?></td>
                                            <td><?= $user['prenom'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            
                                        </tr>
                                <?php endforeach; ?>        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
              