<?php
   $args = new Args();   
   $file=null;
   $directory = '/var/www/library/web/uploads/spend/';   
   //if($args->flag('f')){
     // $csv = file($directory.$args->flag('f').'.csv');
    //  $csv = file($args->flag('f'));
    //}else{
     //echo "we need a file??  usage:  php loadspend.php -f <file name>\n";
    // echo "\n";
    // die();       
   // }
   foreach($args->args as $arg){
     echo "Argument: $arg\n";
     $csv=$arg;
   }
  // $csv = $args->args;
   echo "starting $csv  \n";
  require_once(dirname(__FILE__) .'/../config/ProjectConfiguration.class.php');
  $configuration = ProjectConfiguration::getApplicationConfiguration('frontend','dev',true);
  $databaseManager = new sfDatabaseManager($configuration);


      $reader = new sfCsvReader($csv);
      $reader->open();
      echo 'parsing file '.$csv;
      echo '<br/>';
      while ($data = $reader->read())
      {
          makestuff($data);
      }//end while
      $reader->close();
      $reader=null;//release the memory
      
    //}//end foreach -files
    echo "completed $csv \n\n\n\n";
//----------------------------------------------------------------------

function makestuff( $data){
           $spend=new Spend();
          //lets convert the crappy dates dd-mm-yy to a good old mysql date yyyy-mm-dd
          $datebits=explode('-',$data[2]);
          $day=$datebits[0];
          $month=date('m', strtotime($datebits[1]));
          $year='20'.$datebits[2];
          $spenddate=$year.'-'.$month.'-'.$day;
          $spend->setSpenddate($spenddate);
         // echo $spenddate.'<br/>';
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
       //   echo 'Original name:'.$data[5].'<br/>';
          $cleanSupplierName=trim($cleanSupplierName,'.');
          $cleanSupplierName = str_replace('LIMITED','LTD',$cleanSupplierName);
          $cleanSupplierName = str_replace('NO CHQ ONLY ','',$cleanSupplierName);
          $cleanSupplierName = str_replace('IMPREST ACCOUNT','',$cleanSupplierName);
          $cleanSupplierName = preg_replace('/^THE /','',$cleanSupplierName);
         // need to do regexp replace on these strings..
         
          $cleanSupplierName = trim($cleanSupplierName);
        //  echo 'end name:'.$cleanSupplierName.'<br/>';
          $supplier= Doctrine::getTable('Supplier')->findOneByName($cleanSupplierName);
          if($supplier){
            //we have the supplier so we can insert the supplier id 
            $spend->setSupplierId($supplier->getId());
        //    echo 'Found a supplier so we grabe the id:'.$supplier->getId().'<br/>';
          }else{
            // no supplier so we create one
            $supplier = new Supplier();
            $supplier->setName($cleanSupplierName);
            $supplier->setSoundexvalue(soundex($cleanSupplierName));
            $supplier->save();
            $spend->setSupplierID($supplier->getId());
        //    echo 'Created a new supplier with id:'.$supplier->getId().'<br/>';
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
  
  }
class Args
    {
        private $flags;
        public $args;

        public function __construct()
        {
            $this->flags = array();
            $this->args  = array();

            $argv = $GLOBALS['argv'];
            array_shift($argv);

            for($i = 0; $i < count($argv); $i++)
            {
                $str = $argv[$i];

                // --foo
                if(strlen($str) > 2 && substr($str, 0, 2) == '--')
                {
                                        $str = substr($str, 2);
                    $parts = explode('=', $str);
                    $this->flags[$parts[0]] = true;

                    // Does not have an =, so choose the next arg as its value
                    if(count($parts) == 1 && isset($argv[$i + 1]) && preg_match('/^--?.+/', $argv[$i + 1]) == 0)
                    {
                        $this->flags[$parts[0]] = $argv[$i + 1];
                    }
                    elseif(count($parts) == 2) // Has a =, so pick the second piece
                    {
                        $this->flags[$parts[0]] = $parts[1];
                    }
                }
                elseif(strlen($str) == 2 && $str[0] == '-') // -a
                {
                    $this->flags[$str[1]] = true;
                    if(isset($argv[$i + 1]) && preg_match('/^--?.+/', $argv[$i + 1]) == 0)
                        $this->flags[$str[1]] = $argv[$i + 1];
                }
                elseif(strlen($str) > 1 && $str[0] == '-') // -abcdef
                {
                    for($j = 1; $j < strlen($str); $j++)
                        $this->flags[$str[$j]] = true;
                }
            }

            for($i = count($argv) - 1; $i >= 0; $i--)
            {
                if(preg_match('/^--?.+/', $argv[$i]) == 0)
                    $this->args[] = $argv[$i];
                else
                    break;
            }

            $this->args = array_reverse($this->args);
        }

        public function flag($name)
        {
            return isset($this->flags[$name]) ? $this->flags[$name] : false;
        }
    }
