<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="titulo">Formulário</div>

<h2>Cadastro</h2>

<?php
if(count($_POST) > 0){
    //validação do nome
    if(!filter_input(INPUT_POST,"nome")){
        echo "Nome é obrigatório" , '<br>';
    }
    //validação de data
    if(!filter_input(INPUT_POST,"nascimento")){
        $data = DateTime::createFromFormat('d/m/Y',$_POST['nascimento']);
        if(!$data){
            echo "A data deve estar no formato padrão dd/mm/aaaa", '<br>';
        }
    }
    //validação de email
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        echo "Email inválido", '<br>';
    }

    //validação de site
    if(!filter_var($_POST['site'],FILTER_VALIDATE_URL)){
        echo "Site inválido", '<br>';
    }

    $filhosConfig = [
        "options" => ["min_range"=>0, "max_range"=>20]
    ];
    
    //validação de filhos
    if(!filter_var($_POST['filhos'],FILTER_VALIDATE_INT, $filhosConfig) && $_POST['filhos'] != 0 ){
        echo "Quantidade de filhos inválida";
    }

    $salarioConfig = ['options'=>['decimal'=>',']];

    //validação de salário
    if(!filter_var($_POST['salario'],FILTER_VALIDATE_FLOAT,$salarioConfig)){
        echo "Salário em formato inválido";
    }
}
?>



<form action="#" method="post">
    <div class="form-row">
        <div class="form-group col-md-9">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?= $_POST['nome'] ?>"> 
        </div>    
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="nascimento">Nascimento</label>
            <input type="text" class="form-control" id="nascimento" name="nascimento" placeholder="Nascimento" value="<?= $_POST['nascimento'] ?>"> 
        </div>    
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email">E-mail</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" value="<?= $_POST['email'] ?>"> 
        </div>    
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="site">Site</label>
            <input type="text" class="form-control" id="site" name="site" placeholder="Site" value="<?= $_POST['site'] ?>"> 
        </div>    
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="filhos">Quantidade de filhos</label>
            <input type="text" class="form-control" id="filhos" name="filhos" placeholder="Quantidade de filhos" value="<?= $_POST['filhos'] ?>"> 
        </div>    
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="salario">Salário</label>
            <input type="text" class="form-control" id="salario" name="salario" placeholder="Salário" value="<?= $_POST['salario'] ?>"> 
        </div>    
    </div>

    <button class="btn btn-primary btn-lg">Enviar</button>
</form>