@if(session('sucesso'))
<div class="alert alert-success">
    {{session('sucesso')}}
</div>
@endif

@if(session('erro'))
<div class="alert alert-danger">
    {{session('erro')}}
</div>
@endif