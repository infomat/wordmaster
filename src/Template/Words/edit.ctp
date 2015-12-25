<div class="words form content">
    <?= $this->Form->create($word) ?>
    <fieldset>
        <legend><?= __('Edit Word') ?></legend>
        <?php
            echo $this->Form->input('english');
            echo $this->Form->input('meaning',['rows' => '3']);
            echo '<label for="example"><strong>Example</strong></label>';
            echo $this->Form->textarea('example');
            echo '<label for="completed"><strong>Completed</strong> ';
            echo $this->Form->checkbox('completed', ['value' => 1, 'hiddenFields'=>0]); 
            echo '</label>';
            echo $this->Form->select('tags._ids', $tags, ['multiple' => 'checkbox']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
