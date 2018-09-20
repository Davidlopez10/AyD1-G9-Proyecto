<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $carnet
 * @property string $nombres
 * @property string $apellidos
 * @property string $contrasena
 * @property string $correo
 *
 * @property UsuarioCurso[] $usuarioCursos
 * @property Curso[] $cursos
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carnet', 'nombres', 'apellidos'], 'required'],
            [['carnet'], 'integer'],
            [['nombres', 'apellidos', 'contrasena', 'correo'], 'string', 'max' => 255],
            [['carnet'], 'unique'],
            [['contrasena'], 'string', 'min'=>8],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'carnet' => 'Carnet',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'contrasena' => 'Contrasena',
            'correo' => 'Correo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioCursos()
    {
        return $this->hasMany(UsuarioCurso::className(), ['usuario' => 'carnet']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::className(), ['codigo' => 'curso'])->viaTable('usuario_curso', ['usuario' => 'carnet']);
    }
}
