<?php

namespace app\utilities;

use Yii;
use app\models\Area;
use app\models\Curso;
use app\models\Usuario;
use app\models\UsuarioCurso;

class Dashboard{

    public static function get_cursos_usuario($carnet){
        $result = [];
        $area_rows = Area::find()->all();

        foreach($area_rows as $area_row){
            $cursos = UsuarioCurso::find()->joinWith('curso0','estadoCurso');
            $cursos = $cursos->where('usuario = :usuario', [':usuario' => $carnet]);
            $cursos = $cursos->andWhere('curso.area = :area', [':area' => $area_row->id]);
            $cursos = $cursos->all();

            $temp['area'] = $area_row;
            $temp['cursos'] = $cursos;
            $result[] = $temp;
        } // foreach

        return $result;
    } // get_cursos_usuario

}