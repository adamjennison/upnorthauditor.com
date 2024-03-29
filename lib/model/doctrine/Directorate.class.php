<?php

/**
 * Directorate
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    myshelf
 * @subpackage model
 * @author     Adam Jennison
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class Directorate extends BaseDirectorate
{

  public function getTotalSpent(){
         $connection = Doctrine_Manager::connection();
        $query = 'SELECT sum(amount) as total from spend where directorate_id='.$this->getId();
        $statement=$connection->execute($query);
        $statement->execute();
        $resultset=$statement->fetch(PDO::FETCH_OBJ);
        $total=$resultset->total;
        return $total;
  }
  
  public function getTotalTransactions(){
         $connection = Doctrine_Manager::connection();
        $query = 'SELECT count(amount) as total from spend where directorate_id='.$this->getId();
        $statement=$connection->execute($query);
        $statement->execute();
        $resultset=$statement->fetch(PDO::FETCH_OBJ);
        $total=$resultset->total;
        return $total;
  }
  
  public function getMinPayment(){
         $connection = Doctrine_Manager::connection();
        $query = 'SELECT min(amount) as total from spend where directorate_id='.$this->getId();
        $statement=$connection->execute($query);
        $statement->execute();
        $resultset=$statement->fetch(PDO::FETCH_OBJ);
        $total=$resultset->total;
        return $total;
  }  

  public function getAvgPayment(){
         $connection = Doctrine_Manager::connection();
        $query = 'SELECT avg(amount) as total from spend where directorate_id='.$this->getId();
        $statement=$connection->execute($query);
        $statement->execute();
        $resultset=$statement->fetch(PDO::FETCH_OBJ);
        $total=$resultset->total;
        return $total;
  }    

  public function getMaxPayment(){
         $connection = Doctrine_Manager::connection();
        $query = 'SELECT max(amount) as total from spend where directorate_id='.$this->getId();
        $statement=$connection->execute($query);
        $statement->execute();
        $resultset=$statement->fetch(PDO::FETCH_OBJ);
        $total=$resultset->total;
        return $total;
  }      
  
  public function getServicesInOrder(){
      $q=Doctrine_Core::getTable('Service')
      ->createQuery('s')
      ->where('s.directorate_id=?',$this->getId())
      ->orderBy('s.name Asc');
      $services=$q->execute();
      return $services;
    }
}
