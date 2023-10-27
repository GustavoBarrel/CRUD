<?php
spl_autoload_register(function($class) {
    if (file_exists($class . '.php')) {
        require_once $class . '.php';
    }
});

$classe = isset($_REQUEST['class']) ? $_REQUEST['class'] : 'PessoaList';
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';

if (class_exists($classe)) {
    $pagina = new $classe($_REQUEST);

    // Verifica se o método é especificado e existe na classe, se não, redireciona para o método padrão
    if (!empty($method) && method_exists($classe, $method)) {
        $pagina->$method($_REQUEST);
        $pagina->show();

    } else {
        // Redireciona para o método 'show' da classe
        $pagina->show();
    }
} else {
    // Se a classe não existir, redireciona para uma página de erro ou mostra uma mensagem de erro
    echo "Classe não encontrada: $classe";
}
?>
