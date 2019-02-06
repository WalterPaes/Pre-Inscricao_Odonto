// Dom7
var $$ = Dom7;

// Framework7 App main instance
var app  = new Framework7({
  root: '#app', // App root element
  id: 'io.framework7.testapp', // App bundle ID
  name: 'Framework7', // App name
  theme: 'auto', // Automatic theme detection
  // App root dat
  data: function () {
    return {
      baseUrl: "http://localhost/preinscricao/api/index.php",
      periodo: null
    };
  },
  // App root methods
  methods: {
  },
  // App routes
  routes: routes,
});

// Init/Create main view
var mainView = app.views.create('.view-main', {
  url: '/'
});

app.init(
  // Consultar a data e o horário -> Redirecionar para página inicial
  app.request.get(app.data.baseUrl + '/periodo', function (data) {
    app.preloader.show();
    
    var response = JSON.parse(data);
    if (response.status === 100) {
      app.data.periodo = 1;
      app.router.navigate('/inicial/')
    }

    app.preloader.hide();
  })
);