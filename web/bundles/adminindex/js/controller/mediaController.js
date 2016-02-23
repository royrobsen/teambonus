 app.controller('PaginationCtrl', function ($scope, $http) {

  

$scope.$watch('path', function () {
    console.log($scope.path);
 $scope.curPage = 0;
 $scope.pageSize = 60;

    // Now just unbind it after doing your logic

    $scope.datalists = [];
    
    $scope.formInfo = {};
    var searchit = $scope.formInfo;
        $http({
        url: '/admin/media/json'+'/'+ $scope.path,
        method: "GET",
        params: searchit
        }).success(function(data) {
            $scope.datalists = data;
        });
    $scope.saveData = function() {
        $http({
        url: '/admin/media/json'+'/'+ $scope.path, 
        method: "GET",
        params: searchit
        }).success(function(data) {
            $scope.datalists = data;
        });
        $scope.curPage = 0;
       };
     $scope.numberOfPages = function() {
	return Math.ceil($scope.datalists.length / $scope.pageSize);
     };
         
});
});