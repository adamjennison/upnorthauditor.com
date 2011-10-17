<h1>List of Directorates</h1>
<?php foreach($directorates as $directorate){ ?>

<p>
  <?php echo link_to($directorate->getName(),'hullspend/directorate?id='.$directorate->getSlug()) ?>

</p>
<?php } ?>
