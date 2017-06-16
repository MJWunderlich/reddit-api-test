<!DOCTYPE html>
<html>
    <head>
        <title>Reddit Test Project</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/default.css">
    </head>
    <body ng-app="reddit">
        <div class="body container-fluid">
            <div id="app" ng-controller="redditController">

                <button class="btn btn-primary" ng-click="fetchHotPosts()">HOT</button>
                <button class="btn btn-success" ng-click="fetchRisingPosts()">RISING</button>
                <button class="btn btn-default" ng-click="fetchNewPosts()">NEW</button>
                &nbsp;
                &nbsp;
                <button class="paginate next btn btn-default" ng-click="fetchNextPage()">Next {{ current_category }} posts</button>

                <div class="post row" ng-repeat="post in posts">
                    <div class="upvotes col-sm-1 col-md-1 col-lg-1 hidden-xs">
                        <span class="glyphicon glyphicon-triangle-top arrow-up"></span>
                        <span class="ups">{{ post.ups }}</span>
                    </div>

                    <div class="thumbnail col-xs-12 col-sm-3 col-md-2 col-lg-1">
                        <div ng-if="post.has_thumbnail" class="thumbnail"
                             style="background-image: url('{{ post.thumbnail }}');"></div>
                        <div ng-if="!post.has_thumbnail" class="no-thumbnail">
                            No Thumbnail
                        </div>
                    </div>

                    <div class="subreddit col-md-2 col-lg-2 hidden-sm hidden-xs">
                        <strong>{{ post.subreddit_name_prefixed }}</strong>
                    </div>

                    <div class="upvotes col-xs-2 hidden-sm hidden-md hidden-lg" style="margin-bottom: 150px;">
                        <span class="glyphicon glyphicon-triangle-top arrow-up"></span>
                        <span class="ups">{{ post.ups }}</span>
                    </div>

                    <div class="information col-xs 10 col-sm-8 col-md-6">
                        <div class="title">
                            <a href="https://www.reddit.com/{{ post.permalink }}" target="_blank">{{ post.title }}</a>
                        </div>
                        <div class="subreddit.inner hidden-md hidden-lg">
                            <strong>{{ post.subreddit_name_prefixed }}</strong>
                        </div>
                        <div class="domain">{{ post.domain }}</div>
                        <div class="meta">
                            <em>Posted on <strong>{{ post.created_utc | dateConverter }}</strong></em>
                            <em>by <strong>{{ post.author }}</strong></em>
                        </div>
                    </div>
                </div>

                <button class="paginate next bottom btn btn-default" ng-click="fetchNextPage()">Next {{ current_category }} posts</button>

            </div>
        </div>

        <script
                src="https://code.jquery.com/jquery-3.2.1.min.js"
                integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
                crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <script src="/js/app.js"></script>
        <script src="/js/controllers/reddit.js"></script>
    </body>
</html>
