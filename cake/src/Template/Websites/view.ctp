<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Website $website
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Website'), ['action' => 'edit', $website->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Website'), ['action' => 'delete', $website->id], ['confirm' => __('Are you sure you want to delete # {0}?', $website->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Websites'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Website'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Games'), ['controller' => 'Games', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Game'), ['controller' => 'Games', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="websites view large-9 medium-8 columns content">
    <h3><?= h($website->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Game') ?></th>
            <td><?= $website->has('game') ? $this->Html->link($website->game->name, ['controller' => 'Games', 'action' => 'view', $website->game->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($website->url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($website->id) ?></td>
        </tr>
    </table>
</div>
