<?php
switch ($user_type) {
    case "3": //bibliotecario
        ?>
        <div class="content">
            <div class="container box">
                <section id="dashboard" class="row">
                    <div class="col-sm-12">
                        <div class="section-header text-center dashboard">
                            <h2>Dashboard</h2>
                            <div class="margin-top-5px">
                                <a class="btn btn-info btn-lg" href="/listBooks/">
                                    <i class="glyphicon glyphicon-book"></i>
                                    <br />
                                    <h3>Inventario</h3>
                                </a>

                                <a class="btn btn-info btn-lg" href="/listEditorial/">
                                    <i class="glyphicon glyphicon-tasks"></i>
                                    <br />
                                    <h3>Editoriales</h3>
                                </a>

                                <a class="btn btn-info btn-lg" href="/listaAutores/">
                                    <i class="glyphicon glyphicon-font"></i>
                                    <br />
                                    <h3>Autores</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php
        break;
    case "6": //admin
        ?>
        <div class="content">
            <div class="container box">
                <section id="dashboard" class="row">
                    <div class="col-sm-12">
                        <div class="section-header text-center dashboard">
                            <h2>Dashboard</h2>

                            <div class="margin-top-5px">
                                <a class="btn btn-info btn-lg" href="/admInformation/">
                                    <i class="glyphicon glyphicon-book"></i>
                                    <br />
                                    <h3>Informaci&oacute;n</h3>
                                </a>
                                <a class="btn btn-info btn-lg" href="/usuarios/">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <br />
                                    <h3>Usuarios</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php
        break;
}
?>
