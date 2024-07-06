<?php
include_once(".././CapaDato/capaDatoReceta.php");
include_once(".././CapaDato/capaDatoMedicamentoReceta.php");
class capaNegocioReceta{
	public $objectoCapaDatoReceta;
	public $objectoCapaDatoMedicamentoReceta;

	

	public function __construct(){
		$this->objectoCapaDatoReceta=new capaDatoReceta();
		$this->objectoCapaDatoMedicamentoReceta=new capaDatoMedicamentoReceta();
	}


	public function insertar($recomendacion,$fecha,$idtratamiento,$datos){
		$vector =$datos;
            $b=0;$i=0;
            $idmedicamentos[]=array();$indexidmedicamento=0;
            $horafrecuencias[]=array();$indexhorafrecuencia=0;
            while ($i < count($vector)) { 
          
                if ($b==0){
                    $idmedicamentos[$indexidmedicamento]=$vector[$i];
                    $indexidmedicamento++;
                     $b=1;
                }else{
                    $horafrecuencias[$indexhorafrecuencia]=$vector[$i];
                    $indexhorafrecuencia++;
                    $b=0;
                }
              $i++;
            }
        $this->objectoCapaDatoReceta->insertar($recomendacion,$fecha,$idtratamiento);
        $sql =$this->objectoCapaDatoReceta->getIdUltimoReceta();
        $idreceta=$sql[0]['id'];
        $idmedicamento=0;$horafrecuencia=0;
        for ($i=0; $i <count($idmedicamentos) ; $i++) { 	
        	$idmedicamento=$idmedicamentos[$i];
        	$horafrecuencia=$horafrecuencias[$i];
        	$this->objectoCapaDatoMedicamentoReceta->insertar($idreceta,$idmedicamento,$horafrecuencia);
        }
		
	}

	public function eliminar($id){
		$this->objectoCapaDatoReceta->eliminar($id);
	}


	public function mostrar(){
		return $this->objectoCapaDatoReceta->mostrar();
	}


	public function getIdReceta(){
		return $this->objectoCapaDatoReceta->getIdReceta();
	}



    public function getMedicamentoRecetaByIdReceta($id){
        return $this->objectoCapaDatoMedicamentoReceta->getMedicamentoRecetaByIdReceta($id);
    }
    
}


	
?>