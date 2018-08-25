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
 * @property string $obligatorio
 * @property int $creditos_necesarios
 * @property int $area
 *
 * @property Area $area0
 * @property Prerrequisito[] $prerrequisitos
 * @property Prerrequisito[] $prerrequisitos0
 * @property Curso[] $posts
 * @property Curso[] $pres
 * @property UsuarioCurso[] $usuarioCursos
 * @property Usuario[] $usuarios
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
            [['codigo', 'nombre', 'creditos', 'inicio_rama', 'obligatorio', 'area'], 'required'],
            [['creditos', 'creditos_necesarios', 'area'], 'integer'],
            [['codigo'], 'string', 'max' => 10],
            [['nombre'], 'string', 'max' => 255],
            [['inicio_rama', 'obligatorio'], 'string', 'max' => 1],
            [['codigo'], 'unique'],
            [['area'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['area' => 'id']],
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
            'obligatorio' => 'Obligatorio',
            'creditos_necesarios' => 'Creditos Necesarios',
            'area' => 'Area',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea0()
    {
        return $this->hasOne(Area::className(), ['id' => 'area']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrerrequisitos()
    {
        return $this->hasMany(Prerrequisito::className(), ['pre' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrerrequisitos0()
    {
        return $this->hasMany(Prerrequisito::className(), ['post' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Curso::className(), ['codigo' => 'post'])->viaTable('prerrequisito', ['pre' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPres()
    {
        return $this->hasMany(Curso::className(), ['codigo' => 'pre'])->viaTable('prerrequisito', ['post' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioCursos()
    {
        return $this->hasMany(UsuarioCurso::className(), ['curso' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['carnet' => 'usuario'])->viaTable('usuario_curso', ['curso' => 'codigo']);
    }
}
