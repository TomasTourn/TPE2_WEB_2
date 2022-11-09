<?php


        class gamesModel{

    
            private $db;

            function __construct(){ //start the connection with the db
                $this->db = $this->connectDB();
            }
            
            private function connectDB(){
                $db = new PDO('mysql:host=localhost;'.'dbname=videojuegos;charset=utf8','root',''); 
                return $db;
            }
            
            function getAll(){
            
            
                $query = $this->db->prepare('SELECT * FROM juego  JOIN genero ON genero.id_genero = juego.id_genero_fk ');
                $query-> execute();
            
                $juegos  = $query->fetchAll(PDO::FETCH_OBJ);
            
            
                return $juegos;
        }
        function getGames(){
            
            
            $query = $this->db->prepare('SELECT * FROM juego');
            $query-> execute();
        
            $juegos  = $query->fetchAll(PDO::FETCH_OBJ);
        
        
            return $juegos;
    }


        function getOne($id){
            $query = $this->db->prepare('SELECT * FROM juego  JOIN genero ON genero.id_genero = juego.id_genero_fk  WHERE id_juego= ?');
            $query-> execute([$id]);

            $juego  = $query->fetch(PDO::FETCH_OBJ);
            return $juego;


        }
        function getGame($id){
            $query = $this->db->prepare('SELECT * FROM juego  WHERE id_juego= ?');
            $query-> execute([$id]);

            $juego  = $query->fetch(PDO::FETCH_OBJ);
            return $juego;


        }


        function addGame($name,$price,$description,$genre,$image = null){

            $pathImg = null;
            if($image){
                $pathImg = $this->uploadImage($image);

                $query = $this->db->prepare('INSERT INTO juego  (nombre,precio,descripcion,id_genero_fk,imagen) VALUES (?,?,?,?,?)');
                $query-> execute([$name,$price,$description,$genre,$pathImg]);
            }else{
                $query = $this->db->prepare('INSERT INTO juego  (nombre,precio,descripcion,id_genero_fk) VALUES (?,?,?,?)');
                $query-> execute([$name,$price,$description,$genre]);
            }
            return $this->db->lastInsertId();
        }
        private function uploadImage($image){

            $target = 'images/' . uniqid() . '.jpg';
            move_uploaded_file($image, $target);
            return $target;

        }

        function deleteGame($id){

            $query = $this->db->prepare('DELETE FROM juego WHERE id_juego=?');
            $query-> execute([$id]);

        }

        function getByGenre($id){


            $query = $this->db->prepare('SELECT * FROM juego  WHERE id_genero_fk= ?');
            $query-> execute([$id]);
        
            $games  = $query->fetchAll(PDO::FETCH_OBJ);
        
            return $games;
    
        }
        function updateGame($id,$name,$price,$description,$genre,$image = null){

            $pathImg = null;
            if($image){
                $pathImg = $this->uploadImage($image);

                $query = $this->db->prepare('UPDATE juego SET nombre =?,precio=?,descripcion = ?,id_genero_fk=?, imagen=? WHERE id_juego =?');
                $query-> execute([$name,$price,$description,$genre,$pathImg,$id]);
            
            }else{
                $query = $this->db->prepare('UPDATE juego SET nombre =?,precio=?,descripcion = ?,id_genero_fk=? WHERE id_juego =?');
                $query-> execute([$name,$price,$description,$genre,$id]);
            }
        }


}
