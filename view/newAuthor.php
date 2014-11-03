<?php

include 'headerBiblioteca.php';
?>
<div class="content">
    <div class="container box">
        <section id="adm-information" class="row">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <legend><h2>Agregar Autor</h2></legend>
                </div>
            </div>
            <div class="col-sm-12" style="padding-top: 50px">
                <div class="row">
                    <div class="col-md-6">
                        <div class="well">
                            <form class="form-horizontal form-crear-author" role="form" id="form-crear-author" onsubmit="return false">
                                
                                <div class="form-group" style="margin-top: 20px">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <input class="form-control nombre" type="text" placeholder="Nombre Autor" name="nombre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <button type="submit" class="btn btn-primary pull-right btn-crear-author">Crear</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-offset-2 col-md-4">
                        <img src="../sources/images/books.png">
                    </div>
                </div>
            </div>
        </section>
        <div id="gotop" class="gotop fa fa-arrow-up"></div>
    </div>
</div>