<?php

/**
 * hullspend actions.
 *
 * @package    myshelf
 * @subpackage hullspend
 * @author     Adam Jennison
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class hullspendActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  
  public function executeSuppliers(sfWebRequest $request)
  {
   // grabs all the suppliers 
   $q= Doctrine::getTable('Supplier')->createQuery()->orderBy('Name');
   $this->suppliers=$q->execute();
  }
  
  public function executeSupplier(sfWebRequest $request)
  {
    //grabs just one supplier
    $supplier=Doctrine::getTable('Supplier')->findOneBySlug($request->getParameter('id'));
    $this->forward404Unless($supplier);
    $this->supplier=$supplier;
    $returnInfo=Doctrine::getTable('Spend')->getAllSupplierSpend($supplier->getId());
    $this->spend=$returnInfo['spend'];
    $this->total=$returnInfo['total'];
  }

  public function executeServices(sfWebRequest $request)
  {
    //grabs all services
    $q= Doctrine::getTable('Service')->createQuery()->orderBy('Name');
    $this->services=$q->execute();
  }  
  
  public function executeService(sfWebRequest $request)
  {
    //grabs just one service
    $service=Doctrine::getTable('Service')->findOneBySlug($request->getParameter('id'));
    $this->forward404Unless($service);
    $this->service=$service;
    $this->suppliers=$service->getSupplier();
  }
  public function executeServicePayments(sfWebRequest $request)
  {
    //grabs just one service
    $service=Doctrine::getTable('Service')->findOneBySlug($request->getParameter('id'));
    $this->forward404Unless($service);
    $this->service=$service;
    $returnInfo=Doctrine::getTable('Spend')->getAllServiceSpend($service->getId());
    $this->spend=$returnInfo['spend'];
    $this->total=$returnInfo['total'];
  }  
  
  public function executeDirectorates(sfWebRequest $request)
  {
    //grabs all directorates
    $q= Doctrine::getTable('Directorate')->createQuery()->orderBy('Name');
    $this->directorates=$q->execute();    
  }  
  
  public function executeDirectorate(sfWebRequest $request)
  {
    //grabs just one directorate
    $directorate=Doctrine::getTable('Directorate')->findOneBySlug($request->getParameter('id'));
    $this->forward404Unless($directorate);
    $this->directorate=$directorate;
    $returnInfo=Doctrine::getTable('Spend')->getAllDirectorateSpend($directorate->getId());
    $this->spend=$returnInfo['spend'];
    $this->total=$returnInfo['total'];    
  }
  
  
  
  
  
  
  
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $returnInfo=Doctrine::getTable('Service')->getNumberOfServices();
    $this->numberofservices=$returnInfo;
    $returnInfo2=Doctrine::getTable('Directorate')->getNumberOfDirectorates();
    $this->numberofdirectorates=$returnInfo2;
    $returnInfo3=Doctrine::getTable('Supplier')->getNumberOfSuppliers();
    $this->numberofsuppliers=$returnInfo3;    
    $returnInfo4=Doctrine::getTable('Spend')->getNumberOfTransactions();
    $this->numberoftransactions=$returnInfo4;    
    $returnInfo5=Doctrine::getTable('Spend')->getNumberOfNegTransactions();
    $this->numberofnegtransactions=$returnInfo5; 
    $returnInfo6=Doctrine::getTable('Spend')->getTotalValue();
    $this->totalvalueoftransactions=$returnInfo6;     
    $returnInfo7=Doctrine::getTable('Spend')->getMaxTransaction();
    $this->largesttransaction=$returnInfo7;        
  }
}
