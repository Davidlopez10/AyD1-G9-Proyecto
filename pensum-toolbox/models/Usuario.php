<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $carnet
 * @property string $nombres
 * @property string $apellidos
 *
 * @property Asignacion[] $asignacions
 * @property Curso[] $codigoCursos
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
            [['nombres', 'apellidos'], 'string', 'max' => 255],
            [['carnet'], 'unique'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacions()
    {
        return $this->hasMany(Asignacion::className(), ['carnet' => 'carnet']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoCursos()
    {
        return $this->hasMany(Curso::className(), ['codigo' => 'codigo_curso'])->viaTable('asignacion', ['carnet' => 'carnet']);
    }
}
