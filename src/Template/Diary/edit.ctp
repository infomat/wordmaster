<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $diary->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $diary->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Diary'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="diary form large-9 medium-8 columns content">
    <?= $this->Form->create($diary) ?>
    <fieldset>
        <legend><?= __('Edit Diary') ?></legend>
        <?php
            echo $this->Form->input('subject');
            echo $this->Form->input('body');
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
