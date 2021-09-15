<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Evidence Controller
 *
 * @property \App\Model\Table\EvidenceTable $Evidence
 * @property \App\Model\Table\UserAnswersTable $UserAnswers
 * @method \App\Model\Entity\Evidence[] paginate($object = null, array $settings = [])
 */
class EvidenceController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['UserTests', 'Users', 'Useranswers']
        ];
        $evidence = $this->paginate($this->Evidence);


        $this->set(compact('evidence'));
        $this->set('_serialize', ['evidence']);
    }

    /**
     * View method
     *
     * @param string|null $id Evidence id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null )
    {
        $evidence = $this->Evidence->get($id, [
            'contain' => ['UserTests', 'Users', 'Useranswers']

            
        ]);
        // dump($this->$Evidence->user_test_id->get());exit;
        $this->set('evidence', $evidence);
        $this->set('_serialize', ['evidence']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $evidence = $this->Evidence->newEntity();
        if ($this->request->is('post')) {
            $evidence = $this->Evidence->patchEntity($evidence, $this->request->getData());
            if ($this->Evidence->save($evidence)) {
                $this->Flash->success(__('The evidence has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The evidence could not be saved. Please, try again.'));
        }
        $userTests = $this->Evidence->UserTests->find('list', ['limit' => 200]);
        $users = $this->Evidence->Users->find('list', ['limit' => 200]);
        // $courseTests = $this->Evidence->CourseTests->find('list', ['limit' => 200]);
        $answers = $this->Evidence->Useranswers->find('list', ['limit' => 200]);
        $this->set(compact('evidence', 'userTests', 'users',  'answers'));
        $this->set('_serialize', ['evidence']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Evidence id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $evidence = $this->Evidence->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evidence = $this->Evidence->patchEntity($evidence, $this->request->getData());
            if ($this->Evidence->save($evidence)) {
                $this->Flash->success(__('The evidence has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The evidence could not be saved. Please, try again.'));
        }
        $userTests = $this->Evidence->UserTests->find('list', ['limit' => 200]);
        $users = $this->Evidence->Users->find('list', ['limit' => 200]);
        // $courseTests = $this->Evidence->CourseTests->find('list', ['limit' => 200]);
        $answers = $this->Evidence->Useranswers->find('list', ['limit' => 200]);
        $this->set(compact('evidence', 'userTests', 'users',  'answers'));
        $this->set('_serialize', ['evidence']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Evidence id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $evidence = $this->Evidence->get($id);
        if ($this->Evidence->delete($evidence)) {
            $this->Flash->success(__('The evidence has been deleted.'));
        } else {
            $this->Flash->error(__('The evidence could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function clview($id = null, $student_id = null){       
     
        $this->paginate = [
            'contain' => ['UserTests', 'Users', 'Useranswers']
        ];
        $evidence = $this->paginate($this->Evidence);

        // dump($evidence);exit;
         $this->set(compact('evidence'));
    

    
            // $user_test_id = $evidenceSelect[0]->user_test_id;
            
            // // $UserAnswersTable = TableRegistry::get('user_answers');
            // $UserAnswersTable = TableRegistry::get('UserAnswers');
            // $UserAnswers = $this->UserAnswers->find()
            // ->where(['user_id' => $student_id, 'user_test_id' => $user_test_id])
            // ->toArray();
    
            // // dump($UserAnswersSelect);exit;
    
            // $students = $this->Tests->Modules->CourseEnrolledModules->CourseEnrolledUsers->Users
            // ->find()
            // ->where(['id IN' => $student_id])        
            // ->toArray();
    
    
            // $userTestsTable = TableRegistry::get('UserTests');
            // $userTestSelect = $userTestsTable->find()
            // ->where(['user_id' => $student_id, 'course_test_id' => $id])
            // ->toArray();
    
    
            // $userTestSelect = $userTestsTable->find()
            // ->where(['user_id' => $student_id, 'course_test_id' => $id])
            // ->toArray();
    
            // $studentId = $student_id;
            // $userTestsId = $userTestSelect[0]->id;
            // // dump($this->Tests);exit; 
            // $tests = $this->Tests->get($id, [
            //     'contain' => [
            //         'Questions' => function(Query $q){
            //             return $q->contain(['CourseQuestionTypes', 'Answers',
            //             'CourseQuestionChoices' => ['sort' => ['CourseQuestionChoices.id' => 'DESC']]]);
            //         }, 
            //         'Modules',
            //         'CourseTestTypes',
            //         // 'Answers',
                    
            //     ]
            // ]);
    
                
            // $this->set(compact('evidenceSelect','students','UserAnswers','tests'));
    
        }
    
        
}
