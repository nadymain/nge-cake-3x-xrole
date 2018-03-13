<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Inflector;
use Intervention\Image\ImageManager;

/**
 * Images Model
 *
 * @method \App\Model\Entity\Image get($primaryKey, $options = [])
 * @method \App\Model\Entity\Image newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Image[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Image|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Image patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Image[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Image findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ImagesTable extends Table
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

        $this->setTable('images');
        $this->setDisplayField('file');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Search');
        $this->searchManager()
            ->add('filter', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['file']
            ]);
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'file' => [
                'filesystem' => [
                    'root' => ROOT . DS . 'webroot' . DS . 'img' . DS . 'uploads' . DS
                ],
                'path' => '{year}',
                'fields' => [
                    'dir' => 'dir',
                    'size' => 'size',
                    'type' => 'type'
                ],
                'nameCallback' => function ($data, $settings) {
                    $filename = pathinfo($data['name'], PATHINFO_FILENAME);
                    $filename = Inflector::slug($filename, '-');
                    $ext = pathinfo($data['name'], PATHINFO_EXTENSION);
                    if (!empty($ext)) {
                        $filename = $filename . '.' . $ext;
                    }
                    return date('dmYHis') . '-' . strtolower($filename);
                },
                'transformer' => 'Josegonzalez\Upload\File\Transformer\SlugTransformer',
                'transformer' =>  function ($table, $entity, $data, $field, $settings) {
                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);

                    // Use the Intervention library to DO THE THING
                    $manager = new ImageManager(array('driver' => 'GD'));
                    $image150 = $manager
                        ->make($data['tmp_name'])
                        ->widen(150, function ($constraint) {
                            $constraint->upsize();
                        });
                    
                    // Store the thumbnail in a temporary file
                    $tmp150 = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;
                    
                    // Save the thumbnail
                    $image150->save($tmp150);

                    // Now return the original and the thumbnail
                    return [
                        $data['tmp_name'] => $data['name'],
                        $tmp150 => 'thumb150-' . $data['name'],
                    ];
                },
                'deleteCallback' => function ($path, $entity, $field, $settings) {
                    return [
                        $path . DS . $entity->{$field},
                        $path . DS . 'thumb150-' . $entity->{$field}
                    ];
                },
                'keepFilesOnDelete' => false
            ]
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
            ->requirePresence('file', 'create')
            ->notEmpty('file')
            ->add('file', 'extension', [
                'rule' => ['extension', ['gif', 'jpeg', 'png', 'jpg']],
                'message' => 'File does not have a jpg, png, and gif extension.',
            ]);

        $validator
            ->setProvider('upload', \Josegonzalez\Upload\Validation\UploadValidation::class)
            ->add('file', 'fileUnderPhpSizeLimit', [
                'rule' => 'isUnderPhpSizeLimit',
                'message' => 'This file is too large',
                'provider' => 'upload'
            ])
            ->add('file', 'fileUnderFormSizeLimit', [
                'rule' => 'isUnderFormSizeLimit',
                'message' => 'This file is too large',
                'provider' => 'upload'
            ])
            ->add('file', 'fileFileUpload', [
                'rule' => 'isFileUpload',
                'message' => 'There was no file found to upload',
                'provider' => 'upload'
            ])
            ->add('file', 'fileBelowMaxSize', [
                'rule' => ['isBelowMaxSize', 900000],
                'message' => 'The file exceeded the max allowed size of 900KB.',
                'provider' => 'upload'
            ]);

        return $validator;
    }
}
