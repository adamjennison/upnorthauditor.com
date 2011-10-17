<?php  use_helper('jQuery') ?>
<script>
<?php echo "$(document).ready(function() {	$('#spupplier_data').dataTable(
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

<h1>
  <?php echo $supplier->getName() ?>
</h1>
<?php $words=array(' ltd',' Ltd',' LTD') ?>
<?php $cleanname=str_replace($words,' Limited',$supplier->getName()) ?>
<p>Search for more information on <?php echo link_to($supplier->getName().' via Google','http://www.google.co.uk/search?q='.$supplier->getName(),'target=_blank') ?> </p>
<p>Search for more information on <?php echo link_to($supplier->getName().' via Open Corporations','http://opencorporates.com/search?utf8=%E2%9C%93&q='.$cleanname.'&commit=Search','target=_blank') ?> </p>

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
            <td class='center'>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $supplier->getTotalTransactions() ?></td>
            <td class='right'><?php echo $total ?></td>

            <td class='right'><?php echo number_format($supplier->getMaxPayment()) ?></td>
            <td class='right'><?php echo number_format($supplier->getMinPayment()) ?></td>
            <td class='right'><?php echo number_format(sprintf("%.2f",$supplier->getAvgPayment())) ?></td>
          </tr>
        </table>



    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Service Name');
        data.addColumn('number', 'total');
        data.addRows(<?php echo count($supplierData) ?>);
        <?php $counter=0; ?>
        <?php foreach($supplierData as $data) {  ?>
       
          data.setValue(<?php echo $counter ?>, 0, '<?php echo $data->getServicename() ?>');
          data.setValue(<?php echo $counter ?>, 1, <?php echo $data->getOrder2() ?>);
          <?php $counter++; ?>
        <?php } ?>
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, {width: 550, height: 400, title: 'Break down of payments to suppliers','legend': 'none'});
      }
    </script>

    <div id="chart_div"></div>

<div>
<table cellpadding="0" cellspacing="0" border="0" id="spupplier_data" class="display">
<thead>
  <tr>
    <th class="date">
      Date
    </th>
    <th>
      Transaction
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
</thead>
<tbody>
<?php foreach($spend as $order){ ?>
<?php $datetime = strtotime($order->getSpenddate()); ?>
<?php $mysqldate = date("d M Y", $datetime); ?>
   <tr>
      <td><?php echo $mysqldate ?></td>
      <td><?php echo $order->getTransactionnumber() ?></td>
      <td><?php echo link_to($order->getDirectoratename(),'hullspend/directorate?id='.$order->getDirectorate()->getSlug()) ?></td>
      <td><?php echo link_to($order->getServicename(),'hullspend/service?id='.$order->getService()->getSlug()) ?></td>
      <td align="right"><?php echo $order->getAmount() ?></td>
      
   </tr>
  <?php } ?>
  
  </tbody>
</table>
<div style="text-align:right">
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
<h2>Are you a supplier who feels can provide a better service to Hull City Council?</h2>
<p>If so then please <?php echo link_to('visit the tender and procurement pages on Hull City Councils website','http://www.hullcc.gov.uk/portal/page?_pageid=221,97534&_dad=portal&_schema=PORTAL') ?></p>
<?php include_partial('global/disqus'); ?>
