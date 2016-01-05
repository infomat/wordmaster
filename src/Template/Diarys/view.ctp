<div class="diarys view content">
    <h3><?= h($diary->subject) ?></h3>
    <table class="vertical-table">
        <tr>
            <th class='large-3 medium-3 columns'><?= __('User') ?></th>
            <td class='large-9 medium-9 columns'><?= $diary->has('user') ? $this->Html->link($diary->user->name, ['controller' => 'Users', 'action' => 'view', $diary->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th class='large-3 medium-3 columns'><?= __('Subject') ?></th>
            <td class='large-9 medium-9 columns'><?= h($diary->subject) ?></td>
        </tr>
        <tr>
            <th class='large-3 medium-3 columns'><?= __('Body') ?></th>
            <td class='large-9 medium-9 columns'>
                <div id = 'body'>
                    <?= $this->Text->autoParagraph($diary->body)?>
                </div>
            </td>
        </tr>
        <tr>
        <th class='large-3 medium-3 columns'><?= __('Word Count') ?></th>
        <td class='large-9 medium-9 columns'>
        <div id="word_statistic"></div>
        </td>
        </tr>
        <tr>
            <th class='large-3 medium-3 columns'><?= __('Created') ?></th>
            <td class='large-9 medium-9 columns'><?= h($diary->created) ?></td>
        </tr>
        <tr>
            <th class='large-3 medium-3 columns'><?= __('Modified') ?></th>
            <td class='large-9 medium-9 columns'><?= h($diary->modified) ?></td>
        </tr>
    </table>

</div>
