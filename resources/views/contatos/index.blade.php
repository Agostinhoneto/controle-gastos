@include('layouts.topo')
@extends('layout')

<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')

    <div class="container my-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Contatos</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-center d-flex align-items-center justify-content-center">
                        <div>
                            <h2><strong>Sistema de Controle de Gastos</strong></h2>
                            <p class="lead mb-4">Monte Santo - Bahia<br>Telefone: (75) 99929-15575</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('contatos.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="inputName">Nome</label>
                                <input type="text" name="name" id="inputName" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">E-mail</label>
                                <input type="email" name="email" id="inputEmail" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="inputSubject">Assunto</label>
                                <input type="text" name="subject" id="inputSubject" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="inputMessage">Mensagem</label>
                                <textarea name="message" id="inputMessage" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

<!-- Scripts -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
