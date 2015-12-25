<div class="words form content">
    <?= $this->Form->create($word) ?>
    <fieldset>
        <legend><?= __('Add Word') ?></legend>
        <?php
            echo $this->Form->input('english');
            echo $this->Form->input('meaning',['rows' => '3']);
            echo '<label for="example"><strong>Example</strong></label>';
            echo $this->Form->textarea('example');
            echo $this->Form->select('tags._ids', $tags, ['multiple' => 'checkbox']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
