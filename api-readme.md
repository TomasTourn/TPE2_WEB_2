DOCUMENTACION API PARA RECURSO BANDAS

API REST-FULL sencilla para manejar ABM de videojuegos.


Importar DB desde PHPMyAdmin (o cualquiera) database/videojuegos.sql
 
PRUEBA CON POSTMAN

El endpoint de la API es: http://localhost/tucarpetalocal/api/games

El nombre del recurso se asigna a un endpoint, aqui las consultas:

Method Url Code 
GET /games 200 -> coleccion de entidades.
GET /bands/:id 200 -> obtenemos un juego en especifico usando su id(:id).
POST /bands 201 -> creamos un juego.
DELETE /bands/:id 200 -> eliminamos un juego usando su id(:id).

Paginacion

agregar query params (?) para obtener la solicitud 
api/games?limit=5&offset=0   (5 y 0 son meros ejemplos)

Ordenamiento

agregar query params (?) para obtener la solicitud 
order = ASC OR DESC. sort = Columna de la tabla correspondiente a la db. ejemplo: api/games?sort=nombre&order=desc
