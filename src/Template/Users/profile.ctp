<div class="users index content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('username') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('lastLoginTime') ?></th>
                <th><?= $this->Paginator->sort('Words Added') ?></th>
                <th><?= $this->Paginator->sort('Words Finished') ?></th>
                <th><?= $this->Paginator->sort('Journals') ?></th>
                <th><?= $this->Paginator->sort('History') ?></th>
                <th><?= __('Total POINTS') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <?php 
                    $sum = 0;
                    foreach ($user->diarys as $diary) {
                        $sum = $sum + ((str_word_count($diary['body'])) % $maxWord) * $rateJournalWord;    
                    }
                    $numWords = 0;
                    foreach ($user->words as $word) {
                        if ($word->meaning != null)  {
                            $numWords++;
                        } 
                    }
                 ?>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->lastLoginTime) ?></td>
                <td><?= $numWords ?></td>
                <td><?= count($user->completed_words) ?></td>
                <td><?= count($user->diarys) ?></td>
                <td><?= count($user->historys) ?></td>
                <td><?= $numWords*$rateAddWord+count($user->completed_words)*$rateFinishWord+count($user->diarys)*$rateJournal+count($user->historys)*$rateHistory+$sum ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p class=wmnotice>* Points are caculated with following fomula: (# of Word)* <?= $rateAddWord ?> 
                + (#ofCompleted Word)*<?= $rateFinishWord ?> 
                + (#ofJournal)*<?= $rateJournal ?>  
                + (#ofJournal Word)* <?= $rateJournalWord?> 
                + (#ofHistory)*<?= $rateHistory ?></p>
</div>
