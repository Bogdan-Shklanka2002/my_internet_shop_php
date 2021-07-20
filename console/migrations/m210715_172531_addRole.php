<?php

use yii\db\Migration;

/**
 * Class m210715_172531_addRole
 */
class m210715_172531_addRole extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $auth->add($auth->createRole('admin'));
        $auth->add($auth->createRole('owner'));
        $auth->add($auth->createRole('seo_manager'));
        $auth->add($auth->createRole('content_manager'));
        $auth->add($auth->createRole('user'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210715_172531_addRole cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210715_172531_addRole cannot be reverted.\n";

        return false;
    }
    */
}
