<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TransactionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TransactionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TransactionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Transaction');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/transaction');
        $this->crud->setEntityNameStrings('transaction', 'transactions');

        $this->crud->addFilter([
            'name' => 'transaction_amount',
            'type' => 'range',
            'label'=> 'Transaction Amount',
            'label_from' => 'min amount',
            'label_to' => 'max amount'
          ],
          false,
          function($value) {
                      $range = json_decode($value);
                      if ($range->from) {
                          $this->crud->addClause('where', 'transaction_amount', '>=', (float) $range->from);
                      }
                      if ($range->to) {
                          $this->crud->addClause('where', 'transaction_amount', '<=', (float) $range->to);
                      }
          });
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addColumn([
            'name' => 'transaction_type',
            'type' => 'select',
            'label' => 'Transaction Type',
            'entity' => 'types',
            'attribute' => 'type',
            'model' => 'App\Models\TransactionType'
        ]);

        $this->crud->addColumn([
            'name' => 'account_id',
            'type' => 'select',
            'label' => 'Account Name',
            'entity' => 'accounts',
            'attribute' => 'account_name',
            'model' => 'App\Models\Account'
        ]);

        $this->crud->addColumn([
            'name' => 'invoice_id',
            'type' => 'number',
            'label' => 'Invoice Number',
        ]);

        $this->crud->addColumn([
            'name' => 'transaction_amount',
            'type' => 'number',
            'label' => 'Transaction Amount',
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TransactionRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
        $this->crud->addField([
            'name' => 'transaction_type',
            'type' => 'select',
            'label' => 'Transaction Type',
            'entity' => 'types',
            'attribute' => 'type',
            'model' => 'App\Models\TransactionType'
        ]);

        $this->crud->addField([
            'name' => 'account_id',
            'type' => 'select',
            'label' => 'Account Name',
            'entity' => 'accounts',
            'attribute' => 'account_name',
            'model' => 'App\Models\Account'
        ]);

        $this->crud->addField([
            'name' => 'invoice_id',
            'type' => 'select',
            'label' => 'Invoice Number',
            'entity' => 'invoices',
            'attribute' => 'id',
            'model' => 'App\Models\Invoice'
        ]);

        $this->crud->addField([
            'name' => 'transaction_amount',
            'type' => 'number',
            'label' => 'Transaction Amount',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
