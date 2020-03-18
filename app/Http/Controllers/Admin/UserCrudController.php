<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('user', 'users');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setColumns(['name', 'email', 'role']);
        $this->crud->addFilter([
            'name' => 'role',
            'type' => 'dropdown',
            'label' => 'Role'
        ], [
            2 => 'Supplier',
            3 => 'Buyer'
        ], function($value) {
            $this->crud->addClause('where', 'role', $value);
        }
    );
    }

    protected function setupCreateOperation()
    {
        $this->addUserFields();
        $this->crud->request = $this->handlePasswordInput($this->crud->request);
        $this->crud->setValidation(UserRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function handlePasswordInput($request)
    {
        // Encrypt password if specified.
        if ($request->input('password')) {
            $request->request->set('password', Hash::make($request->input('password')));
        } else {
            $request->request->remove('password');
        }

        return $request;
    }

    protected function addUserFields()
    {
        $this->crud->addField([
            'name' => 'role',
            'type' => 'select',
            'label' => 'User Role',
            'entity' => 'roles',
            'attribute' => 'role',
            'model' => 'App\Models\Role'
        ]);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'User Name'
        ]);

        $this->crud->addField([
            'name' => 'email',
            'type' => 'email',
            'label' => 'Email'
        ]);

        $this->crud->addField([
            'name' => 'password',
            'type' => 'password',
            'label' => 'Password'
        ]);
    }
}
