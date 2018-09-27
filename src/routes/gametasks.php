<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

/*   [Modulo jogos] */

$app->get('/api/listaJogos', function(Request $request, Response $response){
    $sql = "SELECT * FROM jogos";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->query($sql);
        if ($resultado->rowCount() > 0) {
            $jogos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($jogos);
        }else{ echo json_encode("Nenhum jogo encontrado"); }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){ echo '{"error" : {"text":'.$e->getMessage().'}'; }
});

$app->put('/api/atualizaJogo/{id}', function(Request $request, Response $response){
    $id_jogo            = $request->getAttribute('id');
    $nome               = $request->getParam('nome');
    $sinopse            = $request->getParam('sinopse');
    $image_url          = $request->getParam('image_url');
    $meta_critic_rank   = $request->getParam('meta_critic_rank');
    $produtora          = $request->getParam('produtora');
    $desenvolvedora     = $request->getParam('desenvolvedora');
  
    
    $sql = "UPDATE jogos SET 
            nome                = :nome,
            sinopse             = :sinopse,
            image_url           = :image_url,
            meta_critic_rank    = :meta_critic_rank,
            produtora           = :produtora,
            desenvolvedora      = :desenvolvedora
            WHERE id = $id_jogo";
     try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);
        $resultado->bindParam(':nome', $nome);
        $resultado->bindParam(':sinopse', $sinopse);
        $resultado->bindParam(':image_url', $image_url);
        $resultado->bindParam(':meta_critic_rank', $meta_critic_rank);
        $resultado->bindParam(':produtora', $produtora);
        $resultado->bindParam(':desenvolvedora', $desenvolvedora);

        $resultado->execute();
        echo json_encode("Jogo modificado com sucesso!");

        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});
$app->post('/api/novoJogo', function(Request $request, Response $response){
    $nome               = $request->getParam('nome');
    $sinopse            = $request->getParam('sinopse');
    $image_url          = $request->getParam('image_url');
    $meta_critic_rank   = $request->getParam('meta_critic_rank');
    $produtora          = $request->getParam('produtora');
    $desenvolvedora     = $request->getParam('desenvolvedora');
  
    
      $sql = "INSERT INTO jogos (nome, sinopse, image_url, meta_critic_rank, produtora, desenvolvedora) 
              VALUES (:nome, :sinopse, :image_url, :meta_critic_rank, :produtora, :desenvolvedora)";
      try{
          $db = new db();
          $db = $db->connectDB();
          $resultado = $db->prepare($sql);
          $resultado->bindParam(':nome', $nome);
          $resultado->bindParam(':sinopse', $sinopse);
          $resultado->bindParam(':image_url', $image_url);
          $resultado->bindParam(':meta_critic_rank', $meta_critic_rank);
          $resultado->bindParam(':produtora', $produtora);
          $resultado->bindParam(':desenvolvedora', $desenvolvedora);  
          $resultado->execute();
          echo json_encode("Novo Jogo adicionado");
  
          $resultado = null;
          $db = null;
      }catch(PDOException $e){
          echo '{"error" : {"text":'.$e->getMessage().'}';
      }
});

$app->get('/api/verJogo/{id}', function(Request $request, Response $response){
    $id_jogo            = $request->getAttribute('id');
    $sql = "SELECT * FROM jogos WHERE id = $id_jogo";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->query($sql);
        if ($resultado->rowCount() > 0) {
            $jogos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($jogos);
        }else{ echo json_encode("Nenhum jogo encontrado"); }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){ echo '{"error" : {"text":'.$e->getMessage().'}'; }
});

$app->delete('/api/deletaJogo/{id}', function(Request $request, Response $response){
    $id_jogo = $request->getAttribute('id');

    $sql = "DELETE FROM jogos  WHERE id = $id_jogo";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);
        $resultado->execute();
      if($resultado->rowCount() > 0 ){
          echo json_encode("Jogo  deletado");
      }else{
          echo json_encode("Jogo id invalido");
      }
      
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});



/*    [Modulo jogos FIM] */


/*  [Modulo plataformas] */

$app->get('/api/listaPlataformas', function(Request $request, Response $response){
    echo json_encode("Lista Plataforma");
});

$app->get('/api/atualizaPlataforma/{id}', function(Request $request, Response $response){
    echo json_encode("atualiza Plataforma");
});

$app->get('/api/deletaPlataforma/{id}', function(Request $request, Response $response){
    echo json_encode("Deleta Plataforma");
});

$app->get('/api/novaPlataforma', function(Request $request, Response $response){
    echo json_encode("Novo Plataforma");
});

$app->get('/api/verPlataforma/{id}', function(Request $request, Response $response){
    echo json_encode("ver Plataforma");
});

/*    [Modulo plataformas FIM] */