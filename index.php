<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Carrinho de compras PHP</title>
    <style type="text/css">
        * {
          margin: 0;
          padding: 0;
          box-sizing:
          border-box;
        }
        h2.title {
            background-color:#069;
            width: 100%;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .carrinho-container {
            display: flex;
            margin-top: 10px;
        }

        .produto{
            width: 33.3%;
            padding: 0 30px;
        }

        .produto img {
            max-width: 100%;
        }

        .produto a {
            display: block;
            width: 100%;
            padding: 10px;
            color: white;
            background-color: cyan;
            text-align: center;
            text-decoration: none;
        }

        .carrinho-item {
          max-width: 1200px;
          margin: 10px auto;
        }

        .carrinho-item p{
          font-size: 19px;
          color: black;
          padding-bottom: 10px;
          border-bottom: 2px dotted #ccc;
        }
    </style>
</head>
<body>
    <h2 class="title">Carrinho com PHP</h2>
    <div class="carrinho-container">
<?php
    $items = array(['nome'=>'Curso 1','imagem'=>'item1.png', 'preco'=>'200'],
                    ['nome'=>'Curso 2','imagem'=>'item2.png', 'preco'=>'100'],
                    ['nome'=>'Curso 3','imagem'=>'item3.png', 'preco'=>'400']);

    foreach($items as $key => $value) {
?>
    <div class="produto">
        <img src="<?php echo $value['imagem'] ?>" />
        <a href="?adicionar=<?php echo $key ?>">Adicionar ao carrinho!</a>

    </div> <!-- produto -->
<?php
    }
?>
    </div> <!-- carrinho container -->

    <?php
      if(isset($_GET['adicionar'])) {
        //vamos adicionar oo carrinho
        $idProduto = (int) $_GET ['adicionar'];
        if(isset($items[$idProduto])) {
            if(isset($_SESSION['carrinho'][$idProduto])){
              $_SESSION['carrinho'][$idProduto]['quantidade']++;
            }else {
              $_SESSION['carrinho'][$idProduto] = array('quantidade' => 1,'nome'=>$items[$idProduto]['nome'],'preco'=>$items[$idProduto]['preco']);
            }
            echo '<script>alert("o item foi adiciona ao carrinho");</script>';
        } else {
          die('VOCE NAO PODE ADICIONAR UM ITEM QUE NAO EXISTE');
        }
      }
    ?>

    <h2 class="title">Carrinho:</h2>

    <?php
        foreach($_SESSION['carrinho'] as $key => $value) {
            //nome do prod
            //quantidade
            //preço
            echo '<div class="carrinho-item">';
            echo '<p>Nome: '.$value['nome'].' | Quantidade: '.$value['quantidade']. ' | Preço: R$'.($value['quantidade'] * $value['preco']).',00</p>';
            echo '</div>';
        }
    ?>

</body>
</html>
