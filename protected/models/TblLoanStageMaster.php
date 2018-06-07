<?php

/**
 * This is the model class for table "tbl_loan_stage_master".
 *
 * The followings are the available columns in table 'tbl_loan_stage_master':
 * @property string $loan_stage_id
 * @property string $loan_stage_name
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class TblLoanStageMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblLoanStageMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_loan_stage_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('loan_stage_name', 'length', 'max'=>255),
			array('created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('loan_stage_id, loan_stage_name, status, created_at, modified_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'loan_stage_id' => 'Loan Stage',
			'loan_stage_name' => 'Loan Stage Name',
			'status' => 'Status',
			'created_at' => 'Created At',
			'modified_at' => 'Modified At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('loan_stage_id',$this->loan_stage_id,true);
		$criteria->compare('loan_stage_name',$this->loan_stage_name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getLoanStage()
    {
        $sql = "SELECT * FROM tbl_loan_stage_master WHERE status = 1";
        $result	=Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }
}