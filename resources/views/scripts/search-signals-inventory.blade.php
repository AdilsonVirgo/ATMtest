<script>
    $(function() {
        var cardTitle = $('#card_title');
        var vsignalsTable = $('#inventory_table');
        var resultsContainer = $('#search_results');
        var vsignalsCount = $('#inventory_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_vsignal');
        var searchformInput = $('#vsignal_search_box');
        var vsignalPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html('Buscando. Espere por favor...');
            vsignalsTable.hide();
            clearSearchTrigger.show();
            let noResulsHtml = '<tr>' +
                                '<td>{!! trans("signalsinventory.search.no-results") !!}</td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "{{ route('search-signals-inventory') }}",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length != 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="signals-inventory/' + val.id + '" data-toggle="tooltip" title="{{ trans("signalsinventory.tooltips.show") }}">{!! trans("signalsinventory.buttons.show") !!}</a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="signals-inventory/' + val.id + '/edit" data-toggle="tooltip" title="{{ trans("signalsinventory.tooltips.edit") }}">{!! trans("signalsinventory.buttons.edit") !!}</a>';
                            let deleteCellHtml = '<form method="POST" action="/signals-inventory/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '{!! Form::hidden("_method", "DELETE") !!}' +
                                    '{!! csrf_field() !!}' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="{!! trans("signalsinventory.modals.delete_user_message", ["user" => "'+val.name+'"]) !!}">' +
                                        '{!! trans("signalsinventory.buttons.delete") !!}' +
                                    '</button>' +
                                '</form>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.code + '</td>' +
                                '<td>' + val.name + '</td>' +
                                '<td>' + val.group + '</td>' +
                                '<td>' + val.subgroup + '</td>' +
                                '<td>' + val.variations + '</td>' +
                                '<td>' + deleteCellHtml + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                '<td>' + editCellHtml + '</td>' +
                            '</tr>');
                        });
                    } else {
                        resultsContainer.append(noResulsHtml);
                    };
                    vsignalsCount.html(jsonData.length + " {!! trans('signalsinventory.search.found-footer') !!}");
                    vsignalPagination.hide();
                    cardTitle.html("{!! trans('signalsinventory.search.title') !!}");
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.append(noResulsHtml);
                        vsignalsCount.html(0 + " {!! trans('signalsinventory.search.found-footer') !!}");
                        vsignalPagination.hide();
                        cardTitle.html("{!! trans('signalsinventory.search.title') !!}");
                    };
                },
            });
        });

        searchSubmit.click(function(event) {
            event.preventDefault();
            searchform.submit();
        });

        searchformInput.keyup(function(event) {
            if ($('#vsignal_search_box').val() != '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                vsignalsTable.show();
                cardTitle.html("{!! trans('signalsinventory.showing-all-signals-inventories') !!}");
                vsignalPagination.show();
                vsignalsCount.html(" ");
            };
        });

        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            vsignalsTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("{!! trans('signalsinventory.showing-all-signals-inventories') !!}");
            vsignalPagination.show();
            vsignalsCount.html(" ");
        });
    });
</script>
