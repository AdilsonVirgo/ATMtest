<script>
    $(function() {
        var cardTitle = $('#card_title');
        var alertsTable = $('#alerts_table');
        var resultsContainer = $('#search_results');
        var alertsCount = $('#alert_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_alerts');
        var searchformInput = $('#alert_search_box');
        var alertPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html('Buscando. Espere por favor...');
            alertsTable.hide();
            searchformInput.prop("readonly", true);
            clearSearchTrigger.show();
            let noResulsHtml = '<tr>' +
                                '<td>alerts.no.result</td>' +
                                '<td></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-sm hidden-xs"></td>' +
                                '<td class="hidden-sm hidden-xs hidden-md"></td>' +
                                '<td class="hidden-sm hidden-xs hidden-md"></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "{{ route('search-alerts') }}",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length != 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="vertical-signals/' + val.id + '" data-toggle="tooltip" title="{{ trans("verticalsignals.tooltips.show") }}">{!! trans("verticalsignals.buttons.show") !!}</a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="vertical-signals/' + val.id + '/edit" data-toggle="tooltip" title="{{ trans("verticalsignals.tooltips.edit") }}">{!! trans("verticalsignals.buttons.edit") !!}</a>';
                            let deleteCellHtml = '<form method="POST" action="/vertical-signals/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '{!! Form::hidden("_method", "DELETE") !!}' +
                                    '{!! csrf_field() !!}' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="{!! trans("verticalsignals.modals.delete_alert_message", ["alert" => "'+val.name+'"]) !!}">' +
                                        '{!! trans("verticalsignals.buttons.delete") !!}' +
                                    '</button>' +
                                '</form>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.code + '</td>' +
                                '<td>' + val.creator + '</td>' +
                                '<td>' + val.state + '</td>' +
                                '<td>' + val.fastener + '</td>' +
                                '<td>' + val.material + '</td>' +
                                '<td>' + val.normative + '</td>' +
                                '<td>' + val.google_address + '</td>' +
                                @role('atmadmin') '<td>' + deleteCellHtml + '</td>' + @endrole
                                '<td>' + showCellHtml + '</td>' +
                                '<td>' + editCellHtml + '</td>' +
                            '</tr>');
                        });
                    } else {
                        resultsContainer.append(noResulsHtml);
                    };
                    alertsCount.html(jsonData.length + " {!! trans('verticalsignals.search.found-footer') !!}");
                    alertPagination.hide();
                    cardTitle.html("{!! trans('verticalsignals.search.title') !!}");
                    searchformInput.prop("readonly", false);
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.append(noResulsHtml);
                        alertsCount.html(0 + " {!! trans('verticalsignals.search.found-footer') !!}");
                        alertPagination.hide();
                        cardTitle.html("{!! trans('verticalsignals.search.title') !!}");
                        searchformInput.prop("readonly", false);
                    };
                },
            });
        });
        searchSubmit.click(function(event) {
            event.preventDefault();
            searchform.submit();
        });
        searchformInput.keyup(function(event) {
            if ($('#alert_search_box').val() != '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                alertsTable.show();
                cardTitle.html("{!! trans('verticalsignals.showing-all-alerts') !!}");
                alertPagination.show();
                alertsCount.html(" ");
            };
        });
        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            alertsTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("{!! trans('verticalsignals.showing-all-alerts') !!}");
            alertPagination.show();
            alertsCount.html(" ");
        });
    });
</script>
