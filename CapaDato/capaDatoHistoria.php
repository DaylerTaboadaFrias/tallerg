<?php
include_once("conexion.php");
	class capaDatoHistoria{
		private $objetoConexion;


		public function __construct(){
			$this->objetoConexion=new conexion();
		}
		public function obtenerHistoriaClinica($pacienteId) {
			$this->objetoConexion->conectar();
			
			$query = "
				SELECT 
                ed.id as evaluacion_id, 
                ed.fecha, 
                ed.antecedentes_patologicos, 
                t.id as tratamiento_id, 
                t.descripcion as tratamiento_descripcion, 
                t.fecha, 
                tr.id as trabajo_id, 
                tr.nombre as trabajo_nombre, 
                p.nombre as paciente_nombre,
                p.apellido as paciente_apellido,
                p.correo as paciente_correo,
                p.sexo as paciente_sexo,
                p.cedula as paciente_cedula
            FROM 
                evaluacion_dental ed
            LEFT JOIN 
                tratamiento t ON ed.id = t.id_evaluacion
            LEFT JOIN 
                trabajotratamiento tt ON t.id = tt.idtratamiento
            LEFT JOIN 
                trabajo tr ON tt.idtrabajo = tr.id
            JOIN 
                paciente pa ON ed.id_paciente = pa.id
            JOIN 
                persona p ON pa.id = p.id
            WHERE 
                ed.id_paciente = '$pacienteId'
			";
	
			$resultado = $this->objetoConexion->ejecutar($query);
			$this->objetoConexion->desconectar();
	
			$resultados = [];
			$evaluaciones = [];
			$paciente_info = null;
	
			foreach ($resultado as $row) {
				$evaluacionId = $row['evaluacion_id'];
	
				if (!$paciente_info) {
					$paciente_info = [
						'nombre' => $row['paciente_nombre'],
						'apellido' => $row['paciente_apellido'],
						'correo' => $row['paciente_correo'],
						'sexo' => $row['paciente_sexo'],
						'cedula' => $row['paciente_cedula']
					];
				}
	
				if (!isset($evaluaciones[$evaluacionId])) {
					$evaluaciones[$evaluacionId] = [
						'id' => $evaluacionId,
						'fecha' => $row['fecha'],
						'antecedentes_patologicos' => $row['antecedentes_patologicos'],
						'tratamientos' => []
					];
				}
	
				$tratamientoId = $row['tratamiento_id'];
				if ($tratamientoId && !isset($evaluaciones[$evaluacionId]['tratamientos'][$tratamientoId])) {
					$evaluaciones[$evaluacionId]['tratamientos'][$tratamientoId] = [
						'id' => $tratamientoId,
						'descripcion' => $row['tratamiento_descripcion'],
						'fecha' => $row['fecha'],
						'trabajos' => []
					];
				}
	
				$trabajoId = $row['trabajo_id'];
				if ($trabajoId) {
					$evaluaciones[$evaluacionId]['tratamientos'][$tratamientoId]['trabajos'][] = [
						'id' => $trabajoId,
						'nombre' => $row['trabajo_nombre'],
					];
				}
			}
	
			foreach ($evaluaciones as $evaluacion) {
				$evaluacion['tratamientos'] = array_values($evaluacion['tratamientos']);
				foreach ($evaluacion['tratamientos'] as &$tratamiento) {
					$tratamiento['trabajos'] = array_values($tratamiento['trabajos']);
				}
				$resultados[] = $evaluacion;
			}
	
			return [
				'paciente' => $paciente_info,
				'evaluaciones' => $resultados
			];
		}

		public function insertar($nombre, $descripcion){
		$this->objetoConexion->conectar();
		$this->objetoConexion->ejecutar(
			"insert into categoria (nombre, descripcion) values ('$nombre', '$descripcion')");

		$this->objetoConexion->desconectar();	
		}

		public function eliminar($id){
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
			"delete from categoria where id='$id'");

			$this->objetoConexion->desconectar();
		}

		public function actualizar($id,$nombre,$descripcion){
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
				"update categoria set nombre='$nombre',descripcion='$descripcion' where id='$id'");
			$this->objetoConexion->desconectar();
		}

		public function mostrar(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"select * from categoria");

			$this->objetoConexion->desconectar();
			return $resultado;
		}

		public function buscar($b){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("SELECT * FROM categoria WHERE nombre LIKE '%".$b."%' LIMIT 10");
			$this->objetoConexion->desconectar();
			return $resultado;
		}
	

		public function getCategoria(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"select * from categoria");

			$this->objetoConexion->desconectar();
			return $resultado;
		}

		
	}


?>