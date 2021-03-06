<div class="words form content">
    <?= $this->Form->create($word) ?>
    <fieldset>
        <legend><?= __('Edit Word') ?></legend>
        <button type="button" class="btn btn-info right" id="lookup">Naver</button>
        <button type="button" class="btn btn-info right" id="lookup_dic">Dictionary.com</button>
        <button type="button" class="btn btn-info right" id="lookup_the">Thesaurus.com</button>
        <?php
            echo $this->Form->input('english');
            echo $this->Form->input('meaning',['rows' => '3']);
            echo '<label for="example"><strong>Example</strong></label>';
            echo $this->Form->textarea('example');
            //echo '<label for="completed"><strong>Completed</strong> ';
            //echo $this->Form->checkbox('completed', ['value' => 1, 'hiddenFields'=>0]); 
            //echo '</label>';
            echo $this->Form->select('tags._ids', $tags, ['multiple' => 'checkbox']);
            echo $this->Form->input('tag_string', ['type' => 'text']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
