<?php

use yii\db\Migration;

/**
 * Class m190328_065448_create_table_place_lang
 */
class m190328_065448_create_table_place_lang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('place_lang', [
            'id' => $this->primaryKey()->unsigned(),
            'place_id' => $this->integer(11)->unsigned()->notNull(),
            'locality' => $this->string(45)->notNull(),
            'country' => $this->string(45)->notNull(),
            'lang' => $this->string(2)->notNull(),
        ]);
        //Создание индекса для текущей таблицы
        $this->createIndex('idx_place_lang_place_id_place',
            'place_lang',
            'place_id'
        );
        //Создание внешнего ключа для текущей таблицы
        $this->addForeignKey('fk_place_lang_place_id_place',
            'place_lang',
            'place_id',
            'place',
            'id',
            'restrict',
            'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //При удалении таблицы важен порядок удаления:
        //Сначала Внешние ключи, потом индексы, затем сама таблица.
        $this->dropForeignKey('fk_place_lang_place_id_place', 'place_lang');

        $this->dropIndex('idx_place_lang_place_id_place', 'place_lang');

        $this->dropTable('place_lang');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190328_065448_create_table_place_lang cannot be reverted.\n";

        return false;
    }
    */
}
