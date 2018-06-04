<?php

/**
 * This is the model class for table "tbl_menu".
 *
 * The followings are the available columns in table 'tbl_menu':
 * @property string $menu_id
 * @property string $menu_name
 * @property integer $parent
 * @property string $index
 * @property string $status
 * @property string $page_url
 * @property string $menu_icon
 */
class TblMenu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblMenu the static model class
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
		return 'tbl_menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent', 'numerical', 'integerOnly'=>true),
			array('menu_name, page_url, menu_icon', 'length', 'max'=>255),
			array('index', 'length', 'max'=>20),
			array('status', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('menu_id, menu_name, parent, index, status, page_url, menu_icon', 'safe', 'on'=>'search'),
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
			'menu_id' => 'Menu',
			'menu_name' => 'Menu Name',
			'parent' => 'Parent',
			'index' => 'Index',
			'status' => 'Status',
			'page_url' => 'Page Url',
			'menu_icon' => 'Menu Icon',
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

		$criteria->compare('menu_id',$this->menu_id,true);
		$criteria->compare('menu_name',$this->menu_name,true);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('index',$this->index,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('page_url',$this->page_url,true);
		$criteria->compare('menu_icon',$this->menu_icon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    function getAllMenus()
    {
        $sql = "SELECT *  FROM tbl_menu where parent = 0 and status LIKE 1 order by `index` asc";
        $result	= Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }
}