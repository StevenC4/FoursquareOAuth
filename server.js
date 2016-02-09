var express = require('express');
var path = require('path');
var port = 3001;

require("node-jsx").install();

var app = express();

app.use(express.static(path.join(__dirname, 'public')));
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

require('./app/routes/core-routes.js')(app);

app.listen(port, function() {
  console.log("Express server listening on port: " + port);
});
