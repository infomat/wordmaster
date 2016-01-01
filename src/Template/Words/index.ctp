<div class="words index content">
    <?php
    if ($index == null) {
        echo '<h3>'.__('My Words').'</h3>';
    } else if ($index == 0) {
        echo '<h3>'.__('My Completed Words').'</h3>';
    } else {
        echo '<h3>'.__('All Words').'</h3>';
    }
    ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('english') ?></th>
                <th><?= $this->Paginator->sort('meaning') ?></th>
                <th><?= $this->Paginator->sort('completed') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($words as $word): ?>
            <tr>
                <td><?= $this->Html->link(h($word->english), 'http://endic.naver.com/search.nhn?sLn=en&searchOption=all&query='.$word->english.'#',['target' => '_blank']) ?></td>
                <td><?= h($word->meaning) ?></td>
                <td><?= $word->completed ? __('Yes') : __('No'); ?></td>
                <td><?= h($word->user->name) ?></td>
                <td><?= h($word->created) ?></td>
                <td><?= h($word->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $word->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $word->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $word->id], ['confirm' => __('Are you sure you want to delete # {0}?', $word->id)]) ?>
                    <?php 
                    if ($index == '0') {
                        echo $this->Form->postLink(__('Uncomplete'), ['controller' => 'Words','action' => 'uncomplete', $word->id], ['confirm' => __('Are you sure you want to uncomplete # {0}?', $word->id)]);
                    } 
                    ?>
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
