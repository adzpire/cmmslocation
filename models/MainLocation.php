<?php

namespace adzpire\location\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "main_location".
 *
 * @property integer $id
 * @property string $loc_name
 * @property string $loc_name_eng
 * @property integer $loc_floor
 *
 * @property InvtLochistory[] $invtLochistories
 * @property InvtMain[] $invtMains
 */
class MainLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loc_name', 'loc_floor'], 'required'],
            [['loc_floor'], 'integer'],
            [['loc_name', 'loc_name_eng'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loc_name' => 'ชื่อ',
            'loc_name_eng' => 'ชื่อภาษาอังกฤษ',
            'loc_floor' => 'ชั้นที่',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvtLochistories()
    {
        return $this->hasMany(InvtLochistory::className(), ['invt_locID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvtMains()
    {
        return $this->hasMany(InvtMain::className(), ['invt_locationID' => 'id']);
    }

    public static function getLocationList(){
        return ArrayHelper::map(self::find()->all(), 'id', 'loc_name');
    }
}
