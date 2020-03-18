<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AccountRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AccountCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AccountCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Account');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/account');
        $this->crud->setEntityNameStrings('account', 'accounts');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addColumn([
            'name' => 'user_id',
            'type' => 'select',
            'label' => 'User',
            'entity' => 'user',
            'attribute' => 'name',
            'model' => 'App\Models\User'
        ]);

        $this->crud->addColumn([
            'name' => 'account_name',
            'type' => 'text',
            'label' => 'Account Name',
        ]);

        $this->crud->addColumn([
            'name' => 'account_number',
            'type' => 'text',
            'label' => 'Account Number',
        ]);

        $this->crud->addColumn([
            'name' => 'date_opened',
            'type' => 'date',
            'label' => 'Date Opened',
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AccountRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
        $this->crud->addField([
            'name' => 'user_id',
            'type' => 'select',
            'label' => 'User',
            'entity' => 'user',
            'attribute' => 'name',
            'model' => 'App\Models\User'
        ]);

        $this->crud->addField([
            'name' => 'account_name',
            'type' => 'text',
            'label' => 'Account Name',
        ]);

        $this->crud->addField([
            'name' => 'account_number',
            'type' => 'text',
            'label' => 'Account Number',
        ]);

        $this->crud->addField([
            'name' => 'date_opened',
            'type' => 'date_picker',
            'label' => 'Date Opened',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
