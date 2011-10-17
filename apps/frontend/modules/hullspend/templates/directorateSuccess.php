

<?php $datetime1 = strtotime($firstDate); ?>
<?php $cleanFirstDate = date("d M Y", $datetime1); ?>
<?php $datetime2 = strtotime($lastDate); ?>
<?php $cleanLastDate = date("d M Y", $datetime2); ?>
 <?php $total=$directorate->getTotalSpent() ?>

<h1>
  <?php echo $directorate->getName() ?>
</h1>

<br/>
<br/>
<h3>Summary of payments of <?php echo $directorate->getName() ?> during the dates <?php echo $cleanFirstDate ?> to <?php echo $cleanLastDate ?> </h3>

        <table>
          <tr>
            <th class='right'>Payments</th>
            <th class='right'>Total</th>

            <th class='right'>Max</th>
            <th class='right'>Min</th>
            <th class='right'>Average</th>
          </tr>
          <tr>
            <td class='center'>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $directorate->getTotalTransactions() ?></td>
            <td class='right'><?php echo number_format($total) ?></td>

            <td class='right'><?php echo number_format($directorate->getMaxPayment()) ?></td>
            <td class='right'><?php echo number_format($directorate->getMinPayment()) ?></td>
            <td class='right'><?php echo number_format(sprintf("%.2f",$directorate->getAvgPayment())) ?></td>
          </tr>
        </table>
     <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Services');
        data.addColumn('number', 'Spend Total');
        data.addRows(<?php echo count($services) ?>);
        <?php $total2=0 ?>
        <?php foreach($services as $service){ ?>
       
          data.setValue(<?php echo $total2 ?>, 0, '<?php echo $service ?>');
          data.setValue(<?php echo $total2 ?>, 1, <?php if($service->getTotalSpent()>0){ echo $service->getTotalSpent(); }else{ echo 0; } ?>);
         <?php $total2++ ?>
        <?php } ?>
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, {width: 550, height: 400, title: 'Break down of payments to suppliers','legend': 'none'});
      }
    </script>

    <div id="chart_div"></div>



<h3>Services in <?php echo $directorate->getName() ?></h3>


  

<?php foreach($services as $service){ ?>

   <p>
     <?php echo link_to($service->getName(),'hullspend/service?id='.$service->getSlug()) ?>
   <p>

<?php } ?>

<?php include_partial('global/disqus'); ?>
