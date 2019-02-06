routes = [
  {
    path: '/',
    url: './index.html',
  },
  {
    path: '/inicial/',
    url: './pages/pagina-inicial.html',
  },
  {
    path: '/unidades/',
    async: function (routeTo, routeFrom, resolve, reject) {
      app.preloader.show();
      app.request.get(app.data.baseUrl + '/unidades', function (data) {
        var response = JSON.parse(data);
        
        if (response.status === 100) {
          resolve(
            {
              componentUrl: './pages/unidades.html'
            },
            {
              context: {
                unidades: response.unidade,
              },
            }
          );
        } else {
          app.dialog.alert("Erro: " + response.status + "\n" + response.message);
        }
        
        app.preloader.hide();
      });
    }
  },
  {
    path: '/formulario/:id/',
    async: function (routeTo, routeFrom, resolve, reject) {
      var id = routeTo.params.id;

      app.preloader.show();
      app.request.get(app.data.baseUrl + '/unidades/' + id, function (data) {
        var response = JSON.parse(data);

        if (response.status === 100) {
          resolve(
            {
              componentUrl: './pages/form-inscricao.html'
            },
            {
              context: {
                unidades: response.unidade,
                periodo: app.data.periodo
              },
            }
          );
        } else {
          app.dialog.alert("Erro: " + response.status + "\n" + response.message);
        }

        
        app.preloader.hide();
      });
    }
  },
  // Default route (404 page). MUST BE THE LAST
  {
    path: '(.*)',
    url: './pages/404.html',
  },
];
