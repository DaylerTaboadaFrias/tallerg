<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
include_once("../CapaNegocio/historia/capaNegocioHistoria.php");

if (isset($_GET['pacienteId'])) {
    $pacienteId = $_GET['pacienteId'];
    $objetoCapaNegocio = new capaNegocioHistoria();
    $historiaClinica = $objetoCapaNegocio->obtenerHistoriaClinica($pacienteId);

    $paciente = $historiaClinica['paciente'];
    $evaluaciones = $historiaClinica['evaluaciones'];
    

            echo "<h2 class='mt-5'>Evaluaciones Dentales</h2>";
            foreach ($evaluaciones as $evaluacion) {
                echo "<div class='card mb-4'>";
                echo "<div class='card-header'>Evaluación #" . $evaluacion['id'] . "</div>";
                echo "<div class='card-body'>";
                echo "<h3 class='mb-4'>Historia Clínica de " . $paciente['nombre'] . " " . $paciente['apellido'] . "</h3>";

                // Información del Paciente en formulario deshabilitado
                echo "<form>";
                echo "<div class='form-group row'>";
                echo "<label for='nombre' class='col-sm-2 col-form-label'>Nombre</label>";
                echo "<div class='col-sm-10'>";
                echo "<input type='text' readonly class='form-control-plaintext' id='nombre' value='" . $paciente['nombre'] . "'>";
                echo "</div>";
                echo "</div>";
                echo "<div class='form-group row'>";
                echo "<label for='apellido' class='col-sm-2 col-form-label'>Apellido</label>";
                echo "<div class='col-sm-10'>";
                echo "<input type='text' readonly class='form-control-plaintext' id='apellido' value='" . $paciente['apellido'] . "'>";
                echo "</div>";
                echo "</div>";
                echo "<div class='form-group row'>";
                echo "<label for='cedula' class='col-sm-2 col-form-label'>Cédula</label>";
                echo "<div class='col-sm-10'>";
                echo "<input type='text' readonly class='form-control-plaintext' id='cedula' value='" . $paciente['cedula'] . "'>";
                echo "</div>";
                echo "</div>";
                echo "<div class='form-group row'>";
                echo "<label for='correo' class='col-sm-2 col-form-label'>Correo</label>";
                echo "<div class='col-sm-10'>";
                echo "<input type='text' readonly class='form-control-plaintext' id='correo' value='" . $paciente['correo'] . "'>";
                echo "</div>";
                echo "</div>";
                echo "<div class='form-group row'>";
                echo "<label for='sexo' class='col-sm-2 col-form-label'>Sexo</label>";
                echo "<div class='col-sm-10'>";
                echo "<input type='text' readonly class='form-control-plaintext' id='sexo' value='" . $paciente['sexo'] . "'>";
                echo "</div>";
                echo "</div>";
                echo "</form>";
                echo "<h5 class='card-title'>Fecha: " . $evaluacion['fecha'] . "</h5>";
                echo "<p class='card-text'>Notas: " . $evaluacion['antecedentes_patologicos'] . "</p>";

                echo "<h5 class='card-title'>Tratamientos:</h5>";

                foreach ($evaluacion['tratamientos'] as $tratamiento) {
                    echo "<div class='card text-left mb-2'>";
                    echo "<div class='card-body'>";
                    echo "<p class='card-text'>Tratamiento #" . $tratamiento['id'] . ": " . $tratamiento['descripcion'] . " (Inicio: " . $tratamiento['fecha'] . ", Fin: " . $tratamiento['fecha'] . ")</p>";
                    echo "<h6>Trabajos realizados:</h6>";
                    echo "<table class='table table-bordered'>";
                    echo "<thead class='thead-light'>";
                    echo "<tr>";
                    echo "<th>Nombre del Trabajo</th>";
                    echo "<th>Descripción</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    foreach ($tratamiento['trabajos'] as $trabajo) {
                        echo "<tr>";
                        echo "<td>" . $trabajo['nombre'] . "</td>";
                        echo "<td>" . $trabajo['nombre'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                    echo "</div>";
                }

                echo "</div>";
                echo "<div class='card-footer text-muted'>Fecha de evaluación: " . $evaluacion['fecha'] . "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>ID de paciente no proporcionado.</p>";
        }
?>
