<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
    'id'          => ['type'=>'INT', 'auto_increment'=>true],
    'election_id' => ['type'=>'INT'],
    'name'        => ['type'=>'VARCHAR', 'constraint'=>255],
    'bio'         => ['type'=>'TEXT'],
    'photo'       => ['type'=>'VARCHAR', 'constraint'=>255, 'null'=>true],
    'votes'       => ['type'=>'INT', 'default'=>0],
    'created_at'  => ['type'=>'DATETIME', 'null'=>true],
    'updated_at'  => ['type'=>'DATETIME', 'null'=>true],
]);
$this->forge->addKey('id', true);
$this->forge->createTable('candidates');

    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
