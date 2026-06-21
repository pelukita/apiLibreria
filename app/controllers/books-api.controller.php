<?php
require_once 'app/models/books-api.model.php';

class BooksApiController {
    private $model;

    public function __construct() {
        $this->model = new BooksApiModel();
    }

    public function getBooks($req, $res) {
        $direction = $_GET['direction'] ?? 'ASC';
        $books = $this->model->getAll($direction);
        return $res->json($books);
    }

    public function getBook($req, $res) {
        $idBook = $req->params->id;
        $book = $this->model->get($idBook);
        
        if (!$book) {
            return $res->json("El libro con el id=$idBook no existe", 404);
        }
        return $res->json($book);
    }

    public function deleteBook($req, $res) {
        $idBook = $req->params->id;
        $book = $this->model->get($idBook);
    
        if (!$book) {
            return $res->json("El libro con el id=$idBook no existe", 404);
        }

        $this->model->remove($idBook);

        return $res->json("El libro con el id=$idBook fue eliminado", 204);
    }

    public function insertBook($req, $res) {
        if (
            empty($req->body->titulo)   || 
            empty($req->body->autor)    || 
            empty($req->body->precio)   ||
            empty($req->body->imagen)   ||
            empty($req->body->id_genero_fk))
            {
            return $res->json('Faltan datos', 400);
        }

        $titulo = $req->body->titulo;
        $autor = $req->body->autor;
        $precio = $req->body->precio;
        $imagen = $req->body->imagen;
        $id = $req->body->id_genero_fk;

        $newBookId= $this->model->insert($titulo, $autor, $precio, $imagen, $id);

        if ($newBookId == false) {
            return $res->json('Error del servidor', 500);
        }

        $newBook = $this->model->get($newBookId);
        return $res->json($newBook, 201);
    }

    public function updateBook($req, $res) {
        $idBook = $req->params->id;
        $book = $this->model->get($idBook);
    
        if (!$book) {
            return $res->json("El libro con el id=$idBook no existe", 404);
        }

        if (
            empty($req->body->titulo)   || 
            empty($req->body->autor)    || 
            empty($req->body->precio)   ||
            empty($req->body->imagen)   ||
            empty($req->body->id_genero_fk))
            {
            return $res->json('Faltan datos', 400);
        }

        $titulo = $req->body->titulo;
        $autor = $req->body->autor;
        $precio = $req->body->precio;
        $imagen = $req->body->imagen;
        $id = $req->body->id_genero_fk;

        $this->model->update($idBook, $titulo, $autor, $precio, $imagen, $id);

        $updatedBook = $this->model->get($idBook);
        return $res->json($updatedBook, 201); 
    }
}
