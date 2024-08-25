@include('layouts.topo')
@extends('layout')
@extends('layout')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="card-body">
        <ul class="list-group">
            <div class="table-responsive">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Contatos</h3>
                    </div>
                    <section class="content">
                        <div class="card">
                            <div class="card-body row">
                                <div class="col-5 text-center d-flex align-items-center justify-content-center">
                                    <div class="">
                                        <h2><strong>Sistemas de Controle de Gastos</strong></h2>
                                        <p class="lead mb-5">Monte Santo - Bahia<br>
                                            Telefone: 75 999291-5575
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('contatos.store') }}" method="POST">
                                        <div class="form-group">
                                            <label for="inputName">Nome</label>
                                            <input type="text" id="inputName" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">E-Mail</label>
                                            <input type="email" id="inputEmail" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSubject">Assunto</label>
                                            <input type="text" id="inputSubject" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputMessage">Mensagem</label>
                                            <textarea id="inputMessage" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" value="Enviar">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </ul>
    </div>
</div>
@include('layouts.footer')

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>