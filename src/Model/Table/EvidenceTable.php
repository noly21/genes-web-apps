<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Evidence Model
 *
 * @property \App\Model\Table\UserTestsTable|\Cake\ORM\Association\BelongsTo $UserTests
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
//  * @property \App\Model\Table\CourseTestsTable|\Cake\ORM\Association\BelongsTo $CourseTests
 * @property \App\Model\Table\UserAnswersTable|\Cake\ORM\Association\BelongsTo $Useranswers
 *
 * @method \App\Model\Entity\Evidence get($primaryKey, $options = [])
 * @method \App\Model\Entity\Evidence newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Evidence[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Evidence|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Evidence patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Evidence[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Evidence findOrCreate($search, callable $callback = null, $options = [])
 */
class EvidenceTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('evidence');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('UserTests', [
            'foreignKey' => 'user_test_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        // $this->belongsTo('CourseTests', [
        //     'foreignKey' => 'course_test_id',
        //     'joinType' => 'INNER'
        // ]);
        $this->belongsTo('Useranswers', [
            'foreignKey' => 'answer_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('photo_url', 'create')
            ->notEmpty('photo_url');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_test_id'], 'UserTests'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        // $rules->add($rules->existsIn(['course_test_id'], 'CourseTests'));
        $rules->add($rules->existsIn(['answer_id'], 'Useranswers'));

        return $rules;
    }
}
