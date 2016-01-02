<div class="points view  content">
    <h3><?= h($point->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $point->has('user') ? $this->Html->link($point->user->name, ['controller' => 'Users', 'action' => 'view', $point->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Comments') ?></th>
            <td><?= h($point->comments) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($point->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Accu Points') ?></th>
            <td><?= $this->Number->format($point->accu_points) ?></td>
        </tr>
        <tr>
            <th><?= __('Remained Points') ?></th>
            <td><?= $this->Number->format($point->remained_points) ?></td>
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
