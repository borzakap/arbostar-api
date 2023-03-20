<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsedCurrencies extends Migration
{
    public function up(): void
    {
        $fields = [
            'in_use' => [
                'type' => 'INT',
                'constraint' => 1,
            ],
        ];
        $this->forge->addColumn('currencies', $fields);
    }

    public function down(): void
    {
        $fields = [
            'in_use',
        ];

        $this->forge->dropColumn('currencies', $fields);
    }
}
