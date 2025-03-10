@include('layouts.topo')
@extends('layout')
@include('mensagem', ['mensagem' => $mensagem])

<style>
    .card-header {
        font-weight: bold;
        font-size: 1.2rem;
    }

    .btn {
        margin-right: 5px;
    }

    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }
</style>

<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')

    <div class="container my-4">
        <div class="card mb-4">
            <div class="card-header" style="background-color: #e0a800; color: white;">Adicionar Novo Usuário</div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nome *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">E-mail *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Senha *</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            function togglePasswordVisibility() {
                                var passwordField = document.getElementById('password');
                                var passwordFieldType = passwordField.getAttribute('type');
                                if (passwordFieldType === 'password') {
                                    passwordField.setAttribute('type', 'text');
                                } else {
                                    passwordField.setAttribute('type', 'password');
                                }
                            }
                        </script>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Repetir Senha *</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordConfirmationVisibility()">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            function togglePasswordConfirmationVisibility() {
                                var passwordField = document.getElementById('password_confirmation');
                                var passwordFieldType = passwordField.getAttribute('type');
                                if (passwordFieldType === 'password') {
                                    passwordField.setAttribute('type', 'text');
                                } else {
                                    passwordField.setAttribute('type', 'password');
                                }
                            }
                        </script>


                        <div class="col-md-6 mb-3">
                            <label for="is_admin">Administrador?</label>
                            <select name="is_admin" id="is_admin" class="form-control" required>
                                <option value="0" {{ old('is_admin') == 0 ? 'selected' : '' }}>Não</option>
                                <option value="1" {{ old('is_admin') == 1 ? 'selected' : '' }}>Sim</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cargo_id" class="form-label fw-bold">Cargo *</label>
                            <select name="cargo_id" id="cargo_id" class="form-control" required>
                                <option value="" selected disabled>Selecione um cargo</option>
                                @foreach($cargos as $cargo)
                                <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-danger mb-3">* Campos obrigatórios</div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-secondary text-white">Lista de Usuários</div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Administrador</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_admin ? 'Sim' : 'Não' }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este usuário?')">
                                        <i class="fas fa-trash-alt"></i> Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#permissions').select2({
            placeholder: "Selecione as permissões",
            allowClear: true,
            width: '100%'
        });
    });
</script>