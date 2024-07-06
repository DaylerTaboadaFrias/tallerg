<?php
include_once(".././CapaDato/capaDatoTratamiento.php");
include_once(".././CapaDato/capaDatoTrabajoTratamiento.php");
class capaNegocioTratamiento{
	public $objectoCapaDatoTratamiento;
	public $objectoCapaDatoTrabajoTratamiento;

	

	public function __construct(){
		$this->objectoCapaDatoTratamiento=new capaDatoTratamiento();
		$this->objectoCapaDatoTrabajoTratamiento=new capaDatoTrabajoTratamiento();
	}


	public function insertar($fecha,$descripcion,$estado,$idusuario,$datos){
		$vector =$datos;
            $montototal=0;
            $subtotal=0;
            $b=1;$i=0; $c=0;
            $idtrabajos[]=array();$indexidtrabajo=0;
            $precios[]=array();$indexprecio=0;
            $cantidades[]=array();$indexcantidad=0;
            while ($i < count($vector)) { 
          
                if ($b==0){
                      if ($c==1) {
                        $subtotal=$subtotal*$vector[$i];
                        $montototal=$montototal+$subtotal;
                        $c=0;
                        $b=1;
                        $cantidades[$indexcantidad]=$vector[$i];$indexcantidad++;
                      }else{
                        $subtotal=$vector[$i];
                        $c++;
						$precios[$indexprecio]=$vector[$i];$indexprecio++;
                      }
                }else{
                  $b=0;
                  $idtrabajos[$indexidtrabajo]=$vector[$i];
                  $indexidtrabajo++;
                }
              $i++;
            }
        $this->objectoCapaDatoTratamiento->insertar($fecha,$descripcion,$estado,$idusuario,$montototal);
        $sql =$this->objectoCapaDatoTratamiento->getIdUltimoTratamiento();
        $idtratamiento=$sql[0]['id'];
        $precio=0;$cantidad=0;$idtrabajo=0;
        for ($i=0; $i <count($idtrabajos) ; $i++) { 
        	$precio=$precios[$i];
        	$cantidad=$cantidades[$i];
        	$idtrabajo=$idtrabajos[$i];
        	$this->objectoCapaDatoTrabajoTratamiento->insertar($idtrabajo,$idtratamiento,$precio,$cantidad);
        }
		
	}

	public function eliminar($id){
		$this->objectoCapaDatoTratamiento->eliminar($id);
	}


	public function mostrar(){
		return $this->objectoCapaDatoTratamiento->mostrar();
	}


	public function getIdUltimoTratamiento(){
		return $this->objectoCapaDatoTratamiento->getIdUltimoTratamiento();
	}

	public function getTrabajoTratamientoByIdTratamiento($id){
		return $this->objectoCapaDatoTrabajoTratamiento->getTrabajoTratamientoByIdTratamiento($id);
	}
	public function getIdTratamiento(){
		return $this->objectoCapaDatoTratamiento->getIdTratamiento();
	}
    public function getTratamiento(){
        return $this->objectoCapaDatoTratamiento->getTratamiento();
    }


}


	
?>