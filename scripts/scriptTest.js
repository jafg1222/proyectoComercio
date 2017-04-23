var app = angular.module("app", []);

function RemoteResource($http,baseUrl,$q) {
  this.insert=function(data2) {
  	var defered = $q.defer();
    var promise = defered.promise;
 
        $http({
          method: 'POST', 
          url: baseUrl+'/insertEmp',
          data : data2
        }).success(function(data, status, headers, config) {
			defered.resolve(data);
        }).error(function(data, status, headers, config) {
            if (status === 400) {
                defered.reject(data);
            } else {
                throw new Error("Fallo obtener los datos:" + status + "\n" + data);
            }
        });

        return promise;
      }

}

function RemoteResourceProvider() {
  var _baseUrl;
  this.setBaseUrl=function(baseUrl) {
    _baseUrl=baseUrl;
  }
  this.$get=['$http','$q',function($http,$q) {
    return new RemoteResource($http,_baseUrl,$q);
  }];
}

app.provider("remoteResource",RemoteResourceProvider);

app.constant("baseUrl", "http://localhost/pvJAFG/apiRest/rest.php");

app.config(['baseUrl', 'remoteResourceProvider',function(baseUrl, remoteResourceProvider) {
    remoteResourceProvider.setBaseUrl(baseUrl);
}]);


app.controller("SeguroController", ['$scope', 'remoteResource',  function($scope, remoteResource) {
    $scope.seguro = {
      cedula:604130495 , 
			nombre:'Jose' ,
			primApe: 'Flores',
			segApe: 'Garcia',
			direcciones:'Mastate, Orotina',
			telefono:'60448883',	
			correo: 'jose_01cr@outlook.com'
    }
  //  remoteResourceProvider.setData($scope.seguro);
    remoteResource.insert($scope.seguro).then(function(msj){
    	$scope.msj = msj;
    }, function(msj){$scope.msj = msj;});
    /*remoteResource.get($scope.seguro,
    	function(msj){$scope.msj = msj;},
    	function(data, status){alert("Ha fallado la petición. Estado HTTP:" + status);}
    	);
/*
    remoteResource.get(function(seguro) {
      $scope.seguro = seguro;
    }, function(data, status) {
      alert("Ha fallado la petición. Estado HTTP:" + status);
    });*/

  }
]);