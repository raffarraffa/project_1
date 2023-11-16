<?php
function getMascotaEspecieRaza($conn, $especie, $raza)
{

    try {
        //SELECT  mascotas.*, especies.especie,
        //				razas.raza,
        //                sociabilidad.sociabilidad
        //        from mascotas                
        //          JOIN especies ON especies.id = mascotas.id_especie
        //          JOIN razas on razas.id = mascotas.id_raza
        //          JOIN sociabilidad on sociabilidad.id_sociabilidad = mascotas.id_sociabilidad
        $stm = "SELECT 
                    m.id as id,
                    m.nombre as nombre,
                    m.fecha_nacimiento as fecha_nacimiento,                   
                    m.descripcion as descripcion,
                    m.observaciones as observaciones,
                    m.castrado as castrado,
                    e.especie as especie,
                    r.raza as raza, s.sociabilidad,
                    u.id as user_id,
                    u.nombres as nombres,
                    u.apellido as apellido
                FROM `mascotas` AS m 
                JOIN `especies` AS e ON e.id = m.id_especie
                JOIN `razas` AS r ON r.id = m.id_raza 
                JOIN `sociabilidad` AS s ON s.id_sociabilidad = m.id_sociabilidad
                JOIN `users` AS u ON u.id = m.id_user
                WHERE m.`id_especie`= :especie";
        if ($raza) {
            $stm .= "AND `raza`= :raza and";
        }
        $stm .= " AND `status`= 1;";
        $statment = $conn->prepare($stm);
        $statment->bindParam(':especie', $especie);
        if ($raza) {
            $statment->bindParam(':raza', $raza);
        }
        $statment->execute();
        $result = $statment->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
