<?php
function lista_pessoas() {
    $conn = mysqli_connect('localhost', 'root', '', 'pessoa');
    $result = mysqli_query($conn, "SELECT * FROM pessoa ORDER BY id");
    $list = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $list;
    }
    function exclui_pessoa($id) {
    $conn = mysqli_connect('localhost', 'root', '', 'pessoa');
    $result = mysqli_query($conn, "DELETE FROM pessoa WHERE id='{$id}'");
    mysqli_close($conn);
    return $result;
    }
    function get_next_pessoa() {
        $conn = mysqli_connect('localhost', 'root', '', 'pessoa');
        $result = mysqli_query($conn, "SELECT max(id) as next FROM pessoa");
        $next = (int) mysqli_fetch_assoc($result)['next'] +1;
        mysqli_close($conn);
        return $next;
        }
 
function get_pessoa($id) {
    $conn = mysqli_connect('localhost', 'root', '', 'pessoa');
    $result = mysqli_query($conn, "SELECT * FROM pessoa WHERE id='{$id}'");
    $pessoa = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $pessoa;
}
    function insert_pessoa($pessoa) {
    $conn = mysqli_connect('localhost', 'root', '', 'pessoa');
    $sql = "INSERT INTO pessoa(id, nome, bairro, endereco, telefone, email) VALUES ('{$pessoa['id']}','{$pessoa['nome']}','{$pessoa['bairro']}','{$pessoa['endereco']}','{$pessoa['telefone']}','{$pessoa['email']}')";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
    }
    function update_pessoa($pessoa) {
    $conn = mysqli_connect('localhost', 'root', '', 'pessoa');
    $sql = "UPDATE pessoa SET 
    Nome = '{$pessoa['nome']}',
    Endereco = '{$pessoa['endereco']}',
    Bairro = '{$pessoa['bairro']}',
    Telefone = '{$pessoa['telefone']}',
    Email = '{$pessoa['email']}'
    WHERE id = '{$pessoa['id']}'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
    }
?>