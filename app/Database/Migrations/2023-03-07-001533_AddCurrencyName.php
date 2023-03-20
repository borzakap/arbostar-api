<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCurrencyName extends Migration
{
    public function up(): void
    {
        $fields = [
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '1000',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('currencies', $fields);
    }

    public function down()
    {
        $fields = [
            'name',
        ];

        $this->forge->dropColumn('currencies', $fields);
    }
}
