<div class="tags view content">
    <h3><?= h($tag->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($tag->name) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Words') ?></h4>
        <?php if (!empty($tag->words)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('English') ?></th>
                <th><?= __('Meaning') ?></th>
                <th><?= __('Completed') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tag->words as $words): ?>
            <tr>
                <td><?= $this->Html->link(h($words->english), 'http://endic.naver.com/search.nhn?sLn=en&searchOption=all&query='.$words->english.'#',['target' => '_blank']) ?></td>
                <td><?= h($words->meaning) ?></td>
                <td><?= h($words->completed) ? __('Yes'):__('No') ?></td>
                <td><?= h($words->created) ?></td>
                <td><?= h($words->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Words', 'action' => 'view', $words->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Words', 'action' => 'edit', $words->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Words', 'action' => 'delete', $words->id], ['confirm' => __('Are you sure you want to delete # {0}?', $words->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
