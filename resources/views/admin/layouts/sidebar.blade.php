<div class="col-md-2">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="p-2 m-0 font-weight-bold text-primary">Controller List</h6>
            </div>
        <div class="card-body">
            <ul class="nav nav-pills">
                <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action 
                {{str_contains(Request::url(), 'admin/category') ? 'active' : ''}}
                 "><i class="fa fa-table"></i> Category</a>
                <a href="{{ route('subCategory.index') }}" class="list-group-item list-group-item-action
                {{str_contains(Request::url(), 'admin/subCategory') ? 'active' : ''}}
                "><i class="fa fa-table"></i> SubCategory</a>
                <a href="{{ route('product.index') }}" class="list-group-item list-group-item-action
                {{str_contains(Request::url(), 'admin/product') ? 'active' : ''}}
                "><i class="fa fa-table"></i> Products</a>
                <a href="{{ route('order.index') }}" class="list-group-item list-group-item-action
                {{str_contains(Request::url(), 'admin/order') ? 'active' : ''}}
                "><i class="fa fa-table"></i> Orders</a>
                <a href="{{ route('all.user') }}" class="list-group-item list-group-item-action
                {{str_contains(Request::url(), 'admin/user') ? 'active' : ''}}
                "><i class="fa fa-users"></i> Users</a>


            </ul>
        </div>
    </div>
</div> 