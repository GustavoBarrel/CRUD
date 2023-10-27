<?php
class Pessoa {
    private static $conn;

    public static function getConnection() {
        if (empty(self::$conn)) {
            $conexao = parse_ini_file('config.ini');
            $host = $conexao['host']; // Endereço do servidor MySQL
            $usuario = $conexao['usuario'];   // Nome de usuário do MySQL
            $senha = $conexao['senha'];      // Senha do MySQL
            $banco = $conexao['banco'];// Nome do seu banco de dados        
            self::$conn = new PDO("mysql:host={$host};dbname={$banco}", $usuario, $senha);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }

    public static function save($pessoa) {
        $conn = self::getConnection();
        if (empty($pessoa['id'])) {
            $result = $conn->query("SELECT max(id) as next FROM pessoa");
            $row = $result->fetch();
            $pessoa['id'] = (int) $row['next'] + 1;
            $sql = "INSERT INTO pessoa(id, nome, bairro, endereco, telefone, email) VALUES (:id, :nome, :bairro, :endereco, :telefone, :email)";
        } else {
            $sql = "UPDATE pessoa SET 
                    nome = :nome,
                    endereco = :endereco,
                    bairro = :bairro,
                    telefone = :telefone,
                    email = :email
                    WHERE id = :id";
        }
        $result = $conn->prepare($sql);
        $result->execute([
            ':id' => $pessoa['id'],
            ':nome' => $pessoa['nome'],
            ':endereco' => $pessoa['endereco'],
            ':bairro' => $pessoa['bairro'],
            ':telefone' => $pessoa['telefone'],
            ':email' => $pessoa['email']
        ]);
        return $pessoa;
    }

    public static function find($id) {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT * FROM pessoa WHERE id=:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function delete($id) {
        $conn = self::getConnection();
        $stmt = $conn->prepare("DELETE FROM pessoa WHERE id=:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return "Dado excluído com sucesso";
    }

    public static function all() {
        $conn = self::getConnection();
        $stmt = $conn->query("SELECT * FROM pessoa ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
