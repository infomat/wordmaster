<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tag'), ['action' => 'edit', $tag->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tag'), ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Words'), ['controller' => 'Words', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Word'), ['controller' => 'Words', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tags view large-10 medium-8 columns content">
    <h3><?= h($tag->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($tag->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($tag->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Words') ?></h4>
        <?php if (!empty($tag->words)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('English') ?></th>
                <th><?= __('Meaning') ?></th>
                <th><?= __('Completed') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tag->words as $words): ?>
            <tr>
                <td><?= h($words->id) ?></td>
                <td><?= h($words->english) ?></td>
                <td><?= h($words->meaning) ?></td>
                <td><?= h($words->completed) ?></td>
                <td><?= h($words->user_id) ?></td>
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
