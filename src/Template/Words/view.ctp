<div class="words view content">
    <h3><?= h($word->english) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('English') ?></th>
            <td><?= $this->Html->link(h($word->english), 'http://www.howjsay.com/index.php?word='.$word->english.'&submit=Submit',['target' => 'pronunciation']) ?></td>
        </tr>
        <tr>
            <th><?= __('Meaning') ?></th>
            <td><?= h($word->meaning) ?></td>
        </tr>
        <tr>
            <th><?= __('Example') ?></th>
            <td><?= h($word->example) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= h($word->user->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Completed') ?></th>
            <td><?= $this->Number->format($word->completed) ? __('Yes') : __('No') ?></td>
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
                <th><?= __('Name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($word->tags as $tags): ?>
            <tr>
                <td><?= h($tags->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
