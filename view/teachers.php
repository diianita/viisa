<?php
include 'headerBiblioteca.php';

Page::loadClass("Docente");
$cl_docente = new Docente();

$docentes = $cl_docente->getDocentes();
?>

<div class="content">
    <div class="container box">
        <section id="managers" class="row">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <h2>Docentes de la Instituci&oacute;n</h2>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <?php
                    foreach ($docentes as $key => $value) {
                        $img = Page::$site_url;
                        $img .= ($value['foto'] != null)? $value['foto']: "sources/images/user.png";
                        
                        ?>
                        <div class="col-md-2">
                            <div class="speaker caja">
                                <div class="speaker-info">
                                    <div class="speaker-photo">
                                        <img src="<?php echo $img;?>" alt="Tony Gallippi">
                                    </div>
                                </div>
                                <h4><?php echo ucwords($value['nombre']." ".$value['apellido']); ?></h4>
                                <h5><?php echo ucwords($value['descripcion']); ?></h5>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

        </section>
        <div id="gotop" class="gotop fa fa-arrow-up"></div>
    </div>
</div>


