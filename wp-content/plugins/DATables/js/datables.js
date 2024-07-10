jQuery(document).ready(function ($)
    {
        $('.loading-message').show();

        var crs = 'BUG';
        var platformUrl;
        var apiKey;
        // Define your DataTable configuration for spids
        var dataTableConfigDepatrures = 
        {
            processing: true,
            serverSide: true,
            ajax: 
            {
                'url': baseDepUrl + '/api/20220120/GetDepBoardWithDetails/' + crs + '?numRows=10&filterType=to&timeOffset=0&timeWindow=120',
                'type': 'GET',
                'beforeSend': function(xhr)
                {
                    xhr.setRequestHeader('x-apikey', apiKey)
                }
            },
            columns: 
            [
                { data: 'operatorCode', title: 'Operator' },
                { data: 'std', title: 'Due' },
                { data: 'destination.locationName' + 'destination.via', title: 'Destination' },
                { data: 'platform', title: 'Platform' },
                { data: 'etd', title: 'Expected' },
                { data: 'length', title: 'Coaches' },
            ],
            pageLength: 25,
            dom: 'Bfrtip',
            order: [[0, 'asc']], // Sort by the chosen column and direction (asc/desc, zero-based index)
            responsive: true
        };

        $('#departures-table').DataTable(dataTableConfigDepatrures);

        $('.loading-message').hide();
    }
);