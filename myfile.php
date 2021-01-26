<?php include "index.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    

    <title>Document</title>
</head>
<body>
    <nav class="nav border-dark border-bottom ">
        <a class="nav-link" href="#">Ínicio</a>
        <a class="nav-link" href="#">Historico</a>
        
      </nav>
    <div class="container-fluid  b mt-3">
        <div class="row">
            <div class="col-4 w-25">
            <form method="post" action="">
                <select class="form-select form-select-sm"  name="categorias" id="categorias" aria-label="Default select example">
                    <?php 
                    $myClass = new wallpaperscraftBot();
                    $categ=$myClass->buscarCategorias();
                    foreach ($categ as $key => $value ) {
                        if (empty($value) || !trim($value)) {
                            unset($aCategorias[$key]);
                            continue;
                        } 
                        $finalValue=preg_replace('/\s+/', '', $value);
                        echo"<option value=\"$finalValue\">$finalValue</option>";              
                                              
                    }//foreach
                    
                    ?>
                  </select>
                    <input type="submit" value="Submit">
                  </form>
            </div>
            <!-- LISTA IMAGENS-->
            <div class="col-8">
                <div class="card" style="width: 18rem;">
                    <?php
                    
                    $categ1=$myClass->buscarImagensPorCategoria();
                    echo "AQUI -><br>";
                    var_dump($categ1);
                    //var_dump($categ);

                   foreach ($categ1 as $key => $value) {
                       
                            echo $value;
                    ?>
                    <img src="<?php echo $value; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary btn-sm">Large button</button>
                    </div>
                    <?php  }?>
                  </div>
            </div>
            
          </div>
      </div>
      
      
    
</body>
</html>