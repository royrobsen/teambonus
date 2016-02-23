    app = angular.module("MyApp", ['textAngular']) .config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');

    }]);

app.filter('pagination', function()
{
 return function(input, start)
 {
  if (!input || !input.length) { return; }
  start = +start;
  return input.slice(start);
 };
});

    app.filter('htmlToPlaintext', function() {

        return function(text) {
            return String(text).replace(/<[^>]+>/gm, '');
        };

    });

    app.filter('login', function() {
    return function(dateSTR) {
        if(dateSTR === "-0001-11-30 00:00:00") {
            return "Nie";
        } else {
            var o = dateSTR.replace(/-/g, "/"); // Replaces hyphens with slashes
            return new Date(Date.parse(o + " -0000")).toLocaleFormat('%d.%m.%Y'); // No TZ subtraction on this sample
        }
    };
    });

    app.filter('brDateFilter', function() {
    return function(dateSTR) {
        var o = dateSTR.replace(/-/g, "/"); // Replaces hyphens with slashes
        return Date.parse(o + " -0000"); // No TZ subtraction on this sample
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
       app.controller('eventcategoryCtrl', function ($scope, $http) {

        
            $scope.articles = [{title : "test", id : "1"}];
    
        
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
   
   