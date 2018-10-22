<?php

namespace app\utilities;

use Yii;
use app\models\Tarea;

class Notificaciones{

    public static function get_cursos($carnet_usuario){
        $result = [];
        $area_rows = Area::find()->all();

        foreach($area_rows as $area_row){
            $cursos = Dashboard::get_cursos_por_area($carnet_usuario, $area_row->id);

            $temp['area'] = $area_row;
            $temp['cursos'] = $cursos;
            $temp['porcentaje'] = OperacionesArea::get_porcentaje_area($area_row->id, $carnet_usuario);
            $result[] = $temp;
        } // foreach

        return $result;
    } // get_cursos_usuario

    public static function get_cursos_por_area($carnet_usuario, $id_area){
        $query = UsuarioCurso::find()->joinWith('curso0','estadoCurso');
        $query = $query->where('usuario = :usuario', [':usuario' => $carnet_usuario]);
        $query = $query->andWhere('curso.area = :area', [':area' => $id_area]);
        $query = $query->all();
        return $query;
    } // get_cursos_usuario_por_area


    /**
     * Proceso de envio de notificacion al usuario que creo el recordatorio.
     * @param  String $correo          Correo del usuario
     * @param  String $descripcion     Descripcion de la tarea
     * @param  String $nombres         Nombre del usuario
     * @return boolean                 Retorna true si envia el correo, false si no lo hace.
     */
    public static function enviar_correo($correo, $descripcion, $nombres){

    }// enviar_correo

}
