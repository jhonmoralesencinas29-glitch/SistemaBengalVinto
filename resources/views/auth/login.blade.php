<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar sesión | Cantón Bengal Vinto</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background-image:
                linear-gradient(
                    rgba(0, 0, 0, 0.55),
                    rgba(0, 0, 0, 0.55)
                ),
                url('{{ asset('images/plaza.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .pagina-login {
            position: relative;
            width: 100%;
            min-height: 100vh;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .identidad {
            position: absolute;
            top: 25px;
            left: 35px;
            display: flex;
            align-items: center;
            gap: 18px;
            color: white;
        }

        .logo-canton {
            display: block;
            width: 145px;
            height: auto;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.55));
        }

        .datos-canton {
            text-align: left;
            text-shadow: 0 3px 5px rgba(0, 0, 0, 0.9);
        }

        .datos-canton h1 {
            margin: 0 0 8px;
            font-size: 24px;
            line-height: 1.1;
            white-space: nowrap;
        }

        .datos-canton p {
            margin: 4px 0;
            font-size: 15px;
            font-weight: bold;
            line-height: 1.3;
            white-space: nowrap;
        }

        .formulario-login {
            width: 100%;
            max-width: 560px;
            padding: 32px 40px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.35);
        }

        .encabezado {
            margin-bottom: 22px;
            text-align: center;
        }

        .encabezado h2 {
            margin: 0;
            color: #1552b5;
            font-size: 29px;
        }

        .error {
            margin-bottom: 16px;
            padding: 12px 15px;
            border: 1px solid #f0a7a7;
            border-radius: 6px;
            color: #a71919;
            background: #fff0f0;
            font-size: 15px;
        }

        .campo {
            margin-bottom: 16px;
        }

        .campo input {
            width: 100%;
            height: 58px;
            padding: 0 19px;
            border: 1px solid #8d99aa;
            border-radius: 10px;
            outline: none;
            color: #243247;
            background: white;
            font-size: 20px;
        }

        .campo input:focus {
            border-color: #1552b5;
            box-shadow: 0 0 0 3px rgba(21, 82, 181, 0.12);
        }

        .campo input::placeholder {
            color: #687386;
        }

        .campo-contrasena {
            position: relative;
        }

        .campo-contrasena input {
            padding-right: 60px;
            background: #edf3fc;
        }

        .ver-contrasena {
            position: absolute;
            top: 50%;
            right: 16px;
            padding: 5px;
            border: 0;
            color: #1552b5;
            background: transparent;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .ver-contrasena svg {
            display: block;
            width: 24px;
            height: 24px;
        }

        .acceder {
            width: 100%;
            height: 57px;
            border: 0;
            border-radius: 10px;
            color: white;
            background: #1c51b7;
            font-size: 21px;
            font-weight: bold;
            cursor: pointer;
        }

        .acceder:hover {
            background: #164599;
        }

        .olvido {
            margin-top: 20px;
            text-align: center;
        }

        .olvido button {
            padding: 0;
            border: 0;
            color: #1552b5;
            background: transparent;
            font-size: 17px;
            cursor: pointer;
        }

        .olvido button:hover {
            text-decoration: underline;
        }

        .mensaje-inferior {
            position: absolute;
            right: 20px;
            bottom: 22px;
            left: 20px;
            margin: 0;
            color: white;
            font-size: 19px;
            font-weight: bold;
            text-align: center;
            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.9);
        }

        @media (max-width: 950px) {
            .identidad {
                top: 20px;
                left: 25px;
            }

            .logo-canton {
                width: 115px;
            }

            .datos-canton h1 {
                font-size: 20px;
            }

            .datos-canton p {
                font-size: 13px;
            }

            .formulario-login {
                max-width: 400px;
            }
        }

        @media (max-width: 720px) {
            body {
                background-attachment: scroll;
            }

            .pagina-login {
                min-height: 100vh;
                padding: 20px;
                flex-direction: column;
                justify-content: flex-start;
            }

            .identidad {
                position: relative;
                top: auto;
                left: auto;
                width: 100%;
                margin-bottom: 24px;
                justify-content: center;
                gap: 12px;
            }

            .logo-canton {
                width: 95px;
            }

            .datos-canton h1 {
                margin-bottom: 5px;
                font-size: 17px;
            }

            .datos-canton p {
                margin: 2px 0;
                font-size: 11px;
            }

            .formulario-login {
                max-width: 500px;
                padding: 28px 24px;
            }

            .encabezado h2 {
                font-size: 25px;
            }

            .campo input {
                height: 53px;
                font-size: 18px;
            }

            .acceder {
                height: 53px;
                font-size: 19px;
            }

            .mensaje-inferior {
                position: relative;
                right: auto;
                bottom: auto;
                left: auto;
                margin-top: 25px;
                padding-bottom: 8px;
                font-size: 16px;
            }
        }

        @media (max-width: 450px) {
            .pagina-login {
                padding: 15px;
            }

            .identidad {
                justify-content: flex-start;
            }

            .logo-canton {
                width: 82px;
            }

            .datos-canton h1 {
                font-size: 15px;
                white-space: normal;
            }

            .datos-canton p {
                font-size: 10px;
                white-space: normal;
            }

            .formulario-login {
                padding: 25px 20px;
            }

            .encabezado h2 {
                font-size: 23px;
            }

            .olvido button {
                font-size: 15px;
            }

            .mensaje-inferior {
                font-size: 14px;
            }
        }

        @media (max-height: 700px) and (min-width: 721px) {
            .identidad {
                top: 12px;
            }

            .logo-canton {
                width: 100px;
            }

            .datos-canton h1 {
                font-size: 18px;
            }

            .datos-canton p {
                font-size: 12px;
            }

            .formulario-login {
                padding-top: 25px;
                padding-bottom: 25px;
            }

            .campo input {
                height: 50px;
            }

            .acceder {
                height: 50px;
            }

            .mensaje-inferior {
                bottom: 12px;
                font-size: 16px;
            }
        }

        .formulario-login {
            width: 12cm;
            min-height: 6cm;
            padding: 25px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            }

        .formulario-login > h1,
        .formulario-login > h2 {
            display: none;
            }

        .formulario-login form {
            width: 100%;
            }

        .campo input {
            height: 48px;
        }

        .acceder {
            height: 48px;
        }

        @media (max-width: 550px) {
            .formulario-login {
                width: calc(100% - 32px);
                min-height: 6cm;
                padding: 22px 20px;
            }
        }

    </style>
        
</head>

<body>
    <main class="pagina-login">
        <section class="identidad">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo del Cantón Bengal Vinto"
                class="logo-canton"
            >

            <div class="datos-canton">
                <h1>CANTÓN BENGAL VINTO</h1>
                <p>FUNDADO EL 21 DE DICIEMBRE DE 1991</p>
                <p>LEY 1268</p>
            </div>
        </section>

        <section class="formulario-login">
            <div class="encabezado">
            </div>

            @if ($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.iniciar') }}">
                @csrf

                <div class="campo">
                    <input
                        type="text"
                        id="usuario"
                        name="usuario"
                        value="{{ old('usuario') }}"
                        placeholder="Usuario"
                        autocomplete="username"
                        required
                        autofocus
                    >
                </div>

                <div class="campo campo-contrasena">
                    <input
                        type="password"
                        id="contrasena"
                        name="contrasena"
                        placeholder="Contraseña"
                        autocomplete="current-password"
                        required
                    >

                    <button
                        type="button"
                        class="ver-contrasena"
                        id="verContrasena"
                        aria-label="Mostrar contraseña"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                            <path id="lineaOjo" d="M3 3 21 21"></path>
                        </svg>
                    </button>
                </div>

                <button type="submit" class="acceder">
                    Acceder
                </button>

                <div class="olvido">
                    <button
                        type="button"
                        onclick="alert('Comuníquese con el administrador para recuperar su contraseña.')"
                    >
                        ¿Olvidó su contraseña?
                    </button>
                </div>
            </form>
        </section>

        <p class="mensaje-inferior">
            “Transparencia y unidad para el desarrollo de nuestra comunidad”
        </p>
    </main>

    <script>
        const botonVer = document.getElementById('verContrasena');
        const contrasena = document.getElementById('contrasena');
        const lineaOjo = document.getElementById('lineaOjo');

        botonVer.addEventListener('click', function () {
            if (contrasena.type === 'password') {
                contrasena.type = 'text';
                lineaOjo.style.display = 'none';
                botonVer.setAttribute('aria-label', 'Ocultar contraseña');
            } else {
                contrasena.type = 'password';
                lineaOjo.style.display = 'block';
                botonVer.setAttribute('aria-label', 'Mostrar contraseña');
            }
        });
    </script>
</body>
</html>