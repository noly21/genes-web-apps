<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Evidence $evidence
  */
?>
<div class='box'>
<div class='box-header'>
        <h3 class='box-title'><i class="fa fa-fighter-jet" aria-hidden="true"></i> <?= $this->request->query('archived')?'Deleted':''?> Equipment</h3>
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
<div class="evidence view large-9 medium-8 columns content">
    <h3><?= h($evidence->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User Test') ?></th>
            <td><?= $evidence->has('user_test') ? $this->Html->link($evidence->user_test->id, ['controller' => 'UserTests', 'action' => 'view', $evidence->user_test->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $evidence->has('user') ? $this->Html->link($evidence->user->name, ['controller' => 'Users', 'action' => 'view', $evidence->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Course Test') ?></th>
            <td><?= $evidence->has('course_test') ? $this->Html->link($evidence->course_test->name, ['controller' => 'CourseTests', 'action' => 'view', $evidence->course_test->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo Url') ?></th>
            <td><img src="<?= h($evidence->photo_url) ?>"></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($evidence->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Answer Id') ?></th>
            <td><?= $this->Number->format($evidence->answer_id) ?></td>
        </tr>
    </table>
</div>
</div>
