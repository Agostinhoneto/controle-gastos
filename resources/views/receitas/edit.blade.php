<div class="container mt-5">
    <h2>Editar Receitas</h2>
    <form method="post" action="{{route('receitas.update',$receitas)}}">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $receitas->descricao }}">
        </div>
        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="text" class="form-control" id="valor" name="valor" value="{{ $receitas->valor }}">
        </div>
        <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
            <label for="status">Status:</label>
            <select class="form-control" name="status" id="status">
                <option value="1" @if (old('active')==1) selected @endif>Ativo</option>
                <option value="0" @if (old('active')==0) selected @endif>Inativo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="data_recebimento">Data do Pagamento:</label>
            <input type="text" class="form-control" id="data_recebimento" name="data_recebimento" value="{{$receitas->data_recebimento}}">
        </div>
        <br>
        <div class="col col-6">
            <label for="categoria_id">Categoria:</label>
            <select name="categoria_id" id="categoria_id" class="form-control">
                <option>Selecione...</option>
                @foreach($categorias as $c)
                <option value="{{ $c->id }}">{{ $c->descricao }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
