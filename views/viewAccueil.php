<?php $this->_t =" post";
echo '<h1>toto</h1>';
foreach ($posts as $p): ?>
<h2> <?= $p->getTitle() ?> </h2>

<?php endforeach; ?>
