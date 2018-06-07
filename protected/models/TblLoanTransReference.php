<?php

/**
 * This is the model class for table "tbl_loan_trans_reference".
 *
 * The followings are the available columns in table 'tbl_loan_trans_reference':
 * @property string $loan_tran_ref_id
 * @property string $loan_id
 * @property string $loan_stage_id
 * @property string $stage_transaction_date
 * @property string $created_at
 * @property string $modified_at
 */
class TblLoanTransReference extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblLoanTransReference the static model class
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
		return 'tbl_loan_trans_reference';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('loan_id, loan_stage_id', 'length', 'max'=>22),
			array('stage_transaction_date, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('loan_tran_ref_id, loan_id, loan_stage_id, stage_transaction_date, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'loan_tran_ref_id' => 'Loan Tran Ref',
			'loan_id' => 'Loan',
			'loan_stage_id' => 'Loan Stage',
			'stage_transaction_date' => 'Stage Transaction Date',
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

		$criteria->compare('loan_tran_ref_id',$this->loan_tran_ref_id,true);
		$criteria->compare('loan_id',$this->loan_id,true);
		$criteria->compare('loan_stage_id',$this->loan_stage_id,true);
		$criteria->compare('stage_transaction_date',$this->stage_transaction_date,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    // set the user data
    function setData($data)
    {
        $this->data = $data;
    }

    // insert the user
    function insertData($id=NULL)
    {
        if($id!=NULL)
        {
            //$transaction=$this->dbConnection->beginTransaction();
            try
            {
                $post=$this->findByPk($id);
                if(is_object($post))
                {
                    $p=$this->data;

                    foreach($p as $key=>$value)
                    {
                        $post->$key=$value;
                    }
                    $post->save(false);
                }
                //$transaction->commit();
            }
            catch(Exception $e)
            {
                //$transaction->rollBack();
            }
        }
        else
        {
            $p=$this->data;
            foreach($p as $key=>$value)
            {
                $this->$key=$value;
            }
            $this->setIsNewRecord(true);
            $this->save(false);
            return Yii::app()->db->getLastInsertID();
        }
    }
}