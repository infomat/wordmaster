<div class="diary form content">
    <?= $this->Form->create($diary) ?>
    <fieldset>
        <legend><?= __('Add Diary') ?></legend>
        <?php
            echo $this->Form->input('subject');
            echo $this->Form->input('body');
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
