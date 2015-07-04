<?php

/**
 * This is the model class for table "ficha_institucion".
 *
 * The followings are the available columns in table 'ficha_institucion':
 * @property integer $id_ficha
 * @property integer $id_institucion
 * @property string $nombre
 * @property integer $cuit
 * @property string $telfijo
 * @property string $celular
 * @property integer $id_localidad
 * @property string $direccion
 * @property string $piso
 * @property string $depto
 * @property string $fhcreacion
 * @property string $fhultmod
 * @property string $cusuario
 *
 * The followings are the available model relations:
 * @property Institucion $idInstitucion
 * @property Localidad $idLocalidad
 */
class FichaInstitucion extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ficha_institucion';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre, cuit, id_localidad, direccion, fhcreacion, cusuario', 'required','message'=>'Ingrese un dato en el campo {attribute}'),
            array('id_institucion, cuit, id_localidad', 'numerical', 'integerOnly'=>true),
            array('telfijo, celular', 'length', 'max'=>30),
            array('direccion, cusuario', 'length', 'max'=>60),
            array('nombre', 'length', 'max'=>200),
            array('piso, depto', 'length', 'max'=>10),
            array('fhultmod', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_ficha, id_institucion, nombre, cuit, telfijo, celular, id_localidad, direccion, piso, depto, fhcreacion, fhultmod, cusuario', 'safe', 'on'=>'search'),
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
            'idInstitucion' => array(self::BELONGS_TO, 'Institucion', 'id_institucion'),
            'idLocalidad' => array(self::BELONGS_TO, 'Localidad', 'id_localidad'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_ficha' => 'Id Ficha',
            'id_institucion' => 'Id Institucion',
            'nombre' => 'Nombre',
            'cuit' => 'Cuit',
            'telfijo' => 'Telfijo',
            'celular' => 'Celular',
            'id_localidad' => 'Id Localidad',
            'direccion' => 'Direccion',
            'piso' => 'Piso',
            'depto' => 'Depto',
            'fhcreacion' => 'Fhcreacion',
            'fhultmod' => 'Fhultmod',
            'cusuario' => 'Cusuario',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id_ficha',$this->id_ficha);
        $criteria->compare('id_institucion',$this->id_institucion);
        $criteria->compare('nombre',$this->nombre);
        $criteria->compare('cuit',$this->cuit);
        $criteria->compare('telfijo',$this->telfijo,true);
        $criteria->compare('celular',$this->celular,true);
        $criteria->compare('id_localidad',$this->id_localidad);
        $criteria->compare('direccion',$this->direccion,true);
        $criteria->compare('piso',$this->piso,true);
        $criteria->compare('depto',$this->depto,true);
        $criteria->compare('fhcreacion',$this->fhcreacion,true);
        $criteria->compare('fhultmod',$this->fhultmod,true);
        $criteria->compare('cusuario',$this->cusuario,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FichaInstitucion the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
