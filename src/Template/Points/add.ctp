<div class="points form content">
    <?= $this->Form->create($point) ?>
    <fieldset>
        <legend><?= __('Add Point') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $username, 'empty' => true]);
            echo $this->Form->input('accu_points',['label' => 'Accumulated Points']);
            echo $this->Form->input('redeem_points',['label' => 'Points to be redeemed']);
            echo $this->Form->input('remained_points',['type'=>'text','label' => 'Remained Points','readonly' => true]);
            echo $this->Form->input('comments');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <h3>Reference</h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= __('Name') ?></th>
                <th><?= __('Accumulated Points') ?></th>
                <th><?= __('Remained Points') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($username as $key => $value): ?>
            <tr>
                <td><?= $value ?></td>
                <td><?= $accumulatedPoints[$key] ?></td>
                <td><?= isset($remainedPoints[$key]) ?  $remainedPoints[$key] : $accumulatedPoints[$key] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
