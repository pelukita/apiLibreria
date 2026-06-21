<?php

class BooksApiModel{
    private $db;

    public function __construct() {
     $this->db = new PDO('mysql:host=localhost;dbname=db_libreria_tpe;charset=utf8', 'root', 'tu_contraseña');
    }

    public function getAll($direction = "ASC") {
        $allowedDirections = ['ASC', 'DESC'];

        if (!in_array(strtoupper($direction), $allowedDirections)) {
        $direction = 'ASC';
        }

        $query = $this->db->prepare("SELECT * FROM libro ORDER BY titulo $direction");
        $query->execute([]);
        $books = $query->fetchAll(PDO::FETCH_OBJ);
        return $books;
    }

    public function get($id) {
        $query = $this->db->prepare('SELECT * FROM libro WHERE id_libro = ?');
        $query->execute([$id]);
        $book = $query->fetch(PDO::FETCH_OBJ);
        return $book;
    }

    public function insert($titulo,$autor,$precio,$imagen,$id_genero_fk) {
        $query = $this->db->prepare("INSERT INTO libro(titulo, autor, precio, imagen, id_genero_fk) VALUES(?,?,?,?,?)");
        $query->execute([$titulo, $autor, $precio, $imagen, $id_genero_fk]);
        return $this->db->lastInsertId();
    }

    public function remove($id) {
        $query = $this->db->prepare('DELETE FROM libro WHERE id_libro = ?');
        $query->execute([$id]);
    }

    public function update($id,$titulo,$autor,$precio,$imagen,$id_genero_fk) {
        $query = $this->db->prepare('UPDATE libro SET titulo = ?, autor = ?, precio = ?, imagen = ?, id_genero_fk = ? WHERE id_genero_fk = ? ');
        $query->execute([$titulo, $autor, $precio, $imagen, $id_genero_fk, $id]);
    }
}