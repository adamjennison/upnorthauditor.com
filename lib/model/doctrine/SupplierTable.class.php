<?php

/**
 * SupplierTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SupplierTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object SupplierTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Supplier');
    }
    
    public static function getNumberOfSuppliers(){
        
                $connection = Doctrine_Manager::connection();
        $query = 'SELECT count(name) as total from supplier';
        $statement=$connection->execute($query);
        $statement->execute();
        $resultset=$statement->fetch(PDO::FETCH_OBJ);
        $total=$resultset->total;
        return $total;
    }    
}