<?php
$title="Mon compte";
$user= \gestion\lib\Session::getSession ("user_connect");
?>


<br/><br/>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mx-auto">
                <img class="card-img-top mx-auto" style="width:60%;" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">Mes information</h4>
                    <p class="card-text"><i class="fa fa-user">&nbsp;</i><?= " ".$user['nom']." ".$user['prenom']?></p>
                    <p class="card-text"><i class="fa fa-user">&nbsp;</i>Role</p>
                    <p class="card-text">Last Login : xxxx-xx-xx</p>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="jumbotron" style="width:100%;height:100%;">
                <h1>Welcome Admin,</h1>
                <div class="row">
                    <div class="col-sm-6">
                        <iframe src="http://free.timeanddate.com/clock/i616j2aa/n1993/szw160/szh160/cf100/hnce1ead6" frameborder="0" width="160" height="160"></iframe>

                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">New Orders</h4>
                                <p class="card-text">Here you can make invoices and create new orders</p>
                                <a href="#" class="btn btn-primary">New Orders</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<p></p>
<p></p>




