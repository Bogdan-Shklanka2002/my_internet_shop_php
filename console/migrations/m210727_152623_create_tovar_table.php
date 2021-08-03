<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tovar}}`.
 */
class m210727_152623_create_tovar_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'count' => $this->integer()->notNull()->defaultValue(1),
            'price' => $this->float()->notNull()->defaultValue(1),
            'category_id' => $this->integer()->notNull(),
            'sub_category_id' => $this->integer()->notNull(),
            'url_images' => 'json',

        ]);
         // creates index for column `category_id`
         $this->createIndex(
            'idx-category',
            'products',
            'category_id'
        );
        $this->createIndex(
            'idx-sub_category',
            'products',
            'sub_category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-products-category_id',
            'products',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-products-sub_category_id',
            'products',
            'sub_category_id',
            'sub_categories',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         // drops foreign key for table `category`
         $this->dropForeignKey(
            'fk-products-category_id',
            'products',
        );
        $this->dropForeignKey(
            'fk-products-sub_category_id',
            'products',
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-category',
            'products',
            
        );
        $this->dropIndex(
            'idx-sub_category',
            'products',
            
        );
       


        $this->dropTable('{{%products}}');
    }
}
