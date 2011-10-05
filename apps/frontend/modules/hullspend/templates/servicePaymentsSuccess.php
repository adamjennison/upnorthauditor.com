<h1>
  <?php echo $service->getName() ?> : Payments to suppliers
</h1>
<br/>
A service in the <?php echo link_to($service->getDirectorate(),'hullspend/directorates?id='.$service->getDirectorate()->getSlug()) ?> directorate.
<br/>
<br/>

<?php echo link_to('Back to '.$service->getName().' summary page','hullspend/service?id='.$service->getSlug()) ?>
<br/>
<br/>

<table>
  <tr>
    <th>
      Spend Date
    </th>
    <th>
      Supplier
    </th>
    <th>
      Supplier No.
    </th>
    <th>
      Transaction No.
    </th>  
    <th>
     &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &pound;
    </th>
  </tr>
<?php $total=0 ?>
<?php foreach($spend as $order){ ?>
<?php $datetime = strtotime($order->getSpenddate()); ?>
<?php $mysqldate = date("d M Y", $datetime); ?>

   <tr>
      <td><?php echo $mysqldate ?></td>
      <td><?php echo link_to($order->getSuppliername(),'hullspend/supplier?id='.$order->getSupplier()->getSlug()) ?></td>
      <td align="center"><?php echo $order->getSuppliernumber() ?></td>
      <td align="center"><?php echo $order->getTransactionnumber() ?></td>
      <td align="right">&pound;<?php echo $order->getAmount() ?></td>
      <?php $total=$total+$order->getAmount(); ?>
   </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>    
    <td><strong>Total &pound;<?php echo $total ?></strong></td>
  </tr>
</table>
