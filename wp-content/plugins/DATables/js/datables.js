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
            serverSide: false,
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
                { 
                    data: null, 
                    title: 'Operator',
                    render: function(data, type, row) {
                        return data.operatorCode || '';
                    }
                },
                { 
                    data: null, 
                    title: 'Due',
                    render: function(data, type, row) {
                        return data.std || '';
                    }
                },
                { 
                    data: null, 
                    title: 'Destination',
                    render: function(data, type, row) {
                        return data.destination[0].locationName + (data.destination[0].via ? ' ' + data.destination[0].via : '');
                    }
                },
                { 
                    data: null, 
                    title: 'Platform',
                    render: function(data, type, row) {
                        return data.platform || '';
                    }
                },
                { 
                    data: null, 
                    title: 'Expected',
                    render: function(data, type, row) {
                        return data.etd || '';
                    }
                },
                { 
                    data: null, 
                    title: 'Coaches',
                    render: function(data, type, row) {
                        return data.length || '';
                    }
                },
            ],
            paging: false,
            info: false,
            pageLength: 25,
            dom: 'Bfrti',
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
                { 
                    data: null, 
                    title: 'Operator',
                    render: function(data, type, row) {
                        return data.operatorCode || '';
                    }
                },
                { 
                    data: null, 
                    title: 'Due',
                    render: function(data, type, row) {
                        return data.sta || '';
                    }
                },
                { 
                    data: null, 
                    title: 'Origin',
                    render: function(data, type, row) {
                        return data.origin[0].locationName;
                    }
                },
                { 
                    data: null, 
                    title: 'Platform',
                    render: function(data, type, row) {
                        return data.platform || '';
                    }
                },
                { 
                    data: null, 
                    title: 'Expected',
                    render: function(data, type, row) {
                        return data.eta || '';
                    }
                },
                { 
                    data: null, 
                    title: 'Coaches',
                    render: function(data, type, row) {
                        return data.length || '';
                    }
                },
            ],
            paging: false,
            info: false,
            pageLength: 25,
            dom: 'Bfrti',
            order: [[0, 'asc']], // Sort by the chosen column and direction (asc/desc, zero-based index)
            responsive: true
        };

        $('#arrivals-table').DataTable(dataTableConfigArrivals);

        $('.loading-message').hide();
    }
);