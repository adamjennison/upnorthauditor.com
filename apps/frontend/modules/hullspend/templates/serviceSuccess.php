<h1>
  <?php echo $service->getName() ?>
</h1>
<br/>
A service in the <?php echo link_to($service->getDirectorate(),'hullspend/directorates?id='.$service->getDirectorate()->getSlug()) ?> directorate.
<br/><br/>
<?php echo link_to('Payments to suppliers details for '.$service->getName(),'hullspend/servicePayments?id='.$service->getSlug()) ?>
<br/><br/>



Summary from 1st payment to last payment
#payments
min
max
avg

<h3>Supplier summary</h3>


<table>
  <tr>
    <th>Supplier</th>
    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&pound;</th>
    <th># transactions</th>
    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total &#37;</th>
  </tr>
  
 <?php $total=$service->getTotalSpent() ?>
  

<?php foreach($suppliers as $supplier){ ?>

<tr>
  <td>
     <?php echo link_to($supplier->getName(),'hullspend/supplier?id='.$supplier->getSlug()) ?>
  </td> 
  <td align="right">
     &pound;<?php echo $supplier->getTotalSpendByService($service->getId()) ?>
  </td>
  <td align="center">
    <?php echo $supplier->getCountSpendByService($service->getId()) ?>
  </td>
  <td align="center">
  <?php $percent=($supplier->getTotalSpendByService($service->getId())/$total)*100 ?>
    <?php echo sprintf("%.2f", $percent) ?>
  </td>
</tr>
<?php } ?>

<tr>
  <td></td>
  <td align="right">
    <strong>Total = &pound;<?php echo $total ?></strong>
  </td>
    <td></td>
  <td></td>
</tr>
</table>

