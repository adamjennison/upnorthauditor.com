<?php

/**
 * Spend filter form base class.
 *
 * @package    myshelf
 * @subpackage filter
 * @author     Adam Jennison
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSpendFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'spenddate'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'transactionnumber'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'amount'              => new sfWidgetFormFilterInput(),
      'suppliername'        => new sfWidgetFormFilterInput(),
      'suppliernamesoundex' => new sfWidgetFormFilterInput(),
      'supplier_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('supplier'), 'add_empty' => true)),
      'suppliernumber'      => new sfWidgetFormFilterInput(),
      'directoratename'     => new sfWidgetFormFilterInput(),
      'directorate_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('directorate'), 'add_empty' => true)),
      'servicename'         => new sfWidgetFormFilterInput(),
      'service_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('service'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'spenddate'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'transactionnumber'   => new sfValidatorPass(array('required' => false)),
      'amount'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'suppliername'        => new sfValidatorPass(array('required' => false)),
      'suppliernamesoundex' => new sfValidatorPass(array('required' => false)),
      'supplier_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('supplier'), 'column' => 'id')),
      'suppliernumber'      => new sfValidatorPass(array('required' => false)),
      'directoratename'     => new sfValidatorPass(array('required' => false)),
      'directorate_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('directorate'), 'column' => 'id')),
      'servicename'         => new sfValidatorPass(array('required' => false)),
      'service_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('service'), 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('spend_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Spend';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'spenddate'           => 'Date',
      'transactionnumber'   => 'Text',
      'amount'              => 'Number',
      'suppliername'        => 'Text',
      'suppliernamesoundex' => 'Text',
      'supplier_id'         => 'ForeignKey',
      'suppliernumber'      => 'Text',
      'directoratename'     => 'Text',
      'directorate_id'      => 'ForeignKey',
      'servicename'         => 'Text',
      'service_id'          => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
