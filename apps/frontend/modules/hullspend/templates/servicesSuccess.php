<h1>Services Listing</h1>
<?php foreach($services as $service){ ?>

<p>
  <?php echo link_to($service->getName(),'hullspend/service?id='.$service->getSlug()) ?>

</p>
<?php } ?>
