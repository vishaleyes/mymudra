<?php

/**
 * This is the model class for table "tbl_user_refrence".
 *
 * The followings are the available columns in table 'tbl_user_refrence':
 * @property string $user_ref_id
 * @property string $user_id
 * @property string $full_name
 * @property string $phone_number
 * @property string $email
 * @property string $employment_type
 * @property string $annual_income
 * @property string $street
 * @property string $city
 * @property string $state
 * @property string $pincode
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class TblUserRefrence extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblUserRefrence the static model class
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
		return 'tbl_user_refrence';
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
			array('user_id', 'length', 'max'=>22),
			array('full_name, email, street, city, state, pincode', 'length', 'max'=>255),
			array('phone_number, employment_type', 'length', 'max'=>20),
			array('annual_income', 'length', 'max'=>12),
			array('created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_ref_id, user_id, full_name, phone_number, email, employment_type, annual_income, street, city, state, pincode, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'user_ref_id' => 'User Ref',
			'user_id' => 'User',
			'full_name' => 'Full Name',
			'phone_number' => 'Phone Number',
			'email' => 'Email',
			'employment_type' => 'Employment Type',
			'annual_income' => 'Annual Income',
			'street' => 'Street',
			'city' => 'City',
			'state' => 'State',
			'pincode' => 'Pincode',
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

		$criteria->compare('user_ref_id',$this->user_ref_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('employment_type',$this->employment_type,true);
		$criteria->compare('annual_income',$this->annual_income,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('pincode',$this->pincode,true);
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

    function checkMobilenumberExists($mobile_number=NULL,$user_id=NULL)
    {
        if($user_id != "")
        {
            $user_id = "And user_id != ".$user_id." ";
        } else{
            $user_id = "";
        }
        $mobile_number =addslashes($mobile_number);
        $sql = "select * from tbl_user_refrence where phone_number = '".$mobile_number."' ".$user_id." ";
        $result	=Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }

    function checkEmailExists($email=NULL,$user_id=NULL)
    {
        if($user_id != "")
        {
            $user_id = "And user_id != ".$user_id." ";
        } else{
            $user_id = "";
        }
        $email = addslashes($email);
        $sql = "select * from tbl_user_refrence where email  = '".$email."'  ".$user_id."    ";
        $result	=Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }

    function getUserdetailsbyId($user_id)
    {
        $sql = "select * from tbl_user_refrence where user_ref_id = " . $user_id ;
        $result	= Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }
}