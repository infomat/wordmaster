<div class="points view content">
    <h3><?= h($point->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $point->has('user') ? $this->Html->link($point->user->id, ['controller' => 'Users', 'action' => 'view', $point->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($point->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Points') ?></th>
            <td><?= $this->Number->format($point->points) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($point->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($point->modified) ?></td>
        </tr>
    </table>
</div>
