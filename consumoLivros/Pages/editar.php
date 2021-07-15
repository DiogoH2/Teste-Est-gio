<?php

include('../CRUD/Crud.php');


?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">

    <title>Livro Selecionado</title>
  </head>
  <body>
      <div class="row">
            <section class="containerRegistro d-flex align-items-center justify-content-center flex-column offset-5">
             
                        <div class="text-center">
                            <h1>Editar Livros</h1>
                        </div> 
                        <p>Escolha a foto do livro</p>
                        <img style="height: 150px; width: 150px; border-radius: 50%;" src="../CRUD/uploads/<?php echo $registros['foto'] ?>" >
                        <br>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Atualizar foto do livro
                        </button>

                        <!-- Modal -->
                        <form action="../CRUD/Crud.php" method="POST" enctype="multipart/form-data">
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                                <div class="modal-body">
                                <input class="form-control" type="hidden" name="idLivro" id="idLivro" value="<?php echo $registros['id'] ?>">
                                <br>
                                <input type="file" name="FotoAtt" id="FotoAtt">
                                  <br>
                                  <br>
                                  <button type="submit" id="botao" name="botaoATTFOTO" class="btn btn-primary">Atualizar</button>
                                  <br>
                                </div>
                            </div>
                          </div>
                      </div>
                        </form>                        
                <form class="d-flex align-items-center justify-content-center flex-column" action="../CRUD/Crud.php" method="POST" enctype="multipart/form-data">
                        <input class="form-control" type="hidden" name="idLivro" id="idLivro" value="<?php echo $registros['id'] ?>">
                        <br>

                        <input class="form-control" type="text" name="tituloAtt" id="tituloAtt" placeholder="<?php echo $registros['titulo'] ?>" value="<?php echo $registros['titulo'] ?>">
                        <br>
                        <input class="form-control" type="text" name="autorAtt" id="autorAtt" placeholder="<?php echo $registros['autor'] ?>" value="<?php echo $registros['autor'] ?>">
                        <br>
                        <input class="form-control" type="text" name="sinopseAtt" id="sinopseAtt" placeholder="<?php echo $registros['sinopse'] ?>" value="<?php echo $registros['sinopse'] ?>">
                        <br>
                        <input class="form-control" type="text" name="ISBNAtt" id="ISBNAtt" placeholder="<?php echo $registros['ISBN'] ?>" value="<?php echo $registros['ISBN'] ?>">
                        <br>
                        <select style="width:200px;" id="tipoAtt" name="tipoAtt"><br>
                            <option selected value="<?php echo $registros['tipo'] ?>"><?php echo $registros['tipo'] ?></option>
                            <option value="0">Capa Dura</option>
                            <option value="1">Capa Cartonada</option>
                       </select>
                        <br><br>
                        <button type="submit" id="botaoATT" name="botaoATT" class="btn btn-primary ">Registrar</button>
                    <br>
                </form>
                    <br>
            </section>
      </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    
  </body>
</html>