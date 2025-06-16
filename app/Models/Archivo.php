<?php
namespace App\Models;
use Core\Database;
use PDO;

class Archivo 
{
    public static function obtenerPorCurso($curso_id) {
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM archivos WHERE curso_id = ?");
    $stmt->execute([$curso_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    
}


?>