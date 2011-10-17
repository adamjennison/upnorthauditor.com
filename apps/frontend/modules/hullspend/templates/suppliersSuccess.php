<h1>List of Suppliers</h1>
<div id="azindex">      
<ul id="index">
<li><?php echo link_to('0-9', 'hullspend/suppliers?letter=none') ?></li>
<li><?php echo link_to('A', 'hullspend/suppliers?letter=a') ?></li>
<li><?php echo link_to('B', 'hullspend/suppliers?letter=b') ?></li>
<li><?php echo link_to('C', 'hullspend/suppliers?letter=c') ?></li>
<li><?php echo link_to('D', 'hullspend/suppliers?letter=d') ?></li>
<li><?php echo link_to('E', 'hullspend/suppliers?letter=e') ?></li>
<li><?php echo link_to('F', 'hullspend/suppliers?letter=f') ?></li>
<li><?php echo link_to('G', 'hullspend/suppliers?letter=g') ?></li>
<li><?php echo link_to('H', 'hullspend/suppliers?letter=h') ?></li>
<li><?php echo link_to('I', 'hullspend/suppliers?letter=i') ?></li>
<li><?php echo link_to('J', 'hullspend/suppliers?letter=j') ?></li>
<li><?php echo link_to('K', 'hullspend/suppliers?letter=k') ?></li>
<li><?php echo link_to('L', 'hullspend/suppliers?letter=l') ?></li>
<li><?php echo link_to('M', 'hullspend/suppliers?letter=m') ?></li>
<li><?php echo link_to('N', 'hullspend/suppliers?letter=n') ?></li>
<li><?php echo link_to('O', 'hullspend/suppliers?letter=o') ?></li>
<li><?php echo link_to('P', 'hullspend/suppliers?letter=p') ?></li>
<li><?php echo link_to('Q', 'hullspend/suppliers?letter=q') ?></li>
<li><?php echo link_to('R', 'hullspend/suppliers?letter=r') ?></li>
<li><?php echo link_to('S', 'hullspend/suppliers?letter=s') ?></li>
<li><?php echo link_to('T', 'hullspend/suppliers?letter=t') ?></li>
<li><?php echo link_to('U', 'hullspend/suppliers?letter=u') ?></li>
<li><?php echo link_to('V', 'hullspend/suppliers?letter=v') ?></li>
<li><?php echo link_to('W', 'hullspend/suppliers?letter=w') ?></li>
<li><?php echo link_to('X', 'hullspend/suppliers?letter=x') ?></li>
<li><?php echo link_to('Y', 'hullspend/suppliers?letter=y') ?></li>
<li><?php echo link_to('Z', 'hullspend/suppliers?letter=z') ?></li>
</ul>
</div>
<br/><br/>
<br/><br/>
<div style="padding-top: 100px;">
  <?php foreach ($pager->getResults() as $supplier): ?>
  <p>
    <?php echo link_to($supplier->getName(),'hullspend/supplier?id='.$supplier->getSlug()) ?>
  </p>
  <?php endforeach; ?>

  <div style="width:20px;float:left;margin-top:3px;margin-right:10px">
  <?php echo link_to('first', 'hullspend/suppliers?page='.$pager->getFirstPage().'&letter='.$letter) ?>
  </div>

  <div>
  <?php if ($pager->haveToPaginate()): ?>
  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
  <div style="padding:5px 5px 5px 5px;border:#000000 thin solid;float:left;width:10px;margin-left:3px;font-size:10px" >
  <?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'hullspend/suppliers?page='.$page.'&letter='.$letter) ?>
  </div>
  <?php endforeach ?>
  <?php endif ?>
  </div>

  <div style="width:20px;float:left;margin-left:10px;margin-top:3px;">
  <?php echo link_to('last', 'hullspend/suppliers?page='.$pager->getLastPage().'&letter='.$letter) ?>
  </div>
</div>

<br/><br/>

<!--
<?php //foreach($suppliers as $supplier){ ?>

<p>
  <?php //echo link_to($supplier->getName(),'hullspend/supplier?id='.$supplier->getSlug()) ?>

</p>
<?php //} ?>
-->
