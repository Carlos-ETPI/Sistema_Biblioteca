
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    @role('admin')
                        <div class="sb-sidenav-menu-heading">Gestion de usuarios</div>
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Usuarios
                        </a>
                        <a class="nav-link" href="{{ route('admin.rol.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                            Roles
                        </a>
                        <a class="nav-link" href="{{ route('admin.permissions.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                            Permisos
                        </a>
                    @endrole
                    <div class="sb-sidenav-menu-heading">Acciones</div>
                        <a class="nav-link" href="{{ route('register') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                            Registrar Usuario
                        </a>
                        <a class="nav-link" href="{{ route('ejemplares.disponibles') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                            Registrar Prestamo
                        </a>
                        <a class="nav-link" href="{{ route('usuarios.prestamos') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                            Procesar Prestamo
                        </a>
                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Prueba
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="#">Static Navigation</a>
                            <a class="nav-link" href="#">Light Sidenav</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Pages
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                Authentication
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#">Login</a>
                                    <a class="nav-link" href="#">Register</a>
                                    <a class="nav-link" href="#">Forgot Password</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                Error
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#">401 Page</a>
                                    <a class="nav-link" href="#">404 Page</a>
                                    <a class="nav-link" href="#">500 Page</a>
                                </nav>
                            </div>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading"></div>
                    
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Inicio sesion como: {{ Auth::user()->name }}</div>
                Librarium
            </div>
        </nav>
    </div>
</div>
