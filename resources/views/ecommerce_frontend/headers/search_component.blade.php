{{-- @if (Request::segment(1) != '')
    {!! Form::open(['route' => 'inCategoriesSearch', 'method' => 'GET', 'id' => 'search-categories-form', 'class' => 'navbar-left navbar-form navbar-search cus-form', 'role' => 'search', 'style' => 'width:100% !important;']) !!}

    <div class="form-group">
        {!! Form::text('search', null, ['class' => 'form-control availableProducts', 'automplete' => 'true', 'id' => 'searchPhrase', 'placeholder' => trans('theme.main_searchbox_placeholder')]) !!}
    </div>
    <a class="fa fa-search navbar-search-submit"
        onclick="document.getElementById('search-categories-form').submit()"></a>
    {!! Form::close() !!}
@endif --}}
@if (Request::segment(1) != '')
{{-- <div> --}}
<form action="{{route('inCategoriesSearch')}}" class="me-3" method="GET" id="search-categories-form" role="search" style="width:100%">
<div class="input-group me-4" style="width:100%">
    <input id="searchPhrase" type="text" class="form-control availableProducts" name="search" placeholder="Search..." autocomplete="true">
    <span class="input-group-icon-right navbar-search-submit"  onclick="document.getElementById('search-categories-form').submit()">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" style=" fill:#353535;" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
        </svg>
    </span>
</div>
</form>
{{-- </div> --}}
@endif

<script>
    $(function () {
        var availableProducts = @json($search_product_list);
        
        $(".availableProducts").autocomplete({
            source: availableProducts,
            select: function(event,ui) {
                $('#searchPhrase').val(ui.item.value)
                // alert(ui.item.value);
                document.getElementById('search-categories-form').submit()
            }
        });

        // $('#search-category-select').on('change', loadProducts);

        loadProducts();

        function loadProducts() {
            var selected_country = '{{session('selected_country')}}';
            $.ajax({
                    url: `api/searchableList/${selected_country}`,
                    type: "get",
                })
                .done(function (result) {
                    $(".availableProducts").autocomplete({
                        source: result,
                        select: function(event,ui) {
                            $('#searchPhrase').val(ui.item.value)
                            document.getElementById('search-categories-form').submit()
                        }
                    });
                })
        }

        
    });
</script>
