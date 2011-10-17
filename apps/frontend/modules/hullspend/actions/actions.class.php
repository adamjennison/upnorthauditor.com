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
     $response=$this->getResponse();
     $response->setTitle('Suppliers to Hull City Council :: UpNorthAuditor.com');
     
     
     $this->pager = new sfDoctrinePager('Supplier', '20');
     $q=Doctrine::getTable('Supplier')->createQuery('s')->orderBy('s.Name');
     if($request->getParameter('letter')){
       if($request->getParameter('letter')=='none'){
         $q->where('s.Name like \'0%\'')
         ->orWhere('s.Name like \'1%\'')
         ->orWhere('s.Name like \'2%\'')
         ->orWhere('s.Name like \'3%\'')
         ->orWhere('s.Name like \'4%\'')
         ->orWhere('s.Name like \'5%\'')
         ->orWhere('s.Name like \'6%\'')
         ->orWhere('s.Name like \'7%\'')
         ->orWhere('s.Name like \'8%\'')
         ->orWhere('s.Name like \'9%\'');
       }else{
         $q->where('s.Name like \''.$request->getParameter('letter').'%\'');
       }
       
        
     }
     $this->letter=$request->getParameter('letter');
     $this->pager->setQuery($q);
     $this->pager->setPage($request->getParameter('page', 1));
     $this->pager->init();


   // grabs all the suppliers 
   /*
   $response=$this->getResponse();
   $q= Doctrine::getTable('Supplier')->createQuery()->orderBy('Name');
   $this->suppliers=$q->execute();
   $response->setTitle('Suppliers to Hull City Council :: UpNorthAuditor.com');
   */
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
    $this->firstDate=Doctrine::getTable('Spend')->getDateFirstPayment();
    $this->lastDate=Doctrine::getTable('Spend')->getDateLastPayment();   
    $response=$this->getResponse();
    $response->setTitle($this->supplier->getName().' supplier to Hull City Council :: UpNorthAuditor.com'); 

    $this->supplierData=$supplier->getSuppliersOrders();
    
    
    //$this->orders=$returnInfo['order2'];
    //$this->servicenames=$returnInfo['servicename'];
    
  }

  public function executeServices(sfWebRequest $request)
  {
    
     $response=$this->getResponse();
     $response->setTitle('Services within Hull City Council :: UpNorthAuditor.com');
     
     
     $this->pager = new sfDoctrinePager('Service', '20');
     $q=Doctrine::getTable('Service')->createQuery('s')->orderBy('s.Name');
     if($request->getParameter('letter')){
       if($request->getParameter('letter')=='none'){
         $q->where('s.Name like \'0%\'')
         ->orWhere('s.Name like \'1%\'')
         ->orWhere('s.Name like \'2%\'')
         ->orWhere('s.Name like \'3%\'')
         ->orWhere('s.Name like \'4%\'')
         ->orWhere('s.Name like \'5%\'')
         ->orWhere('s.Name like \'6%\'')
         ->orWhere('s.Name like \'7%\'')
         ->orWhere('s.Name like \'8%\'')
         ->orWhere('s.Name like \'9%\'');
       }else{
         $q->where('s.Name like \''.$request->getParameter('letter').'%\'');
       }
       
        
     }
     $this->letter=$request->getParameter('letter');
     $this->pager->setQuery($q);
     $this->pager->setPage($request->getParameter('page', 1));
     $this->pager->init();
     
    //grabs all services
    /*
    $q= Doctrine::getTable('Service')->createQuery()->orderBy('Name');
    $this->services=$q->execute();
    $response=$this->getResponse();
    $response->setTitle('Services within Hull City Council :: UpNorthAuditor.com');     
    */
  }  
  
  public function executeService(sfWebRequest $request)
  {
    //grabs just one service
    $service=Doctrine::getTable('Service')->findOneBySlug($request->getParameter('id'));
    $this->forward404Unless($service);
    $this->service=$service;
    $this->suppliers=$service->getSupplier();
    $this->firstDate=Doctrine::getTable('Spend')->getDateFirstPayment();
    $this->lastDate=Doctrine::getTable('Spend')->getDateLastPayment();
    $response=$this->getResponse();
    $response->setTitle($this->service->getName().' part of the '.$this->service->getDirectorate().' directorate within Hull City Council :: UpNorthAuditor.com');     
  }
  public function executeServicePayments(sfWebRequest $request)
  {
    //grabs just one service
    $service=Doctrine::getTable('Service')->findOneBySlug($request->getParameter('id'));
    $this->forward404Unless($service);
    $this->service=$service;
    $this->suppliers=$service->getSupplier();
    $returnInfo=Doctrine::getTable('Spend')->getAllServiceSpend($service->getId());
    $this->spend=$returnInfo['spend'];
    $this->total=$returnInfo['total'];
    $response=$this->getResponse();    
    $response->setTitle('Spend detail for '.$this->service->getName().' :: a service within Hull City Council :: UpNorthAuditor.com');      
  }  
  
  public function executeDirectorates(sfWebRequest $request)
  {
    //grabs all directorates
    $q= Doctrine::getTable('Directorate')->createQuery()->orderBy('Name');
    $this->directorates=$q->execute();    
    $response=$this->getResponse();
    $response->setTitle('Directorates within Hull City Council :: UpNorthAuditor.com');     
     
  }  
  
  public function executeDirectorate(sfWebRequest $request)
  {
    //grabs just one directorate
    $directorate=Doctrine::getTable('Directorate')->findOneBySlug($request->getParameter('id'));
    $this->forward404Unless($directorate);
    $this->directorate=$directorate;
    $this->services=$directorate->getServicesInOrder();
    $this->firstDate=Doctrine::getTable('Spend')->getDateFirstPayment();
    $this->lastDate=Doctrine::getTable('Spend')->getDateLastPayment(); 
    $response=$this->getResponse();
    $response->setTitle($this->directorate->getName().' :: a directorate within Hull City Council :: UpNorthAuditor.com');    
    
  }
  
   public function executeDirectoratePayments(sfWebRequest $request)
  {
    //grabs just one service
    $service=Doctrine::getTable('Directorate')->findOneBySlug($request->getParameter('id'));
    $this->forward404Unless($service);
    $this->service=$service;
    $returnInfo=Doctrine::getTable('Spend')->getAllDirectorateSpend($service->getId());
    $this->spend=$returnInfo['spend'];
    $this->total=$returnInfo['total'];
    $response=$this->getResponse();    
    $response->setTitle('Spend detail for '.$this->service->getName().' :: a directorate within Hull City Council :: UpNorthAuditor.com');      
     
  }  

  
  public function executeTop10(sfWebRequest $request)
  {
    
    
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
    $this->firstDate=Doctrine::getTable('Spend')->getDateFirstPayment();
    $this->lastDate=Doctrine::getTable('Spend')->getDateLastPayment(); 
    $response=$this->getResponse();    
    $response->setTitle('UpNorthAuditor.com looking in detail at how Hull City Council has spent &pound'.$returnInfo6);      
           
  }
  
  public function executeAbout(sfWebRequest $request)
  {
  }
}
