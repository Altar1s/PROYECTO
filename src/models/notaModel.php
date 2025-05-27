<?php
require_once __DIR__ . '/utils.php';

// Obtener todas las notas de un estudiante (todas las materias y evaluaciones)
function getNotasDeEstudiante(mysqli $conexion, string $bbdd, int $estudiante_id)
{
   if (!selectDB($conexion, $bbdd)) return [];
   $query = "SELECT notas.*, cursos.nombre AS nombre_curso, evaluaciones.nombre AS nombre_evaluacion
      FROM notas
      JOIN cursos ON notas.curso_id = cursos.id
      JOIN evaluaciones ON notas.evaluacion_id = evaluaciones.id
      WHERE notas.estudiante_id = $estudiante_id
      ORDER BY cursos.id, evaluaciones.id";
   $result = mysqli_query($conexion, $query);
   return fetchAll($result);
}

// Obtener todas las notas de un estudiante en un curso específico
function getNotasDeEstudianteEnCurso(mysqli $conexion, string $bbdd, int $estudiante_id, int $curso_id)
{
   if (!selectDB($conexion, $bbdd)) return [];
   $query = "SELECT notas.*, evaluaciones.nombre AS nombre_evaluacion
      FROM notas
      JOIN evaluaciones ON notas.evaluacion_id = evaluaciones.id
      WHERE notas.estudiante_id = $estudiante_id AND notas.curso_id = $curso_id
      ORDER BY evaluaciones.id";
   $result = mysqli_query($conexion, $query);
   return fetchAll($result);
}

// Cambiar o insertar nota de un estudiante para una evaluación específica
function setNotasEstudiante(mysqli $conexion, string $bbdd, int $estudiante_id, int $curso_id, array $notas)
{
   if (!selectDB($conexion, $bbdd)) return false;
   foreach ($notas as $i => $nota) {
      $evaluacion = $i + 1;
      $query = "INSERT INTO notas (estudiante_id, curso_id, evaluacion_id, nota)
         VALUES ($estudiante_id, $curso_id, $evaluacion, $nota)
         ON DUPLICATE KEY UPDATE nota = VALUES(nota);";
      mysqli_query($conexion, $query);
   }
   return true;
}
