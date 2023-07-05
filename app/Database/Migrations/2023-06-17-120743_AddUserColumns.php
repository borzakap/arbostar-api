<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserColumns extends Migration {

    public function up(): void {

        $fields = [
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'timezone_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'icon_url' => [
                'type' => 'VARCHAR',
                'constraint' => '1000',
                'null' => true,
            ],
            'language' => [
                'type' => 'VARCHAR',
                'constraint' => '2',
                'null' => true,
            ],
            'pipedrive_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down() {
        $fields = [
            'full_name', 'phone', 'timezone_name', 'icon_url', 'language', 'pipedrive_id',
        ];

        $this->forge->dropColumn('users', $fields);
    }
}
