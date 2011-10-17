<h1>List of Services</h1>
<div id="azindex">      
<ul id="index">
<li><?php echo link_to('0-9', 'hullspend/services?letter=none') ?></li>
<li><?php echo link_to('A', 'hullspend/services?letter=a') ?></li>
<li><?php echo link_to('B', 'hullspend/services?letter=b') ?></li>
<li><?php echo link_to('C', 'hullspend/services?letter=c') ?></li>
<li><?php echo link_to('D', 'hullspend/services?letter=d') ?></li>
<li><?php echo link_to('E', 'hullspend/services?letter=e') ?></li>
<li><?php echo link_to('F', 'hullspend/services?letter=f') ?></li>
<li><?php echo link_to('G', 'hullspend/services?letter=g') ?></li>
<li><?php echo link_to('H', 'hullspend/services?letter=h') ?></li>
<li><?php echo link_to('I', 'hullspend/services?letter=i') ?></li>
<li><?php echo link_to('J', 'hullspend/services?letter=j') ?></li>
<li><?php echo link_to('K', 'hullspend/services?letter=k') ?></li>
<li><?php echo link_to('L', 'hullspend/services?letter=l') ?></li>
<li><?php echo link_to('M', 'hullspend/services?letter=m') ?></li>
<li><?php echo link_to('N', 'hullspend/services?letter=n') ?></li>
<li><?php echo link_to('O', 'hullspend/services?letter=o') ?></li>
<li><?php echo link_to('P', 'hullspend/services?letter=p') ?></li>
<li><?php echo link_to('Q', 'hullspend/services?letter=q') ?></li>
<li><?php echo link_to('R', 'hullspend/services?letter=r') ?></li>
<li><?php echo link_to('S', 'hullspend/services?letter=s') ?></li>
<li><?php echo link_to('T', 'hullspend/services?letter=t') ?></li>
<li><?php echo link_to('U', 'hullspend/services?letter=u') ?></li>
<li><?php echo link_to('V', 'hullspend/services?letter=v') ?></li>
<li><?php echo link_to('W', 'hullspend/services?letter=w') ?></li>
<li><?php echo link_to('X', 'hullspend/services?letter=x') ?></li>
<li><?php echo link_to('Y', 'hullspend/services?letter=y') ?></li>
<li><?php echo link_to('Z', 'hullspend/services?letter=z') ?></li>
</ul>
</div>
<br/><br/>
<br/><br/>
<div style="padding-top: 100px;">
  <?php foreach ($pager->getResults() as $service): ?>
  <p>
    <?php echo link_to($service->getName(),'hullspend/service?id='.$service->getSlug()) ?>
  </p>
  <?php endforeach; ?>

  <div style="width:20px;float:left;margin-top:3px;margin-right:10px">
  <?php echo link_to('first ', 'hullspend/services?page='.$pager->getFirstPage().'&letter='.$letter) ?>
  </div>

  <div>
  <?php if ($pager->haveToPaginate()): ?>
  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
  <div style="padding:5px 5px 5px 5px;border:#000000 thin solid;float:left;width:10px;margin-left:3px;font-size:10px" >
  <?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'hullspend/services?page='.$page.'&letter='.$letter) ?>
  </div>
  <?php endforeach ?>
  <?php endif ?>
  </div>

  <div style="width:20px;float:left;margin-left:10px;margin-top:3px;">
  <?php echo link_to(' last', 'hullspend/services?page='.$pager->getLastPage().'&letter='.$letter) ?>
  </div>
</div>

<br/><br/>
<!--
<?php //foreach($services as $service){ ?>

<p>
  <?php //echo link_to($service->getName(),'hullspend/service?id='.$service->getSlug()) ?>

</p>
<?php //} ?>
-->
