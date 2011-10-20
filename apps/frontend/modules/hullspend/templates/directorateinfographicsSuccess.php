    
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["treemap"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
          // Create and populate the data table.
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Service');
          data.addColumn('string', 'Parent');
          data.addColumn('number', 'spend');
          data.addRows([
           ["HullCC £<?php echo $totalvalueoftransaction ?>",null,0],
            <?php foreach($directorates as $directorate){ ?>       
            ["<?php echo $directorate.' £'.$directorate->getTotalSpent() ?>","HullCC £<?php echo $totalvalueoftransaction ?>",<?php echo $directorate->getTotalSpent() ?>],
               <?php $services=$directorate->getServices() ?>
                    <?php  foreach($services as $service){ ?>
                    ["<?php echo $service.' £'.$service->getTotalSpent()?>","<?php echo $directorate.' £'.$directorate->getTotalSpent()  ?>",<?php if($service->getTotalSpent()>0){ echo $service->getTotalSpent(); }else{ echo 0; } ?>],
                <?php } ?>  
            <?php } ?>
            ["test","HullCC £<?php echo $totalvalueoftransaction ?>",10]
          ]);

          // Create and draw the visualization.
          var tree = new google.visualization.TreeMap(document.getElementById('visualization'));
          tree.draw(data, {
            minColor: '#f00',
            midColor: '#ddd',
            maxColor: '#0d0',
            headerHeight: 15,
            fontColor: 'black',
            showScale: true});
      }
    </script>


    <div id="visualization" style="width: 1100px; height: 500px;"></div>
 
 <?php /* ?>   
    <?php foreach($directorates as $directorate){ ?>
    
      <?php echo '<strong>'.$directorate->getName().' &pound;'.$directorate->getTotalSpent().'</strong></br>' ?>
        <?php $services=$directorate->getServices() ?>
        <?php  foreach($services as $service){ ?>
        <?php   echo $service.' &pound;'.$service->getTotalSpent().'<br/>' ?>
        <?php } ?>    
    <?php } ?>
<?php */ ?>
