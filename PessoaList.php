<?php
require_once 'pessoa.php';
class PessoaList {
private $html;
private $items;
public function __construct() {
$this->html = file_get_contents('list.html');
$this->items ='';
}
public function delete($param) {
try {
$id = (int) $param['id'];
Pessoa::delete($id);
}
catch (Exception $e) {
print $e->getMessage();
}
}
public function load() {
try {
$pessoas = Pessoa::all();
$items = '';
foreach ($pessoas as $pessoa) {
$item = file_get_contents('item.html');
$item = str_replace('{id}', $pessoa['id'], $item);
$item = str_replace('{nome}', $pessoa['nome'], $item);
$item = str_replace('{endereco}', $pessoa['endereco'], $item);
$item = str_replace('{bairro}', $pessoa['bairro'], $item);
$item = str_replace('{telefone}', $pessoa['telefone'], $item);
$item = str_replace('{email}', $pessoa['email'], $item);

$items.= $item;
}
$this->html = str_replace('{items}', $items, $this->html);
}
catch (Exception $e) {
print $e->getMessage();
}
}
public function show() {
$this->load();
print $this->html;

}
}
?>