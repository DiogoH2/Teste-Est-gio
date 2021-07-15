<?php
    include('Classes/Class.Conexao.php');
    include('Classes/Class.Crud.php');

    Error_reporting (0);
//Função para ler os livros

    $codigo = $_GET['idLivro'];



      function read(&$codigo){

       
        
        include_once('Classes/Class.Conexao.php');
        $conexao = Conexao::getConexao();
    
        $pdo = "SELECT * FROM livros WHERE id = '$codigo' ";
        $result = $conexao->query($pdo);
        return $result->fetchall(PDO::FETCH_ASSOC);
    }
    
    
    
      $registro = read($codigo);
    
      $html = ' ';
      foreach ($registro as $registros){
          $html .= "
                      {$registros['foto']}
                      {$registros['id']}
                      {$registros['sinopse']}
                      
          ";
      }

 //Função para editar os Livros

function editarLivro(){
    $conexao = Conexao::getConexao();
    Crud::setConexao($conexao);
    $id = (isset($_POST['idLivro'])) ? $_POST['idLivro'] : '';
    $titulo = (isset($_POST['tituloAtt'])) ? $_POST['tituloAtt'] : '';
    $autor = (isset($_POST['autorAtt'])) ? $_POST['autorAtt'] : '';
    $sinopse = (isset($_POST['sinopseAtt'])) ? $_POST['sinopseAtt'] : '';
    $ISBN = (isset($_POST['ISBNAtt'])) ? $_POST['ISBNAtt'] : '';
    $tipo = (isset($_POST['tipoAtt'])) ? $_POST['tipoAtt'] : '';


    if(is_numeric($titulo)){
        http_response_code(406);
        echo "<script>alert('Coloque um titulo valido');</script>";
        echo "<script>window.location = '../Pages/index.php'</script>";
        exit;
    }

    if(is_numeric($autor)){
        http_response_code(406);
        echo "<script>alert('Coloque um autor valido');</script>";
        echo "<script>window.location = '../Pages/index.php'</script>";
        exit;
    }

    if(is_numeric($sinopse)){
        http_response_code(406);
        echo "<script>alert('Coloque uma sinopse valida');</script>";
        echo "<script>window.location = '../Pages/index.php'</script>";
        exit;
    }

    if(!is_numeric($tipo)){
        http_response_code(406);
        echo "<script>alert('Coloque um codigo valido');</script>";
        echo "<script>window.location = '../Pages/index.php'</script>";
        exit;
    }



    Crud::setTabela('livros');
    $pegaLivro =  Crud::select('SELECT * FROM livros WHERE titulo = :titulo', ['titulo' => $titulo], true);

    if(!$pegaLivro){

         Crud::update(['titulo' => $titulo, 'autor' => $autor, 'sinopse' => $sinopse, 'ISBN'=> $ISBN, 'tipo'=> $tipo],['id' => $id]);
         header('location: ../Pages/index.php');
    }
 else{
    echo "<script>alert('Nome já cadastrado!!');</script>";
    echo "<script>window.location = '../Pages/index.php'</script>";
    exit;
 }

    
   header('location: ../Pages/index.php');
}

//Botão para Editar os livros

if(isset($_POST['botaoATT'])){

    EditarLivro ($_POST);

    header('location: ../Pages/index.php');

}

//Função para editar foto
function attFoto (){
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $conexao = Conexao::getConexao();
        Crud::setConexao($conexao);
     $id = (isset($_POST['idLivro'])) ? $_POST['idLivro'] : '';
     $file = $_FILES["FotoAtt"];
 
        if($file["error"]){
            throw new Exception("erro: ".$file["error"]);
 
        }
 
        $dirUploads = "uploads";
 
        if(!is_dir($dirUploads)){
            mkdir($dirUploads);
        }
 
        if(move_uploaded_file($file["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $file["name"])){
 
            Crud::setTabela('livros');
            Crud::update(['foto' => $file["name"]],['id' => $id]);
         
 
        }else{
         throw new Exception("não foi possivel realizar o upload");
        }
    }
 }


 //botão para editar a foto
 if(isset($_POST['botaoATTFOTO'])){

    attFoto($_POST);

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

    