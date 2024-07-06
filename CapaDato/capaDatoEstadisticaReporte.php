<?php
include_once("conexion.php");

class capaDatoEstadisticaReporte {
    private $objetoConexion;

    public function __construct() {
        $this->objetoConexion = new conexion();
    }
    public function getIngresosMensualesPorAno($year) {
        try {
            $this->objetoConexion->conectar();
            $resultado = $this->objetoConexion->ejecutar("
                SELECT MONTH(fecha) as mes, SUM(montototal) as total 
                FROM tratamiento 
                WHERE YEAR(fecha) = '$year' 
                GROUP BY MONTH(fecha)
            ");
            $this->objetoConexion->desconectar();

            $ingresos = [];
            foreach ($resultado as $row) {
                $ingresos[intval($row['mes'])] = floatval($row['total']);
            }

            // Asegurarse de que todos los meses estén presentes en el array
            for ($i = 1; $i <= 12; $i++) {
                if (!isset($ingresos[$i])) {
                    $ingresos[$i] = 0;
                }
            }

            ksort($ingresos);
            return $ingresos;
        } catch (PDOException $ex) {
            throw $ex;
        }
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
