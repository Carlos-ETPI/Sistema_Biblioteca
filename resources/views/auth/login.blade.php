<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login - SB Admin</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- SB Admin Styles -->
    <link href="https://cdn.jsdelivr.net/gh/StartBootstrap/startbootstrap-sb-admin@7.0.7/dist/css/styles.css" rel="stylesheet" />
</head>
<body style="background-image: url('{{ asset('image/login.jpg') }}'); background-size: cover; background-position: center;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Iniciar Sesion</h3></div>
                                <div class="card-body">
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com" />
                                            <label for="email">Correo Electronico</label>
                                        </div>
                                        @if ($errors->has('email'))
                                            <div style="color: red; font-size: 14px; margin-bottom: 1rem;">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="password" type="password" name="password" required placeholder="Password" />
                                            <label for="password">Contraseña</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="remember" name="remember" type="checkbox" />
                                            <label class="form-check-label" for="remember">Recordar Contraseña</label>
                                        </div>
                                        

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">
                                                {{ __('¿Olvidaste tu contraseña?') }}
                                            </a>
                                        @endif
                                            <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Biblioteca 2025</div>
                        <div>
                            <a href="#"></a>
                            &middot;
                            <a href="#"></a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
