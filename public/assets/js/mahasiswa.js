var app = angular.module('mahasiswa', ['ui.bootstrap','blockUI'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
app.factory('myHttpInterceptor', function($q, $window, blockUI) {
    return function(promise) {
        return promise.then(function(response) {
            // do something on success
            // todo hide the spinner
            blockUI.stop();
            return response;

        }, function(response) {
            // do something on error
            // todo hide the spinner
            blockUI.stop();
            return $q.reject(response);
        });
    };
})
app.factory('baseURL', function($location) {
    return {
        url: function(url) {
            return base_url + '/' + url;
        }
    };
});
app.filter('_uriseg', function($location, baseURL) {
    return function(segment) {
        var query = $location.absUrl().replace(baseURL.url(), "");
        var data = query.split("/");
        if (data[segment - 1]) {
            return data[segment - 1];
        }
        return false;
    }
});
angular.module('mahasiswa').controller('jurusan', function($scope, $http, $filter, $timeout, baseURL) {
    $scope.jurusan = {};
    $scope.data = {};
    $scope.show = false;
    $http.get(baseURL.url('api/jurusandropdown')).success(function(data) {
        $scope.jurusan = data;
    });
    $scope.submit = function() {
        $scope.show = true;
        $http.get(baseURL.url('api/ambilmahasiswa/' + $scope.data['id_jurusan'])).success(function(e) {

            $scope.telo = e;
        })
    }

});
angular.module('mahasiswa').controller('absensi', function($scope, $http, $filter, $timeout, baseURL) {
    $scope.data = {};
    $scope.show = false;
    $scope.telo = {};
    $scope.jurusan = {};
    $scope.date = [];
    $scope.tahun = [];
    $scope.bulan = [
        {'id': 1, 'label': 'Januari'},
        {'id': 2, 'label': 'Februari'},
        {'id': 3, 'label': 'Maret'},
        {'id': 4, 'label': 'April'},
        {'id': 5, 'label': 'Mei'},
        {'id': 6, 'label': 'Juni'},
        {'id': 7, 'label': 'July'},
        {'id': 8, 'label': 'Agustus'},
        {'id': 9, 'label': 'September'},
        {'id': 10, 'label': 'Oktober'},
        {'id': 11, 'label': 'November'},
        {'id': 12, 'label': 'Desember'},
    ];
    var dateobj = new Date();
    $scope.data['jurusan'] = 1;
    $scope.data['bulan'] = dateobj.getMonth() + 1; // 3  (0 = January, 3 = April)
    $scope.data['tahun'] = dateobj.getFullYear(); // 6
    for (var t = dateobj.getFullYear() - 5; t <= dateobj.getFullYear(); t++)
    {
        var tahun = {'id': t, 'label': t};
        $scope.tahun.push(tahun);
    }
    
    $http.get(baseURL.url('api/jurusandropdown')).success(function(data) {
        $scope.jurusan = data;
    });

    $http.get(baseURL.url('api/jasdropdown')).success(function(data) {
        $scope.jas = data;
    });

    $scope.submit = function() {
        $http.post(baseURL.url('api/showabsensi'), $scope.data).success(function(e) {
            $scope.show = true;
            $scope.telo = e;
        });
    }
});