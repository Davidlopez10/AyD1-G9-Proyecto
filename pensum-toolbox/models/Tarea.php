<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tarea".
 *
 * @property int $id
 * @property string $codigo_curso
 *
 * @property Curso $codigoCurso
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
            [['codigo_curso'], 'string', 'max' => 10],
            [['codigo_curso'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['codigo_curso' => 'codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo_curso' => 'Codigo Curso',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoCurso()
    {
        return $this->hasOne(Curso::className(), ['codigo' => 'codigo_curso']);
    }
}
