<div class="words form content">
    <?= $this->Form->create($word) ?>
    <fieldset>
        <legend><?= __('Add Word') ?></legend>
        <button type="button" class="btn btn-info right" id="lookup">Naver</button>
        <button type="button" class="btn btn-info right" id="lookup_dic">Dictionary.com</button>
        <button type="button" class="btn btn-info right" id="lookup_the">Thesaurus.com</button>
        <?php
            echo $this->Form->input('english');
            echo $this->Form->input('meaning',['rows' => '3']);
            echo '<label for="example"><strong>Example</strong></label>';
            echo $this->Form->textarea('example');
            echo '<label>Tag:</label>';
            echo $this->Form->select('tags._ids', $tags, ['multiple' => 'checkbox']);
            echo $this->Form->input('tag_string', ['type' => 'text']);
            if ($this->request->session()->read('Auth.User.role') == 'admin') {
                echo $this->Form->input('user_id', ['options' => $username, 'empty' => true]);
            }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
