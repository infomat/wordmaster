<div class="diarys form content">
    <?= $this->Form->create($diary) ?>
    <fieldset>
        <legend><?= __('Edit Diary') ?></legend>
        <?php
            echo $this->Form->input('subject');
            echo $this->Form->input('body');
        ?>
        <label>Word Count</label>
        <div id="word_statistic" class="well"></div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
