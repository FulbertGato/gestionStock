<?php
use gestion\lib\Session;
$title = 'Creer un compte';
$array_error=[];
if (Session::keyExist("array_error")){
    
    $array_error = Session::getSession("array_error");
    Session::destroyKey("array_error"); 
    //dd($array_error) ;
}
 
?>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Creer un compte</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="<?php path('user/register')?>">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                       <!-- <input class="form-control" id="inputFirstName" type="text" placeholder="Entrez prenom " name="prenom" />-->
                                                       <?php $form->input("prenom","form-control","text") ?>
                                                       <?php $form->label("Prénom") ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <?php $form->input("nom","form-control","text") ?>
                                                        <?php $form->label("Nom") ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                      <?php $form->input("email","form-control","email") ?>
                                                       <?php $form->label("Email") ?>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                      <?php $form->input("password","form-control","password") ?>
                                                       <?php $form->label("Mot de passe") ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                      <?php $form->input("Cpassword","form-control","password") ?>
                                                       <?php $form->label("confirmer Mot de passe") ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                
                                                <button type="submit" class="btn btn-primary btn-block" >Ajouter le compte</button>
                                                
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
              
