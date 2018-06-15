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

    function getAllBankLoanAppliedUserPaginated($limit=10,$sortType="asc",$sortBy="user_ref_id",$keyword=NULL,$filter=NULL,$stage_id=NULL)
    {
        $criteria = new CDbCriteria();

        $search = " ";
        if(isset($stage_id) && $stage_id != "")
        {
            $project_con = "WHERE lsm.`loan_stage_id` = ". $stage_id;
        }
        else
        {
            $project_con = "";
        }

        if(isset($keyword) && $keyword != NULL )
        {
            if(isset($project_con) && $project_con!='')
            {
                $search .= $project_con." AND ";
            }
            else
            {
                $search .= " WHERE ";
            }
            $search .= " (ur.full_name like '%".addslashes($keyword)."%' or ur.phone_number like '%".addslashes($keyword)."%' or ur.annual_income like '%".addslashes($keyword)."%' or loan_amount like '%".addslashes($keyword)."%' or ltm.description like '%".addslashes($keyword)."%' or lsm.loan_stage_name like '%".addslashes($keyword)."%' or ltm1.description like '%".addslashes($keyword)."%' or u.full_name like '%".addslashes($keyword)."%')";
        }
        else
        {
            if(isset($project_con) && $project_con!='')
            {
                $search .= $project_con;
            }
            else
            {
                $search .= '';
            }
        }

        if(isset($filter['date_from']) && $filter['date_from']!='' && isset($filter['date_to']) && $filter['date_to']!='')
        {   //echo "first if"; die;
            if(isset($search) && $search!='')
            {
                $search .= " AND ";

                if($filter['date_from'] == $filter['date_to']){
                    $search .= "  ( ur.created_at LIKE '%".addslashes($filter['date_from'])."%')";
                }
                else{
                    $search .= "  ( (ur.created_at >= '".addslashes($filter['date_from'])."' OR ur.created_at LIKE '%".addslashes($filter['date_from'])."%' ) AND (ur.created_at <= '".addslashes($filter['date_to'])."' OR ur.created_at LIKE '%".addslashes($filter['date_to'])."%'  ) )";
                }
            }
            else
            {
                $search .= " WHERE ";

                if($filter['date_from'] == $filter['date_to']){
                    $search .= "  ( ur.created_at LIKE '%".addslashes($filter['date_from'])."%')";
                }
                else{
                    $search .= "  ( (ur.created_at >= '".addslashes($filter['date_from'])."' OR ur.created_at LIKE '%".addslashes($filter['date_from'])."%' ) AND (ur.created_at <= '".addslashes($filter['date_to'])."' OR ur.created_at LIKE '%".addslashes($filter['date_to'])."%'  ) )";
                }
            }
        }

        /*$sql = "SELECT ur.*, ltrans.*,ltr.*,lsm.loan_stage_name,ltrans.loan_id As loan_transaction_id,
            ltm.description AS loan_type_name,ur.`created_at` AS createdDate, ltm1.description AS loan_sub_type_name
            FROM `tbl_user_refrence` ur INNER JOIN `tbl_loan_transaction` ltrans
            ON ur.`user_ref_id` = ltrans.`user_ref_id`
            LEFT JOIN `tbl_loan_type_master` ltm
            ON ltm.loan_type_id = ltrans.`loan_type`
            LEFT JOIN `tbl_loan_type_master` ltm1
            ON ltm1.loan_type_id = ltrans.`loan_sub_type`
            LEFT JOIN `tbl_loan_trans_reference` ltr
            ON ltrans.`loan_id` = ltr.`loan_id`
            LEFT JOIN `tbl_loan_stage_master` lsm
            ON lsm.`loan_stage_id` = ltr.`loan_stage_id` ".$search." order by ".$sortBy." ".$sortType." ";*/

        $sql = "SELECT ur.*, ltrans.*,ltr.*,lsm.loan_stage_name,ltrans.loan_id AS loan_transaction_id,
            ltm.description AS loan_type_name,ur.`created_at` AS createdDate, ltm1.description AS loan_sub_type_name,
            u.full_name AS referenceBy
            FROM `tbl_user_refrence` ur INNER JOIN `tbl_loan_transaction` ltrans
            ON ur.`user_ref_id` = ltrans.`user_ref_id`
            LEFT JOIN `tbl_loan_type_master` ltm
            ON ltm.loan_type_id = ltrans.`loan_type`
            LEFT JOIN `tbl_loan_type_master` ltm1
            ON ltm1.loan_type_id = ltrans.`loan_sub_type`
            LEFT JOIN `tbl_loan_trans_reference` ltr
            ON ltrans.`loan_id` = ltr.`loan_id`
            LEFT JOIN `tbl_loan_stage_master` lsm
            ON lsm.`loan_stage_id` = ltr.`loan_stage_id`
            INNER JOIN `tbl_user` u
            ON u.user_id = ur.user_id ".$search." order by ".$sortBy." ".$sortType." ";
        //echo $sql; die;
        /*$sql_count = "SELECT COUNT(*) FROM `tbl_user_refrence` ur INNER JOIN `tbl_loan_transaction` ltrans
            ON ur.`user_ref_id` = ltrans.`user_ref_id`
            LEFT JOIN `tbl_loan_type_master` ltm
            ON ltm.loan_type_id = ltrans.`loan_type`
            LEFT JOIN `tbl_loan_type_master` ltm1
            ON ltm1.loan_type_id = ltrans.`loan_sub_type`
            LEFT JOIN `tbl_loan_trans_reference` ltr
            ON ltrans.`loan_id` = ltr.`loan_id`
            LEFT JOIN `tbl_loan_stage_master` lsm
            ON lsm.`loan_stage_id` = ltr.`loan_stage_id` ".$search." order by ".$sortBy." ".$sortType." ";*/

        $sql_count = "SELECT COUNT(*) FROM `tbl_user_refrence` ur INNER JOIN `tbl_loan_transaction` ltrans
            ON ur.`user_ref_id` = ltrans.`user_ref_id`
            LEFT JOIN `tbl_loan_type_master` ltm
            ON ltm.loan_type_id = ltrans.`loan_type`
            LEFT JOIN `tbl_loan_type_master` ltm1
            ON ltm1.loan_type_id = ltrans.`loan_sub_type`
            LEFT JOIN `tbl_loan_trans_reference` ltr
            ON ltrans.`loan_id` = ltr.`loan_id`
            LEFT JOIN `tbl_loan_stage_master` lsm
            ON lsm.`loan_stage_id` = ltr.`loan_stage_id`
            INNER JOIN `tbl_user` u
            ON u.user_id = ur.user_id  ".$search." order by ".$sortBy." ".$sortType." ";

        //echo $sql_count; die;

        $count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
        //echo $sql_count;
        $result	=	new CSqlDataProvider($sql, array(
            'totalItemCount'=>$count,
            'pagination'=>array(
                'pageSize'=>$limit,
            ),
        ));

        $index = 0;
        return array('pagination'=>$result->pagination, 'bankUserList'=>$result->getData());
    }

    function getAllinvAdvisoryLoanAppliedUserPaginated($limit=10,$sortType="asc",$sortBy="user_ref_id",$keyword=NULL,$filter=NULL,$stage_id=NULL)
    {
        $criteria = new CDbCriteria();

        $search = " ";$con = " ";

        if(isset($stage_id) && $stage_id!='')
        {
            $project_con = " WHERE ism.inv_stage_id = ".$stage_id;
        }
        else
        {
            $project_con = " ";
        }

        if(isset($keyword) && $keyword != NULL )
        {
            if(isset($project_con) && $project_con!='')
            {
                $search .= $project_con." AND ";
            }
            else
            {
                $search .= " WHERE ";
            }
            $search .= "  (ur.full_name like '%".addslashes($keyword)."%' or ur.phone_number like '%".addslashes($keyword)."%' or ur.annual_income like '%".addslashes($keyword)."%' or inv_amount like '%".addslashes($keyword)."%' or itm.description like '%".addslashes($keyword)."%' or ism.inv_stage_name like '%".addslashes($keyword)."%' or u.full_name like '%".addslashes($keyword)."%')";
        }
        else
        {
            if(isset($project_con) && $project_con!='')
            {
                $search .= $project_con;
            }
            else
            {
                $search .= " ";
            }
        }

        if(isset($filter['date_from']) && $filter['date_from']!='' && isset($filter['date_to']) && $filter['date_to']!='')
        {   //echo "first if"; die;
            if(isset($search) && $search!='')
            {
                $search .= " AND ";
                if($filter['date_from'] == $filter['date_to']){
                    $search .= "  ( ur.created_at LIKE '%".addslashes($filter['date_from'])."%')";
                }
                else{
                    $search .= "  ( (ur.created_at >= '".addslashes($filter['date_from'])."' OR ur.created_at LIKE '%".addslashes($filter['date_from'])."%' ) AND (ur.created_at <= '".addslashes($filter['date_to'])."' OR ur.created_at LIKE '%".addslashes($filter['date_to'])."%'  ) )";
                }
            }
            else
            {
                //$search .= " AND ";
                if($filter['date_from'] == $filter['date_to']){
                    $search .= " WHERE ( ur.created_at LIKE '%".addslashes($filter['date_from'])."%')";
                }
                else{
                    $search .= " WHERE ( (ur.created_at >= '".addslashes($filter['date_from'])."' OR ur.created_at LIKE '%".addslashes($filter['date_from'])."%' ) AND (ur.created_at <= '".addslashes($filter['date_to'])."' OR ur.created_at LIKE '%".addslashes($filter['date_to'])."%'  ) )";
                }
            }

        }

        $sql = "SELECT ur.*, iatrans.*,itr.*,ism.inv_stage_name,iatrans.inv_id AS inv_transaction_id,
            itm.description AS inv_type_name,ur.`created_at` AS createdDate, u.full_name AS referenceBy
            FROM `tbl_user_refrence` ur 
            INNER JOIN `tbl_investment_transaction` iatrans
            ON ur.`user_ref_id` = iatrans.`user_ref_id`
            LEFT JOIN `tbl_inv_type_master` itm
            ON itm.inv_type_id = iatrans.`inv_type`
            LEFT JOIN `tbl_inv_trans_reference` itr
            ON iatrans.`inv_id` = itr.`inv_id`
            LEFT JOIN `tbl_inv_stage_master` ism
            ON ism.`inv_stage_id` = itr.`inv_stage_id` 
            INNER JOIN `tbl_user` u
            ON u.user_id = ur.user_id  ".$search." order by ".$sortBy." ".$sortType." ";
        //echo $sql; die;
        $sql_count = "SELECT COUNT(*) FROM `tbl_user_refrence` ur 
            INNER JOIN `tbl_investment_transaction` iatrans
            ON ur.`user_ref_id` = iatrans.`user_ref_id`
            LEFT JOIN `tbl_inv_type_master` itm
            ON itm.inv_type_id = iatrans.`inv_type`
            LEFT JOIN `tbl_inv_trans_reference` itr
            ON iatrans.`inv_id` = itr.`inv_id`
            LEFT JOIN `tbl_inv_stage_master` ism
            ON ism.`inv_stage_id` = itr.`inv_stage_id` 
            INNER JOIN `tbl_user` u
            ON u.user_id = ur.user_id  ".$search." order by ".$sortBy." ".$sortType." ";

        //echo $sql_count; die;

        $count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
        //echo $sql_count;
        $result	=	new CSqlDataProvider($sql, array(
            'totalItemCount'=>$count,
            'pagination'=>array(
                'pageSize'=>$limit,
            ),
        ));

        $index = 0;
        return array('pagination'=>$result->pagination, 'invAdvisoryUserList'=>$result->getData());
    }

    function getAllrealEstateLoanAppliedUserPaginated($limit=10,$sortType="asc",$sortBy="user_ref_id",$keyword=NULL,$filter=NULL,$stage_id=NULL)
    {
        $criteria = new CDbCriteria();

        $search = " ";$con = " ";
        //echo $keyword;
        if(isset($stage_id) && $stage_id!='')
        {
            $project_con = " WHERE psm.property_stage_id = ".$stage_id;
        }
        else
        {
            $project_con = " ";
        }

        if(isset($keyword) && $keyword != NULL )
        {
            if(isset($project_con) && $project_con!='')
            {
                $search .= $project_con." AND ";
            }
            else
            {
                $search .= " WHERE ";
            }
            $search .= "  (ur.full_name like '%".addslashes($keyword)."%' or ur.phone_number like '%".addslashes($keyword)."%' or ur.annual_income like '%".addslashes($keyword)."%' or ptrans.property_type like '%".addslashes($keyword)."%' or ptm.description like '%".addslashes($keyword)."%' or psm.prop_stage_name like '%".addslashes($keyword)."%' or u.full_name like '%".addslashes($keyword)."%')";
        }
        else
        {
            if(isset($project_con) && $project_con!='')
            {
                $search .= $project_con;
            }
            else
            {
                $search .= " ";
            }
        }

        if(isset($filter['date_from']) && $filter['date_from']!='' && isset($filter['date_to']) && $filter['date_to']!='')
        {   //echo "first if"; die;
            if(isset($search) && $search!='')
            {
                $search .= " AND ";
                if($filter['date_from'] == $filter['date_to']){
                    $search .= "  ( ur.created_at LIKE '%".addslashes($filter['date_from'])."%')";
                }
                else{
                    $search .= "  ( (ur.created_at >= '".addslashes($filter['date_from'])."' OR ur.created_at LIKE '%".addslashes($filter['date_from'])."%' ) AND (ur.created_at <= '".addslashes($filter['date_to'])."' OR ur.created_at LIKE '%".addslashes($filter['date_to'])."%'  ) )";
                }
            }
            else
            {
                //$search .= " AND ";
                if($filter['date_from'] == $filter['date_to']){
                    $search .= " WHERE ( ur.created_at LIKE '%".addslashes($filter['date_from'])."%')";
                }
                else{
                    $search .= " WHERE ( (ur.created_at >= '".addslashes($filter['date_from'])."' OR ur.created_at LIKE '%".addslashes($filter['date_from'])."%' ) AND (ur.created_at <= '".addslashes($filter['date_to'])."' OR ur.created_at LIKE '%".addslashes($filter['date_to'])."%'  ) )";
                }
            }

        }

        $sql = "SELECT ur.*, ptrans.*,ptr.*,psm.prop_stage_name,ptrans.property_id AS prop_transaction_id,
            ptm.description AS prop_type_name,ur.`created_at` AS createdDate, u.full_name AS referenceBy
            FROM `tbl_user_refrence` ur 
            INNER JOIN `tbl_property_transaction` ptrans
            ON ur.`user_ref_id` = ptrans.`user_ref_id`
            LEFT JOIN `tbl_property_type_master` ptm
            ON ptm.property_type_id = ptrans.`property_transaction_type`
            LEFT JOIN `tbl_prop_trans_reference` ptr
            ON ptrans.`property_id` = ptr.`property_id`
            LEFT JOIN `tbl_property_stage_master` psm
            ON psm.`property_stage_id` = ptr.`property_stage_id`
            INNER JOIN `tbl_user` u
            ON u.user_id = ur.user_id ".$search." order by ".$sortBy." ".$sortType." ";

        $sql_count = "SELECT COUNT(*) FROM `tbl_user_refrence` ur 
            INNER JOIN `tbl_property_transaction` ptrans
            ON ur.`user_ref_id` = ptrans.`user_ref_id`
            LEFT JOIN `tbl_property_type_master` ptm
            ON ptm.property_type_id = ptrans.`property_transaction_type`
            LEFT JOIN `tbl_prop_trans_reference` ptr
            ON ptrans.`property_id` = ptr.`property_id`
            LEFT JOIN `tbl_property_stage_master` psm
            ON psm.`property_stage_id` = ptr.`property_stage_id` 
            INNER JOIN `tbl_user` u
            ON u.user_id = ur.user_id ".$search." order by ".$sortBy." ".$sortType." ";

        //echo $sql_count; die;

        $count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
        //echo $sql_count;
        $result	=	new CSqlDataProvider($sql, array(
            'totalItemCount'=>$count,
            'pagination'=>array(
                'pageSize'=>$limit,
            ),
        ));

        $index = 0;
        return array('pagination'=>$result->pagination, 'realEstateUserList'=>$result->getData());
    }

    function getRegisteredUserForBankLoanListById($user_id=NULL)
    {
        /*$sql = "SELECT ur.*, ltrans.*,ltr.*,lsm.loan_stage_name,ltrans.loan_id AS loan_transaction_id,
            ltm.description AS loan_type_name,ur.`created_at` AS createdDate,ltm1.`description` AS loan_sub_type_name
            FROM `tbl_user_refrence` ur INNER JOIN `tbl_loan_transaction` ltrans
            ON ur.`user_ref_id` = ltrans.`user_ref_id`
            LEFT JOIN `tbl_loan_type_master` ltm
            ON ltm.loan_type_id = ltrans.`loan_type`
            LEFT JOIN tbl_loan_type_master ltm1
            ON ltm1.loan_type_id = ltrans.`loan_sub_type`
            LEFT JOIN `tbl_loan_trans_reference` ltr
            ON ltrans.`loan_id` = ltr.`loan_id`
            LEFT JOIN `tbl_loan_stage_master` lsm
            ON lsm.`loan_stage_id` = ltr.`loan_stage_id` WHERE ur.user_id = ".$user_id;*/

        $sql = "SELECT ur.*, ltrans.*,ltr.*,lsm.loan_stage_name,ltrans.loan_id AS loan_transaction_id,
            ltm.description AS loan_type_name,ur.`created_at` AS createdDate,ltm1.`description` AS loan_sub_type_name,
            bm.bank_name AS BankName
            FROM `tbl_user_refrence` ur 
            INNER JOIN `tbl_loan_transaction` ltrans
            ON ur.`user_ref_id` = ltrans.`user_ref_id`
            LEFT JOIN `tbl_bank_master` bm
            ON ltrans.`bank_id` = bm.`bank_id`
            LEFT JOIN `tbl_loan_type_master` ltm
            ON ltm.loan_type_id = ltrans.`loan_type`
            LEFT JOIN tbl_loan_type_master ltm1
            ON ltm1.loan_type_id = ltrans.`loan_sub_type`
            LEFT JOIN `tbl_loan_trans_reference` ltr
            ON ltrans.`loan_id` = ltr.`loan_id`
            LEFT JOIN `tbl_loan_stage_master` lsm
            ON lsm.`loan_stage_id` = ltr.`loan_stage_id` WHERE ur.user_id = ".$user_id;
        $result	= Yii::app()->db->createCommand($sql)->queryAll();
        return $result;

    }

    function getRegisteredUserForInvLoanListById($user_id=NULL)
    {
        $sql = "SELECT ur.*, iatrans.*,itr.*,ism.inv_stage_name,iatrans.inv_id AS inv_transaction_id,
            itm.description AS inv_type_name,ur.`created_at` AS createdDate
            FROM `tbl_user_refrence` ur 
            INNER JOIN `tbl_investment_transaction` iatrans
            ON ur.`user_ref_id` = iatrans.`user_ref_id`
            LEFT JOIN `tbl_inv_type_master` itm
            ON itm.inv_type_id = iatrans.`inv_type`
            LEFT JOIN `tbl_inv_trans_reference` itr
            ON iatrans.`inv_id` = itr.`inv_id`
            LEFT JOIN `tbl_inv_stage_master` ism
            ON ism.`inv_stage_id` = itr.`inv_stage_id` WHERE ur.`user_id` = ".$user_id;
        $result	= Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function getRegisteredUserForPropLoanListById($user_id=NULL)
    {
        $sql = "SELECT ur.*,ptrans.*,ptr.*,psm.prop_stage_name,ptrans.property_id AS prop_transaction_id,
            ptm.description AS prop_type_name,ur.`created_at` AS createdDate,pst.`size_type_name`,ptm1.description AS prop_sub_type_name
            FROM `tbl_user_refrence` ur 
            INNER JOIN `tbl_property_transaction` ptrans
            ON ur.`user_ref_id` = ptrans.`user_ref_id`
            LEFT JOIN `tbl_property_size_type` pst
            ON pst.`property_size_type_id` = ptrans.`property_size_type`
            LEFT JOIN `tbl_property_type_master` ptm
            ON ptm.property_type_id = ptrans.`property_transaction_type`
            LEFT JOIN tbl_property_type_master ptm1
            ON ptm1.`property_type_id` = ptrans.`property_sub_type`
            LEFT JOIN `tbl_prop_trans_reference` ptr
            ON ptrans.`property_id` = ptr.`property_id`
            LEFT JOIN `tbl_property_stage_master` psm
            ON psm.`property_stage_id` = ptr.`property_stage_id` WHERE ur.`user_id` = ".$user_id;
        $result	= Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function getBankUserListByDate($fromDate=NULL,$toDate=NULL)
    {
        if((isset($fromDate) && $fromDate != "") && (isset($toDate) && $toDate))
        {
            $condition = "AND (DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '".$fromDate."' AND '".$toDate."')";
        }
        else
        {
            $condition = "";
        }
        $sql = "SELECT ur.* FROM tbl_user_refrence ur 
                INNER JOIN tbl_loan_transaction ltrans 
                ON ltrans.user_ref_id = ur.user_ref_id WHERE  ur.`status` =  1 ".$condition;
        $result	= Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function getInvestmentUserListByDate($fromDate=NULL,$toDate=NULL)
    {
        if((isset($fromDate) && $fromDate != "") && (isset($toDate) && $toDate))
        {
            $condition = "AND (DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '".$fromDate."' AND '".$toDate."')";
        }
        else
        {
            $condition = "";
        }
        $sql = "SELECT ur.* FROM tbl_user_refrence ur 
                INNER JOIN tbl_investment_transaction itrans 
                ON itrans.user_ref_id = ur.user_ref_id WHERE  ur.`status` =  1 ".$condition;
        $result	= Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function getRealEstateUserListByDate($fromDate=NULL,$toDate=NULL)
    {
        if((isset($fromDate) && $fromDate != "") && (isset($toDate) && $toDate))
        {
            $condition = "AND (DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '".$fromDate."' AND '".$toDate."')";
        }
        else
        {
            $condition = "";
        }
        $sql = "SELECT ur.* FROM tbl_user_refrence ur 
                INNER JOIN tbl_property_transaction ptrans 
                ON ptrans.user_ref_id = ur.user_ref_id WHERE  ur.`status` =  1 ".$condition;
        $result	= Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }


    /*export report query*/

    function getBankLoanUsersForReport($from_date=NULL,$to_date=NULL)
    {
        if($from_date != NULL)
        {
            $from_day = date("Y-m-d",strtotime($from_date));
        }
        else
        {
            $from_day = date("Y-m-d");
        }

        if($to_date != NULL)
        {
            $to_day = date("Y-m-d",strtotime($to_date));
        }
        else
        {
            $to_day = date("Y-m-d");
        }

        $sql = "SELECT ur.*, ltrans.*,ltr.*,lsm.loan_stage_name,
                    ltrans.loan_id AS loan_transaction_id,
                    ltm.description AS loan_type_name,
                    ur.`created_at` AS createdDate, 
                    ltm1.description AS loan_sub_type_name,
                    u.full_name AS referenceBy
                    FROM `tbl_user_refrence` ur 
                    INNER JOIN `tbl_loan_transaction` ltrans
                    ON ur.`user_ref_id` = ltrans.`user_ref_id`
                    LEFT JOIN `tbl_loan_type_master` ltm
                    ON ltm.loan_type_id = ltrans.`loan_type`
                    LEFT JOIN `tbl_loan_type_master` ltm1
                    ON ltm1.loan_type_id = ltrans.`loan_sub_type`
                    LEFT JOIN `tbl_loan_trans_reference` ltr
                    ON ltrans.`loan_id` = ltr.`loan_id`
                    LEFT JOIN `tbl_loan_stage_master` lsm
                    ON lsm.`loan_stage_id` = ltr.`loan_stage_id`
                    INNER JOIN `tbl_user` u
                    ON u.user_id = ur.user_id WHERE DATE(ur.`created_at`) BETWEEN '".$from_day."' AND '".$to_day."' ORDER BY ur.user_ref_id ASC ";
        $result	= Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function getInvLoanUsersForReport($from_date=NULL,$to_date=NULL)
    {
        if($from_date != NULL)
        {
            $from_day = date("Y-m-d",strtotime($from_date));
        }
        else
        {
            $from_day = date("Y-m-d");
        }

        if($to_date != NULL)
        {
            $to_day = date("Y-m-d",strtotime($to_date));
        }
        else
        {
            $to_day = date("Y-m-d");
        }

        $sql = "SELECT ur.*, iatrans.*,itr.*,ism.inv_stage_name,
            iatrans.inv_id AS inv_transaction_id,
            itm.description AS inv_type_name,
            ur.`created_at` AS createdDate, 
            u.full_name AS referenceBy
            FROM `tbl_user_refrence` ur 
            INNER JOIN `tbl_investment_transaction` iatrans
            ON ur.`user_ref_id` = iatrans.`user_ref_id`
            LEFT JOIN `tbl_inv_type_master` itm
            ON itm.inv_type_id = iatrans.`inv_type`
            LEFT JOIN `tbl_inv_trans_reference` itr
            ON iatrans.`inv_id` = itr.`inv_id`
            LEFT JOIN `tbl_inv_stage_master` ism
            ON ism.`inv_stage_id` = itr.`inv_stage_id` 
            INNER JOIN `tbl_user` u
            ON u.user_id = ur.user_id WHERE DATE(ur.`created_at`) BETWEEN '".$from_day."' AND '".$to_day."' ORDER BY ur.user_ref_id ASC ";
        $result	= Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function getRealEstateLoanUsersForReport($from_date=NULL,$to_date=NULL)
    {
        if($from_date != NULL)
        {
            $from_day = date("Y-m-d",strtotime($from_date));
        }
        else
        {
            $from_day = date("Y-m-d");
        }

        if($to_date != NULL)
        {
            $to_day = date("Y-m-d",strtotime($to_date));
        }
        else
        {
            $to_day = date("Y-m-d");
        }

        $sql = "SELECT ur.*, ptrans.*,ptr.*,
            psm.prop_stage_name,
            ptrans.property_id AS prop_transaction_id,
            ptm.description AS prop_type_name,
            ur.`created_at` AS createdDate, 
            u.full_name AS referenceBy,
            pst.`size_type_name`
            FROM `tbl_user_refrence` ur 
            INNER JOIN `tbl_property_transaction` ptrans
            ON ur.`user_ref_id` = ptrans.`user_ref_id`
            LEFT JOIN `tbl_property_size_type` pst
            ON pst.`property_size_type_id` = ptrans.`property_size_type`
            LEFT JOIN `tbl_property_type_master` ptm
            ON ptm.property_type_id = ptrans.`property_transaction_type`
            LEFT JOIN `tbl_prop_trans_reference` ptr
            ON ptrans.`property_id` = ptr.`property_id`
            LEFT JOIN `tbl_property_stage_master` psm
            ON psm.`property_stage_id` = ptr.`property_stage_id`
            INNER JOIN `tbl_user` u
            ON u.user_id = ur.user_id  WHERE DATE(ur.`created_at`) BETWEEN '".$from_day."' AND '".$to_day."' ORDER BY ur.user_ref_id ASC ";
        $result	= Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }
}