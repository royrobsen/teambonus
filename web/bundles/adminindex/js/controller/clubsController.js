app.controller('PaginationCtrl', function ($scope, $http) {

$scope.showData = function( ){

        $http({
        url: '/admin/clubs/jsonallclubs'
        }).success(function(data) {
            $scope.datalists = data;
        });
};
});