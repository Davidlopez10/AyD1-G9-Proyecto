<?php

namespace app\utilities;

use Yii;
use app\models\Curso;
use app\models\UsuarioCurso;

class OperacionesArea{

    public static function get_porcentaje_area($id_area, $carnet_usuario){
        $total = OperacionesArea::get_total_cursos_por_area($id_area);
        $cantidad = OperacionesArea::get_cursos_aprobados_por_area($id_area, $carnet_usuario);
        return OperacionesArea::calcular_porcentaje($total, $cantidad);
    } // get_porcentaje_area

    public static function calcular_porcentaje($total, $cantidad){
        if($total < 1)
            return 0;
        return $cantidad * 100 / $total;
    } // calcular_porcentaje

    public static function get_total_cursos_por_area($id_area){
        $query = Curso::find()->where('area = :area', [':area' => $id_area]);
        return $query->count();
    } // get_total_cursos_por_area

    public static function get_cursos_aprobados_por_area($id_area, $carnet_usuario){
        $query = UsuarioCurso::find()->joinWith('curso0');
        $query = $query->where('usuario = :usuario', [':usuario' => $carnet_usuario]);
        $query = $query->andWhere('curso.area = :area', [':area' => $id_area]);
        $query = $query->andWhere('usuario_curso.estado_curso = 2');
        return $query->count();
    } // get_cursos_aprobados_por_area
    
}