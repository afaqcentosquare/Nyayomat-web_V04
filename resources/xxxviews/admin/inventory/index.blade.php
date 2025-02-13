@extends('admin.layouts.master')

@section('content')
	@can('create', App\Inventory::class)
		@include('admin.inventory._add')
	@endcan

	<div class="box">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs nav-justified">
				<li class="{{ Request::has('tab') ? '' : 'active' }}"><a href="#active_inventory_tab" data-toggle="tab">
					<i class="fa fa-superpowers hidden-sm"></i>
					{{ trans('app.active_stocks') }}
				</a></li>
				<!--<li class="{{ Request::input('tab') == 'inactive_listings' ? 'active' : '' }}"><a href="#inactive_listings_tab" data-toggle="tab">-->
				<!--	<i class="fa fa-bell-o hidden-sm"></i>-->
				<!--	{{ trans('app.inactive_stocks') }}-->
				<!--</a></li>-->
				<!--<li class="{{ Request::input('tab') == 'out_of_stock' ? 'active' : '' }}"><a href="#stock_out_tab" data-toggle="tab">-->
				<!--	<i class="fa fa-bullhorn hidden-sm"></i>-->
				<!--	{{ trans('app.out_of_stock') }}-->
				<!--</a></li>-->
			</ul>
			<div class="tab-content">
			    <div class="tab-pane {{ Request::has('tab') ? '' : 'active' }}" id="active_inventory_tab">
					<table class="table table-hover table-2nd-short">
						<thead>
							<tr>
								<th>Product Image</th>
								<th>Product Name</th>
								<th>Product Category</th>
								<th>Sub category</th>
								<th>Product Code</th>
								<th>Condition</th>
								<th>Price <small>( unit )</small> </th>
								<!--<th>Quantity Available</th>-->
								<th>Stock</th>
								<th>{{ trans('app.option') }}</th>
							</tr>
						</thead>
						<tbody>
						    
							@foreach($inventories->where('active', 1) as $inventory )
							@php $pro = DB::table('products')->where("id",$inventory->product_id)->get(); @endphp
							@php 
							    $cat = DB::table('category_product')->where("product_id",$inventory->product_id)->get();
							    foreach($cat as $c1) { 
							        $cat_name = DB::table('categories')->where("id",$c1->category_id)->get();
			                        if(count($cat_name)>0)		        
							            $cname[] = array($cat_name[0]->name);
							        $cname = [];
							        
							    }
							    
							    
							
							@endphp
								<tr class="{{ $inventory->isLowQtt() ? 'danger' : '' }}">
									<td>
									  	@if($inventory->image)
											<img src="{{ get_storage_file_url($inventory->image->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
										@else
											<img src="{{ get_storage_file_url(optional($inventory->product->image)->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
										@endif
									</td>
									<td>
										@if(isset($pro[0]))
										{{ $pro[0]->name }}
										@else
											""
										@endif
									</td>
									<td>
									    <ul>
									    @php 
									        if(count($cname)>0){
									            foreach($cname as $cn) { 
									        
									    @endphp
									       <li>{{ $cn[0] }}</li>
									    @php }} @endphp
									    </ul>
									</td>
									<td>
									    <ul>
									    @php 
									        
									        foreach($cname as $cn) { 
									        $cat_name = DB::table('categories')->where("name",$cn[0])->get();
									        $cat_sub = DB::table('category_sub_groups')->where("id",$cat_name[0]->category_sub_group_id)->get();
									    @endphp
									       <li>{{ $cat_sub[0]->name }}</li>
									    @php } @endphp
									    </ul>
									</td>
									<td>
										@if(isset($pro[0]))
											{{ $pro[0]->model_number }}
										@else
											""
										@endif
										
									</td>
									<td>{{ $inventory->condition }}</td>
									<td>
										@if(($inventory->offer_price > 0) && ($inventory->offer_end > \Carbon\Carbon::now()))
											@php
												$offer_price_help =
													trans('help.offer_starting_time') . ': ' .
													$inventory->offer_start->diffForHumans() . ' ' . trans('app.and') . ' ' .
													trans('help.offer_ending_time') . ': ' .
													$inventory->offer_end->diffForHumans();
											@endphp

											<small class="text-muted">{{ $inventory->sale_price }}</small><br/>
											{{ round($inventory->offer_price) }} KSh

											<small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ $offer_price_help }}"><sup><i class="fa fa-question"></i></sup></small>
										@else
											{{ round($inventory->sale_price) }} KSh
										@endif
									</td>
									<td>
										@if(Gate::allows('update', $inventory))
											<a href="#" data-link="{{ route('admin.stock.inventory.editQtt', $inventory->id) }}" class="ajax-modal-btn qtt-{{$inventory->id}}" data-toggle="tooltip" data-placement="top" title="{{ trans('app.update') }}">
												{{ ($inventory->stock_quantity > 0) ? $inventory->stock_quantity : trans('app.out_of_stock') }}
											</a>
										@else
											{{ ($inventory->stock_quantity > 0) ? $inventory->stock_quantity : trans('app.out_of_stock') }}
										@endif
									</td>
									<td class="row-options">
										@can('view', $inventory)
											<a href="#" data-link="{{ route('admin.stock.inventory.show', $inventory->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.detail') }}" class="fa fa-expand"></i></a>&nbsp;
										@endcan

										@can('update', $inventory)
											<a href="{{ route('admin.stock.inventory.edit', $inventory->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
										@endcan

										@can('delete', $inventory)
											{!! Form::open(['route' => ['admin.stock.inventory.trash', $inventory->id], 'method' => 'delete', 'class' => 'data-form']) !!}
												{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
											{!! Form::close() !!}
										@endcan
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			    <div class="tab-pane {{ Request::input('tab') == 'inactive_listings' ? 'active' : '' }}" id="inactive_listings_tab">
					<table class="table table-hover table-2nd-short">
						<thead>
							<tr>
								<th>{{ trans('app.image') }}</th>
								<th>{{ trans('app.sku') }}</th>
								<th>{{ trans('app.title') }}</th>
								<th>{{ trans('app.condition') }}</th>
								<th>{{ trans('app.price') }} <small>( {{ trans('app.excl_tax') }} )</small> </th>
								<th>{{ trans('app.quantity') }}</th>
								<th>{{ trans('app.option') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($inventories->where('active', 0) as $inventory )
								<tr class="{{ $inventory->isLowQtt() ? 'danger' : '' }}">
									<td>
									  	@if($inventory->image)
											<img src="{{ get_storage_file_url($inventory->image->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
										@else
											<img src="{{ get_storage_file_url(optional($inventory->product->image)->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
										@endif
									</td>
									<td>{{ $inventory->sku }}</td>
									<td>{{ $inventory->title }}</td>
									<td>{{ $inventory->condition }}</td>
									<td>
										@if(($inventory->offer_price > 0) && ($inventory->offer_end > \Carbon\Carbon::now()))
											<?php $offer_price_help =
													trans('help.offer_starting_time') . ': ' .
													$inventory->offer_start->diffForHumans() . ' and ' .
													trans('help.offer_ending_time') . ': ' .
													$inventory->offer_end->diffForHumans(); ?>

											<small class="text-muted">{{ $inventory->sale_price }}</small><br/>
											{{ get_formated_currency($inventory->offer_price) }}

											<small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ $offer_price_help }}"><sup><i class="fa fa-question"></i></sup></small>
										@else
											{{ get_formated_currency($inventory->sale_price) }}
										@endif
									</td>
									<td>{{ ($inventory->stock_quantity > 0) ? $inventory->stock_quantity : trans('app.out_of_stock') }}</td>
									<td class="row-options">
										@can('view', $inventory)
											<a href="#" data-link="{{ route('admin.stock.inventory.show', $inventory->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.detail') }}" class="fa fa-expand"></i></a>&nbsp;
										@endcan

										@can('update', $inventory)
											<a href="{{ route('admin.stock.inventory.edit', $inventory->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
										@endcan

										@can('delete', $inventory)
											{!! Form::open(['route' => ['admin.stock.inventory.trash', $inventory->id], 'method' => 'delete', 'class' => 'data-form']) !!}
												{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
											{!! Form::close() !!}
										@endcan
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			    <div class="tab-pane {{ Request::input('tab') == 'out_of_stock' ? 'active' : '' }}" id="stock_out_tab">
					<table class="table table-hover table-2nd-short">
						<thead>
							<tr>
								<th>{{ trans('app.image') }}</th>
								<th>{{ trans('app.sku') }}</th>
								<th>{{ trans('app.title') }}</th>
								<th>{{ trans('app.condition') }}</th>
								<th>{{ trans('app.price') }} <small>( {{ trans('app.excl_tax') }} )</small> </th>
								<th>{{ trans('app.quantity') }}</th>
								<th>{{ trans('app.option') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($inventories->where('stock_quantity', '<=', 0) as $inventory )
								<tr>
									<td>
									  	@if($inventory->image)
											<img src="{{ get_storage_file_url($inventory->image->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
										@else
											<img src="{{ get_storage_file_url(optional($inventory->product->image)->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
										@endif
									</td>
									<td>{{ $inventory->sku }}</td>
									<td>{{ $inventory->title }}</td>
									<td>{{ $inventory->condition }}</td>
									<td>
										@if(($inventory->offer_price > 0) && ($inventory->offer_end > \Carbon\Carbon::now()))
											<?php $offer_price_help =
													trans('help.offer_starting_time') . ': ' .
													$inventory->offer_start->diffForHumans() . ' and ' .
													trans('help.offer_ending_time') . ': ' .
													$inventory->offer_end->diffForHumans(); ?>

											<small class="text-muted">{{ $inventory->sale_price }}</small><br/>
											{{ get_formated_currency($inventory->offer_price) }}

											<small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ $offer_price_help }}"><sup><i class="fa fa-question"></i></sup></small>
										@else
											{{ get_formated_currency($inventory->sale_price) }}
										@endif
									</td>
									<td>
										@if(Gate::allows('update', $inventory))
											<a href="#" data-link="{{ route('admin.stock.inventory.editQtt', $inventory->id) }}" class="ajax-modal-btn qtt-{{$inventory->id}}" data-toggle="tooltip" data-placement="top" title="{{ trans('app.update') }}">
												{{ ($inventory->stock_quantity > 0) ? $inventory->stock_quantity : trans('app.out_of_stock') }}
											</a>
										@else
											{{ ($inventory->stock_quantity > 0) ? $inventory->stock_quantity : trans('app.out_of_stock') }}
										@endif
									</td>
									<td class="row-options">
										@can('view', $inventory)
											<a href="#" data-link="{{ route('admin.stock.inventory.show', $inventory->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.detail') }}" class="fa fa-expand"></i></a>&nbsp;
										@endcan

										@can('update', $inventory)
											<a href="{{ route('admin.stock.inventory.edit', $inventory->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
										@endcan

										@can('delete', $inventory)
											{!! Form::open(['route' => ['admin.stock.inventory.trash', $inventory->id], 'method' => 'delete', 'class' => 'data-form']) !!}
												{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
											{!! Form::close() !!}
										@endcan
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->

	<div class="box collapsed-box">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-trash-o"></i>{{ trans('app.trash') }}</h3>
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
						<th>{{ trans('app.sku') }}</th>
						<th>{{ trans('app.title') }}</th>
						<th>{{ trans('app.condition') }}</th>
						<th>{{ trans('app.price') }}</th>
						<th>{{ trans('app.quantity') }}</th>
						<th>{{ trans('app.deleted_at') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($trashes as $trash )
					<tr>
						<td>
						  	@if($trash->image)
								<img src="{{ get_storage_file_url($trash->image->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
							@else
								<img src="{{ get_storage_file_url(optional($trash->product->image)->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
							@endif
						</td>
						<td>{{ $trash->sku }}</td>
						<td>{{ $trash->title }}</td>
						<td>{{ $trash->condition }}</td>
						<td>{{ round($trash->sale_price) }} KSh</td> 
						<td>{{ $trash->stock_quantity }}</td>
						<td>{{ $trash->deleted_at->diffForHumans() }}</td>
						<td class="row-options">
							@can('delete', $trash)
								<a href="{{ route('admin.stock.inventory.restore', $trash->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>&nbsp;

								{!! Form::open(['route' => ['admin.stock.inventory.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']) !!}
									{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.delete_permanently'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
								{!! Form::close() !!}
							@endcan
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection