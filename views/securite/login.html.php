<?php
use gestion\lib\Session;
$title = 'Connexion';
$array_error=[];
if (Session::keyExist("array_error")){
    
    $array_error = Session::getSession("array_error");
    Session::destroyKey("array_error"); 
    
}
?>
<body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">connexion</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="<?php path('securite/login')?>">
                                            <?php if(isset($array_error["error_login"])): ?>
                                                <div class="alert alert-danger my-2 " role="alert">
                                                    <strong><?= $array_error["error_login"]?></strong>
                                                </div>
                                            <?php endif ?>
                                            <div class="form-floating mb-3">
                                                <?php $form->input("email","form-control","email") ?>
                                                <?php $form->label("email") ?>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <?php $form->input("password","form-control","password") ?>
                                                <?php $form->label("password") ?>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

        </div>