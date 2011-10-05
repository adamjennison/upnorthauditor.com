<h2><?php echo link_to('Number of directorates','hullspend/directorates') ?> <?php echo $numberofdirectorates?></h2>
<h2><?php echo link_to('Number of services','hullspend/services') ?> <?php echo $numberofservices  ?></h2>
<h2><?php echo link_to('Number of suppliers','hullspend/suppliers') ?> <?php echo $numberofsuppliers ?></h2>
<h2>Number of transactions <?php echo $numberoftransactions ?></h2>
<h2>Number of failed transactions <?php echo $numberofnegtransactions ?></h2>
<h2>Total Value of transactions: &pound;<?php echo $totalvalueoftransactions ?></h2>
<h2>Largest transaction total: &pound;<?php echo $largesttransaction ?></h2>
<h2><?php echo link_to('Supplier with most spend','hullspend/suppliers') ?> <?php echo $largestsupplier ?></h2>