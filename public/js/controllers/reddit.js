app.controller('redditController', function ($scope, $http, API_URL) {

    $scope.posts = [];
    $scope.current_category = false;
    $scope.current_page = 0;
    $scope.next_page_id = false;
    $scope.prev_page_id = false;

    // Fetches a series of posts
    $scope.fetchPosts = function (type, id, position) {

        // Disable pagination
        disablePagination();

        if ($scope.current_category != type) {
            $scope.next_page_id = false;
            $scope.prev_page_id = false;
            $scope.current_page = 0;
        }

        $scope.posts = [];
        $scope.current_category = type;

        var url = API_URL + "posts/" + type;
        if (id) {
            url += "/" + id + "?position=" + position || "after";
        }

        // Use AJAX to fetch the next posts from the API
        $http({
            method: 'GET',
            url: url
        }).then(function (response) {
            $scope.posts = response.data.posts;
            $scope.next_page_id = response.data.next_page_id;
            $scope.prev_page_id = response.data.prev_page_id;

            // Re-enable pagination
            enablePagination();
        });
    };

    $scope.fetchHotPosts = function () {
        console.info("Current category: " + $scope.current_category);
        console.info("Current last id: " + $scope.next_page_id);

        this.fetchPosts('hot');
    };

    $scope.fetchNewPosts = function () {
        this.fetchPosts('new');
    };

    $scope.fetchRisingPosts = function () {
        this.fetchPosts('rising');
    };

    $scope.fetchNextPage = function() {
        $scope.current_page ++;
        $scope.fetchPosts($scope.current_category, $scope.next_page_id, 'after');
    };

    $scope.fetchPrevPage = function() {
        $scope.current_page --;
        var next_page = $scope.prev_page_id;
        if ($scope.current_page <= 0) {
            $scope.current_page = 0;
            $scope.prev_page_id = false;
            next_page = false;
        }
        $scope.fetchPosts($scope.current_category, next_page, 'before');
    };

    $scope.fetchHotPosts();

    $scope.convertTime = function (UNIX_timestamp){
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

    function disablePagination() {
        $('button.paginate').attr('disabled', true);
        $('button.paginate.bottom').hide();
        $('.current-page.bottom').hide();
    }

    function enablePagination() {
        $('button.paginate.bottom').show();
        $('.current-page.bottom').show();

        $('button.next').removeAttr('disabled');
        if ($scope.current_page > 0)
            $('button.prev').removeAttr('disabled');
    }
});
