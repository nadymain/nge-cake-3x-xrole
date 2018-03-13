<?php if ($this->Paginator->hasPage(null, 2)) : ?>
<nav class="paginator">
    <h3 class="hidden_element">Paginator</h3>
    <ul>
        <?= $this->Paginator->prev(__('Prev')) ?>
        <?= $this->Paginator->numbers(['first' => 1, 'last' => 1, 'modulus' => 2]) ?>
        <?= $this->Paginator->next(__('Next')) ?>
    </ul>
    <p>
        <?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}')]) ?>
    </p>
</nav>
<?php endif ?>
