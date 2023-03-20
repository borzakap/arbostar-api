<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Statistic extends Migration
{
    public function up()
    {
        // deals
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'referral' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'utm_source' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'utm_medium' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'utm_campaign' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'utm_content' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'utm_term' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'contragent_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'status' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'added_at' => ['type' => 'datetime', 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('contragent_id', 'contragents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('deals', true);
        
        // stages
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'deal_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'order_nr' => ['type' => 'int', 'constraint' => 11, 'null' => false],
            'name' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'stage_change_time' => ['type' => 'datetime', 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('deal_id', 'deals', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('stages', true);
        
    }

    public function down()
    {
        if ($this->db->DBDriver != 'SQLite3')
        {
            $this->forge->dropForeignKey('deals', 'deals_contragent_id_foreign');
            $this->forge->dropForeignKey('stages', 'stages_deal_id_foreign');
        }
        $this->forge->dropTable('deals', true);
        $this->forge->dropTable('stages', true);
    }
}
