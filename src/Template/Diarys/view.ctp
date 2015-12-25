<div class="diarys view content">
    <h3><?= h($diary->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Subject') ?></th>
            <td><?= h($diary->subject) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $diary->has('user') ? $this->Html->link($diary->user->id, ['controller' => 'Users', 'action' => 'view', $diary->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($diary->id) ?></td>
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
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($diary->body)); ?>
    </div>
</div>
