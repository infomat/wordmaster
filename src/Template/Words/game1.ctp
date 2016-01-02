<div class="words view content">
    <?= $this->Form->create($problems) ?>
    <table class="vertical-table">
    <?php $index = 1; ?>
    <?php foreach ($problems as $word): ?>
        <tr>
             <th><h3><?= __('Problem: ').$index ?></h3></th>
             <td></td>
        </tr>
        <tr>
             <th><?= __('Meaning') ?></th>
             <td><?= h($word->meaning) ?></td>
        </tr>
        <tr>
            <th><?= __('Example') ?></th>
            <td>
                <?php
                    echo str_ireplace($word->english,str_repeat("_",strlen($word->english)),$word->example);
                ?>
            </td>
            <td hidden id='answer_<?= $index ?>'></td>
        </tr>
        <tr>
            <th><?= __('English') ?></th>
            <td>
            <input type="text" id='uanswer_<?= $index ?>' name="<?=$word->id ?>" class="form-control" placeholder="Enter Word" maxlength="120" required>
            </td>
        </tr>
        <tr hidden>
            <th>Answer<h3 id='answer_<?= $index ?>'><?=$word->english?></h3></th>
            <td><span id='result_<?= $index ?>'></span></td>
        </tr>
        <?php $index++; ?>
     <?php endforeach; ?>
     </table>
    <div hidden class = 'well'>
        <span id='mark'></span>
    </div>
    <p hidden id='index'><?= $index-1 ?></p>
    <input type="text" id='correctIDs' name='correctIDs' class='hidden'></input>
    <input type="text" id='finalmarks' name='finalmarks' class='hidden'></input>
    <?php
    echo $this->Form->button('Try Again', ['id' => 'reset','class' => 'hidden']);
    echo $this->Form->button('Submit', ['type' => 'submit','id'=>'submitResult','class' => 'hidden']);
    ?>
    <?= $this->Form->end() ?>
    <?= $this->Form->button('Check Answer', ['id' => 'checkAnswer']) ?>

</div>
