<?php
require_once 'pessoa_db.php';
require_once 'pessoa.php';

if (!empty($_REQUEST['action'])) {
    try{
    if ($_REQUEST['action'] == 'edit') {
    $id = (int) $_GET['id'];
    $pessoa = Pessoa::find($id);

    }
    else 
    if ($_REQUEST['action'] == 'save') {
    $pessoa = $_POST;
    $_POST['id'];
    Pessoa::save($pessoa);
    print "Pessoa salva com sucesso";
    }
}
catch (Exception $e) {
    print $e->getMessage();
    }
}
    else {
    $pessoa = [];
    $pessoa['id'] = '';
    $pessoa['nome'] = '';
    $pessoa['endereco'] = '';
    $pessoa['bairro'] = '';
    $pessoa['telefone'] = '';
    $pessoa['email'] = '';
}

$form = file_get_contents('Form.html');
$form = str_replace('{id}', $pessoa['id'], $form);
$form = str_replace('{nome}', $pessoa['nome'], $form);
$form = str_replace('{endereco}', $pessoa['endereco'], $form);
$form = str_replace('{bairro}', $pessoa['bairro'], $form);
$form = str_replace('{telefone}', $pessoa['telefone'], $form);
$form = str_replace('{email}', $pessoa['email'], $form);
print $form;
