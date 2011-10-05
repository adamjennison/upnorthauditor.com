<?php

/**
 * import actions.
 *
 * @package    myshelf
 * @subpackage import
 * @author     Adam Jennison
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class importActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $directory = 'uploads/spend/';
    $csvs = glob("" . $directory . "*.csv");
    //$csvs = glob("" . $directory );
    //echo 'There are '.count($csvs).' files to parse<br/>';
    foreach($csvs as $csv)
    {
      $reader = new sfCsvReader($csv);
      $reader->open();
      echo 'parsing file '.$csv;
      echo '<br/>';
      while ($data = $reader->read())
      {
          $spend=new Spend();
          //lets convert the crappy dates dd-mm-yy to a good old mysql date yyyy-mm-dd
          $datebits=explode('-',$data[2]);
          $day=$datebits[0];
          $month=date('m', strtotime($datebits[1]));
          $year='20'.$datebits[2];
          $spenddate=$year.'-'.$month.'-'.$day;
          $spend->setSpenddate($spenddate);
          echo $spenddate.'<br/>';
          $spend->setSuppliername($data[5]);
          $spend->setSuppliernamesoundex(soundex($data[5]));
          $spend->setAmount($data[4]);
          $spend->setTransactionnumber($data[3]);
          $spend->setSuppliernumber($data[6]);
          $spend->setServicename($data[7]);
          $spend->setDirectoratename($data[8]);
          
          //right we have set the main details now lets try making the relationships
          //first supplier
          $cleanSupplierName=trim($data[5]);
          echo 'Original name:'.$data[5].'<br/>';
          $cleanSupplierName=trim($cleanSupplierName,'.');
          $cleanSupplierName = str_replace('LIMITED','LTD',$cleanSupplierName);
          $cleanSupplierName = str_replace('NO CHQ ONLY ','',$cleanSupplierName);
          $cleanSupplierName = str_replace('IMPREST ACCOUNT','',$cleanSupplierName);
          $cleanSupplierName = preg_replace('/^THE /','',$cleanSupplierName);
         // need to do regexp replace on these strings..
         
          $cleanSupplierName = trim($cleanSupplierName);
          echo 'end name:'.$cleanSupplierName.'<br/>';
          $supplier= Doctrine::getTable('Supplier')->findOneByName($cleanSupplierName);
          if($supplier){
            //we have the supplier so we can insert the supplier id 
            $spend->setSupplierId($supplier->getId());
            echo 'Found a supplier so we grabe the id:'.$supplier->getId().'<br/>';
          }else{
            // no supplier so we create one
            $supplier = new Supplier();
            $supplier->setName($cleanSupplierName);
            $supplier->setSoundexvalue(soundex($cleanSupplierName));
            $supplier->save();
            $spend->setSupplierID($supplier->getId());
            echo 'Created a new supplier with id:'.$supplier->getId().'<br/>';
            //now lets check for a supplier alias and create one if need be
          }
            $supplieralias= Doctrine::getTable('Supplieralias')->findOneByName($data[5]);
            
            
            if($supplieralias){
                //we have an alias - so ignore it
            }else{
               //we haven't an alias - so lets create it
              $supplieralias= new Supplieralias();
              $supplieralias->setName($data[5]);
              $supplieralias->setSupplierId($supplier->getId());
              $supplieralias->setSuppliernumber($data[6]);
              $supplieralias->save();
              $supplieralias->free(true);
            }  
            $supplier->free(true);
         ;
          
          // now lets save the directorate and service
          $directorateId=null;// create the directorateId outside of the loop for scope
          $directorate= Doctrine::getTable('Directorate')->findOneByName($data[8]);
          if($directorate){
            //we have a directorate
            $directorateId=$directorate->getId(); //capture the id
          }else{
            //we dont have a directorate so lets make one
            $directorate = new Directorate();
            $directorate->setName($data[8]);
            $directorate->setSoundexvalue(soundex($data[8]));
            $directorate->save();
            $directorateId=$directorate->getId(); //capture the id
          }
          $spend->setDirectorateId($directorateId);          
          $directorate->free(true); //be nice and release the memory
          //lets go looking for the service 
          $serviceId=null;// create the serviceId outside of the loop for scope          
          $service= Doctrine::getTable('Service')->findOneByName($data[7]);
          if($service){
            //we have the service - do we check the directorate id?
            $serviceId=$service->getId();
          }else{
            //no service so lets create it
            $service=new Service();
            $service->setName($data[7]);
            $service->setDirectorateId($directorateId);
            $service->setSoundexvalue(soundex($data[7]));
            $service->save();
            $serviceId=$service->getId();
          }
          $spend->setServiceId($serviceId);
          $service->free(true); //release the memory
          $spend->save();
          $spend->free(true); //release the memory 
      }//end while
      $reader->close();
      $reader=null;//release the memory
      
    }//end foreach -files
  }
}