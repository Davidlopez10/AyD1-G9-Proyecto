<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_curso".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property UsuarioCurso[] $usuarioCursos
 */
class EstadoCurso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado_curso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nombre'], 'required'],
            [['id'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioCursos()
    {
        return $this->hasMany(UsuarioCurso::className(), ['estado_curso' => 'id']);
    }
}
