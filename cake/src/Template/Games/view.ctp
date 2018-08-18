<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Game $game
 */
?>
<nav class="large-3 medium-4 columns cake" id="actions-sidebar">
    <ul class="cake side-nav">
        <li class="cake heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Game'), ['action' => 'edit', $game->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Game'), ['action' => 'delete', $game->id], ['confirm' => __('Are you sure you want to delete # {0}?', $game->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Games'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Game'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Websites'), ['controller' => 'Websites', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Website'), ['controller' => 'Websites', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="games cake view large-9 medium-8 columns content">
    <h3><?= h($game->name) ?></h3>

    <div class="row">

        <div class="col-md-3">
            <img src="//images.igdb.com/igdb/image/upload/t_cover_big/<?= $game->cover; ?>.jpg"" alt="<?= $game->name; ?> cover" class="mb-4">
        </div>

        <div class="col-md-9">
            <table class="cake vertical-table">
                <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($game->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Slug') ?></th>
                    <td><?= h($game->slug) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($game->id) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Rating') ?></th>
                    <td><?= $this->Number->format($game->rating) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Popularity') ?></th>
                    <td><?= $this->Number->format($game->popularity) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($game->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($game->modified) ?></td>
                </tr>
            </table>
        </div>

    </div>

    <div class="row">
        <h4><?= __('Summary') ?></h4>
        <?= $this->Text->autoParagraph(h($game->summary)); ?>
    </div>
    <div class="cake related">
        <h4><?= __('Related Websites') ?></h4>
        <?php if (!empty($game->websites)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Game Id') ?></th>
                <th scope="col"><?= __('Url') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($game->websites as $websites): ?>
            <tr>
                <td><?= h($websites->id) ?></td>
                <td><?= h($websites->game_id) ?></td>
                <td><?= h($websites->url) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Websites', 'action' => 'view', $websites->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Websites', 'action' => 'edit', $websites->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Websites', 'action' => 'delete', $websites->id], ['confirm' => __('Are you sure you want to delete # {0}?', $websites->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
