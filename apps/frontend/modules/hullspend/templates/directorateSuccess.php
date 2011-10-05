<h1>Directorate: <?php echo $directorate->getName() ?></h1>

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
<?php $total=0 ?>
<?php foreach($spend as $order){ ?>
   <tr>
      <td><?php echo $order->getSpenddate() ?></td>
      <td><?php echo $order->getTransactionnumber() ?></td>
      <td><?php echo $order->getDirectoratename() ?></td>
      <td><?php echo $order->getServicename() ?></td>
      <td>&pound;<?php echo $order->getAmount() ?></td>
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
