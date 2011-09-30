<?php

/**
 * accident actions.
 *
 * @package    myshelf
 * @subpackage accident
 * @author     Adam Jennison
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class accidentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $this->form=new incidentForm();
    
  }
}
