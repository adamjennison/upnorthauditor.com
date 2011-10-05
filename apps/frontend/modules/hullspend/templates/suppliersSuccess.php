<h1>Suppliers Listing</h1>
<?php foreach($suppliers as $supplier){ ?>

<p>
  <?php echo link_to($supplier->getName(),'hullspend/supplier?id='.$supplier->getSlug()) ?>

</p>
<?php } ?>
