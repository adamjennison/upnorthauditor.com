<?php

/**
 * Spend form base class.
 *
 * @method Spend getObject() Returns the current form's model object
 *
 * @package    myshelf
 * @subpackage form
 * @author     Adam Jennison
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSpendForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'spenddate'           => new sfWidgetFormDate(),
      'transactionnumber'   => new sfWidgetFormInputText(),
      'amount'              => new sfWidgetFormInputText(),
      'suppliername'        => new sfWidgetFormInputText(),
      'suppliernamesoundex' => new sfWidgetFormInputText(),
      'supplier_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('supplier'), 'add_empty' => true)),
      'suppliernumber'      => new sfWidgetFormInputText(),
      'directoratename'     => new sfWidgetFormInputText(),
      'directorate_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('directorate'), 'add_empty' => true)),
      'servicename'         => new sfWidgetFormInputText(),
      'service_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('service'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'spenddate'           => new sfValidatorDate(array('required' => false)),
      'transactionnumber'   => new sfValidatorString(array('max_length' => 255)),
      'amount'              => new sfValidatorNumber(array('required' => false)),
      'suppliername'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'suppliernamesoundex' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'supplier_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('supplier'), 'required' => false)),
      'suppliernumber'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'directoratename'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'directorate_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('directorate'), 'required' => false)),
      'servicename'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'service_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('service'), 'required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('spend[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Spend';
  }

}
