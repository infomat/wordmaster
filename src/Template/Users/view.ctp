<div class="users view content">
    <h3><?= h($user->id) ?></h3>
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
                <th><?= __('Id') ?></th>
                <th><?= __('Subject') ?></th>
                <th><?= __('Body') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->diarys as $diary): ?>
            <tr>
                <td><?= h($diary->id) ?></td>
                <td><?= h($diary->subject) ?></td>
                <td><?= h($diary->body) ?></td>
                <td><?= h($diary->user_id) ?></td>
                <td><?= h($diary->created) ?></td>
                <td><?= h($diary->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Diary', 'action' => 'view', $diary->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Diary', 'action' => 'edit', $diary->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Diary', 'action' => 'delete', $diary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diary->id)]) ?>

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
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Duration') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->historys as $history): ?>
            <tr>
                <td><?= h($history->id) ?></td>
                <td><?= h($history->user_id) ?></td>
                <td><?= h($history->created) ?></td>
                <td><?= h($history->duration) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'History', 'action' => 'view', $history->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'History', 'action' => 'edit', $history->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'History', 'action' => 'delete', $history->id], ['confirm' => __('Are you sure you want to delete # {0}?', $history->id)]) ?>

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
                <th><?= __('Id') ?></th>
                <th><?= __('Points') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->points as $points): ?>
            <tr>
                <td><?= h($points->id) ?></td>
                <td><?= h($points->points) ?></td>
                <td><?= h($points->user_id) ?></td>
                <td><?= h($points->created) ?></td>
                <td><?= h($points->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Points', 'action' => 'view', $points->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Points', 'action' => 'edit', $points->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Points', 'action' => 'delete', $points->id], ['confirm' => __('Are you sure you want to delete # {0}?', $points->id)]) ?>

                </td>
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
                <th><?= __('Id') ?></th>
                <th><?= __('English') ?></th>
                <th><?= __('Meaning') ?></th>
                <th><?= __('Completed') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->words as $words): ?>
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
