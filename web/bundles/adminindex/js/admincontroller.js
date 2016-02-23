    var app = angular.module("MyApp", ['textAngular', 'ui.bootstrap']) .config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');

    }]);

    app.filter('offset', function() {

        return function(input, start) {
            if (!input || !input.length) { return; }
            start = parseInt(start, 10);
            return input.slice(start);    
        };

    });

    app.filter('htmlToPlaintext', function() {

        return function(text) {
            return String(text).replace(/<[^>]+>/gm, '');
        };

    });
    
app.filter('brDateFilter', function() {
    return function(dateSTR) {
        var o = dateSTR.replace(/-/g, "/"); // Replaces hyphens with slashes
        return Date.parse(o + " -0000"); // No TZ subtraction on this sample
    }
});
    
    app.controller("PaginationCtrl", function($scope, $http) {

        $scope.articlesPerPage = 15;
        $scope.currentPage = 0;

        function htmlToPlaintext(text) {
            return String(text).replace(/<[^>]+>/gm, '');
        }

        // this should load the json from '/admin/jsonallarticles' into the articles variable
        $http.get('/admin/jsonallarticles').success(function(data) {
            $scope.articles = data;
        });
        

        $scope.range = function() {
            var rangeSize = 5;
            var ret = [];
            var start;
            start = $scope.currentPage;

            if ( start > $scope.pageCount()-rangeSize ) {
                start = $scope.pageCount()-rangeSize+1;
            }

            for (var i=start; i<start+rangeSize; i++) {
                ret.push(i);
            }

            return ret;
        };

        $scope.prevPage = function() {
            if ($scope.currentPage > 0) {
            $scope.currentPage--;
            }
        };

        $scope.prevPageDisabled = function() {
            return $scope.currentPage === 0 ? "disabled" : "";
        };

        $scope.pageCount = function() {
            return Math.ceil($scope.articles.length/$scope.articlesPerPage)-1;
        };

        $scope.nextPage = function() {
            if ($scope.currentPage < $scope.pageCount()) {
                $scope.currentPage++;
            }
        };

        $scope.nextPageDisabled = function() {
            return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
        };

        $scope.setPage = function(n) {
        $scope.currentPage = n;
        };
        
    });

        app.controller("PaginationCtrl2", function($scope, $http) {

        $scope.articlesPerPage = 15;
        $scope.currentPage = 0;

        function htmlToPlaintext(text) {
            return String(text).replace(/<[^>]+>/gm, '');
        }
             
            
            
        // this should load the json from '/admin/jsonalldumpedarticles' into the articlesdumped variable
        $http.get('/admin/jsonalldumpedarticles').success(function(data) {
            $scope.articles = data;
        });

        $scope.range = function() {
            var rangeSize = 5;
            var ret = [];
            var start;
            start = $scope.currentPage;

            if ( start > $scope.pageCount()-rangeSize ) {
                start = $scope.pageCount()-rangeSize+1;
            }

            for (var i=start; i<start+rangeSize; i++) {
                ret.push(i);
            }

            return ret;
        };

        $scope.prevPage = function() {
            if ($scope.currentPage > 0) {
            $scope.currentPage--;
            }
        };

        $scope.prevPageDisabled = function() {
            return $scope.currentPage === 0 ? "disabled" : "";
        };

        $scope.pageCount = function() {
            return Math.ceil($scope.articles.length/$scope.articlesPerPage)-1;
        };

        $scope.nextPage = function() {
            if ($scope.currentPage < $scope.pageCount()) {
                $scope.currentPage++;
            }
        };

        $scope.nextPageDisabled = function() {
            return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
        };

        $scope.setPage = function(n) {
        $scope.currentPage = n;
        };
        
    });
    app.controller("PaginationCtrl3", function($scope, $http) {

        $scope.articlesPerPage = 15;
        $scope.currentPage = 0;

        function htmlToPlaintext(text) {
            return String(text).replace(/<[^>]+>/gm, '');
        }

        // this should load the json from '/admin/jsonallarticles' into the articles variable
        $http.get('/admin/categoriesjson').success(function(data) {
            $scope.articles = data;
        });
        

        $scope.range = function() {
            var rangeSize = 5;
            var ret = [];
            var start;
            start = $scope.currentPage;

            if ( start > $scope.pageCount()-rangeSize ) {
                start = $scope.pageCount()-rangeSize+1;
            }

            for (var i=start; i<start+rangeSize; i++) {
                ret.push(i);
            }

            return ret;
        };

        $scope.prevPage = function() {
            if ($scope.currentPage > 0) {
            $scope.currentPage--;
            }
        };

        $scope.prevPageDisabled = function() {
            return $scope.currentPage === 0 ? "disabled" : "";
        };

        $scope.pageCount = function() {
            return Math.ceil($scope.articles.length/$scope.articlesPerPage)-1;
        };

        $scope.nextPage = function() {
            if ($scope.currentPage < $scope.pageCount()) {
                $scope.currentPage++;
            }
        };

        $scope.nextPageDisabled = function() {
            return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
        };

        $scope.setPage = function(n) {
        $scope.currentPage = n;
        };
        
    });

app.controller("PaginationCtrl4", function($scope, $http) {

        $scope.articlesPerPage = 15;
        $scope.currentPage = 0;

        function htmlToPlaintext(text) {
            return String(text).replace(/<[^>]+>/gm, '');
        }

        // this should load the json from '/admin/jsonallarticles' into the articles variable
        $http.get('/admin/jsonevents').success(function(data) {
            $scope.articles = data;
        });
        

        $scope.range = function() {
            var rangeSize = 5;
            var ret = [];
            var start;
            start = $scope.currentPage;

            if ( start > $scope.pageCount()-rangeSize ) {
                start = $scope.pageCount()-rangeSize+1;
            }

            for (var i=start; i<start+rangeSize; i++) {
                ret.push(i);
            }

            return ret;
        };

        $scope.prevPage = function() {
            if ($scope.currentPage > 0) {
            $scope.currentPage--;
            }
        };

        $scope.prevPageDisabled = function() {
            return $scope.currentPage === 0 ? "disabled" : "";
        };

        $scope.pageCount = function() {
            return Math.ceil($scope.articles.length/$scope.articlesPerPage)-1;
        };

        $scope.nextPage = function() {
            if ($scope.currentPage < $scope.pageCount()) {
                $scope.currentPage++;
            }
        };

        $scope.nextPageDisabled = function() {
            return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
        };

        $scope.setPage = function(n) {
        $scope.currentPage = n;
        };
        
    });

    app.controller("myCtrl", function($scope, $http) {   
          //initiate an array to hold all active tabs
    $scope.activeTabs = [];
 
    //check if the tab is active
    $scope.isOpenTab = function (tab) {
        //check if this tab is already in the activeTabs array
        if ($scope.activeTabs.indexOf(tab) > -1) {
            //if so, return true
            return true;
        } else {
            //if not, return false
            return false;
        }
    }
 
    //function to 'open' a tab
    $scope.openTab = function (tab) {
        //check if tab is already open
        if ($scope.isOpenTab(tab)) {
            //if it is, remove it from the activeTabs array
            $scope.activeTabs.splice($scope.activeTabs.indexOf(tab), 1);
        } else {
            //if it's not, add it!
            $scope.activeTabs.push(tab);
        }
    }
   });
   
   app.controller('DatepickerDemoCtrl', function ($scope) {
  $scope.today = function() {
    $scope.dt = new Date();
  };
  $scope.today();

  $scope.clear = function () {
    $scope.dt = null;
  };

  // Disable weekend selection
  $scope.disabled = function(date, mode) {
    return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
  };

  $scope.toggleMin = function() {
    $scope.minDate = $scope.minDate ? null : new Date();
  };
  $scope.toggleMin();

  $scope.open = function($event) {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.opened = true;
  };

  $scope.dateOptions = {
    formatYear: 'yy',
    startingDay: 1
  };

  $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
  $scope.format = $scope.formats[0];
});
   
   