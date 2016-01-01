<div class="historys index content">
    <h3><?= __('Historys') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('login time') ?></th>
                <th><?= $this->Paginator->sort('duration') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($historys as $history): ?>
            <tr>
                <td><?= $this->Number->format($history->id) ?></td>
                <td><?= $history->has('user') ? $this->Html->link($history->user->name, ['controller' => 'Users', 'action' => 'view', $history->user->id]) : '' ?></td>
                <td><?= h($history->created) ?></td>
                <td><?= h($history->duration) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
