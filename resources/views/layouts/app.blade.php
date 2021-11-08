<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SAPERE') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/production.dist.min.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <script src='https://meet.jit.si/external_api.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Styles -->
    <link href="{{ asset('css/production.dist.min.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>

</head>
<body>
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <?php $permissao_usuario = Auth::user()->permissao;
    ?>
    <div id="app">
        @include('componentes.header', [$permissao_usuario])
        <main class="py-4" style="margin-top: 5%">
            @yield('content')
        </main>

        @if(session('mensagem'))
            @include('componentes.mensagem') 
        @endif

        <!-- <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-copy-right">
                            <p>Copyright © <?= (new DateTime())->format('Y');?>. Todos os direitos reservados</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
</body>
</html>