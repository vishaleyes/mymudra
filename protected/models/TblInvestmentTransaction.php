<?php

/**
 * This is the model class for table "tbl_investment_transaction".
 *
 * The followings are the available columns in table 'tbl_investment_transaction':
 * @property string $inv_id
 * @property string $inv_type
 * @property double $inv_amount
 * @property string $user_ref_id
 * @property string $inv_transaction_date
 * @property string $description
 * @property string $created_at
 * @property string $modified_at
 */
class TblInvestmentTransaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblInvestmentTransaction the static model class
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
		return 'tbl_investment_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('inv_amount', 'numerical'),
			array('inv_type', 'length', 'max'=>20),
			array('user_ref_id', 'length', 'max'=>22),
			array('description', 'length', 'max'=>255),
			array('inv_transaction_date, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('inv_id, inv_type, inv_amount, user_ref_id, inv_transaction_date, description, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'inv_id' => 'Inv',
			'inv_type' => 'Inv Type',
			'inv_amount' => 'Inv Amount',
			'user_ref_id' => 'User Ref',
			'inv_transaction_date' => 'Inv Transaction Date',
			'description' => 'Description',
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

		$criteria->compare('inv_id',$this->inv_id,true);
		$criteria->compare('inv_type',$this->inv_type,true);
		$criteria->compare('inv_amount',$this->inv_amount);
		$criteria->compare('user_ref_id',$this->user_ref_id,true);
		$criteria->compare('inv_transaction_date',$this->inv_transaction_date,true);
		$criteria->compare('description',$this->description,true);
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
        $sql = "SELECT itrans.*,itr.*,ism.inv_stage_name FROM tbl_investment_transaction itrans
                INNER JOIN `tbl_inv_trans_reference` itr
                ON itrans.`inv_id` = itr.`inv_id`
                INNER JOIN `tbl_inv_stage_master` ism
                ON ism.`inv_stage_id` = itr.`inv_stage_id` WHERE itrans.user_ref_id = ".$user_ref_id;
        //$sql = "select * from tbl_investment_transaction where user_ref_id = ".$user_ref_id;
        $result	=Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }

}