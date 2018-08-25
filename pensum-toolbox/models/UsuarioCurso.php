<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario_curso".
 *
 * @property int $usuario
 * @property string $curso
 * @property int $estado_curso
 *
 * @property Usuario $usuario0
 * @property Curso $curso0
 * @property EstadoCurso $estadoCurso
 */
class UsuarioCurso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario_curso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario', 'curso', 'estado_curso'], 'required'],
            [['usuario', 'estado_curso'], 'integer'],
            [['curso'], 'string', 'max' => 10],
            [['usuario', 'curso'], 'unique', 'targetAttribute' => ['usuario', 'curso']],
            [['usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario' => 'carnet']],
            [['curso'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['curso' => 'codigo']],
            [['estado_curso'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoCurso::className(), 'targetAttribute' => ['estado_curso' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usuario' => 'Usuario',
            'curso' => 'Curso',
            'estado_curso' => 'Estado Curso',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['carnet' => 'usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurso0()
    {
        return $this->hasOne(Curso::className(), ['codigo' => 'curso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoCurso()
    {
        return $this->hasOne(EstadoCurso::className(), ['id' => 'estado_curso']);
    }
}
