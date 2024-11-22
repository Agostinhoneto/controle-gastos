# Controle de Gastos

Um sistema de gerenciamento financeiro pessoal que permite controlar categorias de gastos, metas financeiras, notificações de pagamentos e relatórios detalhados.

## 🚀 Recursos Principais
- **Gerenciamento de Categorias**: Adicione, edite e organize suas categorias de gastos.
- **Metas Financeiras**: Estabeleça metas para categorias específicas e acompanhe seu progresso.
- **Lembretes de Pagamento**: Receba notificações por e-mail para pagamentos próximos do vencimento.
- **Relatórios Financeiros**: Visualize gráficos e estatísticas sobre seus gastos.
- **Autenticação Segura**: Controle de acesso para usuários.

---

## 🛠️ Requisitos
- PHP 8.1 ou superior
- Composer
- MySQL ou outro banco de dados compatível
- Node.js (para gerenciamento de dependências front-end)
- Laravel 10.x
- Extensão `BCMath` habilitada
- XAMPP ou Docker (opcional, para ambiente local)

---

## 📦 Instalação

### Clonar o Repositório
```bash
git clone https://github.com/Agostinhoneto/controle-gastos.git
cd controle-gastos
----------------------------------------------------------------------------------------

Instalar Dependências PHP

composer install

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=controle_gastos
DB_USERNAME=root
DB_PASSWORD=senha


php artisan key:generate


npm install
npm run build


php artisan migrate


php artisan db:seed
