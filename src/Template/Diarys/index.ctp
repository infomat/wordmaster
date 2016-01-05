<div class="diarys index content">
    <h3><?= __('Articles') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('subject') ?></th>
                <th><?= __('WordCount') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($diarys as $diary): ?>
            <tr>
                <td><?= h($diary->created) ?></td>
                <td><?= h($diary->subject) ?></td>
                <td><?= $this->Html->link(str_word_count($diary->body), ['action' => 'view', $diary->id]) ?></td>
                <td><?= $diary->has('user') ? $this->Html->link($diary->user->name, ['controller' => 'Users', 'action' => 'view', $diary->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $diary->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $diary->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $diary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diary->id)]) ?>
                </td>
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
