@extends('base.base')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <hr>
                <div class="table-rep-plugin">
                    <div class="mb-0" data-pattern="priority-columns">
                        <table class="table table-bordered table-striped" id="tabla_usuarios">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Juan Pérez</td>
                                    <td>juan@example.com</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Editar</button>
                                        <button class="btn btn-sm btn-danger">Eliminar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Ana Gómez</td>
                                    <td>ana@example.com</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Editar</button>
                                        <button class="btn btn-sm btn-danger">Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Formulario de Usuario</h3>
        <div class="card-body">
            <form class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" required>
                    <div class="invalid-feedback">
                        Por favor, ingresa un nombre válido.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" required>
                    <div class="invalid-feedback">
                        Por favor, ingresa un email válido.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
</div>
<script>
    window.addEventListener("load", function () {
        
        var t = document.getElementsByClassName("needs-validation");
        Array.prototype.filter.call(t, function (e) {
            e.addEventListener("submit", function (t) {
                !1 === e.checkValidity() && (t.preventDefault(), t.stopPropagation()), e.classList.add("was-validated");
            }, !1);
        });
    }, !1);
    $(document).ready(function() {
        $('#tabla_usuarios').DataTable({
        autoWidth: false,
        paging: true,
        ordering: true,
        // language: dataTableEs,
        "pagingType": "full_numbers",
            "lengthMenu": [
                [50, 100, 500, -1],
                [50, 100, 500, "Todos"]
            ],
        responsive: {
            details: {
                type: 'inline',
            }
        },
        buttons: [
            {
                extend: 'copy',
                text: 'Copiar',
                exportOptions: {
                    columns: [0, 1 ]
                },
            },
            {
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                    columns: [0, 1]
                },
                title: '',
            },
            
        ],
        
    }).buttons().container().appendTo("#tabla_usuarios_wrapper .col-md-6:eq(0)");
});
</script>
    @endsection