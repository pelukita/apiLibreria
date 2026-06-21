<?php

class GenresApiModel{
    private $db;

    public function __construct() {
     $this->db = new PDO('mysql:host=localhost;dbname=db_libreria_tpe;charset=utf8', 'root', '');
    }

    public function getAll($direction = "ASC") {
        $allowedDirections = ['ASC', 'DESC'];

        if (!in_array(strtoupper($direction), $allowedDirections)) {
        $direction = 'ASC';
        }

        $query = $this->db->prepare("SELECT * FROM genero ORDER BY nombre $direction");
        $query->execute([]);
        $genres = $query->fetchAll(PDO::FETCH_OBJ);
        return $genres;
    }

    public function get($id) {
        $query = $this->db->prepare('SELECT * FROM genero WHERE id_genero = ?');
        $query->execute([$id]);
        $genre = $query->fetch(PDO::FETCH_OBJ);
        return $genre;
    }

    public function insert($nombre, $description, $imagen) {
        $query = $this->db->prepare("INSERT INTO genero(nombre, descripcion, imagen) VALUES(?,?,?)");
        $query->execute([$nombre, $description, $imagen]);
        return $this->db->lastInsertId();
    }

    public function remove($id) {
        $query = $this->db->prepare('DELETE FROM genero WHERE id_genero = ?');
        $query->execute([$id]);
    }

    public function update($id, $nombre, $description, $imagen) {
        $query = $this->db->prepare('UPDATE genero SET nombre = ?, descripcion = ?, imagen = ? WHERE id_genero = ? ?
        ');
        $query->execute([$nombre, $description, $imagen, $id]);
    }
}