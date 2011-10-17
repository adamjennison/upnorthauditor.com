<?php

/**
 * Supplier form base class.
 *
 * @method Supplier getObject() Returns the current form's model object
 *
 * @package    myshelf
 * @subpackage form
 * @author     Adam Jennison
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSupplierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInputText(),
      'soundexvalue'     => new sfWidgetFormInputText(),
      'url'              => new sfWidgetFormInputText(),
      'notes'            => new sfWidgetFormTextarea(),
      'views'            => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'slug'             => new sfWidgetFormInputText(),
      'directorate_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Directorate')),
      'service_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Service')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'soundexvalue'     => new sfValidatorString(array('max_length' => 255)),
      'url'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'notes'            => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'views'            => new sfValidatorInteger(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'slug'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'directorate_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Directorate', 'required' => false)),
      'service_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Service', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Supplier', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('supplier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Supplier';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['directorate_list']))
    {
      $this->setDefault('directorate_list', $this->object->Directorate->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['service_list']))
    {
      $this->setDefault('service_list', $this->object->Service->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveDirectorateList($con);
    $this->saveServiceList($con);

    parent::doSave($con);
  }

  public function saveDirectorateList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['directorate_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Directorate->getPrimaryKeys();
    $values = $this->getValue('directorate_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Directorate', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Directorate', array_values($link));
    }
  }

  public function saveServiceList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['service_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Service->getPrimaryKeys();
    $values = $this->getValue('service_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Service', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Service', array_values($link));
    }
  }

}
