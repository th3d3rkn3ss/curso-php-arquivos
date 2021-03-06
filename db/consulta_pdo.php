<div class="titulo">PDO CONSULTA</div>

<?php
require_once "conexao_pdo.php";

$conexao = novaConexao();
$sql = "SELECT * FROM cadastro";
$resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
 

print_r($resultado);


echo "<hr>";

$sql = "SELECT * FROM cadastro LIMIT :qtde OFFSET :inicio";

$stmt = $conexao->prepare($sql);
$stmt->bindValue(':qtde',2,PDO::PARAM_INT);
$stmt->bindValue(':inicio',0,PDO::PARAM_INT);

if($stmt->execute()){
    $resultado = $stmt->fetchAll();
    print_r($resultado);
}else{
    echo "Código: " . $stmt->errorCode() . "<br>";
    print_r($stmt->errorInfo());
}


echo "<hr>";

$sql = "SELECT * FROM cadastro WHERE id = :id ";
$stmt = $conexao->prepare($sql);
$stmt->bindValue(':id',2,PDO::PARAM_INT);
//if($stmt->execute([2])){
if($stmt->execute()){
    $resultado = $stmt->fetchAll();
    print_r($resultado);
}else{
    echo "Código: " . $stmt->errorCode() . "<br>";
    print_r($stmt->errorInfo());
}


$conexao = null;     //fecha conexao 