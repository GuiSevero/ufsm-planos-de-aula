<?php

/**
 * This is the model class for table "class".
 *
 * The followings are the available columns in table 'class':
 * @property integer $id_class
 * @property string $title
 * @property string $objectives
 * @property string $contents
 * @property string $resources
 * @property string $evaluation
 * @property string $sobek_keywords
 * @property string $tags
 * @property boolean $released
 * @property integer $id_owner
 * @property string $descricao
 * @property string $theme
 * @property string $access_token
 *
 * The followings are the available model relations:
 * @property User $owner
 * @property User $participants
 */
class ClassPlan extends CActiveRecord
{

	public static $themes = array(
			"amelia"=>"Amelia"
		,	"cyborg"=>"Cyborg"
		,	"flatly"=>"Flatly"
		,	"readable"=>"Readable"
		,	"slate"=>"Slate"
		,	"united"=>"United"
		,	"yeti"=>"Yeti"

	);
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClassPlan the static model class
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
		return 'class';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, id_owner, description', 'required'),
			array('id_owner', 'numerical', 'integerOnly'=>true),
			array('objectives, contents, access_token, resources, evaluation, sobek_keywords, tags, released, description, theme', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_class, access_token title, objectives, contents, resources, evaluation, sobek_keywords, tags, released, id_owner', 'safe', 'on'=>'search'),
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
			'owner' => array(self::BELONGS_TO, 'User', 'id_owner'),
			'participants' => array(self::MANY_MANY, 'User', 'participation(id_class, id_user)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_class' => 'Id Class',
			'title' => 'Título',
			'objectives' => 'Objetivos',
			'contents' => 'Conteúdo',
			'resources' => 'Recursos',
			'evaluation' => 'Avaliação',
			'sobek_keywords' => 'Sobek Keywords',
			'tags' => 'Marcadores',
			'released' => 'Publicado',
			'id_owner' => 'Id Owner',
			'theme'=>'Tema',
			'description'=>'Descrição',
			'access_token'=>'Token de Acesso',
			'participants'=>'Colaboradores',

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

		$criteria->compare('id_class',$this->id_class);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('objectives',$this->objectives,true);
		$criteria->compare('contents',$this->contents,true);
		$criteria->compare('resources',$this->resources,true);
		$criteria->compare('evaluation',$this->evaluation,true);
		$criteria->compare('sobek_keywords',$this->sobek_keywords,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('released',$this->released);
		$criteria->compare('id_owner',$this->id_owner);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function afterSave()
	{
		
		
		Participation::model()->deleteAll('id_class = '.$this->id_class);
		foreach($this->participants as $pt){
			
			$part = new Participation();
			$part->id_user = is_object($pt) ? $pt->id_user : $pt;
			$part->id_class = $this->id_class;

			if(!$part->save()){
				return false;
			}

			unset($part);
		}

		parent::afterSave();
		
	}
}