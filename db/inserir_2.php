<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="titulo">Inserir Registro #2</div>


<?php
if(count($_POST) > 0){
    $dados = $_POST;
    $erros = [];



    //validação do nome
    if(trim($dados['nome']) === ""){
        $erros['nome'] = "Nome é obrigatório";
    }
    //validação de data
    if(isset($dados['nascimento'])){
        $data = DateTime::createFromFormat('d/m/Y',$dados['nascimento']);
        if(!$data){
            $erros['nascimento'] =  "A data deve estar no formato padrão dd/mm/aaaa";
        }
    }
    //validação de email
    if(!filter_var($dados['email'],FILTER_VALIDATE_EMAIL)){
        $erros['email'] =  "Email inválido";
    }

    //validação de site
    if(!filter_var($dados['site'],FILTER_VALIDATE_URL)){
        $erros['site'] =  "Site inválido";
    }

    $filhosConfig = [
        "options" => ["min_range"=>0, "max_range"=>20]
    ];
    
    //validação de filhos
    if(!filter_var($dados['filhos'],FILTER_VALIDATE_INT, $filhosConfig) && $dados['filhos'] != 0 ){
        $erros['filhos'] =  "Quantidade de filhos inválida (0 à 20)";
    }

    $salarioConfig = ['options'=>['decimal'=>',']];

    //validação de salário
    if(!filter_var($dados['salario'],FILTER_VALIDATE_FLOAT,$salarioConfig)){
        $erros['salario'] =  "Salário em formato inválido";
    }

    if(!count($erros)){
        require_once "conexao.php";
        $sql = 'INSERT INTO cadastro
        (nome,nascimento,email,site,filhos,salario)
        VALUES (?,?,?,?,?,?)
        ';

        $conexao = novaConexao();
        mysqli_select_db($conexao,"primeiro_banco");
        $statement = $conexao->prepare($sql);

        $params = [
            $dados['nome'],
            $data ? $data->format('Y-m-d') : null,
            $dados['email'],
            $dados['site'],
            $dados['filhos'],
            $dados['salario']
        ];

        $statement->bind_param("ssssid",...$params);

        if($statement->execute()){
            unset($dados);
        }
    }

}
?>


<form action="#" method="post">
    <div class="form-row">
        <div class="form-group col-md-9">
            <label for="nome">Nome</label>
            <input type="text" class="form-control <?= $erros['nome'] ? 'is-invalid' : '' ?>" id="nome" name="nome" placeholder="Nome" value="<?= $dados['nome'] ?>"> 
            <div class="invalid-feedback"> 
                <?= $erros['nome'] ?> 
            </div>
        </div>    
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="nascimento">Nascimento</label>
            <input type="text" class="form-control <?= $erros['nascimento'] ? 'is-invalid' : '' ?>" id="nascimento" name="nascimento" placeholder="Nascimento" value="<?= $dados['nascimento'] ?>"> 
            <div class="invalid-feedback"> 
                <?= $erros['nascimento'] ?> 
            </div>
        </div>    
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email">E-mail</label>
            <input type="text" class="form-control  <?= $erros['email'] ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="E-mail" value="<?= $dados['email'] ?>"> 
            <div class="invalid-feedback"> 
                <?= $erros['email'] ?> 
            </div>
        </div>    
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="site">Site</label>
            <input type="text" class="form-control  <?= $erros['site'] ? 'is-invalid' : '' ?>" id="site" name="site" placeholder="Site" value="<?= $dados['site'] ?>"> 
            <div class="invalid-feedback"> 
                <?= $erros['site'] ?> 
            </div>
        </div>    
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="filhos">Quantidade de filhos</label>
            <input type="text" class="form-control  <?= $erros['filhos'] ? 'is-invalid' : '' ?>" id="filhos" name="filhos" placeholder="Quantidade de filhos" value="<?= $dados['filhos'] ?>"> 
            <div class="invalid-feedback"> 
                <?= $erros['filhos'] ?> 
            </div>
        </div>    
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="salario">Salário</label>
            <input type="text" class="form-control <?= $erros['salario'] ? 'is-invalid' : '' ?>" id="salario" name="salario" placeholder="Salário" value="<?= $dados['salario'] ?>"> 
            <div class="invalid-feedback"> 
                <?= $erros['salario'] ?> 
            </div>
        </div>    
    </div>

    <button class="btn btn-primary btn-lg">Enviar</button>
</form>