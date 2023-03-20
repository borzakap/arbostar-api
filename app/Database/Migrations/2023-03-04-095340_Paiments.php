<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Paiments extends Migration
{
    public function up()
    {
        // currency
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'iso' => ['type' => 'varchar', 'constraint' => 3, 'null' => false],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('currencies', true);

        // contragents
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('contragents', true);

        // contragents_conditions
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'contragent_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'field_name' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'field_value' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['contragent_id', 'field_name', 'field_value'], 'key_name_value');
        $this->forge->addForeignKey('contragent_id', 'contragents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('contragents_conditions', true);

        // payments
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'summ' => ['type' => 'decimal', 'constraint' => '10,2', 'null' => true],
            'converted_to_usd' => ['type' => 'decimal', 'constraint' => '10,2', 'null' => true],
            'currency_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'contragent_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'payment_at' => ['type' => 'datetime', 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('contragent_id', 'contragents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('currency_id', 'currencies', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payments', true);
    }

    public function down()
    {
        if ($this->db->DBDriver != 'SQLite3')
        {
            $this->forge->dropForeignKey('contragents_conditions', 'contragents_conditions_contragent_id_foreign');
            $this->forge->dropForeignKey('payments', 'payments_contragent_id_foreign');
            $this->forge->dropForeignKey('payments', 'payments_currency_id_foreign');
        }
        $this->forge->dropTable('currencies', true);
        $this->forge->dropTable('contragents', true);
        $this->forge->dropTable('contragents_conditions', true);
        $this->forge->dropTable('payments', true);
    }
}
