@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header">
                <h4 class="modal-title">Criar Usuários</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Corpo do Modal -->
            <div class="modal-body">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <br>
                            <form class="form" method="POST" action="{{ route('users.store') }}">
                                @csrf
                                <div class="col col-8">
                                    <label for="descricao">Nome:</label>
                                    <input type="text" class="form-control" name="name" id="descricao" required placeholder="Nome">
                                </div>
                                <br>
                                <div class="col col-8">
                                    <label for="valor">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email" required placeholder="Email">
                                </div>
                                <br>
                                <div class="col col-6">
                                    <label for="data_pagamento">Senha:</label>
                                    <input type="password" class="form-control" name="password" id="password" required placeholder="Senha">
                                </div>
                                <br>
                                <div class="col col-2">
                                    <button class="btn btn-primary mt-2">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Rodapé do Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- /.card-header -->