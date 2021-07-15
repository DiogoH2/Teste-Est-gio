<?php

    include('Crud.php');


//Botão Criar Livro

if(isset($_POST['botao'])){

    CriaLivro ($_POST);

    header('location: ../Pages/index.php');

}


//Botão para Editar os livros

if(isset($_POST['botaoATT'])){

    EditarLivro ($_POST);

    header('location: ../Pages/index.php');

}



 //botão para editar a foto
 if(isset($_POST['botaoATTFOTO'])){

    attFoto($_POST);

    header('location: ../Pages/index.php');


 }


 //botão para deletar o livro
if(isset($_GET['excluirLivro'])){
    $id = $_GET['idLivro'];
        del ($id);
    
        header('location: ../Pages/index.php');
    
    }