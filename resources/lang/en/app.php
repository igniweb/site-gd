<?php

return [

    'javascript' => [
        'datatables' => [
            // https://github.com/DataTables/Plugins/tree/master/i18n
            'sProcessing'     => 'Traitement en cours...',
            'sSearch'         => 'Rechercher&nbsp;:',
            'sLengthMenu'     => 'Nombre d\'&eacute;l&eacute;ments:_MENU_',
            'sInfo'           => 'Affichage de l\'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments',
            'sInfoEmpty'      => 'Affichage de l\'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments',
            'sInfoFiltered'   => '(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)',
            'sInfoPostFix'    => '',
            'sLoadingRecords' => 'Chargement en cours...',
            'sZeroRecords'    => 'Aucun &eacute;l&eacute;ment &agrave; afficher',
            'sEmptyTable'     => 'Aucune donn&eacute;e disponible dans le tableau',
            'oPaginate'       => [
                'sFirst'    => 'Premier',
                'sPrevious' => 'Pr&eacute;c&eacute;dent',
                'sNext'     => 'Suivant',
                'sLast'     => 'Dernier',
            ],
            'oAria'           => [
                'sSortAscending'  => ': activer pour trier la colonne par ordre croissant',
                'sSortDescending' => ': activer pour trier la colonne par ordre d&eacute;croissant',
            ],
        ],
        'form_validation' => [
            'empty' => 'Champ obligatoire',
            'email' => 'Adresse e-mail non valide',
            'match' => 'Ce champ doit correspondre au champ {attribute}',
        ],
    ],

    'search' => [
        'user' => 'Utilisateurs',
    ],

    'roles' => [
        'super_admin' => 'Super-Administrateur',
        'admin'       => 'Administrateur',
        'user'        => 'Utilisateur',
    ],

    'user' => [
        'id'               => 'ID',
        'role'             => 'Rôle',
        'email'            => 'E-mail',
        'first_name'       => 'Prénom',
        'last_name'        => 'Nom',
        'password'         => 'Mot de passe',
        'password_confirm' => 'Confirmation du mot de passe',
    ],

];
