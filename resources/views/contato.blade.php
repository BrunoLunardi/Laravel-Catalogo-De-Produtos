<!-- invoca o arquivo /resources/views/layout/app.blade.php -->
@extends('layout.app')
<!-- usa a seção title de /resources/views/layout/app.blade.php -->
@section('title', $titulo)
<!-- usa a seção content de /resources/views/layout/app.blade.php -->
@section('content')

<h1>Contato</h1>

<!-- Form para enviar dados para enviar email -->
{{Form::open(['url'=>['contato/enviar']])}}

<div class="row">

    <div class="col-lg-12">

        {{Form::label('assunto', "Assunto")}}
        {{Form::text('assunto', "", ['class'=>'form-control', 'required',
            'placeholder'=>'Assunto'])}}
        {{Form::label('mensagem', "Mensagem")}}
        {{Form::textarea('mensagem', "", ['class'=>'form-control', 'required',
            'placeholder'=>'Mensagem'])}}
        {{Form::submit('Enviar mensagem', ['class'=>'btn btn-default'])}}

    </div>

</div>

{{Form::close()}}

@endsection