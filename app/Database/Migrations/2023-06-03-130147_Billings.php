<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Billings extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'client_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'currency_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'summ' => ['type' => 'decimal', 'constraint' => '10,2', 'null' => false],
            'status' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'period' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'date_start' => ['type' => 'datetime', 'null' => true],
            'date_end' => ['type' => 'datetime', 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('client_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('currency_id', 'currencies', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('billings', true);
    }

    public function down()
    {
        if ($this->db->DBDriver != 'SQLite3') {
            $this->forge->dropForeignKey('billings', 'billings_client_id_foreign');
            $this->forge->dropForeignKey('billings', 'billings_currency_id_foreign');
        }
        $this->forge->dropTable('billings', true);
    }
}
