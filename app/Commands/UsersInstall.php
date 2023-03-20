<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class UsersInstall extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Users';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'users:create';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Create user in CLI';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'users:create [username] [email] [password]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [
        'username' => "username",
        'email' => "email",
        'password' => "password",
    ];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params) {

        $row = [];
        
        $row['username'] = array_shift($params);
        if (empty($row['username'])) {
            $row['username'] = CLI::prompt('Username', null, 'required');
        }

        $row['email'] = array_shift($params);
        if (empty($row['email'])) {
            $row['email'] = CLI::prompt('Email', null, 'required');
        }

        $row['password'] = array_shift($params);
        if (empty($row['password'])) {
            $row['password'] = CLI::prompt('Password', null, 'required');
        }
        
        $users = model(UserModel::class);
        
        $user = new User([
            'username' => $row['username'],
        ]);
        
        $users->save($user);

        $user = $users->findById($users->getInsertID());

        $user->createEmailIdentity($row);

        $user->addGroup('superadmin');
        
        CLI::write(lang('Auth.registerCLI', [$row['username']]), 'green');
    }

}
