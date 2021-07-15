
<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>HOME</title>
</head>

<body>
    <header class="text-center">
        <h1 class="titulo">Livraria-SR<h1>
    </header>
    <hr>
    <article class="row">    
                                
                        <div class="containerRegistro d-flex align-items-center justify-content-around offset-2">
                            <form class="d-flex align-items-center justify-content-center flex-column" action="../CRUD/Controller.php" method="POST" enctype="multipart/form-data">
                                <div>
                                    <h1>Registrar Livros</h1>
                                </div>
                                <input class="form-control" type="text" name="titulo" id="titulo" placeholder="Insira o título do livro">
                                <br>
                                <input class="form-control" type="text" name="autor" id="autor" placeholder="Insira o nome do autor do livro">
                                <br>
                                <input class="form-control" type="text" name="sinopse" id="sinopse" placeholder="Insira a sinopse  do livro">
                                <br>
                                <input class="form-control" type="text" name="ISBN" id="ISBN" placeholder="Insira o código ISBN do livro">
                                <br>
                                <select style="width:200px;" id="tipo" name="tipo"><br>
                                    <option selected>Tipo de capa</option>
                                    <option value="0">Capa Dura</option>
                                    <option value="1">Capa Cartonada</option>
                                </select>
                                <br>
                                <p>Escolha a foto do livro</p>

                                <input type="file" name="Foto" id="Foto">
                                <br>
                                <button type="submit" id="botao" name="botao" class="btn btn-primary">Registrar</button>
                                <br>
                            </form>
                            <br>
                        </div>
                    <br>
                    <div class=" d-flex flex-column align-items-center justify-content-center  offset-5">
                        <div class="text-center">
                            <h2>Livros Registrados</h2>
                        </div> 

                        <?php

                        function ler()
                        {
                            include_once('../CRUD/Classes/Class.Conexao.php');
                            $conn = Conexao::getConexao();
                            $pdo = 'SELECT * FROM livros';
                            $result = $conn->query($pdo);
                            return $result->fetchall(PDO::FETCH_ASSOC);
                        }
                       
                            $registro = ler();
                        
                        


                        foreach ($registro as $registros) {
                        ?>
                        <br>
                            <form class='d-flex flex-column align-items-center' action='editar.php' method="GET">
                            
                                <div class='livros-get'>


                                    <img src='../Crud/uploads/<?php echo $registros['foto'] ?>' width="80px;" height="80px;">


                                    <p class="infoLivro">Titulo: <?php echo $registros['titulo'] ?></p>

                                    <p class="infoLivro">Autor: <?php echo $registros['autor'] ?></p>

                                    <p class="infoLivro">Sinopse: <?php echo $registros['sinopse'] ?></p>

                                    <p class="infoLivro">Tipo Capa: <?php echo $registros['tipo'] ?></p>

                                    <p class="infoLivro">Código ISBN do Livro: <?php echo $registros['ISBN'] ?></p>

                                    <input type='hidden' name='idLivro' id='idLivro' value='<?php echo $registros['id'] ?>'>


                                    <div >
                                        <button class="btn btn-dark" type='submit' name='editarLivro'>Editar Livro</button>

                                        <button class="btn btn-dark" type='submit' name='excluirLivro'> Excluir livro</button>
                                    </div>
                                </div>
                                <br>
                            </form>


                        <?php
                        }


                        ?>
                    </div>
    </article>
</body>

</html>