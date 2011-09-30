<?php

/**
 * Supplieralias form base class.
 *
 * @method Supplieralias getObject() Returns the current form's model object
 *
 * @package    myshelf
 * @subpackage form
 * @author     Adam Jennison
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSupplieraliasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInputText(),
      'soundexvalue'   => new sfWidgetFormInputText(),
      'suppliernumber' => new sfWidgetFormInputText(),
      'supplier_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('supplier'), 'add_empty' => true)),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'slug'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'soundexvalue'   => new sfValidatorString(array('max_length' => 255)),
      'suppliernumber' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'supplier_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('supplier'), 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
      'slug'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Supplieralias', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('supplieralias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Supplieralias';
  }

}
