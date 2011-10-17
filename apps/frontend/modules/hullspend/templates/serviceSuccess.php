<?php  use_helper('jQuery') ?>
<script>
<?php echo "$(document).ready(function() {	$('#service_data').dataTable(
{ 
    \"bJQueryUI\": false,
    \"bPaginate\": true,
		\"bLengthChange\": true,
		\"bFilter\": true,
		\"bSort\": true,
		\"bInfo\": true,
		\"bAutoWidth\": false   });} );" ?>
</script>
<?php $datetime1 = strtotime($firstDate); ?>
<?php $cleanFirstDate = date("d M Y", $datetime1); ?>
<?php $datetime2 = strtotime($lastDate); ?>
<?php $cleanLastDate = date("d M Y", $datetime2); ?>
 <?php $total=$service->getTotalSpent() ?>

<h1>
  <?php echo $service->getName() ?>
</h1>
<br/>
A service in the <?php echo link_to($service->getDirectorate().' directorate.','hullspend/directorates?id='.$service->getDirectorate()->getSlug()) ?>
<br/><br/>
<?php echo link_to('Payments to suppliers details for '.$service->getName(),'hullspend/servicePayments?id='.$service->getSlug()) ?>
<br/>
<h3>Summary from <?php echo $cleanFirstDate ?> to <?php echo $cleanLastDate ?> </h3>

        <table>
          <tr>
            <th class='right'>Payments</th>
            <th class='right'>Total</th>

            <th class='right'>Max</th>
            <th class='right'>Min</th>
            <th class='right'>Average</th>
          </tr>
          <tr>
            <td class='center'>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $service->getTotalTransactions() ?></td>
            <td class='right'><?php echo number_format($total) ?></td>

            <td class='right'><?php echo number_format($service->getMaxPayment()) ?></td>
            <td class='right'><?php echo number_format($service->getMinPayment()) ?></td>
            <td class='right'><?php echo number_format(sprintf("%.2f",$service->getAvgPayment())) ?></td>
          </tr>
        </table>



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

    <div id="chart_div"></div>

<h3>Supplier summary from <?php echo $cleanFirstDate ?> to <?php echo $cleanLastDate ?> </h3>

<div>
  <table cellpadding="0" cellspacing="0" border="0" id="service_data" class="display">
    <thead>
      <tr>
        <th>Supplier</th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&pound;</th>
        <th>No. Payments</th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total &#37;</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($suppliers as $supplier){ ?>
        <tr>
          <td>
             <?php echo link_to($supplier->getName(),'hullspend/supplier?id='.$supplier->getSlug()) ?>
          </td> 
          <td align="right">
            <?php echo $supplier->getTotalSpendByService($service->getId()) ?>
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
    </tbody>  
  </table>
  <div style="text-align:right; 
          margin: 0px 0px 0px 0px;
          padding: 0px 0px 0px 0px;">
    <h2><strong>Total&nbsp;&nbsp;&pound; <?php echo number_format($total) ?></strong></h2>
  </div>
    <div style="align:right;">
    <!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
      <a class="addthis_button_preferred_1"></a>
      <a class="addthis_button_preferred_2"></a>
      <a class="addthis_button_preferred_3"></a>
      <a class="addthis_button_preferred_4"></a>
      <a class="addthis_button_compact"></a>
      <a class="addthis_counter addthis_bubble_style"></a>
    </div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=adamjennison"></script>
    <!-- AddThis Button END -->
  </div>
</div>
<?php include_partial('global/disqus'); ?>
