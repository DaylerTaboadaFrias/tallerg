<?php
include_once(".././CapaDato/capaDatoEstadisticaReporte.php");

class capaNegocioEstadisticaReporte {
    public $objetoTrabajoModel;

    public function __construct() {
        $this->objetoTrabajoModel = new capaDatoEstadisticaReporte();
    }

    public function getTrabajosMasRequeridosPorMes($year, $month) {
        try {
            return $this->objetoTrabajoModel->getTrabajosMasRequeridosPorMes($year, $month);
        } catch (PDOException $ex) {
            throw $ex;
        }
    }
}
?>
