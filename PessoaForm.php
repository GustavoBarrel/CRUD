<?php
require_once 'Pessoa.php';
class PessoaForm {
private $html;
private $data;
public function __construct() {
$this->html = file_get_contents('Form.html');
$this->data = ['id' => null, 'nome' => null, 'endereco' => null, 'bairro' => null, 'telefone' => null, 'email' => null]; // Falta o ponto e vírgula aqui
}
    public function edit($param) {
        try {
            $id = (int) $param['id'];
            $pessoa = Pessoa::find($id);
            $this->data = $pessoa;
        }
        catch (Exception $e) {
        print $e->getMessage();
            }
}
public function save($param) {
    try {
    
    $this->data = Pessoa::save($param);
    print "Pessoa salva com sucesso";
    
    }
    catch (Exception $e) {
    print $e->getMessage();
    }
}
public function show(){
$this->html = str_replace('{id}', $this->data['id'], $this->html);
$this->html = str_replace('{nome}', $this->data['nome'], $this->html);
$this->html = str_replace('{endereco}', $this->data['endereco'], $this->html);
$this->html = str_replace('{bairro}', $this->data['bairro'], $this->html);
$this->html = str_replace('{telefone}', $this->data['telefone'], $this->html);
$this->html = str_replace('{email}', $this->data['email'], $this->html);
print $this->html;
 if 
}
}
?>