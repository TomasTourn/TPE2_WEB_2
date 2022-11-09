<?php
     
    require_once "app/models/gamesModel.php";
    require_once "app/views/apiView.php";

 class apiGamesController{

    private $view;
    private $model;
    private $data;

    function __construct(){
        $this->model= new gamesModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    function getGames(){
     
        $games= $this->model->getGames();
        return $this->view->response($games);
    }
   
    function getGame($params = null){
        $id=$params[':ID'];
        $game= $this->model->getGame($id);
                
            if ($game)
              $this->view->response($game);
            else 
               $this->view->response("El juego con el id=$id no existe", 404);
    }



   function deleteGame($params = null){

        $id= $params[':ID'];
        $game= $this->model->getGame($id);

        if($game){
            $this->model->deleteGame($id);
            $this->view->response("el juego se eapiGamesControllerlimino con exito");  
        }
        else{
            $this->view->response("el juego con el id $id no existe",404);
        }

   }

   function addGame(){

        $game= $this->getData();
         if(empty($game->nombre) || empty($game->precio) || empty($game->descripcion) || empty($game->id_genero_fk)){
            $this->view->response("complete bien los datos",401);
         }else{
            $id= $this->model->addGame($game->nombre,$game->precio,$game->descripcion,$game->id_genero_fk);
            $this->view->response("se agrego un juego con la id $id correctamente");
         }
   }

   function updateGame($params = null){

        $id= $params[':ID'];

        $game=$this->model->getOne($id);

        $updatedGame=$this->getData();
    
          if($game){

            if(!empty($updatedGame->nombre) && !empty($updatedGame->precio) && !empty($updatedGame->descripcion) && !empty($updatedGame->id_genero_fk)){
                $this->model->updateGame($id,$updatedGame->nombre,$updatedGame->precio,$updatedGame->descripcion,$updatedGame->id_genero_fk);
                $this->view->response("el juego con el id $id fue editado correctamente");
            }
            else{
                $this->view->response("complete bien los datos",400);
            }
       
          }
          else{
            $this->view->response("el juego con el id $id no existe",404);
          }

   }

 }