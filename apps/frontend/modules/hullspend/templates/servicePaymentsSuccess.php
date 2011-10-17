<?php  use_helper('jQuery') ?>
<script>
<?php echo "$(document).ready(function() {	$('#spend_data').dataTable(
{ 
    \"bJQueryUI\": false,
    \"bPaginate\": true,
		\"bLengthChange\": true,
		\"bFilter\": true,
		\"bSort\": true,
		\"bInfo\": true,
		\"bAutoWidth\": false   });} );" ?>
</script>
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

<?php //if(count($spend)<50){  ?>
  
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Supplier');
        data.addColumn('number', 'Spend Total');
        data.addRows(<?php echo count($suppliers) ?>);
        <?php $total2=0 ?>
        <?php foreach($suppliers as $supplier){ ?>
       
          data.setValue(<?php echo $total2 ?>, 0, '<?php echo $supplier ?>');
          data.setValue(<?php echo $total2 ?>, 1, <?php if($supplier->getTotalSpendByService($service->getId())>0){ echo $supplier->getTotalSpendByService($service->getId()); }else{ echo 0; } ?>);
         <?php $total2++ ?>
        <?php } ?>
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, {width: 550, height: 400, title: 'Break down of payments to suppliers','legend': 'none'});
      }
    </script>
<?php //} ?>
    <div id="chart_div"></div>

<table cellpadding="0" cellspacing="0" border="0" id="spend_data" class="display">
  <thead>
    <tr>   
        <th>
          Date
        </th>
        <th>
          Supplier
        </th>
        <th>
          Supplier No.
        </th>
        <th>
          Transaction
        </th>  
        <th>
         &pound;
        </th>
    </tr>
  </thead>
  <tbody>
<?php $total=0 ?>
<?php foreach($spend as $order){ ?>
<?php $datetime = strtotime($order->getSpenddate()); ?>
<?php $mysqldate = date("d M Y", $datetime); ?>

   <tr>
      <td><?php echo $mysqldate ?></td>
      <td><?php echo link_to($order->getSuppliername(),'hullspend/supplier?id='.$order->getSupplier()->getSlug()) ?></td>
      <td align="center"><?php echo $order->getSuppliernumber() ?></td>
      <td align="center"><?php echo $order->getTransactionnumber() ?></td>
      
<?php //setlocale(LC_MONETARY, 'en_GB.ISO-8859-15'); ?>
<!--<td align="right"><?php echo number_format($order->getAmount()) ?></td>-->
      <td align="right"><?php echo $order->getAmount() ?></td>
      <?php $total=$total+$order->getAmount(); ?>
   </tr>
  <?php } ?>
  </tbody>
</table>
<div style="text-align:right">
<h2><strong>Total&nbsp;&nbsp;&pound; <?php echo number_format($total) ?></strong></h2>
</div>


<?php //include_partial('global/disqus'); ?>
