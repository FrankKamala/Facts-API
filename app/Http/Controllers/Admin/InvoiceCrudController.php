<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InvoiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class InvoiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InvoiceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Invoice');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/invoice');
        $this->crud->setEntityNameStrings('invoice', 'invoices');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addColumn([
            'name' => 'supplier_id',
            'type' => 'select',
            'label' => 'Supplier',
            'entity' => 'supplier',
            'attribute' => 'name',
            'model' => "App\Models\User"
        ]);

        $this->crud->addColumn([
            'name' => 'buyer_id',
            'type' => 'select',
            'label' => 'Buyer',
            'entity' => 'buyer',
            'attribute' => 'name',
            'model' => "App\Models\User"
        ]);

        $this->crud->addColumn([
            'name' => 'invoice_status',
            'type' => 'select',
            'label' => 'Invoice Status',
            'entity' => 'status',
            'attribute' => 'status',
            'model' => "App\Models\Invoice"
        ]);

        $this->crud->addColumn([
            'name' => 'due_date',
            'type' => 'date',
            'label' => 'Due Date',
        ]);

        $this->crud->addColumn([
            'name' => 'invoice_amount',
            'type' => 'number',
            'label' => 'Invoice Amount'
        ]);

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(InvoiceRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addField([
            'name' => 'supplier_id',
            'type' => 'select',
            'label' => 'Supplier',
            'entity' => 'supplier',
            'attribute' => 'name',
            'model' => "App\Models\User"
        ]);

        $this->crud->addField([
            'name' => 'buyer_id',
            'type' => 'select',
            'label' => 'Buyer',
            'entity' => 'buyer',
            'attribute' => 'name',
            'model' => "App\Models\User"
        ]);

        $this->crud->addField([
            'name' => 'invoice_status',
            'type' => 'select',
            'label' => 'Invoice Status',
            'entity' => 'status',
            'attribute' => 'status',
            'model' => "App\Models\InvoiceStatus"
        ]);

        
        $this->crud->addField([
            'name' => 'due_date',
            'type' => 'date_picker',
            'label' => 'Due Date',
        ]);

        $this->crud->addField([
            'name' => 'invoice_amount',
            'type' => 'number',
            'label' => 'Invoice Amount'
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
