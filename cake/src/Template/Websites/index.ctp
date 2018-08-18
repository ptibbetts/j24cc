<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Website[]|\Cake\Collection\CollectionInterface $websites
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Website'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Games'), ['controller' => 'Games', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Game'), ['controller' => 'Games', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="websites index large-9 medium-8 columns content">
    <h3><?= __('Websites') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('game_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('url') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($websites as $website): ?>
            <tr>
                <td><?= $this->Number->format($website->id) ?></td>
                <td><?= $website->has('game') ? $this->Html->link($website->game->name, ['controller' => 'Games', 'action' => 'view', $website->game->id]) : '' ?></td>
                <td><?= h($website->url) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $website->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $website->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $website->id], ['confirm' => __('Are you sure you want to delete # {0}?', $website->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
