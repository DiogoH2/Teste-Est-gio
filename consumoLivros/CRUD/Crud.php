<?php
    include('Classes/Class.Conexao.php');
    include('Classes/Class.Crud.php');

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

    
    if($file["error"]){
        throw new Exception("erro: ".$file["error"]);

    }

    $dirUploads = "uploads";

    if(!is_dir($dirUploads)){
        mkdir($dirUploads);
    }


    
    if(move_uploaded_file($file["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $file["name"])){


    Crud::setTabela('livros');
    Crud::insert(['titulo' => $titulo, 'autor' => $autor, 'sinopse' => $sinopse, 'ISBN'=> $ISBN, 'tipo'=> $tipo, 'foto' =>$file["name"]]);
}else{
    throw new Exception("não foi possivel realizar o upload");
   }
    
   header('location: ../Pages/index.php');
}
//Botão Criar Livro

if(isset($_POST['botao'])){

    CriaLivro ($_POST);

    header('location: ../Pages/index.php');

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




    Crud::setTabela('livros');
    Crud::update(['titulo' => $titulo, 'autor' => $autor, 'sinopse' => $sinopse, 'ISBN'=> $ISBN, 'tipo'=> $tipo],['id' => $id]);

    
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
    Crud::delete(['id'=> $id]);

}

//botão para deletar o livro
if(isset($_GET['excluirLivro'])){
$id = $_GET['idLivro'];
    del ($id);

    header('location: ../Pages/index.php');

}

