<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<!-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li> -->

<li class="nav-item"><a class="nav-link" href='{{ backpack_url('user') }}'><i class="nav-icon fa fa-user"></i>Users</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('invoice') }}'><i class='nav-icon fa fa-copy'></i>Invoices</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('transaction') }}'><i class='nav-icon fa fa-money'></i>Transactions</a></li>

<li class="nav-item nav-dropdown">
  <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-cog"></i>Settings</a>
  <ul class="nav-dropdown-items">
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('invoicestatus') }}'><i class='nav-icon fa fa-bell'></i>Invoice Statuses</a></li>
    <li class="nav-item"><a class="nav-link" href='{{ backpack_url('role') }}''><i class="nav-icon fa fa-group"></i>User Roles</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('transactiontype') }}'><i class='nav-icon fa fa-money'></i>Transaction Types</a></li>
  </ul>
</li>