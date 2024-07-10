jQuery(document).ready(function ($)
    {
        $('.loading-message').show();

        var departuresTable = $('#departures-table'); 
        var departuresCrs = departuresTable.data('crs');
        var departuresPlatformUrl = datablesData.departuresPlatformUrl;

        var arrivalsTable = $('#arrivals-table'); 
        var arrivalsCrs = arrivalsTable.data('crs');
        var arrivalsPlatformUrl = datablesData.arrivalsPlatformUrl;

        var departuresApiKey = datablesData.departuresApiKey;
        var arrivalsApiKey = datablesData.arrivalsApiKey;

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
                    xhr.setRequestHeader('x-apikey', departuresApiKey)
                },
                'dataSrc': function(json) {
                    // Adjust this function based on your API response structure
                    return json.trainServices || []; // Assuming the data is in a 'trainServices' array
                }
            },
            columns: 
            [
                { data: 'operatorCode', title: 'Operator' },
                { data: 'std', title: 'Due' },
                { 
                    data: null, 
                    title: 'Destination',
                    render: function(data, type, row) {
                        return data.destination[0].locationName + (data.destination[0].via ? ' ' + data.destination[0].via : '');
                    }
                },
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
                    xhr.setRequestHeader('x-apikey', arrivalsApiKey)
                },
                'dataSrc': function(json) {
                    // Adjust this function based on your API response structure
                    return json.trainServices || []; // Assuming the data is in a 'trainServices' array
                }
            },
            columns: 
            [
                { data: 'operatorCode', title: 'Operator' },
                { data: 'sta', title: 'Due' },
                { 
                    data: null, 
                    title: 'Origin',
                    render: function(data, type, row) {
                        return data.origin[0].locationName;
                    }
                },
                { data: 'platform', title: 'Platform' },
                { data: 'eta', title: 'Expected' },
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