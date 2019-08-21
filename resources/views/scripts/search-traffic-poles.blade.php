<script>
    $(function() {
        var cardTitle = $('#card_title');
        var trafficpolesTable = $('#traffic_poles_table');
        var resultsContainer = $('#search_results');
        var trafficpolesCount = $('#traffic_poles_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_traffic_poles');
        var searchformInput = $('#traffic_pole_search_box');
        var trafficpolesPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');

        let searching = '<i class="fa fa-spinner fa-spin"></i> Buscando postes de tráfico. Por favor espere...';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html(searching);
            trafficpolesTable.hide();
            trafficpolesPagination.hide();
            clearSearchTrigger.show();

            let noResulsHtml = '<tr>' +
                                '<td>{!! trans("traffic-poles.search.no-results") !!}</td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "{{ route('search-traffic-poles') }}",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length !== 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="traffic-poles/' + val.id + '" data-toggle="tooltip" title="{{ trans("traffic-poles.tooltips.show") }}">{!! trans("traffic-poles.buttons.show") !!}</a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="traffic-poles/' + val.id + '/edit" data-toggle="tooltip" title="{{ trans("traffic-poles.tooltips.edit") }}">{!! trans("traffic-poles.buttons.edit") !!}</a>';
                            let deleteCellHtml = '<form method="POST" action="/traffic-poles/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '{!! Form::hidden("_method", "DELETE") !!}' +
                                    '{!! csrf_field() !!}' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="{!! trans("traffic-poles.modals.delete_traffic_pole_message", ["code" => "'+val.code+'"]) !!}">' +
                                        '{!! trans("traffic-poles.buttons.delete") !!}' +
                                    '</button>' +
                                '</form>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.code + '</td>' +
                                '<td>' + val.state + '</td>' +
                                '<td>' + val.height + '</td>' +
                                '<td class="hidden-xs">' + val.material + '</td>' +
                                '<td class="hidden-xs">' + val.google_address + '</td>' +
                                '<td class="hidden-xs">' + val.comment + '</td>' +
                                '<td>' + val.erp_code + '</td>' +
                                '<td>' + deleteCellHtml + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                '<td>' + editCellHtml + '</td>' +
                            '</tr>');
                        });
                    } else {
                        resultsContainer.html(noResulsHtml);
                    }
                    trafficpolesCount.html(jsonData.length + " {!! trans('traffic-poles.search.found-footer') !!}");
                    intersectionPagination.hide();
                    cardTitle.html("{!! trans('traffic-poles.search.title') !!}");
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.append(noResulsHtml);
                        trafficpolesCount.html(0 + " {!! trans('traffic-poles.search.found-footer') !!}");
                        intersectionPagination.hide();
                        cardTitle.html("{!! trans('traffic-poles.search.title') !!}");
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
                trafficpolesTable.show();
                cardTitle.html("{!! trans('traffic-poles.showing-all-traffic-poles') !!}");
                intersectionPagination.show();
                trafficpolesCount.html(" ");
            }
        });

        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            trafficpolesTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("{!! trans('traffic-poles.showing-all-traffic-poles') !!}");
            intersectionPagination.show();
            trafficpolesCount.html(" ");
        });
    });
</script>
