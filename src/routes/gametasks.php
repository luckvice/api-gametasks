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
    $sql = "SELECT * FROM plataformas";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->query($sql);
        if ($resultado->rowCount() > 0) {
            $plataformas = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($plataformas);
        }else{ echo json_encode("Nenhuma plataforma encontrada"); }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){ echo '{"error" : {"text":'.$e->getMessage().'}'; }
});

$app->put('/api/atualizaPlataforma/{id}', function(Request $request, Response $response){
    $id_plataforma      = $request->getAttribute('id');
    $pl_name            = $request->getParam('pl_name');

    $sql = "UPDATE plataformas SET 
            pl_name  = :pl_name
            WHERE id = $id_plataforma";
     try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);
        $resultado->bindParam(':pl_name', $pl_name);
        $resultado->execute();
        echo json_encode("Plataforma modificada com sucesso!");

        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

$app->delete('/api/deletaPlataforma/{id}', function(Request $request, Response $response){
    $id_plataforma = $request->getAttribute('id');

    $sql = "DELETE FROM plataformas  WHERE id = $id_plataforma";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);
        $resultado->execute();
      if($resultado->rowCount() > 0 ){
          echo json_encode("Plataforma  deletada!");
      }else{
          echo json_encode("Plataforma id invalido");
      }
      
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

$app->post('/api/novaPlataforma', function(Request $request, Response $response){
    $pl_name = $request->getParam('pl_name');
  
    
      $sql = "INSERT INTO plataformas (pl_name) 
              VALUES (:pl_name)";
      try{
          $db = new db();
          $db = $db->connectDB();
          $resultado = $db->prepare($sql);
          $resultado->bindParam(':pl_name', $pl_name);
          $resultado->execute();
          echo json_encode("Nova plataforma adicionada com sucesso!");
  
          $resultado = null;
          $db = null;
      }catch(PDOException $e){
          echo '{"error" : {"text":'.$e->getMessage().'}';
      }
});

$app->get('/api/verPlataforma/{id}', function(Request $request, Response $response){
    $id_plataforma = $request->getAttribute('id');
    $sql = "SELECT * FROM plataformas WHERE id = $id_plataforma";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->query($sql);
        if ($resultado->rowCount() > 0) {
            $plataformas = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($plataformas);
        }else{ echo json_encode("Nenhum jogo encontrado"); }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){ echo '{"error" : {"text":'.$e->getMessage().'}'; }
});

/*    [Modulo plataformas FIM] */



/*  [Modulo generos] */

$app->get('/api/listaGeneros', function(Request $request, Response $response){
    $sql = "SELECT * FROM generos";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->query($sql);
        if ($resultado->rowCount() > 0) {
            $generos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($generos);
        }else{ echo json_encode("Nenhum genero encontrado"); }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){ echo '{"error" : {"text":'.$e->getMessage().'}'; }
});

$app->put('/api/atualizaGenero/{id}', function(Request $request, Response $response){
    $id_genero      = $request->getAttribute('id');
    $gnr_name       = $request->getParam('gnr_name');

    $sql = "UPDATE generos SET 
            gnr_name  = :gnr_name
            WHERE id = $id_genero";
     try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);
        $resultado->bindParam(':gnr_name', $gnr_name);
        $resultado->execute();
        echo json_encode("Genero modificado com sucesso!");

        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

$app->delete('/api/deletaGenero/{id}', function(Request $request, Response $response){
    $id_genero = $request->getAttribute('id');

    $sql = "DELETE FROM generos  WHERE id = $id_genero";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);
        $resultado->execute();
      if($resultado->rowCount() > 0 ){
          echo json_encode("Genero  deletado!");
      }else{
          echo json_encode("Genero id invalido");
      }
      
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

$app->post('/api/novoGenero', function(Request $request, Response $response){
    $gnr_name = $request->getParam('gnr_name');
  
    
      $sql = "INSERT INTO generos (gnr_name) 
              VALUES (:gnr_name)";
      try{
          $db = new db();
          $db = $db->connectDB();
          $resultado = $db->prepare($sql);
          $resultado->bindParam(':gnr_name', $gnr_name);
          $resultado->execute();
          echo json_encode("Novo genero adicionado com sucesso!");
  
          $resultado = null;
          $db = null;
      }catch(PDOException $e){
          echo '{"error" : {"text":'.$e->getMessage().'}';
      }
});

$app->get('/api/verGenero/{id}', function(Request $request, Response $response){
    $id_genero = $request->getAttribute('id');
    $sql = "SELECT * FROM generos WHERE id = $id_genero";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->query($sql);
        if ($resultado->rowCount() > 0) {
            $plataformas = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($plataformas);
        }else{ echo json_encode("Nenhum Genero encontrado"); }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){ echo '{"error" : {"text":'.$e->getMessage().'}'; }
});

/*    [Modulo generos FIM] */



/*  [Modulo usuario] */

$app->get('/api/listaUsuarios', function(Request $request, Response $response){
    $sql = "SELECT * FROM usuario";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->query($sql);
        if ($resultado->rowCount() > 0) {
            $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($usuarios);
        }else{ echo json_encode("Nenhum usuario encontrado"); }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){ echo '{"error" : {"text":'.$e->getMessage().'}'; }
});

$app->put('/api/atualizaUsuario/{id}', function(Request $request, Response $response){
    $id_usuario     = $request->getAttribute('id');
    $nome           = $request->getParam('nome');
    $genero         = $request->getParam('genero');
    $dt_nasc        = $request->getParam('dt_nasc');
    $senha          = $request->getParam('senha');
    $email          = $request->getParam('email');
    $nickname       = $request->getParam('nickname');
    $steam_profile  = $request->getParam('steam_profile');
    $psn_profile    = $request->getParam('psn_profile');
    $live_profile   = $request->getParam('live_profile');

    $sql = "UPDATE usuario SET 
            nome            = :nome, 
            genero          = :genero,
            dt_nasc         = :dt_nasc,
            senha           = :senha, 
            email           = :email, 
            nickname        = :nickname, 
            steam_profile   = :steam_profile, 
            psn_profile     = :psn_profile, 
            live_profile    = :live_profile
            WHERE id = $id_usuario";
     try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);
        $resultado->bindParam(':nome', $nome);
        $resultado->bindParam(':genero', $genero);
        $resultado->bindParam(':dt_nasc', $dt_nasc);
        $resultado->bindParam(':senha', $senha);
        $resultado->bindParam(':email', $email);
        $resultado->bindParam(':nickname', $nickname);
        $resultado->bindParam(':steam_profile', $steam_profile);
        $resultado->bindParam(':psn_profile', $psn_profile);
        $resultado->bindParam(':live_profile', $live_profile);
        $resultado->execute();
        if($resultado->rowCount() > 0 ){
            echo json_encode("Usuario  modificado com sucesso!");
        }else{
            echo json_encode("Usuario id invalido");
        }

        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

$app->delete('/api/deletaUsuario/{id}', function(Request $request, Response $response){
    $id_usuario = $request->getAttribute('id');

    $sql = "DELETE FROM usuario  WHERE id = $id_usuario";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);
        $resultado->execute();
      if($resultado->rowCount() > 0 ){
          echo json_encode("Usuario  deletado!");
      }else{
          echo json_encode("Usuario id invalido");
      }
      
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

$app->post('/api/novoUsuario', function(Request $request, Response $response){
    $nome           = $request->getParam('nome');
    $genero         = $request->getParam('genero');
    $dt_nasc          = $request->getParam('dt_nasc');
    $senha          = $request->getParam('senha');
    $email          = $request->getParam('email');
    $nickname       = $request->getParam('nickname');
    $steam_profile  = $request->getParam('steam_profile');
    $psn_profile    = $request->getParam('psn_profile');
    $live_profile   = $request->getParam('live_profile');
  
    
      $sql = "INSERT INTO usuario (nome,genero,dt_nasc,senha,email,nickname,steam_profile,psn_profile,live_profile) 
              VALUES (:nome,:genero,:dt_nasc,:senha,:email,:nickname,:steam_profile,:psn_profile,:live_profile)";
      try{
          $db = new db();
          $db = $db->connectDB();
          $resultado = $db->prepare($sql);
          $resultado->bindParam(':nome', $nome);
          $resultado->bindParam(':genero', $genero);
          $resultado->bindParam(':dt_nasc', $dt_nasc);
          $resultado->bindParam(':senha', $senha);
          $resultado->bindParam(':email', $email);
          $resultado->bindParam(':nickname', $nickname);
          $resultado->bindParam(':steam_profile', $steam_profile);
          $resultado->bindParam(':psn_profile', $psn_profile);
          $resultado->bindParam(':live_profile', $live_profile);
          $resultado->execute();
          echo json_encode("Novo usuario adicionado com sucesso!");
  
          $resultado = null;
          $db = null;
      }catch(PDOException $e){
          echo '{"error" : {"text":'.$e->getMessage().'}';
      }
});

$app->get('/api/verUsuario/{id}', function(Request $request, Response $response){
    $id_usuario = $request->getAttribute('id');
    $sql = "SELECT * FROM usuario WHERE id = $id_usuario";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->query($sql);
        if ($resultado->rowCount() > 0) {
            $plataformas = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($plataformas);
        }else{ echo json_encode("Nenhum Usuario encontrado"); }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){ echo '{"error" : {"text":'.$e->getMessage().'}'; }
});

/*    [Modulo usuario FIM] */




/*  [Modulo game-task] */

$app->get('/api/listaGameTasksUser/{id}', function(Request $request, Response $response){
    $id_usuario = $request->getAttribute('id');
    $sql = "SELECT * FROM game_task AS gt
            JOIN jogos j        ON gt.id_jogo_task = j.id
            JOIN plataformas p  ON gt.id_plataforma_task = p.id 
            WHERE gt.id_usuario = $id_usuario";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->query($sql);
        if ($resultado->rowCount() > 0) {
            $gameTask = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($gameTask);
        }else{ echo json_encode("Nenhum jogo encontrado na sua gametask"); }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){ echo '{"error" : {"text":'.$e->getMessage().'}'; }
});

$app->put('/api/atualizaGameTaskUser/{id}', function(Request $request, Response $response){
    $id_usuario             = $request->getAttribute('id');
    $id_jogo_task           = $request->getParam('id_jogo_task');  
    $id_plataforma_task     = $request->getParam('id_plataforma_task'); 
    $finalizado             = $request->getParam('finalizado');
    $jogando                = $request->getParam('jogando');
    $parado                 = $request->getParam('parado');
    $rejogando              = $request->getParam('rejogando');
    $current_progress_time  = $request->getParam('current_progress_time');
    $id_usuario             = $request->getParam('id_usuario');
    $percent_complete       = $request->getParam('percent_complete');
    $priority               = $request->getParam('priority');

    $sql = "UPDATE game_task SET 
            id_jogo_task            = :id_jogo_task, 
            id_plataforma_task      = :id_plataforma_task, 
            finalizado              = :finalizado, 
            jogando                 = :jogando, 
            parado                  = :parado, 
            rejogando               = :rejogando, 
            current_progress_time   = :current_progress_time, 
            id_usuario              = :id_usuario, 
            percent_complete        = :percent_complete, 
            priority                = :priority
            WHERE id_usuario        = $id_usuario";
     try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);
        $resultado->bindParam(':id_jogo_task'           , $id_jogo_task);
        $resultado->bindParam(':id_plataforma_task'     , $id_plataforma_task);
        $resultado->bindParam(':finalizado'             , $finalizado);
        $resultado->bindParam(':jogando'                , $jogando);
        $resultado->bindParam(':parado'                 , $parado);
        $resultado->bindParam(':rejogando'              , $rejogando);
        $resultado->bindParam(':current_progress_time'  , $current_progress_time);
        $resultado->bindParam(':id_usuario'             , $id_usuario);
        $resultado->bindParam(':percent_complete'       , $percent_complete);
        $resultado->bindParam(':priority'               , $priority);
        $resultado->execute();
        
        echo json_encode("GameTask modificada com sucesso!");

        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

$app->delete('/api/deletaGameTaskUser/{id_gt}/{id_usuario}', function(Request $request, Response $response){
    $id_usuario = $request->getAttribute('id_usuario');
	$id_gt = $request->getAttribute('id_gt');
	
    $sql = "DELETE FROM game_task  WHERE id_gt = $id_gt and id_usuario = $id_usuario";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);
        $resultado->execute();
      if($resultado->rowCount() > 0 ){
          echo json_encode("gameTask  deletada!");
      }else{
          echo json_encode("gameTask id_gt invalido (".$id_gt.")");
      }
      
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

$app->post('/api/novaGameTask', function(Request $request, Response $response){
	
	$id_jogo_task       	= $request->getParam('id_jogo_task');
    $id_plataforma_task     = $request->getParam('id_plataforma_task');
    $finalizado        		= $request->getParam('finalizado');
    $jogando          		= $request->getParam('jogando');
    $parado          		= $request->getParam('parado');
    $rejogando       		= $request->getParam('rejogando');
    $current_progress_time  = $request->getParam('current_progress_time');
    $id_usuario    			= $request->getParam('id_usuario');
    $percent_complete   	= $request->getParam('percent_complete');
	$priority   			= $request->getParam('priority');
	

  
    
      $sql = "INSERT INTO game_task (id_jogo_task, id_plataforma_task, finalizado, jogando, parado, rejogando, current_progress_time, id_usuario, percent_complete, priority) 
              VALUES (:id_jogo_task, :id_plataforma_task, :finalizado, :jogando, :parado, :rejogando, :current_progress_time, :id_usuario, :percent_complete, :priority)";
      try{
          $db = new db();
          $db = $db->connectDB();
          $resultado = $db->prepare($sql);
          $resultado->bindParam(':id_jogo_task'           , $id_jogo_task);
          $resultado->bindParam(':id_plataforma_task'     , $id_plataforma_task);
          $resultado->bindParam(':finalizado'             , $finalizado);
          $resultado->bindParam(':jogando'                , $jogando);
          $resultado->bindParam(':parado'                 , $parado);
          $resultado->bindParam(':rejogando'              , $rejogando);
          $resultado->bindParam(':current_progress_time'  , $current_progress_time);
          $resultado->bindParam(':id_usuario'             , $id_usuario);
          $resultado->bindParam(':percent_complete'       , $percent_complete);
          $resultado->bindParam(':priority'               , $priority);
          $resultado->execute();
          echo json_encode("Novo gameTask adicionada com sucesso!");
  
          $resultado = null;
          $db = null;
      }catch(PDOException $e){
          echo '{"error" : {"text":'.$e->getMessage().'}';
      }
});


/*    [Modulo gameTasks FIM] */