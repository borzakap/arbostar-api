<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToStages extends Migration
{
    public function up()
    {
        $fields = [
            'stage_id' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true,
                'null' => true,
                'after' => 'order_nr',
            ],
        ];
        $this->forge->addColumn('stages', $fields);
    }

    public function down()
    {
        $fields = [
            'stage_id',
        ];

        $this->forge->dropColumn('stages', $fields);
    }
}
