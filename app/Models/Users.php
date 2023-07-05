<?php

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel;

class Users extends UserModel {

    protected function initialize(): void {

        parent::initialize();
        // Merge properties with parent
        $this->allowedFields = array_merge($this->allowedFields, [
            'full_name', 'phone', 'timezone_name', 'icon_url', 'language', 'pipedrive_id',
        ]);
    }
}
