<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tarea".
 *
 * @property int $id
 * @property string $descripcion
 * @property string $fecha
 * @property int $usuario
 *
 * @property Usuario $usuario0
 */
class Tarea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarea';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'fecha', 'usuario'], 'required'],
            [['fecha'], 'safe'],
            [['usuario'], 'integer'],
            [['descripcion'], 'string', 'max' => 500],
            [['usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario' => 'carnet']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'fecha' => 'Fecha',
            'usuario' => 'Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['carnet' => 'usuario']);
    }
}
