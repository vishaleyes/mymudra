<?php

/**
 * This is the model class for table "tbl_api_calls".
 *
 * The followings are the available columns in table 'tbl_api_calls':
 * @property string $api_call_id
 * @property string $api_name
 * @property string $request
 * @property string $response
 * @property string $time
 * @property string $rideID
 * @property integer $status
 * @property string $created
 */
class TblApiCalls extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblApiCalls the static model class
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
		return 'tbl_api_calls';
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
			array('api_name, time', 'length', 'max'=>255),
			array('rideID', 'length', 'max'=>22),
			array('request, response, created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('api_call_id, api_name, request, response, time, rideID, status, created', 'safe', 'on'=>'search'),
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
			'api_call_id' => 'Api Call',
			'api_name' => 'Api Name',
			'request' => 'Request',
			'response' => 'Response',
			'time' => 'Time',
			'rideID' => 'Ride',
			'status' => 'Status',
			'created' => 'Created',
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

		$criteria->compare('api_call_id',$this->api_call_id,true);
		$criteria->compare('api_name',$this->api_name,true);
		$criteria->compare('request',$this->request,true);
		$criteria->compare('response',$this->response,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('rideID',$this->rideID,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created,true);

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
}