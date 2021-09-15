<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Hash;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
/**
 * Modules Controller
 * @property \App\Model\Table\CourseEnrolledUsersTable $CourseEnrolledUsersTable
 * @property \App\Model\Table\CourseEnrolledModulesTable $CourseEnrolledModulesTable
 * @property \App\Model\Table\UsersTable $UsersTable
 * @property \App\Model\Table\ModulesTable $Modules
 *
 * @method \App\Model\Entity\Module[] paginate($object = null, array $settings = [])
 */
class ModulesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Courses']
        ];
        $modules = $this->paginate($this->Modules);
        $courses = $this->Modules->Courses->find('list', ['limit' => 200]);
        // dump($modules);exit;
        $this->set(compact('modules','courses'));
        $this->set('_serialize', ['modules']);
    }

    public function listModules()
    {
        $this->viewBuilder()->setLayout('taro');
        $modules = $this->paginate($this->Modules);
        $courses = $this->Modules->Courses->find('list', ['limit' => 200]);
  
        $this->set(compact('modules','courses'));
        $this->set('_serialize', ['modules']);
    }

    public function viewModule($id = null)
    {
        $userID = $this->Auth->user('id');
        $this->viewBuilder()->setLayout('taro');
        $module = $this->Modules->get($id, [
            'contain' => ['Courses', 
            'Tests' => function(Query $q) use ($userID){
                return $q->contain(
                    [
                        'CourseTestTypes',
                        'UserTests' => function(Query $q) use ($userID){
                            return $q->where(['user_id' => $userID]);
                        }
                    ]
                );
            },
            
            ]
        ]);
        // dump($module->tests[0]->user_tests[0]);exit;
        $this->set(compact('module'));
        $this->set('_serialize', ['module']);
    }

    /**
     * View method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $module = $this->Modules->get($id, 
            [
                'contain' => ['Courses', 'Resources', 'Tests' => function (Query $q){
                    return $q->contain('CourseTestTypes');
                }]
            ]
        );

        $CourseEnrolledModulesTable = TableRegistry::get('course_enrolled_modules');
        $Enrolled_modules = $CourseEnrolledModulesTable->find()
        ->where(['course_module_id' => $id , 'status' => 'accepted'])
        ->toArray();
        
        $user = array();
        foreach ($Enrolled_modules as $key => $value) {
           $user[] = $value->course_enrolled_user_id;
        }
        
        
        $CourseEnrolledUsersTable = TableRegistry::get('course_enrolled_users');
        $Enrolled_users = $CourseEnrolledUsersTable->find()
        ->where(['id IN' => $user , 'status' => 'accepted'])
        ->toArray();
        
        // var_dump($Enrolled_users);
        //  exit;
        $users = array();
        foreach ($Enrolled_users as $key => $value) {
            $users[] = $value->user_id;
        }        

        // var_dump($users);exit;

        $UsersTable = TableRegistry::get('Users');
        $UsersEn = $UsersTable->find()
        ->where(['id IN' => $users ])
        ->toArray();
        
        $this->set(compact('Enrolled_modules','Enrolled_users','UsersEn'));
        $this->set('module', $module);
        $this->set('_serialize', ['module']);
        
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($courseID = null)
    {
        $module = $this->Modules->newEntity();
        $courses = $this->Modules->Courses->find('list', ['limit' => 200])->toArray();
        (!array_key_exists($courseID, $courses)) ? $courseID = false : '';
        if ($this->request->is('post')) {
            $serialized=$this->Modules->serializeMachineType($this->request->getData('course_machine_types_id'));
            
            $module = $this->Modules->patchEntity($module, $this->request->getData());
            
            if ($this->Modules->save($module)) {
                $this->Flash->success(__('The module has been saved.'));
                if($courseID){
                    return $this->redirect(['controller' => 'Courses', 'action' => 'view', $courseID]);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The module could not be saved. Please, try again.'));
        }
        
        $courses = $this->Modules->Courses->find('list', ['limit' => 200]);
        $resources = $this->Modules->Resources->find('list', ['limit' => 200]);
        $test = $this->Modules->Tests->find('list', ['limit' => 200]);
        if(!$courseID){
            $courseID = false;
        }
        $this->set(compact('module', 'courses', 'resources', 'test', 'courseID' ));
        
        $this->set('_serialize', ['module']);
        
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $module = $this->Modules->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $module = $this->Modules->patchEntity($module, $this->request->getData());
            if ($this->Modules->save($module)) {
                $this->Flash->success(__('The module has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The module could not be saved. Please, try again.'));
        }
        $courses = $this->Modules->Courses->find('list', ['limit' => 200]);
        $resources = $this->Modules->Resources->find('list', ['limit' => 200]);
        //$tests = $this->Modules->Test->find('list', ['limit' => 200]);
        $this->set(compact('module', 'courses', 'resources', 'tests'));
        $this->set('_serialize', ['module']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $module = $this->Modules->get($id);
        // $query =  $this->Modules->query();
        // if ($query->update()->set(['active' => 0])->where(['id' => $id])->execute()) {
        if($this->Modules->delete($module)){
            $this->Flash->success(__('The module has been deleted.'));
        } else {
            $this->Flash->error(__('The module could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function restore($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        // $module = $this->Modules->get($id);
        $query =  $this->Modules->query();
        if ($query->update()->set(['active' => 1])->where(['id' => $id])->execute()) {
            $this->Flash->success(__('The module has been deleted.'));
        } else {
            $this->Flash->error(__('The module could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function removed($id = null)
    {
        // exit;
        $this->request->allowMethod(['post', 'delete']);
        // $module = $this->Modules->get($id);
        $CourseEnrolledUsersTable = TableRegistry::get('course_enrolled_users');
        $query =  $CourseEnrolledUsersTable->query();
        if ($query->update()->set(['status' => 'test'])->where(['id ' => $id])->execute()) {
            $this->Flash->success(__('The student has been kick.'));
        } else {
            $this->Flash->error(__('The module could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
