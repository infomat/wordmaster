<div class="diarys view content">
    <h3><?= h($diary->subject) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $diary->has('user') ? $this->Html->link($diary->user->name, ['controller' => 'Users', 'action' => 'view', $diary->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Subject') ?></th>
            <td><?= h($diary->subject) ?></td>
        </tr>
        <tr>
            <th><?= __('Body') ?></th>
            <td>
                <p id = 'body'><?= $diary->body ?></p>
            </td>
        </tr>
        <tr>
        <th><?= __('Word Count') ?></th>
        <td>
        <div id="word_statistic"></div>
        </td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($diary->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($diary->modified) ?></td>
        </tr>
    </table>

</div>
