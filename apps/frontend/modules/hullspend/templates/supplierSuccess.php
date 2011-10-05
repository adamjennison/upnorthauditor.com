<h1>
  <?php echo $supplier->getName() ?>
</h1>

 <h3>Summary for <start> to <end></h3>
    
<table>
  <th>
    <td>Payments</td>
    <td>Total</td>
    <td>Max</td>
    <td>Min</td>            
    <td>Average</td>
  </th>
  <?php  ?>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <?php ?>
</table>



<table>
  <tr>
    <th>
      Spend Date
    </th>
    <th>
      Transaction Number
    </th>
    <th>
      Directorate
    </th>
    <th>
      Service
    </th>    
    <th>
      &pound;
    </th>
  </tr>

<?php foreach($spend as $order){ ?>
<?php $datetime = strtotime($order->getSpenddate()); ?>
<?php $mysqldate = date("d M Y", $datetime); ?>
   <tr>
      <td><?php echo $mysqldate ?></td>
      <td><?php echo $order->getTransactionnumber() ?></td>
      <td><?php echo link_to($order->getDirectoratename(),'hullspend/directorate?id='.$order->getDirectorate()->getSlug()) ?></td>
      <td><?php echo link_to($order->getServicename(),'hullspend/service?id='.$order->getService()->getSlug()) ?></td>
      <td>&pound;<?php echo $order->getAmount() ?></td>
      
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
