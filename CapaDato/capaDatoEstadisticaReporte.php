<?php
include_once("conexion.php");

class capaDatoEstadisticaReporte {
    private $objetoConexion;

    public function __construct() {
        $this->objetoConexion = new conexion();
    }

    public function getTrabajosMasRequeridosPorMes($year, $month) {
        try {
            $this->objetoConexion->conectar();
            $resultado = $this->objetoConexion->ejecutar("
                SELECT tr.nombre, COUNT(tt.idtrabajo) AS cantidad
                FROM trabajo tr
                JOIN trabajotratamiento tt ON tr.id = tt.idtrabajo
                JOIN tratamiento t ON t.id = tt.idtratamiento
                WHERE YEAR(t.fecha) = '$year' AND MONTH(t.fecha) = '$month'
                GROUP BY tr.nombre
                ORDER BY cantidad DESC
            ");
            $this->objetoConexion->desconectar();
            return $resultado;
        } catch (PDOException $ex) {
            throw $ex;
        }
    }
}
?>
