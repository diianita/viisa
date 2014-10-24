<div class="content">
    <div class="container box">
        <section id="managers" class="row">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <h2>Lista De libros</h2>
                    <h4>...</h4>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                        <th>Materia</th>
                        <th>Nombre</th>
                        <th>Autor</th>
                        <th>Cant. Ejemplares</th>
                        <th>Cant. en Prestamo</th>
                        <th>Acciones</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Matemáticas</td>
                                <td>Calculo I</td>
                                <td>Graciela</td>
                                <td>15</td>
                                <td>8</td>
                                <td>
                                    <button class="btn btn-success btn-xs" data-book="1" data-title="New" data-toggle="modal" data-target="#new" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button class="btn btn-primary btn-xs" data-book="1" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button class="btn btn-danger btn-xs" data-book="1" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <div class="clearfix"></div>
                    <ul class="pagination pull-right">
                        <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="modal fade" id="new" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Nuevo Ejemplar</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Código">
                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-warning btn-lg">Agregar</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>


<div class="modal fade" id="edit" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Editar Libro</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select class="form-control">
                        <option>Selecciones una materia</option>
                    </select>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Autor">
                </div>
                <div class="form-group">
                    <textarea rows="2" class="form-control" placeholder="Descripción"></textarea>
                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-warning btn-lg">Editar</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>



<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Eliminar Libro</h4>
            </div>
            <div class="modal-body">
                <div class="alert">Desea eliminar este libro?</div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-ok-sign"></span> S&iacute;</button>
                <button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-remove"></span> No</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>