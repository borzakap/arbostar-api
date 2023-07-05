<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Invices extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'billing_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'summ' => ['type' => 'decimal', 'constraint' => '10,2', 'null' => false],
            'driver' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'method' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'slug' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'payment_log' => ['type' => 'text', 'null' => true],
            'payment_at' => ['type' => 'datetime', 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('billing_id', 'billings', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('invoices', true);
    }

    public function down()
    {
        if ($this->db->DBDriver != 'SQLite3') {
            $this->forge->dropForeignKey('invoices', 'invoices_billing_id_foreign');
        }
        $this->forge->dropTable('invoices', true);
    }
}
