
<nav>
  <ul class="pagination justify-content-center">
    <?php for ($i = 1; $i <= $total_de_pages; $i++): ?>
      <li class="page-item <?php if ($page == $i): ?>active<?php endif; ?>">
        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>
