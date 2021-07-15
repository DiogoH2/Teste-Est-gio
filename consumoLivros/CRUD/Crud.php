<?php
    include('Classes/Class.Conexao.php');
    include('Classes/Class.Crud.php');

    
//Função para criar Novo Livro
function CriaLivro(){

    $conexao = Conexao::getConexao();
    Crud::setConexao($conexao);
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : '';
    $autor = (isset($_POST['autor'])) ? $_POST['autor'] : '';
    $sinopse = (isset($_POST['sinopse'])) ? $_POST['sinopse'] : '';
    $ISBN = (isset($_POST['ISBN'])) ? $_POST['ISBN'] : '';
    $tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
    $file = $_FILES['Foto'];

    if(is_numeric($titulo)){
        http_response_code(406);
        echo json_encode(['mensagem' => 'coloque um titulo valido']);
        exit;
    }

    if(is_numeric($autor)){
        http_response_code(406);
        echo json_encode(['mensagem' => 'coloque um autor valido']);
        exit;
    }

    if(is_numeric($sinopse)){
        http_response_code(406);
        echo json_encode(['mensagem' => 'coloque uma sinopse valida']);
        exit;
    }

    if(!is_numeric($ISBN)){
        http_response_code(406);
        echo json_encode(['mensagem' => 'coloque um codigo valido']);
        exit;
    }

    
    if($file["error"]){
        throw new Exception("erro: ".$file["error"]);

    }

    $dirUploads = "uploads";

    if(!is_dir($dirUploads)){
        mkdir($dirUploads);
    }


    
    if(move_uploaded_file($file["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $file["name"])){


    Crud::setTabela('livros');
        $pegaLivro =  Crud::select('SELECT * FROM livros WHERE titulo = :titulo', ['titulo' => $titulo], true);

        if(!$pegaLivro){

            Crud::insert(['titulo' => $titulo, 'autor' => $autor, 'sinopse' => $sinopse, 'ISBN'=> $ISBN, 'tipo'=> $tipo, 'foto' =>$file["name"]]);
           header('location: ../Pages/index.php');
        }
     else{
        echo "<script>alert('Nome já cadastrado!!');</script>";
        echo "<script>window.location = '../Pages/index.php'</script>";
        exit;
     }

}else{
    throw new Exception("não foi possivel realizar o upload");
    exit;
   }
    
   header('location: ../Pages/index.php');
}
//Botão Criar Livro

if(isset($_POST['botao'])){

    CriaLivro ($_POST);

    header('location: ../Pages/index.php');

}



 //Função para deletar livro
function del (&$id){


    include_once('Classes/Class.Conexao.php');
    $conexao = Conexao::getConexao();
    Crud::setConexao($conexao);

    Crud::setTabela('livros');
    $retorno = Crud::delete(['id'=> $id]);

    if($retorno){
        echo "<script>alert('Deletado com sucesso!!');</script>";
        echo "<script>window.location = '../Pages/index.php'</script>";
        exit;
    }else{
        echo "<script>alert('Erro interno!!');</script>";
        echo "<script>window.location = '../Pages/index.php'</script>";
        exit;
    }

}

//botão para deletar o livro
if(isset($_GET['excluirLivro'])){
$id = $_GET['idLivro'];
    del ($id);

    header('location: ../Pages/index.php');

}

