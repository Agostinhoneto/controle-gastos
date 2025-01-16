@if ($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
    <strong class="font-bold">Erro(s):</strong>
    <ul class="mt-2">
        @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header bg-blue-600 text-white">
                <h5 class="modal-title" id="modalTitle">Criar Receitas</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Corpo do Modal -->
            <div class="modal-body">
                <form method="POST" action="{{ route('receitas.store') }}" class="space-y-4">
                    @csrf

                    <!-- Descrição -->
                    <div>
                        <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição:</label>
                        <input type="text" name="descricao" id="descricao" 
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                            placeholder="Descrição" required>
                    </div>

                    <!-- Valor -->
                    <div>
                        <label for="valor" class="block text-sm font-medium text-gray-700">Valor:</label>
                        <input type="number" name="valor" id="valor" step="0.01" min="0.01"
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                            placeholder="Valor $$" required>
                    </div>

                    <!-- Data de Recebimento -->
                    <div>
                        <label for="data_recebimento" class="block text-sm font-medium text-gray-700">Data do Recebimento:</label>
                        <input type="date" name="data_recebimento" id="data_recebimento" 
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                            required>
                    </div>

                    <!-- Categoria -->
                    <div>
                        <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoria:</label>
                        <select name="categoria_id" id="categoria_id" 
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                            required>
                            <option value="">Selecione...</option>
                            @foreach($categorias as $c)
                                <option value="{{ $c->id }}">{{ $c->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                        <select name="status" id="status" 
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Selecione...</option>
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>

                    <!-- Botões -->
                    <div class="flex justify-end space-x-4">
                        <button type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400" data-dismiss="modal">
                            Fechar
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
