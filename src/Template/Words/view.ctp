<div class="words view content">
    <h3><?= h($word->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('English') ?></th>
            <td><?= h($word->english) ?></td>
        </tr>
        <tr>
            <th><?= __('Meaning') ?></th>
            <td><?= h($word->meaning) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $word->has('user') ? $this->Html->link($word->user->id, ['controller' => 'Users', 'action' => 'view', $word->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($word->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Completed') ?></th>
            <td><?= $this->Number->format($word->completed) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($word->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($word->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Tags') ?></h4>
        <?php if (!empty($word->tags)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($word->tags as $tags): ?>
            <tr>
                <td><?= h($tags->id) ?></td>
                <td><?= h($tags->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
