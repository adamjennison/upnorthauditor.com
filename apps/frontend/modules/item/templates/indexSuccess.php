<h1>Items List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Description</th>
      <th>Author</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $item): ?>
    <tr>
      <td><a href="<?php echo url_for('item/edit?id='.$item->getId()) ?>"><?php echo $item->getId() ?></a></td>
      <td><?php echo $item->getTitle() ?></td>
      <td><?php echo $item->getDescription() ?></td>
      <td><?php echo $item->getAuthor() ?></td>
      <td><?php echo $item->getCreatedAt() ?></td>
      <td><?php echo $item->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('item/new') ?>">New</a>
