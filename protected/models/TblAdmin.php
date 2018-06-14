<?php

/**
 * This is the model class for table "tbl_admin".
 *
 * The followings are the available columns in table 'tbl_admin':
 * @property string $admin_id
 * @property string $full_name
 * @property string $phone_number
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string $is_verified
 * @property string $fConfirmPasscode
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class TblAdmin extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblAdmin the static model class
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
		return 'tbl_admin';
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
			array('full_name, email, avatar', 'length', 'max'=>255),
			array('phone_number', 'length', 'max'=>20),
			array('password', 'length', 'max'=>350),
			array('is_verified', 'length', 'max'=>300),
			array('fConfirmPasscode', 'length', 'max'=>150),
			array('created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('admin_id, full_name, phone_number, email, password, avatar, is_verified, fConfirmPasscode, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'admin_id' => 'Admin',
			'full_name' => 'Full Name',
			'phone_number' => 'Phone Number',
			'email' => 'Email',
			'password' => 'Password',
			'avatar' => 'Avatar',
			'is_verified' => 'Is Verified',
			'fConfirmPasscode' => 'F Confirm Passcode',
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

		$criteria->compare('admin_id',$this->admin_id,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('is_verified',$this->is_verified,true);
		$criteria->compare('fConfirmPasscode',$this->fConfirmPasscode,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

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


    function getAdminDetailsByEmail($email,$fields="*")
    {
        $admindata = Yii::app()->db->createCommand()

            ->select($fields)

            ->from($this->tableName())

            ->where('email=:email', array(':email'=>$email))

            ->queryRow();
        return $admindata;

    }

    function getAdminDataById($adminId)
    {
        $sql = "SELECT * FROM  tbl_admin WHERE admin_id ='".$adminId."'" ;
        $userdata =  Yii::app()->db->createCommand($sql)->queryRow();
        return $userdata;
    }
}