<?php

/**
 * BaseSupplieralias
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $soundexvalue
 * @property string $suppliernumber
 * @property integer $supplier_id
 * @property Supplier $supplier
 * 
 * @method integer       getId()             Returns the current record's "id" value
 * @method string        getName()           Returns the current record's "name" value
 * @method string        getSoundexvalue()   Returns the current record's "soundexvalue" value
 * @method string        getSuppliernumber() Returns the current record's "suppliernumber" value
 * @method integer       getSupplierId()     Returns the current record's "supplier_id" value
 * @method Supplier      getSupplier()       Returns the current record's "supplier" value
 * @method Supplieralias setId()             Sets the current record's "id" value
 * @method Supplieralias setName()           Sets the current record's "name" value
 * @method Supplieralias setSoundexvalue()   Sets the current record's "soundexvalue" value
 * @method Supplieralias setSuppliernumber() Sets the current record's "suppliernumber" value
 * @method Supplieralias setSupplierId()     Sets the current record's "supplier_id" value
 * @method Supplieralias setSupplier()       Sets the current record's "supplier" value
 * 
 * @package    myshelf
 * @subpackage model
 * @author     Adam Jennison
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseSupplieralias extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('supplieralias');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('soundexvalue', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('suppliernumber', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('supplier_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Supplier as supplier', array(
             'local' => 'supplier_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'fields' => 
             array(
              0 => 'name',
             ),
             'unique' => true,
             ));
        $this->actAs($timestampable0);
        $this->actAs($sluggable0);
    }
}