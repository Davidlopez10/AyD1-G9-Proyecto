<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prerrequisito".
 *
 * @property string $pre
 * @property string $post
 *
 * @property Curso $pre0
 * @property Curso $post0
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
            [['pre', 'post'], 'required'],
            [['pre', 'post'], 'string', 'max' => 10],
            [['pre', 'post'], 'unique', 'targetAttribute' => ['pre', 'post']],
            [['pre'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['pre' => 'codigo']],
            [['post'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['post' => 'codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pre' => 'Pre',
            'post' => 'Post',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPre0()
    {
        return $this->hasOne(Curso::className(), ['codigo' => 'pre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost0()
    {
        return $this->hasOne(Curso::className(), ['codigo' => 'post']);
    }
}
