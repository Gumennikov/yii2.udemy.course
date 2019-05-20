<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acme.citation".
 *
 * @property int $ID
 * @property string $AUTHOR_NAME
 * @property string $IZDANIE
 * @property string $TEXT
 * @property string $CREATED
 * @property string $CREATED_BY
 * @property string $UPDATED
 * @property string $UPDATED_BY
 * @property int $CITATION_STATUS
 * @property int $REC_STATUS
 */
class CitationRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acme.citation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AUTHOR_NAME', 'TEXT', 'CREATED_BY', 'UPDATED_BY', 'CITATION_STATUS'], 'required'],
            [['CREATED', 'UPDATED'], 'safe'],
            [['CREATED', 'UPDATED'], 'default', 'value' => time()],
            [['CITATION_STATUS', 'REC_STATUS'], 'integer'],
            [['AUTHOR_NAME', 'IZDANIE', 'TEXT', 'CREATED_BY', 'UPDATED_BY'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'AUTHOR_NAME' => 'Author Name',
            'IZDANIE' => 'Izdanie',
            'TEXT' => 'Text',
            'CREATED' => 'Created',
            'CREATED_BY' => 'Created By',
            'UPDATED' => 'Updated',
            'UPDATED_BY' => 'Updated By',
            'CITATION_STATUS' => 'Citation Status',
            'REC_STATUS' => 'Rec Status',
        ];
    }
}
