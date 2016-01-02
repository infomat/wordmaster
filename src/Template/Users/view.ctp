<div class="users view content">
    <h3>TOTAL PTS: <?= count($user->words)*$rateAddWord+count($user->completed_words)*$rateFinishWord+count($user->diarys)*$rateJournal+count($user->historys)*$rateHistory ?></h3>
    <p class=wmnotice>*Points are caculated with following fomula: (# of Word)* <?= $rateAddWord ?> + (#ofCompleted Word)*<?= $rateFinishWord ?> + (#ofJournal)*<?= $rateJournal ?> + (#ofHistory)*<?= $rateHistory ?></p>
    <table class="vertical-table">
        <tr>
            <th><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th><?= __('name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th><?= __('lastLoginTime') ?></th>
            <td><?= h($user->lastLoginTime) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Diary') ?></h4>
        <?php if (!empty($user->diarys)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Subject') ?></th>
                <th><?= __('Body') ?></th>
                <th><?= __('WordCount') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->diarys as $diary): ?>
            <tr>
                <td><?= h($diary->subject) ?></td>
                <td><?= h($diary->body) ?></td>
                <td><?= $this->Html->link(str_word_count($diary->body), ['action' => 'view', $diary->id]) ?></td>
                <td><?= h($diary->created) ?></td>
                <td><?= h($diary->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Diarys', 'action' => 'view', $diary->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Diarys', 'action' => 'edit', $diary->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Diarys', 'action' => 'delete', $diary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diary->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related History') ?></h4>
        <?php if (!empty($user->historys)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Created') ?></th>
                <th><?= __('Duration(Minutes)') ?></th>
            </tr>
            <?php foreach ($user->historys as $history): ?>
            <tr>
                <td><?= h($history->created) ?></td>
                <td><?= h($history->duration) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Historys', 'action' => 'view', $history->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Historys', 'action' => 'edit', $history->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Points') ?></h4>
        <?php if (!empty($user->points)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Accumulated Points') ?></th>
                <th><?= __('Remained Points') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
            </tr>
            <?php foreach ($user->points as $points): ?>
            <tr>
                <td><?= h($points->accu_points) ?></td>
                <td><?= h($points->remained_points) ?></td>
                <td><?= h($points->created) ?></td>
                <td><?= h($points->modified) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Words') ?></h4>
        <?php if (!empty($user->words)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('English') ?></th>
                <th><?= __('Meaning') ?></th>
                <th><?= __('Completed') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->words as $words): ?>
            <tr>
                <td><?= h($words->english) ?></td>
                <td><?= h($words->meaning) ?></td>
                <td><?= $words->completed==0 ? __('No'):__('Yes') ?></td>
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
