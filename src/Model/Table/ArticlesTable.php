<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Articles Model
 *
 * @property \App\Model\Table\TagsTable|\Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \App\Model\Entity\Article get($primaryKey, $options = [])
 * @method \App\Model\Entity\Article newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Article[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Article|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Article patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Article[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Article findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArticlesTable extends Table
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

        $this->setTable('articles');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Tags', [
            'foreignKey' => 'article_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'articles_tags'
        ]);

        $this->addBehavior('Muffin/Slug.Slug');

        $this->addBehavior('Search.Search');
        $this->searchManager()
            ->value('status')
            ->add('tag_id', 'Search.Callback', [  
                'callback' => function ($query, $args, $filter) {
                    $query->matching('Tags', function ($query) use ($args) {
                        return $query->where(['Tags.id' => $args['tag_id']]);
                    });
                },
                'filterEmpty' => true
            ])
            ->add('filter', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['title']
            ])
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['title', 'content']
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
            ->scalar('title')
            ->maxLength('title', 191)
            ->requirePresence('title', 'create')
            ->notEmpty('title')
            ->add('title', 'unique', [
                'rule' => 'validateUnique',
                'message' => 'Title already taken, must be unique',
                'provider' => 'table'
            ]);

        $validator
            ->scalar('slug')
            ->maxLength('slug', 191)
            ->notEmpty('slug')
            ->add('slug', 'unique', [
                'rule' => 'validateUnique',
                'message' => 'Slug already taken, must be unique',
                'provider' => 'table'
            ]);

        $validator
            ->scalar('content')
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

        $validator
            ->scalar('image')
            ->maxLength('image', 191)
            ->allowEmpty('image');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->isUnique(['title']));
        $rules->add($rules->isUnique(['slug']));

        return $rules;
    }

    /**
     * findTagged
     */
    public function findTagged(Query $query, array $options)
    {
        return $this->find()
            ->distinct(['Articles.id'])
            ->matching('Tags', function ($q) use ($options) {
                if (empty($options['tags'])) {
                    return $q->where(['Tags.name IS' => null]);
                }
                return $q->where(['Tags.name IN' => $options['tags']]);
            });
    }

    /**
     * beforeSave
     */
    public function beforeSave($event, $entity, $options)
    {
        if ($entity->tag_string) {
            $entity->tags = $this->_buildTags($entity->tag_string);
        }
    }

    /**
     * _buildTags
     */
    protected function _buildTags($tagString)
    {
        $newTags = array_unique(array_map('trim', explode(',', $tagString)));
        $out = [];
        $query = $this->Tags->find()
            ->where(['Tags.name IN' => $newTags]);
            
        foreach ($query->extract('name') as $existing) {
            $index = array_search($existing, $newTags);
                if ($index !== false) {
                unset($newTags[$index]);
            }
        }

        foreach ($query as $tag) {
            $out[] = $tag;
        }

        // Add new tags.
        foreach ($newTags as $tag) {
            $out[] = $this->Tags->newEntity(['name' => $tag]);
        }

        return $out;
    }
}
