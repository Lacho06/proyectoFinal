@props(['title' => 'Titulo', 'btnText' => 'Login', 'link' => ''])
<style>
    a{
        text-decoration: none;
        color: white;
        font-weight: 600;
    }
    .my-nav{
        margin: 0 0 20px;
        padding: 10px;
        background: #202A62;
        display: flex;
        justify-content: space-between;
    }
    .my-h2{
        font-size: 1.6em;
        font-weight: 700;
        color: white;
        letter-spacing: 2px;
        text-decoration: none;
        display: inline;
    }
    .my-h2:hover{
        color: white;
    }
    .my-btn{
        border-radius: 5px;
        padding: 5px 10px;
        background: linear-gradient(45deg, hsla(120, 100%, 70%, .7) 70%, hsla(120, 100%, 80%, .8)) !important;
    }
    .my-btn:hover{
        background: linear-gradient(45deg, hsla(120, 70%, 70%, .7) 70%, hsla(120, 40%, 80%, .8)) !important;
    }
</style>
<nav class="my-nav">
    <h2 class="my-h2">{{ $title }}</h2>
    @if ($btnText == 'Login')
        <a href="{{ $link }}" class="btn my-btn">Log in</a>
    @else
        <a href="{{ $link }}" class="btn btn-danger">Log out</a>
    @endif
</nav>
