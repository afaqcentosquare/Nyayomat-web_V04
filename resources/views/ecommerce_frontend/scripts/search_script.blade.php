<script>
    $(function() {
        var availableProducts = @json($search_product_list);

        $(".availableProducts").autocomplete({
            source: availableProducts,
            select: function(event, ui) {
                $('#searchPhrase').val(ui.item.value)
                // alert(ui.item.value);
                document.getElementById('search-categories-form').submit()
            }
        });

        // $('#search-category-select').on('change', loadProducts);

        loadProducts();

        function loadProducts() {
            var selected_country = '{{ session('selected_country') }}';
            $.ajax({
                    url: `api/searchableList/${selected_country}`,
                    type: "get",
                })
                .done(function(result) {
                    $(".availableProducts").autocomplete({
                        source: result,
                        select: function(event, ui) {
                            $('#searchPhrase').val(ui.item.value)
                            document.getElementById('search-categories-form').submit()
                        }
                    });
                })
        }


    });
</script>