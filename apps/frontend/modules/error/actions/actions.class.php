<?php

/**
 * error actions.
 *
 * @package    myshelf
 * @subpackage error
 * @author     Adam Jennison
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class errorActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
   // $this->forward('default', 'module');
  }

  public function execute404(sfWebRequest $request)
  {
   // $this->forward('default', 'module');
  }  
}
