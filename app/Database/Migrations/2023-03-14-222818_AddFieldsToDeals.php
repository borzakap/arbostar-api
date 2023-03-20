<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToDeals extends Migration
{
    public function up() : void
    {
        $fields = [
            'stage_id' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true,
                'null' => true,
                'after' => 'status',
            ],
            'stage_order_nr' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true,
                'null' => true,
                'after' => 'stage_id',
            ],
            'stage_change_time' => [
                'type' => 'datetime',
                'null' => true,
                'after' => 'stage_order_nr',
            ],
        ];
        $this->forge->addColumn('deals', $fields);
    }

    public function down()
    {
        $fields = [
            'stage_id', 'stage_order_nr', 'stage_change_time',
        ];

        $this->forge->dropColumn('deals', $fields);
    }
}
