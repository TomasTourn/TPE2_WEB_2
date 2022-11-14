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
        $columns= array('id_juego','id_genero_fk','nombre','precio','descripcion','imagen');


        if((isset($_GET['sort']) && isset($_GET['order'])) && (isset($_GET['offset']) && isset($_GET['limit']))){


              if((in_array($_GET['sort'],$columns) && ((strtoupper($_GET['order'])=="ASC")|| strtoupper($_GET['order'])=="DESC"))&&(is_numeric($_GET['offset']) && is_numeric($_GET['limit']))){

                $games= $this->model->getGames($_GET['sort'],$_GET['order'],$_GET['offset'],$_GET['limit']);
                return $this->view->response($games);
            }
            else{
                $this->view->response("complete bien el request",400);
            }
        }
        else if(isset($_GET['sort']) && (isset($_GET['order']))){

            if(in_array($_GET['sort'],$columns) && ((strtoupper($_GET['order'])=="ASC")|| strtoupper($_GET['order'])=="DESC")){

                $games= $this->model->getGames($_GET['sort'],$_GET['order']);
                return $this->view->response($games);

            }
            else{
                $this->view->response("complete bien el request",400);
            }
        }

        else if(isset($_GET['offset']) && isset($_GET['limit'])){
            
            if(is_numeric($_GET['offset']) && is_numeric($_GET['limit'])){
                $games= $this->model->getGames(null,null,$_GET['offset'],$_GET['limit']);
                return $this->view->response($games);
            }else{
                $this->view->response("error, offset y limit deben ser numeros",400);
            }
        }

        else if(isset($_GET['sort']) || (isset($_GET['order']))){
            $this->view->response("complete bien el request de ordenamiento",400);
        }
        else if(isset($_GET['offset']) || (isset($_GET['limit']))){
            $this->view->response("complete bien el request de paginacion",400);
        }
        else{
            $games= $this->model->getGames();
            return $this->view->response($games);
        }
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
            $this->view->response("el juego con el id $id se elimino con exito");  
        }
        else{
            $this->view->response("el juego con el id $id no existe",404);
        }

   }

   function addGame(){

        $game= $this->getData();
         if(empty($game->nombre) || empty($game->precio) || empty($game->descripcion) || empty($game->id_genero_fk)){
            $this->view->response("complete bien los datos",400);
         }else{
            $id= $this->model->addGame($game->nombre,$game->precio,$game->descripcion,$game->id_genero_fk);
            $this->view->response("se agrego un juego con la id $id correctamente",201);
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