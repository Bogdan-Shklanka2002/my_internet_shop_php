<?php

use yii\db\Migration;

/**
 * Class m210715_173044_addAdminUser
 */
class m210715_173044_addAdminUser extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $adminRole = $auth->getRole('admin');
        $auth->assign($adminRole, 1);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210715_173044_addAdminUser cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210715_173044_addAdminUser cannot be reverted.\n";

        return false;
    }
    */
}
