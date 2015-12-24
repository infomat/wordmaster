<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit History'), ['action' => 'edit', $history->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete History'), ['action' => 'delete', $history->id], ['confirm' => __('Are you sure you want to delete # {0}?', $history->id)]) ?> </li>
        <li><?= $this->Html->link(__('List History'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="history view large-10 medium-8 columns content">
    <h3><?= h($history->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $history->has('user') ? $this->Html->link($history->user->id, ['controller' => 'Users', 'action' => 'view', $history->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($history->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($history->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Duration') ?></th>
            <td><?= h($history->duration) ?></td>
        </tr>
    </table>
</div>
