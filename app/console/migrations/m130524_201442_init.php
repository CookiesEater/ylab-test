<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(255)->notNull(),
            'is_visible' => $this->boolean()->unsigned()->notNull(),
            'sort' => $this->tinyInteger(1)->unsigned()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'KEY (`sort`)',
        ]);

        $this->createTable('{{%provider}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'sort' => $this->tinyInteger(1)->unsigned()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'KEY (`sort`)',
        ]);

        $this->createTable('{{%good}}', [
            'id' => $this->primaryKey()->unsigned(),
            'category_id' => $this->integer()->unsigned()->notNull(),
            'provider_id' => $this->integer()->unsigned()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'price' => $this->double([10,2])->unsigned()->notNull(),
            'image' => $this->string(255)->notNull(),
            'sort' => $this->tinyInteger(2)->unsigned()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'KEY (`sort`)',
        ]);
        $this->addForeignKey('good_ibfk1', '{{%good}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('good_ibfk2', '{{%good}}', 'provider_id', '{{%provider}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%good}}');
        $this->dropTable('{{%provider}}');
        $this->dropTable('{{%category}}');
    }
}
