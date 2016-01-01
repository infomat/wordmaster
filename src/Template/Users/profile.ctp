<div class="users index content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('username') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('lastLoginTime') ?></th>
                <th><?= $this->Paginator->sort('Words Added') ?></th>
                <th><?= $this->Paginator->sort('Words Finished') ?></th>
                <th><?= $this->Paginator->sort('Journals') ?></th>
                <th><?= $this->Paginator->sort('History') ?></th>
                <th><?= __('Total') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->lastLoginTime) ?></td>
                <td><?= count($user->words) ?></td>
                <td><?= count($user->completed_words) ?></td>
                <td><?= count($user->diarys) ?></td>
                <td><?= count($user->historys) ?></td>
                <td><?= count($user->words)+count($user->completed_words)*1.2+count($user->diarys)*1.5+count($user->historys)*0.2 ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
