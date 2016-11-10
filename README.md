# @MediaPost API - Cliente PHP

## Código
### Inicialização
```php
<?php
// Autoloading
require 'vendor/autoload.php';

// Instanciando o client
$mapi = new Mapi\Client(
    '' /* $ConsumerKey */,
    '' /* $ConsumerSecret */,
    '' /* $Token */,
    '' /* $TokenSecret */
);
```

### Requisições
```php
<?php
// ...

// Requisições GET
$response = $mapi->get('url/do/recurso');

// Requisições DELETE
$response = $mapi->delete('url/do/recurso');

// Requisições POST
$response = $mapi->post('url/do/recurso', [
    'campo' => 'valor',
    'campo2' => 'valor2'
]);

// Requisições PUT
$response = $mapi->put('url/do/recurso', [
    'campo' => 'valor',
    'campo2' => 'valor2'
]);
```

### Respostas
Todas as requisições retornam um objeto do tipo `Mapi\Response`.
```php
<?php
// ...

// Retorna a quantidade de registros que o recurso pode retornar (desconsiderando a paginação)
var_dump($response->getTotalCount());

// Essa classe se comporta como um array...

// ... podendo ser iterada...
foreach ($response as $key => $value) {
    var_dump($key, $value);
}

// ... e também acessada
var_dump(count($response));
var_dump($response['key']);

// Se preferir lidar realmente com um array, basta invocar o método toArray()
$arr = $response->toArray();
```

## Credenciais
Para acessar a API, você irá precisar das quatro credenciais de acesso: _Consumer Key, Consumer Secret, Token_ e _Token Secret_.

Para requisitar esses dados, você deve entrar em contato com a equipe de Suporte, criando um chamado através de sua conta @MediaPost.

## Testes
A pasta _tests_ possui alguns arquivos para exemplificar o consumo dos recursos.

Antes de acessar algum desses testes, você precisará modificar as credenciais encontradas no arquivo _conf.php_ nessa mesma pasta.

Toda a documentação está disponível em https://www.mediapost.com.br/api/.
