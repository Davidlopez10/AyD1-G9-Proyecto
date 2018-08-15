<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curso".
 *
 * @property string $codigo
 * @property string $nombre
 * @property int $creditos
 * @property string $inicio_rama
 * @property int $id_area
 *
 * @property Asignacion[] $asignacions
 * @property Usuario[] $carnets
 * @property Area $area
 * @property Prerrequisito[] $prerrequisitos
 * @property Prerrequisito[] $prerrequisitos0
 * @property Curso[] $codigoPosts
 * @property Curso[] $codigoPres
 * @property Tarea[] $tareas
 */
class Curso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'creditos', 'inicio_rama', 'id_area'], 'required'],
            [['creditos', 'id_area'], 'integer'],
            [['codigo'], 'string', 'max' => 10],
            [['nombre'], 'string', 'max' => 255],
            [['inicio_rama'], 'string', 'max' => 1],
            [['codigo'], 'unique'],
            [['id_area'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['id_area' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'creditos' => 'Creditos',
            'inicio_rama' => 'Inicio Rama',
            'id_area' => 'Id Area',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacions()
    {
        return $this->hasMany(Asignacion::className(), ['codigo_curso' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarnets()
    {
        return $this->hasMany(Usuario::className(), ['carnet' => 'carnet'])->viaTable('asignacion', ['codigo_curso' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'id_area']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrerrequisitos()
    {
        return $this->hasMany(Prerrequisito::className(), ['codigo_pre' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrerrequisitos0()
    {
        return $this->hasMany(Prerrequisito::className(), ['codigo_post' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoPosts()
    {
        return $this->hasMany(Curso::className(), ['codigo' => 'codigo_post'])->viaTable('prerrequisito', ['codigo_pre' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoPres()
    {
        return $this->hasMany(Curso::className(), ['codigo' => 'codigo_pre'])->viaTable('prerrequisito', ['codigo_post' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareas()
    {
        return $this->hasMany(Tarea::className(), ['codigo_curso' => 'codigo']);
    }
}
