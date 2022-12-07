<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CallsRecordsLog extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'call_sid' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'action_id' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['call_sid','action_id']);
        $this->forge->createTable('calls_records_log', true);
    }

    public function down()
    {
        $this->forge->dropTable('calls_records_log', true);
    }
}
