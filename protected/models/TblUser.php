<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
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
 * @property string $created_at
 * @property string $modified_at
 * @property string $password
 * @property integer $status
 * @property string $app_version
 * @property integer $device_type
 * @property string $device_model
 * @property string $device_os
 * @property string $is_verified
 * @property string $fConfirmPasscode
 */
class TblUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblUser the static model class
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
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, device_type', 'numerical', 'integerOnly'=>true),
			array('full_name, email, street, city, state, pincode, app_version', 'length', 'max'=>255),
			array('phone_number, employment_type', 'length', 'max'=>20),
			array('annual_income', 'length', 'max'=>12),
			array('password', 'length', 'max'=>350),
			array('device_model, device_os', 'length', 'max'=>100),
			array('is_verified', 'length', 'max'=>300),
			array('fConfirmPasscode', 'length', 'max'=>150),
			array('created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, full_name, phone_number, email, employment_type, annual_income, street, city, state, pincode, created_at, modified_at, password, status, app_version, device_type, device_model, device_os, is_verified, fConfirmPasscode', 'safe', 'on'=>'search'),
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
			'created_at' => 'Created At',
			'modified_at' => 'Modified At',
			'password' => 'Password',
			'status' => 'Status',
			'app_version' => 'App Version',
			'device_type' => 'Device Type',
			'device_model' => 'Device Model',
			'device_os' => 'Device Os',
			'is_verified' => 'Is Verified',
			'fConfirmPasscode' => 'F Confirm Passcode',
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
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('app_version',$this->app_version,true);
		$criteria->compare('device_type',$this->device_type);
		$criteria->compare('device_model',$this->device_model,true);
		$criteria->compare('device_os',$this->device_os,true);
		$criteria->compare('is_verified',$this->is_verified,true);
		$criteria->compare('fConfirmPasscode',$this->fConfirmPasscode,true);

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
        $sql = "select * from tbl_user where phone_number = '".$mobile_number."' ".$user_id." ";
        $result	=Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }

    function checkEmailMobilenumberExists($mobile_number=NULL,$user_id=NULL)
    {
        if($user_id != "")
        {
            $user_id = "And user_id != ".$user_id." ";
        } else{
            $user_id = "";
        }
        $mobile_number =addslashes($mobile_number);
        $sql = "select * from tbl_user where (email = '".$mobile_number."' or phone_number = '".$mobile_number."') ".$user_id." ";
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
        $sql = "select * from tbl_user where email  = '".$email."'  ".$user_id."    ";
        $result	=Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }

    function genPassword()
    {
        $pass_char = array();
        $password = '';
        for($i=65 ; $i < 91 ; $i++)
        {
            $pass_char[] = chr($i);
        }
        for($i=97 ; $i < 123 ; $i++)
        {
            $pass_char[] = chr($i);
        }
        for($i=48 ; $i < 58 ; $i++)
        {
            $pass_char[] = chr($i);
        }
        for($i=0 ; $i<8 ; $i++)
        {
            $password .= $pass_char[rand(0,61)];
        }
        return $password;
    }

    function getUserdetailsbyId($user_id)
    {
        $sql = "select * from tbl_user where user_id = " . $user_id ;
        $result	= Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }

    function getAdmindetailsbyId($admin_id)
    {
        $sql = "select * from tbl_user where user_id = " . $admin_id ;
        $result	= Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
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

    function getAllUserPaginated($limit=10,$sortType="asc",$sortBy="user_id",$keyword=NULL,$filter=NULL)
    {
        $criteria = new CDbCriteria();
        /*echo $keyword;
        echo "<pre>"; print_r($filter); die;*/
        $search = " ";

        if(isset($keyword) && $keyword!= NULL )
        {
            $con = " WHERE (full_name like '%".addslashes($keyword)."%' or phone_number like '%".addslashes($keyword)."%' or annual_income like '%".addslashes($keyword)."%' or city like '%".addslashes($keyword)."%' or state like '%".addslashes($keyword)."%' or created_at like '%".addslashes($keyword)."%')";
        }
        else
        {
            $con = "";
        }
        //echo $con; die;
        if(isset($filter['date_from']) && $filter['date_from']!='' && isset($filter['date_to']) && $filter['date_to']!='')
        {   //echo "filter if"; die;
            if(isset($con) && $con != "")
            {   //echo "inner if"; die;
                $search .= $con." AND ";
                if($filter['date_from'] == $filter['date_to']){
                    $search .= " ( created_at LIKE '%".addslashes($filter['date_from'])."%')";
                }
                else{
                    $search .= " ( (created_at >= '".addslashes($filter['date_from'])."' OR created_at LIKE '%".addslashes($filter['date_from'])."%' )
                AND (created_at <= '".addslashes($filter['date_to'])."' OR created_at LIKE '%".addslashes($filter['date_to'])."%'  ) )";
                }
            }
            else
            {   //echo "inner else"; die;
                $search .= " WHERE ";
                if($filter['date_from'] == $filter['date_to']){
                    $search .= " ( created_at LIKE '%".addslashes($filter['date_from'])."%')";
                }
                else{
                    $search .= " ( (created_at >= '".addslashes($filter['date_from'])."' OR created_at LIKE '%".addslashes($filter['date_from'])."%' )
                AND (created_at <= '".addslashes($filter['date_to'])."' OR created_at LIKE '%".addslashes($filter['date_to'])."%'  ) )";
                }
            }
        }
        else
        {
            if(isset($con) && $con != "")
            {   //echo "inner if"; die;
                $search .= $con;
            }
            else
            {
                $search .= "";
            }
        }
            //echo $search; die;
        $sql = "SELECT * FROM tbl_user ".$search." order by ".$sortBy." ".$sortType." ";

        $sql_count = "SELECT count(*) FROM tbl_user ".$search." order by ".$sortBy." ".$sortType." ";

        //echo $sql; die;

        $count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
        //echo $sql_count;
        $result	=	new CSqlDataProvider($sql, array(
            'totalItemCount'=>$count,
            'pagination'=>array(
                'pageSize'=>$limit,
            ),
        ));

        $index = 0;
        return array('pagination'=>$result->pagination, 'userList'=>$result->getData());
    }

    function resetpassword($data)
    {
        $generalObj = new General();

        $id=$this->getIdByfpasswordConfirm($data['token']);
        // print_r($data);die;

        if(strlen($data['new_password'])>=6)
        {
            if($data['new_password']==$data['new_password_confirm'])
            {
                $new_password =$generalObj->encrypt_password($data['new_password']);

                $admin_field['password'] = $new_password;
                $admin_field['fConfirmPasscode']= NULL;

                $this->setData($admin_field);

                $this->insertData($id);

                return array('success',"Success");
            }
            else
            {
                return array('fail',"Failed");
            }
        }
        else
        {
            return array('fail',"Failed");
        }
    }

    function getIdByfpasswordConfirm($token)
    {
        $sql = "select user_id from tbl_user where fConfirmPasscode = '".$token."' ";
        $result	=Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }

    function getRegisteredUserForBankLoanListById($user_id=NULL)
    {
        $sql = "SELECT u.*,ltrans.*,ltmast.description as loan_type_name FROM tbl_user u INNER JOIN `tbl_user_refrence` ur
                ON ur.`user_id` = u.`user_id` 
                INNER JOIN `tbl_loan_transaction` ltrans 
                ON ltrans.`user_ref_id` = ur.`user_ref_id`
                INNER JOIN `tbl_loan_type_master` ltmast 
                ON ltmast.`loan_type_id` = ltrans.`loan_type` WHERE u.user_id = ".$user_id;
        $result	=Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function getRegisteredUserForInvLoanListById($user_id=NULL)
    {
        $sql = "SELECT u.*,ittrans.*,itmast.description as inv_type_name FROM tbl_user u INNER JOIN `tbl_user_refrence` ur
                ON ur.`user_id` = u.`user_id` 
                INNER JOIN `tbl_investment_transaction` ittrans 
                ON ittrans.`user_ref_id` = ur.`user_ref_id`
                INNER JOIN `tbl_inv_type_master` itmast 
                ON itmast.`inv_type_id` = ittrans.`inv_type` WHERE u.user_id = ".$user_id;
        $result	=Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function getRegisteredUserForPropLoanListById($user_id=NULL)
    {
        $sql = "SELECT u.*,ptrans.*,pmast.description as prop_type_name FROM tbl_user u INNER JOIN `tbl_user_refrence` ur
                ON ur.`user_id` = u.`user_id` 
                INNER JOIN `tbl_property_transaction` ptrans 
                ON ptrans.`user_ref_id` = ur.`user_ref_id`
                INNER JOIN `tbl_property_type_master` pmast 
                ON pmast.`property_type_id` = ptrans.`property_transaction_type` WHERE u.user_id = ".$user_id;
        $result	=Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function getUserListByDate()
    {
        if((isset($fromDate) && $fromDate != "") && (isset($toDate) && $toDate))
        {
            $condition = "AND (DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '".$fromDate."' AND '".$toDate."')";
        }
        else
        {
            $condition = "";
        }
        $sql = "SELECT * FROM tbl_user WHERE `status` =  1 ".$condition;
        $result	= Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

}