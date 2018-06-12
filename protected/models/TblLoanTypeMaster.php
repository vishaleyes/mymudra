<?php

/**
 * This is the model class for table "tbl_loan_type_master".
 *
 * The followings are the available columns in table 'tbl_loan_type_master':
 * @property string $loan_type_id
 * @property string $description
 * @property string $loan_type_parent_id
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class TblLoanTypeMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblLoanTypeMaster the static model class
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
		return 'tbl_loan_type_master';
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
			array('description', 'length', 'max'=>255),
			array('loan_type_parent_id', 'length', 'max'=>20),
			array('created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('loan_type_id, description, loan_type_parent_id, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'loan_type_id' => 'Loan Type',
			'description' => 'Description',
			'loan_type_parent_id' => 'Loan Type Parent',
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

		$criteria->compare('loan_type_id',$this->loan_type_id,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('loan_type_parent_id',$this->loan_type_parent_id,true);
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

	function getLoanTypeList()
    {
        $sql = "SELECT * FROM  tbl_loan_type_master where loan_type_parent_id = 0";
        $result =  Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function getBankLoanTypeList($loan_type_id=NULL)
    {
        $sql = "SELECT * FROM  tbl_loan_type_master where status = 1 AND loan_type_parent_id = ".$loan_type_id;
        $result =  Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function getAllBankLoanPaginated($limit=10,$sortType="asc",$sortBy="loan_type_id",$keyword=NULL)
    {
        $criteria = new CDbCriteria();

        $search = " ";

        if(isset($keyword) && $keyword != NULL )
        {
            $search .= " where (description like '%".$keyword."%')";
        }

        $sql = "SELECT * FROM tbl_loan_type_master ".$search." order by ".$sortBy." ".$sortType." ";

        $sql_count = "SELECT count(*) FROM tbl_loan_type_master ".$search." order by ".$sortBy." ".$sortType." ";

        //echo $sql;

        $count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
        //echo $sql_count;
        $result	=	new CSqlDataProvider($sql, array(
            'totalItemCount'=>$count,
            'pagination'=>array(
                'pageSize'=>$limit,
            ),
        ));

        $index = 0;
        return array('pagination'=>$result->pagination, 'bankLoanList'=>$result->getData());
    }

    function getBankSubLoanTypeListById($loan_type_id=NULL)
    {
        $sql = "SELECT * FROM tbl_loan_type_master WHERE loan_type_parent_id = ".$loan_type_id;
        $result =  Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

}