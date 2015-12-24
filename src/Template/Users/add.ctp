<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Diary'), ['controller' => 'Diary', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Diary'), ['controller' => 'Diary', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List History'), ['controller' => 'History', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New History'), ['controller' => 'History', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Points'), ['controller' => 'Points', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Point'), ['controller' => 'Points', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Words'), ['controller' => 'Words', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Word'), ['controller' => 'Words', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-10 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('role');
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('username');
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
