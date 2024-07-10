jQuery(document).ready(function ($)
    {
        $('.loading-message').show();

        var departuresTable = $('#departures-table'); 
        var departuresCrs = departuresTable.data('crs');
        var departuresPlatformUrl = datablesData.departuresPlatformUrl;

        var arrivalsTable = $('#arrivals-table'); 
        var arrivalsCrs = arrivalsTable.data('crs');
        var arrivalsPlatformUrl = datablesData.arrivalsPlatformUrl;

        var apiKey = datablesData.apiKey;

        var dataTableConfigDepatrures = 
        {
            processing: true,
            serverSide: true,
            ajax: 
            {
                'url': departuresPlatformUrl + '/api/20220120/GetDepBoardWithDetails/' + departuresCrs + '?numRows=10&filterType=to&timeOffset=0&timeWindow=120',
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

        var dataTableConfigArrivals = 
        {
            processing: true,
            serverSide: true,
            ajax: 
            {
                'url': arrivalsPlatformUrl + '/api/20220120/GetArrBoardWithDetails/' + arrivalsCrs + '?numRows=10&filterType=to&timeOffset=0&timeWindow=120',
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

        $('#arrivals-table').DataTable(dataTableConfigArrivals);

        $('.loading-message').hide();
    }
);