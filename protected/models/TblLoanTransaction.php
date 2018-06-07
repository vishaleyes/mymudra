<?php

/**
 * This is the model class for table "tbl_loan_transaction".
 *
 * The followings are the available columns in table 'tbl_loan_transaction':
 * @property string $loan_id
 * @property string $loan_type
 * @property double $loan_amount
 * @property string $user_ref_id
 * @property string $load_transaction_date
 * @property string $description
 * @property string $bank_id
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class TblLoanTransaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblLoanTransaction the static model class
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
		return 'tbl_loan_transaction';
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
			array('loan_amount', 'numerical'),
			array('loan_type, user_ref_id, bank_id', 'length', 'max'=>22),
			array('description', 'length', 'max'=>255),
			array('load_transaction_date, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('loan_id, loan_type, loan_amount, user_ref_id, load_transaction_date, description, bank_id, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'loan_id' => 'Loan',
			'loan_type' => 'Loan Type',
			'loan_amount' => 'Loan Amount',
			'user_ref_id' => 'User Ref',
			'load_transaction_date' => 'Load Transaction Date',
			'description' => 'Description',
			'bank_id' => 'Bank',
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

		$criteria->compare('loan_id',$this->loan_id,true);
		$criteria->compare('loan_type',$this->loan_type,true);
		$criteria->compare('loan_amount',$this->loan_amount);
		$criteria->compare('user_ref_id',$this->user_ref_id,true);
		$criteria->compare('load_transaction_date',$this->load_transaction_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('bank_id',$this->bank_id,true);
		$criteria->compare('status',$this->status);
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

    public function getDetailsByUserRefId($user_ref_id=NULL)
    {
        $sql = "select * from tbl_loan_transaction where user_ref_id = ".$user_ref_id;
        $result	=Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }

}