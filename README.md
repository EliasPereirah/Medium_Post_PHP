# Exemplo pegando seu ID de usuário
```php
<?php
require_once __DIR__.'/config.php';
require_once __DIR__."/vendor/autoload.php";
$Medium = new App\Medium();
$medium_token = ''; // seu medium token -- pegue seu token aqui: https://medium.com/me/settings/security
$my_user_id = $Medium->getMyUserID($medium_token);
// use o código acima apenas uma vez para obter seu ID de usuário do medium
// depois poderá armazená-lo em algum lugar, em config.php ou variável de ambiente
echo "Meu ID de usuário é $my_user_id";
?>
```



# Exemplo fazendo uma postagem
```php
<?php
require_once __DIR__.'/config.php';
require_once __DIR__."/vendor/autoload.php";
$Medium = new App\Medium();
$content = "conteúdo em html ou texto puro aqui";
$title = "Seu título aqui";
$url = "url do conteúdo original aqui"; // ficará como canonical no Medium -- em caso de repostagem de conteúdo de outro blog
$tags = ['exemplo','outro']; // tags
$status = $Medium->post($title, $content, $tags, $url);
if($status){
    echo "Postado com sucesso";
}else{
    echo "Houve um erro ao publicar";
}
?>
```
