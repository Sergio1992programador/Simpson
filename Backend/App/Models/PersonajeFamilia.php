<?php

namespace App\Models;
use App\Core\Database;
use PDO;

class PersonajeFamilia
{

    public static function all()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM personajes_familias");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM personajes_familias WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO personajes_familias (personaje_id, familia_id) VALUES (?, ?)");
        $stmt->execute([$data['personaje_id'], $data['familia_id']]);
        return self::find($db->lastInsertId());
    }

    public static function update($id, $data)
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE personajes_familias SET  personaje_id = ?, familia_id = ? WHERE id = ?");
        $stmt->execute([$data['personaje_id'], $data['familia_id']]);
        return self::find($id);
    }

    public static function delete($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM personajes_familias WHERE id = ?");
        return $stmt->execute([$id]);
    }

}


