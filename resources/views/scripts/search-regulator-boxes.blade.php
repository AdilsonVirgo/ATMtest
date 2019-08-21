<script>
    $(function() {
        var cardTitle = $('#card_title');
        var regulatorboxesTable = $('#regulator_boxes_table');
        var resultsContainer = $('#search_results');
        var regulatorboxesCount = $('#regulator_boxes_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_regulator_boxes');
        var searchformInput = $('#regulator_search_box');
        var regulatorboxesPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');

        let searching = '<i class="fa fa-spinner fa-spin"></i> Buscando reguladores de tráfico. Por favor espere...';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html(searching);
            regulatorboxesTable.hide();
            regulatorboxesPagination.hide();
            clearSearchTrigger.show();

            let noResulsHtml = '<tr>' +
                                '<td>{!! trans("traffic-tensors.search.no-results") !!}</td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "{{ route('search-regulator-boxes') }}",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length !== 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="regulator-boxes/' + val.id + '" data-toggle="tooltip" title="{{ trans("regulator-boxes.tooltips.show") }}">{!! trans("regulator-boxes.buttons.show") !!}</a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="regulator-boxes/' + val.id + '/edit" data-toggle="tooltip" title="{{ trans("regulator-boxes.tooltips.edit") }}">{!! trans("regulator-boxes.buttons.edit") !!}</a>';
                            let deleteCellHtml = '<form method="POST" action="/regulator-boxes/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '{!! Form::hidden("_method", "DELETE") !!}' +
                                    '{!! csrf_field() !!}' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="{!! trans("regulator-boxes.modals.delete_traffic_tensor_message", ["code" => "'+val.code+'"]) !!}">' +
                                        '{!! trans("regulator-boxes.buttons.delete") !!}' +
                                    '</button>' +
                                '</form>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.code + '</td>' +
                                '<td>' + val.erp_code + '</td>' +
                                '<td>' + val.brand + '</td>' +
                                '<td>' + val.state + '</td>' +
                                '<td class="hidden-xs">' + val.google_address + '</td>' +
                                '<td>' + deleteCellHtml + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                '<td>' + editCellHtml + '</td>' +
                            '</tr>');
                        });
                    } else {
                        resultsContainer.html(noResulsHtml);
                    }
                    regulatorboxesCount.html(jsonData.length + " {!! trans('regulator-boxes.search.found-footer') !!}");
                    regulatorboxesPagination.hide();
                    cardTitle.html("{!! trans('regulator-boxes.search.title') !!}");
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.append(noResulsHtml);
                        regulatorboxesCount.html(0 + " {!! trans('regulator-boxes.search.found-footer') !!}");
                        regulatorboxesPagination.hide();
                        cardTitle.html("{!! trans('regulator-boxes.search.title') !!}");
                    };
                },
            });
        });

        searchSubmit.click(function(event) {
            event.preventDefault();
            searchform.submit();
        });

        searchformInput.keyup(function(event) {
            if ($('#intersection_search_box').val() !== '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                regulatorboxesTable.show();
                cardTitle.html("{!! trans('regulator-boxes.showing-all-regulator-boxes') !!}");
                regulatorboxesPagination.show();
                regulatorboxesCount.html(" ");
            }
        });

        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            regulatorboxesTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("{!! trans('regulator-boxes.showing-all-regulator-boxes') !!}");
            regulatorboxesPagination.show();
            regulatorboxesCount.html(" ");
        });
    });
</script>
