<?php

namespace app\utilities;

use Yii;
use app\models\Area;
use app\models\Curso;
use app\models\Usuario;
use app\models\UsuarioCurso;

class Dashboard{

    public static function get_cursos($carnet){
        $result = [];
        $area_rows = Area::find()->all();

        foreach($area_rows as $area_row){
            $cursos = Dashboard::get_cursos_por_area($carnet, $area_row->id);
            
            $temp['area'] = $area_row;
            $temp['cursos'] = $cursos;
            $result[] = $temp;
        } // foreach

        return $result;
    } // get_cursos_usuario

    public static function get_cursos_por_area($carnet, $id_area){
        $query = UsuarioCurso::find()->joinWith('curso0','estadoCurso');
        $query = $query->where('usuario = :usuario', [':usuario' => $carnet]);
        $query = $query->andWhere('curso.area = :area', [':area' => $id_area]);
        $query = $query->all();
        return $query;
    } // get_cursos_usuario_por_area

}