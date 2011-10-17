<?php $datetime1 = strtotime($firstDate); ?>
<?php $cleanFirstDate = date("d M Y", $datetime1); ?>
<?php $datetime2 = strtotime($lastDate); ?>
<?php $cleanLastDate = date("d M Y", $datetime2); ?>

<h2><?php echo link_to('Number of directorates','hullspend/directorates') ?> <?php echo $numberofdirectorates?></h2>
<h2><?php echo link_to('Number of services','hullspend/services') ?> <?php echo $numberofservices  ?></h2>
<h2><?php echo link_to('Number of suppliers','hullspend/suppliers') ?> <?php echo $numberofsuppliers ?></h2>
<h2>Number of payments <?php echo $numberoftransactions ?></h2>
<h2>Number of returned payments <?php echo $numberofnegtransactions ?></h2>
<?php setlocale(LC_MONETARY, 'en_GB'); ?>
<h2>Total Value of payments: &pound;<?php echo number_format($totalvalueoftransactions) ?></h2>
<h2>Largest payment total: &pound;<?php echo number_format($largesttransaction) ?></h2>
<h2>Payments dates range from <?php echo $cleanFirstDate ?> to <?php echo $cleanLastDate ?></h2>
<h2><?php //echo link_to('Supplier with most spend','hullspend/suppliers') ?> <?php //echo $largestsupplier ?></h2>
