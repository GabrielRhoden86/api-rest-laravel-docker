<h1>API Rest para Cadastro de Fornecedores</h1>

<p>Esta API permite o cadastro de fornecedores, permitindo a busca por CNPJ ou CPF, utilizando Laravel no backend.</p>

<h2>CRUD de Fornecedores</h2>

<p>Através do padrão de projeto Repository, utilizando a interface <code>FornecedoresRepositoryInterface.php</code> e o repositório <code>FornecedoresRepository.php</code>, é possível atingir modularidade e escalabilidade na aplicação. Isso permite uma separação clara entre a lógica de negócios e a lógica de acesso a dados, facilitando a manutenção e a expansão do sistema.</p>

<h2>Estrutura do Projeto</h2>

<pre>
app/
├── Providers/
│   └── RepositoryServiceProvider.php
|
├── Repositories/
|   |
│   |── BuscarDados/
│   |  └── BuscaDadosRepository.php
|   |
│   ├── Fornecedores/
│   │   └── FornecedoresRepository.php
|   |
│   ├── Interfaces/
│   │   ├── FornecedoresRepositoryInterface.php
│   │   └── BuscaDadosRepositoryInterface.php
</pre>

<h2>Configuração .ENV:</h2>
<pre><code>
 DB_CONNECTION=mysql
 DB_HOST=mysql-db
 DB_PORT=3306
 DB_DATABASE=controle_fornecedor
 DB_USERNAME=root
 DB_PASSWORD=root
</code></pre>

<h2>Deploy via Docker</h2>

<p>Após baixar o projeto do repositório (GitHub), execute os seguintes comandos para configurar o ambiente Docker:</p>

<pre><code>docker-compose up --build -d</code></pre>

<p>Esse comando cria e inicializa os containers definidos no arquivo <code>docker-compose.yml</code>, construindo a imagem necessária para a aplicação.</p>

<h3>Realizar as Migrations no Container</h3>

<p>Após iniciar os containers, execute as migrations para criar as tabelas no banco de dados:</p>

<pre><code>php artisan migrate</code></pre>

<h3>Seeders</h3>

<p>Execute os seeders para criar dados fictícios de fornecedores para testes:</p>

<pre><code>php artisan db:seed</code></pre>

<p>Isso vai popular o banco de dados com registros de fornecedores utilizando os seeders definidos no projeto.</p>


<small>* Talvez seja necessário executar o comando abaixo para garantir que o servidor web possa acessar o diretório storage:</small>
 <pre> chown -R www-data:www-data /var/www/html/teste-dev-php/storage </pre>


<h2>Testando API</h2>
<small>Validações realizadas via Postman.</small>

<h3><strong>Criar Fornecedor:</strong></h3>
<p>Permite o cadastro de fornecedores usando CNPJ ou CPF, incluindo informações como nome/nome da empresa, contato, endereço, etc. Valida a integridade e o formato dos dados, como o formato correto de CNPJ/CPF e a obrigatoriedade de campos.</p>

<p><strong>POST:</strong> http://127.0.0.1:8000/api/fornecedores</p>

<pre><code>
{
    "nome": "Gabriel Rhoden",
    "tipo_documento": "CPF",
    "contato": "41 991169014",
    "documento": "064.780.799-29",
    "endereco": "Alto da XV"
}
</code></pre>

<h3><strong>Editar Fornecedor:</strong></h3>
<p>Facilita a atualização das informações de fornecedores, mantendo a validação dos dados.</p>

<p><strong>PATCH:</strong> http://127.0.0.1:8000/api/fornecedores/{id}</p>

<pre><code>
{
    "nome": "1235",
    "tipo_documento": "CPF",
    "contato": "41 991169014",
    "documento": "064.780.799-18",
    "endereco": "Leonardo Javorski"
}
</code></pre>

<h3><strong>Excluir Fornecedor:</strong></h3>
<p>Possibilita a remoção segura de fornecedores.</p>

<p><strong>DELETE:</strong> http://127.0.0.1:8000/api/fornecedores/{id}</p>

<hr>

<h3><strong>Listar Fornecedores:</strong></h3>
<p>Apresenta uma lista paginada de fornecedores, com filtragem e ordenação.</p>

<h4><strong>Listar todos fornecedores:</strong></h4>

<p><strong>Sem filtro:</strong> http://127.0.0.1:8000/api/fornecedores</p>

<h4><strong>Incluindo filtros para pesquisa:</strong></h4>

<pre><code>http://127.0.0.1:8000/api/fornecedores?nome=a&tipo_documento=CNPJ&orderBy=nome&sort=desc&perPage=10&page=3</code></pre>

<ul>
  <li><strong>nome</strong></li>
  <li><strong>documento</strong></li>
  <li><strong>tipo_documento</strong></li>
  <li><strong>orderBy</strong> (ordenar por)</li>
  <li><strong>sort</strong> (ascendente ou descendente)</li>
  <li><strong>page</strong> paginação ex page=3</li>
  <li><strong>perPage</strong> (quantidade de registros por página)</li>
</ul>

<h4><strong>Busca empresa via CNPJ:</strong></h4>
<p><strong>CNPJ TESTE:</strong> http://127.0.0.1:8000/api/consulta/{CNPJ}</p>

<h3><strong>Validação de Dados e Segurança</strong></h3>
<p>Foi utilizado o Request para validar os dados de entrada:</p>

<ul>
  <li><strong>app\Http\Requests\FornecedorRequestCreate.php:</strong> Validação e formatação dos dados na criação (create).</li>
  <li><strong>app\Http\Requests\FornecedorRequestUpdate.php:</strong> Validação dos dados antes da alteração (update).</li>
  <li><strong>app\Http\Requests\FornecedorRequest.php:</strong> Validação e formatação dos dados na listagem dos fornecedores.</li>
  <li><strong>app\Http\Requests\BuscaCnpjRequest.php:</strong> Validação dos parâmetros e formatação para realizar a busca no CNPJ.</li>
</ul>

<p>Exemplo de validação e formatação exigida dos dados de entrada:</p>

<pre><code>
return [
    'nome' => 'nullable|string|max:40',
    'tipo_documento' => 'nullable|string|in:CPF,CNPJ',
    'contato' => 'nullable|string|max:25',
    'documento' => 'nullable|string|max:18',
    'endereco' => 'nullable|string|max:255',
    'page' => 'nullable|integer|min:1|max:100',
    'orderBy' => 'nullable|string|in:id,nome,tipo_documento,documento,endereco',
    'sort' => 'nullable|string|in:asc,desc',
    'perPage' => 'nullable|integer|min:1|max:100',
];
</code></pre>

<h3><strong>Rate Limiting</strong></h3>
<p>Utilizamos Rate Limiting para evitar ataques DDoS. Abaixo estão as rotas protegidas:</p>

<pre><code>
Route::middleware(['throttle:60,1'])->group(function () {
    Route::post('/fornecedores', [FornecedorController::class, 'create']);
    Route::get('/fornecedores', [FornecedorController::class, 'read']);
    Route::patch('/fornecedores/{id}', [FornecedorController::class, 'update']);
    Route::delete('/fornecedores/{id}', [FornecedorController::class, 'deleteItem']);
    Route::get('/consulta/{cnpj}', [BuscaCnpjController::class, 'buscaCnpj']);
});


</code></pre>
<h2>Testes Unitários (PHPUnit)</h2>

<p>Para realizar os testes unitários de todos os método, utilize o comando abaixo:</p>
<pre><code>
  php artisan test --testsuite=Unit
</code></pre>

<p>Para realizar os testes por método:</p>
<pre><code>
  php artisan test --filter "FornecedorRepositoryTest::test_remove" --testsuite=Unit
</code></pre>

<small>* No método 'test_remove', é necessário ajustar o ID em cada teste de exclusão para evitar erros devido à inexistência do ID. </small>
<small>* No método 'test_generate', assegure-se de gerar um novo número de documento a cada execução.</small>

<h3><strong>test_generate:</strong></h3>
<p>Verifica se a criação de um fornecedor funciona corretamente. Confirma se o fornecedor é salvo com os dados fornecidos e se existe no banco.</p>

<h3><strong>test_get_all:</strong></h3>
<p>Testa a listagem de fornecedores com paginação e filtros. Verifica se os resultados são paginados e contêm o fornecedor esperado.</p>

<h3><strong>test_modify:</strong></h3>
<p>Testa a atualização de um fornecedor existente. Verifica se os dados são atualizados corretamente no banco de dados.</p>

<h3><strong>test_remove:</strong></h3>
<p>Testa a remoção de um fornecedor. Verifica se o fornecedor foi removido corretamente do banco de dados.</p>

<p>Esses testes garantem que as operações de CRUD (Criar, Ler, Atualizar, Deletar) estão funcionando como esperado.</p>



--TESTE 01
