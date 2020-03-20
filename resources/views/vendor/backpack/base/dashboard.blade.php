@extends(backpack_view('blank'))
@php
    $widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'heading'     => 'Supply Chain Finance Dashboard.',
        'content'     => 'Easily manage your suppliers, buyers and transactions happening across mobile and web platforms.',
        'button_link' => backpack_url('logout'),
        'button_text' => trans('backpack::base.logout'),
      ];


    $widgets['before_content'][] = [
        'type' => 'div',
        'class' => 'row',
        'content' => [
              [
        'type' => 'progress',
        'class' => 'card text-white bg-purple mb-2',
        'value' => App\User::where('role', 2)->count(),
        'description' => 'Registered Suppliers',
        'progress' => App\User::where('role', 2)->count(),
        'hint' => 'Significant growth'],
              [
        'type' => 'progress',
        'class' => 'card text-white bg-blue mb-2',
        'value' => App\User::where('role', 3)->count(),
        'description' => 'Registered Buyers',
        'progress' => App\User::where('role', 3)->count(),
        'hint' => 'Significant growth'],
              [
        'type' => 'progress',
        'class' => 'card text-white bg-danger mb-2',
        'value' => App\Models\Invoice::where('invoice_status', 1)->count(),
        'description' => 'Pending Invoices',
        'progress' => App\Models\Invoice::where('invoice_status', 1)->count(),
        'hint' => 'Significant growth'],
              [
        'type' => 'progress',
        'class' => 'card text-white bg-green mb-2',
        'value' => App\Models\Invoice::where('invoice_status', 2)->count(),
        'description' => 'Approved Invoices',
        'progress' => App\Models\Invoice::where('invoice_status', 2)->count(),
        'hint' => 'Significant growth'],
          ]
    ];
@endphp

@section('content')
@endsection