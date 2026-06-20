<?php
require_once './app/models/genres-api.model.php';

class GenresApiController {
    private $model;

    public function __construct() {
        $this->model = new GenresApiModel();
    }

    public function getGenres($req, $res) {
        $direction = $_GET['direction'] ?? 'ASC';
        $genres = $this->model->getAll($direction);
        return $res->json($genres);
    }

    public function getTask($req, $res) {
        $idGenre = $req->params->id;
        $genre = $this->model->get($idGenre);
        
        if (!$genre) {
            return $res->json("El genero con el id=$idGenre no existe", 404);
        }
        return $res->json($genre);
    }

    public function deleteGenre($req, $res) {
        $idgenre = $req->params->id;
        $genre = $this->model->get($idgenre);
    
        if (!$genre) {
            return $res->json("El genero con el id=$idgenre no existe", 404);
        }

        $this->model->remove($idgenre);

        return $res->json("El genero con el id=$idgenre fue eliminado", 204);
    }

    public function insertGenre($req, $res) {
        if (
            empty($req->body->nombre) || 
            empty($req->body->descripcion) || 
            empty($req->body->imagen)) {
            return $res->json('Faltan datos', 400);
        }

        $nombre = $req->body->nombre;
        $description = $req->body->descripcion;
        $imagen = $req->body->imagen;

        $newGenreId= $this->model->insert($nombre, $description, $imagen);

        if ($newGenreId == false) {
            return $res->json('Error del servidor', 500);
        }

        $newGenre = $this->model->get($newGenreId);
        return $res->json($newGenre, 201); //Buena practica devolver el id y la "entidad" creada
    }

    public function updateGenre($req, $res) {
        $idGenre = $req->params->id;
        $genre = $this->model->get($idGenre);
    
        if (!$genre) {
            return $res->json("El genero con el id=$idGenre no existe", 404);
        }

        if (
            empty($req->body->nombre) ||
            empty($req->body->descripcion) ||
            empty($req->body->imagen)
        ) {
            return $res->json('Faltan datos', 400);
        }

        $nombre = $req->body->nombre;
        $description = $req->body->descripcion;
        $imagen = $req->body->imagen;

        $this->model->update($idGenre, $nombre, $description, $imagen);

        $updatedTask = $this->model->get($idGenre);
        return $res->json($updatedTask, 201); 
    }
}
