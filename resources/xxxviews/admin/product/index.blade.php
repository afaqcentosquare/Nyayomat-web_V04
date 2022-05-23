@extends('admin.layouts.master')

@section('content')
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">{{ trans('app.products') }}</h3>
		<div class="box-tools pull-right">
			@can('create', App\Product::class)
			<a href="#" data-link="{{ route('admin.catalog.product.bulk') }}" class="ajax-modal-btn btn btn-success btn-flat">{{ trans('app.bulk_import') }}</a>
			<a href="{{ route('admin.catalog.product.create') }}" class=" btn btn-success btn-flat">{{ trans('app.add_product') }}</a>
			@endcan
		</div>
	</div> <!-- /.box-header -->
	<div class="box-body">
		<!--<table class="table table-hover" id="all-product-table">-->
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Product Image</th>
					<th>Category Group</th>
					<th>Sub Category</th>
					<th>Product Code</th>
					<th>Condition</th>
					<th>Merchant</th>
					<!--<th>Stock Outs</th>-->
					<th>{{ trans('app.option') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)

				<tr>
					<td>{{$product->name}}</td>
					<td><img src="{{ get_storage_file_url(optional($product->image)->path, 'tiny') }}" class="img-circle" style="width:100px;height:100px;"></td>
					<td>

						@php

						$cats = DB::table('category_product')->where("product_id",$product->id)->get();
						$sub_grp_id = array();
						$groups = array();
						foreach($cats as $cat){

						$s_cats = DB::table('categories')->where("id",$cat->category_id)->get();
						if(!in_array($s_cats[0]->category_sub_group_id, $sub_grp_id)) {
						$sub_grp_id[] = $s_cats[0]->category_sub_group_id;
						$s_cats1 =
						DB::table('category_sub_groups')->where("id",$s_cats[0]->category_sub_group_id)->get();
						$s_cats2 = DB::table('category_groups')->where("id",$s_cats1[0]->category_group_id)->get();
						$groups[] = $s_cats2[0]->name;
						}

						}
						@endphp
						<ul>
							@foreach(array_unique($groups) as $grp)
							<li>{{$grp}}</li>
							@endforeach
						</ul>
					</td>

					<td>

						@php

						$cats = DB::table('category_product')->where("product_id",$product->id)->get();
						$sub_grp_id = array();
						$subgroups = array();
						foreach($cats as $cat){

						$s_cats = DB::table('categories')->where("id",$cat->category_id)->get();
						if(!in_array($s_cats[0]->category_sub_group_id, $sub_grp_id)) {
						$sub_grp_id[] = $s_cats[0]->category_sub_group_id;
						$s_cats1 =
						DB::table('category_sub_groups')->where("id",$s_cats[0]->category_sub_group_id)->get();
						$subgroups[] = $s_cats1[0]->name;
						}

						}
						@endphp
						<ul>
							@foreach(array_unique($subgroups) as $grp)
							<li>{{$grp}}</li>
							@endforeach
						</ul>
					</td>
					<td>{{$product->model_number}}</td>
					<td>
						@php
						$condition = DB::table('inventories')->where("product_id",$product->id)->get();
						if(count($condition)>0) {
						@endphp
						{{ $condition[0]->condition }}
						@php } @endphp
					</td>
					<td>
						@php
						$shop = DB::table('shops')->where("id", $product->shope)->first();
						$user = DB::table('users')->where("id",$shop->owner_id ?? auth()->user()->id)->first();
						@endphp
						{{ optional($user)->name ?? ''}}

					</td>
					<td class="row-options">
						@can('update', $product)
						<a href="{{ route('admin.catalog.product.edit', $product->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
						@endcan
						@can('delete', $product)
						{!! Form::open(['route' => ['admin.catalog.product.trash', $product->id], 'method' => 'delete',
						'class' => 'data-form']) !!}
						{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm
						ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' =>
						'top']) !!}
						{!! Form::close() !!}
						@endcan
					</td>
				</tr>

				@endforeach

			</tbody>
		</table>
	</div> <!-- /.box-body -->
</div> <!-- /.box -->

@if(Auth::user()->isFromPlatform())
<div class="box collapsed-box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-trash-o"></i> {{ trans('app.trash') }}</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
		</div>
	</div> <!-- /.box-header -->
	<div class="box-body">
		<table class="table table-hover table-2nd-short">
			<thead>
				<tr>
					<th>{{ trans('app.image') }}</th>
					<th>{{ trans('app.name') }}</th>
					<th>{{ trans('app.model_number') }}</th>
					<th>{{ trans('app.category') }}</th>
					<th>{{ trans('app.option') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($trashes as $trash )
				<tr>
					<td>
						<img src="{{ get_storage_file_url(optional($trash->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.image') }}">
					</td>
					<td>{{ $trash->name }}</td>
					<td>{{ $trash->model_number }}</td>
					<td>
						@foreach($trash->categories as $category)
						<span class="label label-outline">{{ $category->name }}</span>
						@endforeach
					</td>
					<td class="row-options">
						@can('delete', $trash)
						<a href="{{ route('admin.catalog.product.restore', $trash->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>&nbsp;

						{!! Form::open(['route' => ['admin.catalog.product.destroy', $trash->id], 'method' => 'delete',
						'class' => 'data-form']) !!}
						{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' =>
						'confirm ajax-silent', 'title' => trans('app.delete_permanently'), 'data-toggle' => 'tooltip',
						'data-placement' => 'top']) !!}
						{!! Form::close() !!}
						@endcan
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div> <!-- /.box-body -->
</div> <!-- /.box -->
@endif
@endsection