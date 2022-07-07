<?php $this->_t =" post";
echo '<h1>toto</h1>';
foreach ($posts as $p): ?>
<h2 class="title"> <?= $p->getTitle() ?> </h2>

<?php endforeach; ?>
