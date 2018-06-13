<?php

/**
 * This is the model class for table "tbl_property_transaction".
 *
 * The followings are the available columns in table 'tbl_property_transaction':
 * @property string $property_id
 * @property string $property_transaction_type
 * @property double $property_size
 * @property string $property_size_type
 * @property string $property_type
 * @property string $user_ref_id
 * @property string $property_transaction_date
 * @property string $created_at
 * @property string $modified_at
 */
class TblPropertyTransaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblPropertyTransaction the static model class
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
		return 'tbl_property_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('property_size', 'numerical'),
			array('property_transaction_type, user_ref_id', 'length', 'max'=>22),
			array('property_size_type, property_type', 'length', 'max'=>20),
			array('property_transaction_date, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('property_id, property_transaction_type, property_size, property_size_type, property_type, user_ref_id, property_transaction_date, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'property_id' => 'Property',
			'property_transaction_type' => 'Property Transaction Type',
			'property_size' => 'Property Size',
			'property_size_type' => 'Property Size Type',
			'property_type' => 'Property Type',
			'user_ref_id' => 'User Ref',
			'property_transaction_date' => 'Property Transaction Date',
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

		$criteria->compare('property_id',$this->property_id,true);
		$criteria->compare('property_transaction_type',$this->property_transaction_type,true);
		$criteria->compare('property_size',$this->property_size);
		$criteria->compare('property_size_type',$this->property_size_type,true);
		$criteria->compare('property_type',$this->property_type,true);
		$criteria->compare('user_ref_id',$this->user_ref_id,true);
		$criteria->compare('property_transaction_date',$this->property_transaction_date,true);
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
        //$sql = "select * from tbl_property_transaction where user_ref_id = ".$user_ref_id;
        $sql = "SELECT ptrans.*,ptr.*,psm.prop_stage_name,ptrans.property_id AS property_transaction_id FROM tbl_property_transaction ptrans
                LEFT JOIN `tbl_prop_trans_reference` ptr 
                ON ptrans.`property_id` = ptr.`property_id`
                LEFT JOIN `tbl_property_stage_master` psm
                ON psm.`property_stage_id` = ptr.`property_stage_id` WHERE ptrans.user_ref_id = ".$user_ref_id;
        $result	=Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }

    public function getPropertyDetailsById($property_id=NULL)
    {
        $sql = "SELECT * FROM tbl_property_transaction WHERE property_id = ".$property_id;
        $result	=Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }
}