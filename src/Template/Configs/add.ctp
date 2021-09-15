
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Add Config') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	
        <div class="btn-group">
          <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
			         </ul>
        </div>
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($config); ?>
        <?php
          if(!empty($facilityList)){
            echo $this->Form->input('facility_id',[
              'options'=>$facilityList,
              'empty'=>'All',
              'default'=>$currentFacility_id
            ]);
          }
            
            echo $this->Form->input('title');
            echo $this->Form->hidden('type',['value'=>'text']);
            echo $this->Form->input('data');
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
