<div class="words form content">
    <?= $this->Form->create($word) ?>
    <fieldset>
        <legend><?= __('Add Word') ?></legend>
        <button type="button" class="btn btn-info right" id="lookup">Naver</button>
        <?php
            echo $this->Form->input('english');
            echo $this->Form->input('meaning',['rows' => '3']);
            echo '<label for="example"><strong>Example</strong></label>';
            echo $this->Form->textarea('example');
            echo '<label>Tag:</label>';
            echo $this->Form->select('tags._ids', $tags, ['multiple' => 'checkbox']);
            echo $this->Form->input('tag_string', ['type' => 'text']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
