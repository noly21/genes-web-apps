<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Evidence[]|\Cake\Collection\CollectionInterface $evidence
  */
?>
<div class='box'>
<div class='box-header'>
        <h3 class='box-title'><i class="fa fa-fighter-jet" aria-hidden="true"></i> <?= $this->request->query('archived')?'Deleted':''?> Evidence</h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i>', 
            ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
        
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-trash-o" aria-hidden="true"></i>', 
                ['action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Deleted']);
        }?>
      </div>
      </div>
    </div>
<div class="evidence index large-9 medium-8 columns content">
    <h3><?= __('Evidence') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_test_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('course_test_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('answer_id') ?></th>
                <!-- <th scope="col"><#?= $this->Paginator->sort('photo_url') ?></th> -->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($evidence as $evidence): ?>
            <tr>
                <td><?= $this->Number->format($evidence->id) ?></td>
                <td><?= $evidence->has('user_test') ? $this->Html->link($evidence->user_test->id, ['controller' => 'UserTests', 'action' => 'view', $evidence->user_test->id]) : '' ?></td>
                <td><?= $evidence->has('user') ? $this->Html->link($evidence->user->name, ['controller' => 'Users', 'action' => 'view', $evidence->user->id]) : '' ?></td>
                <td><?= $evidence->has('course_test') ? $this->Html->link($evidence->course_test->name, ['controller' => 'CourseTests', 'action' => 'view', $evidence->course_test->id]) : '' ?></td>
                <td><?= $this->Number->format($evidence->answer_id) ?></td>
                <!-- <td><#?= h($evidence->photo_url) ?></td> -->
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $evidence->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $evidence->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $evidence->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evidence->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
</div>