<div class="diarys form content">
    <?= $this->Form->create($diary) ?>
    <fieldset>
        <legend><?= __('Write My Wonderful Journal') ?></legend>
        <?php
            echo $this->Form->input('subject');
            echo $this->Form->input('body',['rows' => 6]);
        ?>
        <label>Word Count</label>
        <div id="word_statistic" class="well"></div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
