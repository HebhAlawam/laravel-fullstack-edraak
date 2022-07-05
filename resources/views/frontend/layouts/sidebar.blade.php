<div class="col-md-2">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="p-2 m-0 font-weight-bold text-primary">Controller List</h6>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills">
                <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action 
                {{str_contains(Request::url(), 'admin/category') ? 'active' : ''}}
                 ">Category</a>
                <a href="{{ route('subCategory.index') }}" class="list-group-item list-group-item-action
                {{str_contains(Request::url(), 'admin/subCategory') ? 'active' : ''}}
                ">SubCategory</a>
                <a href="{{ route('product.index') }}" class="list-group-item list-group-item-action
                {{str_contains(Request::url(), 'admin/product') ? 'active' : ''}}
                ">Products</a>
                <a href="{{ route('order.index') }}" class="list-group-item list-group-item-action
                {{str_contains(Request::url(), 'admin/order') ? 'active' : ''}}
                ">Orders</a>
            </ul>
        </div>
    </div>
</div> 