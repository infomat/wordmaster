<div class="points form content">
    <?= $this->Form->create($point) ?>
    <fieldset>
        <legend><?= __('Edit Point') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->input('accu_points');
            echo $this->Form->input('remained_points');
            echo $this->Form->input('comments');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
