@extends('base.base')



@section('content')
    <h1 class="mb-4">Ejemplo con DataTables y Select2</h1>

    <div class="mb-3">
        <label for="miSelect" class="form-label">Selecciona una opción:</label>
        <select id="miSelect" class="form-select" style="width: 100%;">
            <option value="1">Opción 1</option>
            <option value="2">Opción 2</option>
            <option value="3">Opción 3</option>
        </select>
    </div>

    <table id="miTabla" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Edad</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Juan Pérez</td>
                <td>juan@example.com</td>
                <td>30</td>
            </tr>
            <tr>
                <td>Ana Gómez</td>
                <td>ana@example.com</td>
                <td>25</td>
            </tr>
        </tbody>
    </table>
@endsection
