<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Evidence Entity
 *
 * @property int $id
 * @property int $user_test_id
 * @property int $user_id
 * @property int $course_test_id
 * @property int $answer_id
 * @property string $photo_url
 *
 * @property \App\Model\Entity\UserTest $user_test
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\CourseTest $course_test
 * @property \App\Model\Entity\Answer $answer
 */
class Evidence extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
