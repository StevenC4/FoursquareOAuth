var React = require('react/addons'),
ReactApp = React.createFactory(require('../components/ReactApp'));

module.exports = function(app) {
  app.get('/', function(req, res) {
    var reactHtml = React.renderToString(ReactApp({}));
    res.render('index.ejs', {reactOutput: reactHtml});
  }),
  app.get('/home', function(req, res) {
    var reactHtml = React.renderToString(ReactApp({}));
    res.render('home.ejs', {reactOutput: reactHtml})
  });
};
