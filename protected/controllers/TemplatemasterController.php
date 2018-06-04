<?php
/**
 * Copyright (c) 2014 All Right Reserved, byPeople Technologies.
 *
 * This source is subject to the Todooli Permissive License. Any Modification
 * must not alter or remove any copyright notices in the Software or Package,
 * generated or otherwise. All derivative work as well as any Distribution of
 * this asis or in Modified
  form or derivative requires express written consent
 * from byPeople Technologies.
 *
 *
 * THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY
 * KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A
 * PARTICULAR PURPOSE.
 *
 *
 * */
class TemplatemasterController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionSetTemplate($lng,$file)
	{
		Yii::app()->session['prefferd_language']=$lng;
		$this->renderPartial($file);
	}
	
	public function actioncreateUser()
	{
		$this->renderPartial('createuser');
	}
}