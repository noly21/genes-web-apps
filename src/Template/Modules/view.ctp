
<style>
td.table-data {
    transform: translateY(7px); 
    vertical-align: top !important;
}

tr:nth-child(even)>td {
    border-top: none !important;
}

.main-thead tr th {
    background: #e5e5e5;
    display: inline-block !important;
    border-radius: 5px 5px 0px 0px;
    padding: 5px 50px;
    position: relative;
    top: 0px;
    color: #000;
}

.main-tbody{
    border: 1px solid #e5e5e5;
}

tr:nth-child(1)>td{
    border: none !important;
    vertical-align: initial;
}

.inner-header h3{
    margin-top: 5px;
    margin-bottom: 5px;
    margin-left: 5px;
    /* text-align: left; */
    display: inline-block;

}

.inner-header thead th a {
    margin-top: 3px;
}

th.text-center {
    text-align: left !important;
}
th.text-center{
background: #4f6d7a;

}

td.td-title {
    font-weight: 600;
}

</style>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../">Module</a></li>
    <li class="breadcrumb-item active" aria-current="page">View</li>
  </ol>
</nav>
<div class='box box-primary'>
    <div class='box-header'>
    <h3 class="timeline-header"><?= $module->name?></h3>

    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $module->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $module->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $module->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
    	<?= $this->element('guide', array("section" => 'formTemplates')) ?>
        
      </div>
    </div>
    <div class='box-body'>

    <div>
    <table class="main-table" width="100%">
    <thead class="main-thead"> <th colspan="2">Details</th></thead>
    <tbody class="main-tbody">
    <tr>
    <td width="50%">
    <table class="table">
        <!-- <thead>
            <tr class="bg-primary text-white">
                <th class="text-center" colspan="2"><h3><#?= 'Details' ?></h3></th>
            </tr>
        </thead> -->
        <tbody>
            <tr>
                <td class="td-title" >Course:</td>
            </tr>
            <tr>
                <td ><?= $module->has('course') ? $this->Html->link($module->course->name, ['controller' => 'Course', 'action' => 'view', $module->course->id]) : '' ?></td>
            </tr>
            <tr>
                <td class="td-title"> Resource:</td>
            </tr>
            <tr>
                <td ><?= $module->has('resource') ? $this->Html->link($module->resource->title, ['controller' => 'Resources', 'action' => 'view', $module->resource->id]) : '' ?></td>
            </tr>
            <tr>
                <td class="td-title">Code:</td>
            </tr>
            <tr>
                <td ><?= $module->code ?></td>
            </tr>
            <!-- <tr> -->
            <!-- </tr> -->
        </tbody>
    </table>
    </td>
    <!-- <br> -->
    <td class="table-data" width="50%">
    <table class="table ">
        <!-- <thead>
            <tr class="bg-primary text-white">
                <th class="text-center"><h3><#?= 'Content' ?></h3></th>
            </tr>
        </thead> -->
        <tbody>
            
            <tr>
                <td class="td-title" >Description:</td>
            </tr>
            <tr>
                <td ><?= $module->description; ?></td>
            </tr>
        </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    <br>

    <!-- Enrroled list in module -->
    
        <table class="table table-striped inner-header">
            <thead>
                <tr class="bg-primary text-white">
                    <th colspan="4" class="text-center">
                        <h3>Enrolled Users</h3>
                        <!-- <#?= $this->Form->button('Invite users', [
                            'type' => 'button',
                            'class' => [
                                'btn',
                                'btn-sm',
                                'btn-success',
                                'pull-right'
                            ],
                            'data-toggle' => 'modal',
                            'data-target' => '#inviteModal'
                        ]); ?> -->
                    </th>
                </tr>
            </thead>    
            <tbody>
                <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>View</th>
                </tr>
                
                <!-- <#?php var_dump($UsersEn); exit;?> -->
                <!-- <#?php if($Enrolled_modules->status == 'accepted'):?> -->
                 <?php if (!empty($UsersEn)): ?>
                 <?php foreach($Enrolled_users as $enrolled ):?>
                        <?php foreach($UsersEn as $user):?>
                        <?php if($user->id == $enrolled->user_id): ?>
                        <?php if($user->status != 'not') : ?>
                    <tr width="100%">
                                <td>
                                    <?= h($user->id); ?>  
                                </td>

                                <td>                            
                                    <?= h($user->given_name. ' ' .$user->surname);  ?>
                                </td>
                                <td>
                                    <?php echo "Enrolled"; ?>
                                </td>
                                <td>
                                    <?= $this->Html->link('<span class="glyphicon glyphicon-eye-open">', ['controller' => 'Users', 'action' => 'view', $user->id ], ['escape' => false , 'class' => 'btn btn-xs btn-primary']) ?>
                                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),['action' => 'removed', $enrolled->id],['confirm' => __('Are you sure you want to delete # {0}?', $enrolled->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')])?>
                        </td>
                    </tr>
                        <?php endif; ?>
                        <?php endif;?>
                            <?php endforeach;?>
                        <?php endforeach; ?>
                <?php else:?>
                    <tr>
                        <td class="text-center">No enrolled user</td>
                    </tr>
                <?php endif;?>
            </tbody>
        </table>
                <!-- <#?php endif;?> -->
    </br>
     <!-- Test list -->
    <table class="table table-striped inner-header">
        <thead>
            <tr class="bg-primary text-white">
                <th class="text-center" colspan="4">
                    <h3><?='Related Tests'?></h3>
                    <?= $this->Html->link('Add Tests', [
                        'controller' => 'Tests',
                        'action' => 'add',
                        $module->id
                    ],
                    [
                        'type' => 'button',
                        'class' => [
                            'btn',
                            'btn-sm',
                            'btn-success',
                            'pull-right'
                        ]
                    ]); ?>
                </th>
            </tr>
            <tr>
                <th><?= __('ID') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Type') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($module->tests as $index=>$test): ?> 
                <tr data-id="<?= $test->id?>">
                    <td><?= h($test->id) ?></td>
                    <td><?= h($test->name) ?></td>
                    <td><?= h($test->course_test_type->value) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller'=> 'Tests','action' => 'view', $test->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                        <?= $this->Html->link('<span class="glyphicon glyphicon-cog"></span><span class="sr-only">' . __('Manage') . '</span>', ['controller'=> 'Tests','action' => 'manage', $test->id], ['escape' => false, 'class' => 'btn btn-xs btn-primary', 'title' => __('Manage')]) ?>
                        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller'=> 'Tests','action' => 'edit', $test->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                        <?php if($test->active):?>
                        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),['action' => 'delete', $test->id],['confirm' => __('Are you sure you want to delete # {0}?', $test->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')])?>
                        <?php endif;?>
                        <?php if(!$test->active):?>
                        <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                            . '</span>', ['action' => 'delete', $test->id], 
                            ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                            'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
                        <?php endif;?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>

</div>


    <!-- Modal -->
    
    <div class="modal fade" id="inviteModal" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">ADD USERS</h4>
            </div>
            <div class="modal-body " style="min-height: auto;">
                <?= $this->Form->create(false, ['url' => ['controller' => 'Courses', 'action' => 'invite', $course->id], 'id' =>'invite-form']) ?>
                <div class="form-group">
                    <?= $this->Form->label('modules')?>
                    <?= $this->Form->select('modules', $modules_list , ['multiple' => true, 'class' => ['chosen-select', 'w-100'], 'id' => 'modules_select', 'value' => $course->modules[0]->id]); ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->label('students')?>
                    <?= $this->Form->select('students', 
                        $students , 
                        ['multiple' => true, 
                        'class' => ['chosen-select', 'w-100'], 
                        'id' => 'students_select']); ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
            <div class="modal-footer">
                <?= $this->Form->button('Send Invites', [
                    'id' => 'send-invites',
                    'class' => [
                        'btn',
                        'btn-success'
                    ],
                    'type' => 'button'
                ]) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
            
        </div>
    </div>
    
    <script type="text/javascript"> 

        const isEmail = (email) => {
            let format = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
            return (email.match(format) == null) ? false : true;
        }

        const emailExists = (email) => {
            let res = false;
            $("#students_select option").each((index) => {
                if($($("#students_select option")[index]).text() == email){
                    res = true;
                };
            });
            return res;
        }

        $('#send-invites').click((e) => {
            let el = $(e.target);
            let form = $($('#invite-form')[0]);
            console.log(form.attr('action'));
            $.ajax({
                type    : 'POST',
                url     : form.attr('action'),
                data    : form.serializeArray(),
            }).done(function(data) {
                alert(data.message);
                window.location.reload();
            })
            .fail(function() {
                alert('Error inviting users');
            })
        });
        $("#invite-form").submit((e) => {
            e.preventDefault();
        });

        $('#modules_select').change(() => {
            let url = "<?= $this->Url->build(['controller'=>'Courses','action'=>'refreshStudentOptions']) ?>";
            let modules = $('#modules_select').val();
            let data = {
                modules : modules,
            }
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : data,
            }).done(function(data) {
                console.log(data);
                if(data){
                let select = $('#students_select');
                select.empty();
                $.each(data, (value, key) => {
                        select.append($("<option></option>")
                            .attr("value", value).text(key));
                })
                select.trigger('chosen:updated');
                }
            })
            .fail(function() {
                alert('Error inviting users');
            })
        });

        $(document).on('keyup','#students_select_chosen input',(e) => {
            let el = $(e.target);
            let value = el.val();
            let keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                if(isEmail(value) && !emailExists(value)){
                    let select = $('#students_select');
                    select.append('<option value="'+value+'" selected>'+value+'</option>');
                    select.trigger('chosen:updated');
                }
            }
        })

        $('table.double-click tbody tr').dblclick(function (){
            var url = "<?php echo $this->Url->build(array('controller' => 'Modules', 'action'=>'view'));?>/"+$(this).attr('data-id');    
            window.location.href = url;
        });
    </script>