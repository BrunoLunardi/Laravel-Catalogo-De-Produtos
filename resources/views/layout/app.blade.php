<!-- Layout padrão para as views do projeto -->
<html>
    <head>
        <!-- Espaço marcado para ser substituido (title) -->
        <title>Olá Mundo - @yield('title')</title>
        {{Html::style('css/bootstrap.min.css')}}
        {{Html::style('css/bootstrap-theme.min.css')}}
    </head>

    <body>
        <div class="container">
        <!-- Espaço marcado para ser substituido (content) -->
            @yield('content')
        </div>
        {{Html::script('js/jquery-3.4.1.min.js')}}
        {{Html::script('js/bootstrap.min.js')}}


    </body>
</html>