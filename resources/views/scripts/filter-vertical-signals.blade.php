<script>
    $(function () {
        let filter_form = $('#vsignal-filters');
        let filter_submit = $('#filter-submit');
        let filter_reset = $('#filter-reset');
        let result_container = $('#vsignals_table');
        let markers_list = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        filter_form.submit(function (e) {
            e.preventDefault();

            let params = filter_form.serialize();
            disable_selectizes();
            result_container.html('Buscando. Por favor espere...');

            let noResulsHtml = '<tr>' +
                '<td>{!! trans("signalsinventory.search.no-results") !!}</td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '</tr>';

            $.ajax({
                type: 'POST',
                url: "{{ route('vsignal-filters') }}",
                data: params,
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length !== 0) {
                        clear_data();

                        $.each(jsonData, function (index, val) {
                            result_container.append('<tr>' +
                                '<td>' + val.code + '</td>' +
                                '<td>' + val.latitude + '</td>' +
                                '<td>' + val.longitude + '</td>' +
                                '<td>' + val.state + '</td>' +
                                '<td>' + val.fastener + '</td>' +
                                '<td>' + val.material + '</td>' +
                                '<td>' + val.parish + '</td>' +
                                '<td>' + val.neighborhood + '</td>' +
                                '<td>' + val.google_address + '</td>' +
                                '</tr>');

                            add_map_marker(val);
                        });
                    } else {
                        clear_data();
                        result_container.append(noResulsHtml);
                    }
                }
            });

            enable_selectizes();
        });

        filter_submit.click(function (event) {
            event.preventDefault();
            clear_data();
            filter_form.submit();
        });

        clear_data = function () {
            // clear result_container
            result_container.html('');

            // clear map markers
            //console.log(markers_list);
            for (let i = 0; i < markers_list.length; i++) {
                markers_list[i].setMap(null);
            }
            markers_list = [];
        };

        add_map_marker = function(val) {
            let marker = new google.maps.Marker({
                map: map,
                //icon: "",
                title: val.code,
                position: new google.maps.LatLng(val.latitude, val.longitude)
            });

            marker['infowindow'] = new google.maps.InfoWindow({
                content: '<div class="card">\
                    <div class="card-horizontal">\
                    <div class="img-square-wrapper">\
                    <img class="signal_picture" src="' + val.picture + '" alt="' + val.code + '" title="' + val.code + '">\
                    </div>\
                    <div class="card-body">\
                    <h4 class="card-title">Señal: ' + val.code + '</h4>\
                    <p class="card-text">\
                    <p><strong>Dirección: </strong>' + val.google_address + '</p>\
                    <p><strong>Comentario: </strong>' + val.comment + '</p>\
                    </p>\
            </div>\
            </div>\
            </div>'
            });

            google.maps.event.addListener(marker, 'mouseover', function () {
                this['infowindow'].open(map, this);
            });

            google.maps.event.addListener(marker, 'mouseout', function () {
                this['infowindow'].close();
            });

            google.maps.event.addListener(marker, 'click', function() {
                var url = '{{ URL::to('vertical-signals/') }}' + '/' + val.id;
                $('#modal-vsignal').on('show.bs.modal', function (e) {
                    var message = 'message';

                    $(this).find('.modal-title').text('Señal vertical: ' + val.code);
                    $(this).find('.modal-body p').text(message);
                    //$(this).find('#signal-picture').attr('src', val.picture);
                    $(this).find('#signal-picture').css('background-image', 'url('+val.picture+')');
                    $(this).find('#signal-code').text(val.code);
                    $(this).find('#signal-group').text(val.group);
                    $(this).find('#signal-subgroup').text(val.subgroup);
                    $(this).find('#signal-lat').text(val.latitude);
                    $(this).find('#signal-lng').text(val.longitude);
                    $(this).find('#signal-address').text(val.google_address);
                    $(this).find('#signal-parish').text(val.parish);
                    $(this).find('#signal-neighborhood').text(val.neighborhood);
                    $(this).find('#signal-state').text(val.state);
                    $(this).find('#signal-material').text(val.material);
                    $(this).find('#signal-fastener').text(val.fastener);
                    $(this).find('#signal-comment').text(val.comment );
                });

                $('#modal-vsignal').modal('show');
            });

            markers_list.push(marker);
        }

        clear_selectizes = function () {
            $('#signal')[0].selectize.clear();
            $('#state')[0].selectize.clear();
            $('#material')[0].selectize.clear();
            $('#fastener')[0].selectize.clear();
            //$('#parish')[0].selectize.clear();
            //$('#neighborhood')[0].selectize.clear();
        };

        disable_selectizes = function () {
            $('#signal')[0].selectize.disable();
            $('#state')[0].selectize.disable();
            $('#material')[0].selectize.disable();
            $('#fastener')[0].selectize.disable();
            //$('#parish')[0].selectize.disable();
            //$('#neighborhood')[0].selectize.disable();
        };

        enable_selectizes = function () {
            $('#signal')[0].selectize.enable();
            $('#state')[0].selectize.enable();
            $('#material')[0].selectize.enable();
            $('#fastener')[0].selectize.enable();
            //$('#parish')[0].selectize.enable();
            //$('#neighborhood')[0].selectize.enable();
        };

        filter_reset.click(function (event) {
            event.preventDefault();
            clear_selectizes();
        });
    });
</script>
