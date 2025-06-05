@extends('base.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="alert alert-primary">
            Bienvenido al dashboard de: <strong>{{ Auth::user()->name }}</strong>
        </div>

        @if (auth()->user()->hasRole('admin'))
            <div class="alert alert-success">
                Bienvenido, administrador.
            </div>
        @endif
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

$(document).ready(function () {
        setTimeout(function () {
            $(".alert").fadeOut("slow");
        }, 2000);
    });
</script>
@endsection
