<?php

return array(
    'label' => array(
        'number' => 'Invoice#',
        'date' => 'Date',
        'due_date' => 'Due Date',

    ),
    'placeholder' => array(
        'number' => 'Invoice number',

    ),
    'general' => array(
        'title' => 'Invoices Management',
        'create' => 'Create a New Invoice',
        'edit' => 'Edit',
        'new' => 'New Invoice',
        'deleted' => 'Inactive Invoices',
        'current' => 'Active Invoices',
        'show_curent' => 'Show Active Invoices',
        'show_deleted' => 'Show Inactive Invoices',
    ),
    'table' => array(
        'number' => 'Invoice Number',
        'biller' => 'Biller',
        'client' => 'Client',
        'last_login' => 'Last Login',
        'activated' => 'Active',
        'created_at' => 'Created',
        'noresults' => 'There are no results that match your query.',
    ),
    'help' => array(
        'logo' => 'Supported: JPEG, GIF and PNG. Recommended size: 240px width by 120px height',
    ),
    'message' => array(
        'warning' => array(
            'delete' => 'Are you sure you wish to delete this invoice?',
        ),
        'success' => array(
            'create' => 'Invoice was successfully created.',
            'update' => 'Invoice was successfully updated.',
            'delete' => 'Invoice was successfully deleted.',
            'restored' => 'Invoice was successfully restored.'
        ),
        'error' => array(
            'create' => 'There was an issue creating the invoice. Please try again.',
            'update' => 'There was an issue updating the invoice. Please try again.',
            'delete' => 'There was an issue deleting the invoice. Please try again.',
        )
    )
);
