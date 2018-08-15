<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asignacion".
 *
 * @property int $carnet
 * @property string $codigo_curso
 *
 * @property Usuario $carnet0
 * @property Curso $codigoCurso
 */
class Asignacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asignacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carnet', 'codigo_curso'], 'required'],
            [['carnet'], 'integer'],
            [['codigo_curso'], 'string', 'max' => 10],
            [['carnet', 'codigo_curso'], 'unique', 'targetAttribute' => ['carnet', 'codigo_curso']],
            [['carnet'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['carnet' => 'carnet']],
            [['codigo_curso'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['codigo_curso' => 'codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'carnet' => 'Carnet',
            'codigo_curso' => 'Codigo Curso',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarnet0()
    {
        return $this->hasOne(Usuario::className(), ['carnet' => 'carnet']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoCurso()
    {
        return $this->hasOne(Curso::className(), ['codigo' => 'codigo_curso']);
    }
}
