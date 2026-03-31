Mars Project - API de Inventário
Este projeto é um sistema de gestão de stock robusto desenvolvido em Laravel 10/11, focado em segurança de dados através de Triggers SQL e autenticação Sanctum.

 Tecnologias Utilizadas
Backend: Laravel (PHP 8.2+)

Base de Dados: MySQL (com Triggers para integridade de stock)

Autenticação: Laravel Sanctum (Bearer Tokens)

Testes: Thunder Client / Postman

 Configuração Rápida
Instalar dependências: composer install

Configurar .env: Copia o .env.example e configura a tua base de dados.

Gerar chave: php artisan key:generate

Migrar e Seed:

Bash
php artisan migrate:fresh --seed
Fluxo de Autenticação (API)
Para testar no Thunder Client, deves garantir o seguinte Header em todas as requisições:

Key: Accept | Value: application/json

1. Registo de Utilizador
URL: POST /api/register

JSON:

JSON
{
  "name": "Admin Mars",
  "email": "admin@mars.com",
  "password": "password123",
  "password_confirmation": "password123"
}
2. Login (Obter Token)
URL: POST /api/login

JSON:

JSON
{
  "email": "admin@mars.com",
  "password": "password123"
}
Nota: Copia o access_token da resposta para usar nos passos seguintes (Aba Auth -> Bearer).

Gestão de Produtos
Listar Todos os Produtos
URL: GET /api/products

Auth: Bearer Token

Ver Produto Específico
URL: GET /api/products/{id}

Movimentações de Stock (Trigger Automático)
Esta API utiliza um Trigger SQL que atualiza o campo stock da tabela products automaticamente sempre que um movimento é registado.

Criar Movimento (Entrada ou Saída)
URL: POST /api/stock-movements

Auth: Bearer Token

JSON:

JSON
{
  "product_id": 1,
  "quantity": 25,
  "type": "entrada"
}
Tipos aceites: entrada (soma ao stock) ou saida (subtrai ao stock).

End-Points

Categorias (/api/categories)
GET /api/categories → Lista todas as categorias.

POST /api/categories → Cria uma nova categoria.

Body: {"name": "Ferramentas", "description": "Uso em Marte"}

GET /api/categories/{id} 

PUT /api/categories/{id} 

DELETE /api/categories/{id} 

Produtos (/api/products)
GET /api/products 

POST /api/products 

GET /api/products/{id} - Detalhe do produto e stock atual.

PUT /api/products/{id} -Edita preço, nome ou categoria.

DELETE /api/products/{id} 

Movimentos (/api/stock-movements)
GET /api/stock-movements 

POST /api/stock-movements 

GET /api/stock-movements/{id} 
