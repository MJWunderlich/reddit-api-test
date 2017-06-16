// Create the Angular application
var app = angular.module('reddit', []);

// Register the base URL as a constant
app.constant('API_URL', '/');

// A simple filter tha converts UNIX timestamps into readable dates
app.filter('dateConverter', function() {
    return function (UNIX_timestamp){
        var a = new Date(UNIX_timestamp * 1000);
        var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var hour = a.getHours();
        var min = a.getMinutes();
        var sec = a.getSeconds();
        var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
        return time;
    };
});