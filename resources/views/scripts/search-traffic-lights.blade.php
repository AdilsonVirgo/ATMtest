<script>
    $(function() {
        var cardTitle = $('#card_title');
        var trafficlightsTable = $('#traffic_lights_table');
        var resultsContainer = $('#search_results');
        var trafficlightsCount = $('#traffic_lights_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_traffic_lights');
        var searchformInput = $('#traffic_light_search_box');
        var trafficlightsPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');

        let searching = '<i class="fa fa-spinner fa-spin"></i> Buscando semáforos. Por favor espere...';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html(searching);
            trafficlightsTable.hide();
            trafficlightsPagination.hide();
            clearSearchTrigger.show();

            let noResulsHtml = '<tr>' +
                                '<td>{!! trans("traffic-lights.search.no-results") !!}</td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "{{ route('search-traffic-lights') }}",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length !== 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="traffic-lights/' + val.id + '" data-toggle="tooltip" title="{{ trans("traffic-lights.tooltips.show") }}">{!! trans("traffic-lights.buttons.show") !!}</a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="traffic-lights/' + val.id + '/edit" data-toggle="tooltip" title="{{ trans("traffic-lights.tooltips.edit") }}">{!! trans("traffic-lights.buttons.edit") !!}</a>';
                            let deleteCellHtml = '<form method="POST" action="/traffic-lights/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '{!! Form::hidden("_method", "DELETE") !!}' +
                                    '{!! csrf_field() !!}' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="{!! trans("traffic-lights.modals.delete_traffic_tensor_message", ["code" => "'+val.code+'"]) !!}">' +
                                        '{!! trans("traffic-lights.buttons.delete") !!}' +
                                    '</button>' +
                                '</form>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.code + '</td>' +
                                '<td>' + val.erp_code + '</td>' +
                                '<td>' + val.brand + '</td>' +
                                '<td class="hidden-xs">' + val.model + '</td>' +
                                '<td>' + val.state + '</td>' +
                                '<td>' + val.orientation + '</td>' +
                                '<td>' + deleteCellHtml + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                '<td>' + editCellHtml + '</td>' +
                            '</tr>');
                        });
                    } else {
                        resultsContainer.html(noResulsHtml);
                    }
                    trafficlightsCount.html(jsonData.length + " {!! trans('traffic-lights.search.found-footer') !!}");
                    intersectionPagination.hide();
                    cardTitle.html("{!! trans('traffic-lights.search.title') !!}");
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.append(noResulsHtml);
                        trafficlightsCount.html(0 + " {!! trans('traffic-lights.search.found-footer') !!}");
                        intersectionPagination.hide();
                        cardTitle.html("{!! trans('traffic-lights.search.title') !!}");
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
                trafficlightsTable.show();
                cardTitle.html("{!! trans('traffic-lights.showing-all-traffic-lights') !!}");
                intersectionPagination.show();
                trafficlightsCount.html(" ");
            }
        });

        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            trafficlightsTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("{!! trans('traffic-lights.showing-all-traffic-lights') !!}");
            intersectionPagination.show();
            trafficlightsCount.html(" ");
        });
    });
</script>
