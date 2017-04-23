var app = angular.module('app', ['ui.bootstrap','ngAnimate']);
/*-----------------------------------------------------------
    Modulo para consumir la APIREST
-------------------------------------------------------------*/
function ApiResource($http,baseUrl,$q){
	this.insert = function(data){
		var defered = $q.defer();
    var promise = defered.promise;

    $http({
          method: 'POST',
          url: baseUrl+'/regis',
          data : data
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
  this.login = function(data){
    var defered = $q.defer();
     var promise = defered.promise;

     $http({
         method: 'POST',
         url: baseUrl+'/sign',
         data : data
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

function apiResourceProvider(){
	var _baseUrl;
  this.setBaseUrl=function(baseUrl) {
    _baseUrl=baseUrl;
  }
  this.$get=['$http','$q',function($http,$q) {
    return new ApiResource($http,_baseUrl,$q);
  }];
}

app.provider("apiResource",apiResourceProvider);
app.constant("baseUrl", "http://localhost/facturaDigital/rest.php");

/*--------------------------------
/* Modal Resource Load
/*-------------------------------*/

function modalResource($modal,size){
  this.modalLoad = function(){
    var modalInstance =  $modal.open({
      templateUrl: 'templates/template.html',
      size: size,
      backdrop: 'static',
      keyboard: false
    });

    return modalInstance;
  }

  this.modalAviso = function(){
    var modalInstance =  $modal.open({
      templateUrl: 'templates/templateLogin.html',
      size: size
      //backdrop: 'static',
      //keyboard: false
    });

    return modalInstance;
  }

}

function modalResourceProvider(){
  var _size;
  this.setSize=function(size) {
    _size=size;
  }
  this.$get=['$modal',function($modal) {
    return new modalResource($modal,_size);
  }];
}

app.provider("modalResource",modalResourceProvider);
app.constant("size", "sm");

/*app.directive('focus', function () {
    return {
        restrict: 'A',
        link: function ($scope, elem, attrs) {

            elem.bind('keydown', function (e) {
                elem.next()[0].focus();
            });
        }
    }
});*/

/*-------------------
/* App configuration
/*------------------*/

app.config(['baseUrl', 'apiResourceProvider','modalResourceProvider','size',function(baseUrl, apiResourceProvider,modalResourceProvider,size) {
    apiResourceProvider.setBaseUrl(baseUrl);
    modalResourceProvider.setSize(size);
}]);

app.controller("employessController", ['$window','$scope', '$timeout','apiResource','modalResource',function($window,$scope,$timeout, apiResource,modalResource) {
  
  $scope.datosEmpleado = {
      cedula: null ,
      nombre: "" ,
      primApe: "",
      segApe: "",
      direcciones:"",
      telefono:"",
      correo: "yo@ejemplo.com",
      fechaInicio:null,
      fechaFin:null,
      pass:""
    };

    $scope.registrar = function(){
    var showModal = modalResource.modalLoad();
    $scope.tam = {
      width : '100%',
    }
      $timeout(function(){
        apiResource.insert($scope.datosEmpleado).then(function(msj){
          showModal.close();
          $scope.msj = msj;
          $window.location.href = '../portal/genKeyPage.php?registro='+$scope.msj.data.numeroRegistro;          
        }, function(msj){
          showModal.close();                    
          $scope.msj = msj;
        });
      },1500);
      
    };

    $scope.datosLogin = {
      numeroRegistro: "",
      pass : ""
    };

    $scope.login = function(){
    var showModal = modalResource.modalLoad();    
    $scope.tam = {
      width : '100%',
    }
     $timeout(function(){
        apiResource.login($scope.datosLogin).then(function(msj){
          showModal.close();
          $window.location.href = '../portal/showFacturas.html';          
          $scope.msj = msj;
        }, function(msj){
          showModal.close();
          var showModal2 = modalResource.modalAviso();
            $scope.tam = {
            width : '100%',
          }           
          $scope.msj = msj;
        });
     },1500); 

      
    
    }

  }
]);
