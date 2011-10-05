<?php

/**
 * Service form base class.
 *
 * @method Service getObject() Returns the current form's model object
 *
 * @package    myshelf
 * @subpackage form
 * @author     Adam Jennison
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseServiceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInputText(),
      'soundexvalue'   => new sfWidgetFormInputText(),
      'directorate_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('directorate'), 'add_empty' => true)),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'slug'           => new sfWidgetFormInputText(),
      'supplier_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Supplier')),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'soundexvalue'   => new sfValidatorString(array('max_length' => 255)),
      'directorate_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('directorate'), 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
      'slug'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'supplier_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Supplier', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Service', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('service[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Service';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['supplier_list']))
    {
      $this->setDefault('supplier_list', $this->object->Supplier->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveSupplierList($con);

    parent::doSave($con);
  }

  public function saveSupplierList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['supplier_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Supplier->getPrimaryKeys();
    $values = $this->getValue('supplier_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Supplier', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Supplier', array_values($link));
    }
  }

}
