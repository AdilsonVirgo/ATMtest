<script>
    $(function() {
        var cardTitle = $('#card_title');
        var devicesTable = $('#inventory_table');
        var resultsContainer = $('#search_results');
        var devicesCount = $('#inventory_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_device');
        var searchformInput = $('#device_search_box');
        var devicesPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');

        let searching = '<i class="fa fa-spinner fa-spin"></i> Buscando dispositivos de tráfico. Por favor espere...';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html(searching);
            devicesPagination.hide();
            devicesTable.hide();
            clearSearchTrigger.show();
            let noResulsHtml = '<tr>' +
                                '<td>{!! trans("device-inventory.search.no-results") !!}</td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "{{ route('search-device-inventory') }}",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length != 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="devices-inventory/' + val.id + '" data-toggle="tooltip" title="{{ trans("device-inventory.tooltips.show") }}">{!! trans("device-inventory.buttons.show") !!}</a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="devices-inventory/' + val.id + '/edit" data-toggle="tooltip" title="{{ trans("device-inventory.tooltips.edit") }}">{!! trans("device-inventory.buttons.edit") !!}</a>';
                            let deleteCellHtml = '<form method="POST" action="/devices-inventory/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '{!! Form::hidden("_method", "DELETE") !!}' +
                                    '{!! csrf_field() !!}' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="{!! trans("device-inventory.modals.delete_user_message", ["user" => "'+val.name+'"]) !!}">' +
                                        '{!! trans("device-inventory.buttons.delete") !!}' +
                                    '</button>' +
                                '</form>';
                            let dimensions = val.dimensions == null ? '' : val.dimensions;
                            let erp_code = val.erp_code == null ? '' : val.erp_code;
                            resultsContainer.append('<tr>' +
                                '<td>' + val.code + '</td>' +
                                '<td>' + val.name + '</td>' +
                                '<td>' + dimensions + '</td>' +
                                '<td>' + erp_code + '</td>' +
                                '<td>' + deleteCellHtml + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                '<td>' + editCellHtml + '</td>' +
                            '</tr>');
                        });
                    } else {
                        resultsContainer.append(noResulsHtml);
                    };
                    devicesCount.html(jsonData.length + " {!! trans('device-inventory.search.found-footer') !!}");
                    devicesPagination.hide();
                    cardTitle.html("{!! trans('device-inventory.search.title') !!}");
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.append(noResulsHtml);
                        devicesCount.html(0 + " {!! trans('device-inventory.search.found-footer') !!}");
                        devicesPagination.hide();
                        cardTitle.html("{!! trans('device-inventory.search.title') !!}");
                    };
                },
            });
        });

        searchSubmit.click(function(event) {
            event.preventDefault();
            searchform.submit();
        });

        searchformInput.keyup(function(event) {
            if ($('#device_search_box').val() != '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                devicesTable.show();
                cardTitle.html("{!! trans('device-inventory.showing-all-signals-inventories') !!}");
                devicesPagination.show();
                devicesCount.html(" ");
            };
        });

        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            devicesTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("{!! trans('device-inventory.showing-all-signals-inventories') !!}");
            devicesPagination.show();
            devicesCount.html(" ");
        });
    });
</script>
