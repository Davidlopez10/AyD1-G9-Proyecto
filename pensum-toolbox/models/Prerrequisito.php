<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prerrequisito".
 *
 * @property string $codigo_pre
 * @property string $codigo_post
 *
 * @property Curso $codigoPre
 * @property Curso $codigoPost
 */
class Prerrequisito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prerrequisito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_pre', 'codigo_post'], 'required'],
            [['codigo_pre', 'codigo_post'], 'string', 'max' => 10],
            [['codigo_pre', 'codigo_post'], 'unique', 'targetAttribute' => ['codigo_pre', 'codigo_post']],
            [['codigo_pre'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['codigo_pre' => 'codigo']],
            [['codigo_post'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['codigo_post' => 'codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo_pre' => 'Codigo Pre',
            'codigo_post' => 'Codigo Post',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoPre()
    {
        return $this->hasOne(Curso::className(), ['codigo' => 'codigo_pre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoPost()
    {
        return $this->hasOne(Curso::className(), ['codigo' => 'codigo_post']);
    }
}
