<?php

/**
 * This is the model class for table "tbl_usersession".
 *
 * The followings are the available columns in table 'tbl_usersession':
 * @property string $user_session_id
 * @property string $user_id
 * @property string $device_token
 * @property integer $user_type
 * @property string $session_code
 * @property string $endpointArn
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class TblUsersession extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblUsersession the static model class
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
		return 'tbl_usersession';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_type, status', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>22),
			array('device_token, session_code, endpointArn', 'length', 'max'=>255),
			array('created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_session_id, user_id, device_token, user_type, session_code, endpointArn, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'user_session_id' => 'User Session',
			'user_id' => 'User',
			'device_token' => 'Device Token',
			'user_type' => 'User Type',
			'session_code' => 'Session Code',
			'endpointArn' => 'Endpoint Arn',
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

		$criteria->compare('user_session_id',$this->user_session_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('device_token',$this->device_token,true);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('session_code',$this->session_code,true);
		$criteria->compare('endpointArn',$this->endpointArn,true);
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

    public function check_session_withToken($userID,$device_token)
    {
        $sql = "select *  from tbl_usersession where user_id = ".$userID."  AND device_token LIKE '".$device_token."'";
        $result	= Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }

    function checksessionExists($userID,$userType)
    {
        $sql = "SELECT * FROM  tbl_usersession where user_id = ".$userID." AND user_type = " . $userType;
        $result	=Yii::app()->db->createCommand($sql)->queryRow();

        return $result;
    }

    function getSessionDataByUserSessionID($user_session_id)
    {
        $result = Yii::app()->db->createCommand()
            ->select("*")
            ->from($this->tableName())
            ->where('user_session_id=:user_session_id ', array(':user_session_id'=>$user_session_id))
            ->queryRow();

        return $result ;
    }

    function checksession($user_id,$session_code,$user_type)
    {
        $sql = "select *  from tbl_usersession where user_id = " . $user_id . " AND user_type = " .$user_type . "  AND session_code = '".$session_code."'";
        $result	= Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }

    function deleteAllSessoion($userID,$userType)
    {
        $sql = "DELETE  from tbl_usersession where user_id = " . $userID . " AND  user_type = ". $userType ;
        $result	= Yii::app()->db->createCommand($sql)->execute();
        return $result;
    }
}