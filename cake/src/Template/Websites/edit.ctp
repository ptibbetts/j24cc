<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Website $website
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $website->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $website->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Websites'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Games'), ['controller' => 'Games', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Game'), ['controller' => 'Games', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="websites form large-9 medium-8 columns content">
    <?= $this->Form->create($website) ?>
    <fieldset>
        <legend><?= __('Edit Website') ?></legend>
        <?php
            echo $this->Form->control('game_id', ['options' => $games]);
            echo $this->Form->control('url');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
