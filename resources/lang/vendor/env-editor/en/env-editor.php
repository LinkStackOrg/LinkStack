<?php

return [
    'menuTitle'          => '.env Editor',
    'controllerMessages' => [
        'backupWasCreated'                       => 'A new backup was created',
        'fileWasRestored'                        => 'The backup file ":name", was restored as default .env',
        'fileWasDeleted'                         => 'The backup file ":name", was deleted',
        'currentEnvWasReplacedByTheUploadedFile' => 'File was uploaded and become the new .env file',
        'uploadedFileSavedAsBackup'              => 'File was uploaded as backup with the name ":name"',
        'keyWasAdded'                            => 'Key ":name" was added',
        'keyWasEdited'                           => 'Key ":name" has ben updated',
        'keyWasDeleted'                          => 'Key ":name" was Deleted',
    ],
    'views' => [
        'tabTitles' => [
            'upload'     => 'Upload',
            'backup'     => 'Backups',
            'currentEnv' => 'Current .env',
        ],
        'currentEnv' => [
            'title'       => 'Current .env file Content',
            'tableTitles' => [
                'key'     => 'Key',
                'value'   => 'Value',
                'actions' => 'Actions',
            ],
            'btn' => [
                'edit'                    => 'Edit File',
                'delete'                  => 'Delete Key',
                'addAfterKey'             => 'Add new key after this key',
                'addNewKey'               => 'Add New key',
                'deleteConfigCache'       => 'Clear config cache',
                'deleteConfigCacheDesc'   => 'On production environments changed values may not applied immediately cause of cached config. So you may try to un-cache it',
            ],
            'modal' => [
                'title' => [
                    'new'    => 'New Key',
                    'edit'   => 'Edit Key',
                    'delete' => 'Delete Key',
                ],
                'input' => [
                    'key'   => 'Key',
                    'value' => 'Value',
                ],
                'btn' => [
                    'close'  => 'Close',
                    'new'    => 'Add Key',
                    'edit'   => 'Update Key',
                    'delete' => 'Delete Key',
                ],
            ],

        ],
        'upload' => [
            'title'            => 'Here You can upload a new ".env" file as a backup or to replace the current ".env"',
            'selectFilePrompt' => 'Select File',
            'btn'              => [
                'clearFile'        => 'Cancel',
                'uploadAsBackup'   => 'Upload as backup',
                'uploadAndReplace' => 'Upload and replace current .env',
            ],
        ],
        'backup' => [
            'title'       => 'Here you can see a list of saved backup files (if you have), you can create a new one, or download the .env file',
            'tableTitles' => [
                'filename'   => 'File Name',
                'created_at' => 'Creation Date',
                'actions'    => 'Actions',
            ],
            'noBackUpItems' => 'There are no backups on your chosen directory. <br> You can make your first backup by pressing the "Get a new BackUp" button',
            'btn'           => [
                'backUpCurrentEnv'   => 'Get a new BackUp',
                'downloadCurrentEnv' => 'Download current .env',
                'download'           => 'Download File',
                'delete'             => 'Delete File',
                'restore'            => 'Restore File',
                'viewContent'        => 'View file Contents',
            ],
        ],
    ],
    'exceptions' => [
        'fileNotExists'    => 'File ":name" does not Exists !!!',
        'keyAlreadyExists' => 'Key ":name" already Exists !!!',
        'keyNotExists'     => 'Key ":name" does not Exists !!!',
        'provideFileName'  => 'You have to provide a FileName !!!',
    ],

];
