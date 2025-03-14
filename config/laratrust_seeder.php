<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'project_manager' => [
            'projects' => 'c,r,u,',
            'tasks' => 'c,r,u',
            'profile' => 'r,u',
        ],
        'team_member' => [
            'tasks' => 'c,r,u',
            'profile' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
