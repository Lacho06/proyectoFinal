@props(['title' => 'Nombre', 'class' => '', 'url' => '', 'imageName' => 'Imagen de la obra'])
<style>
    .my-card{
        width: 300px;
        height: 300px;
    }
</style>
<div class="my-card card {{ $class }}">
    <div class="card-body">
        <img src="{{ $url }}" alt="{{ $imageName }}">
    </div>
    <div class="card-footer">
        <h3>{{ $title }}</h3>
    </div>
</div>
