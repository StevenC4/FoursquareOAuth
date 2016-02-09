var React = require('react/addons');
var Header = require('./Header.js');

var ReactApp = React.createClass({
      render: function () {
        return (
          <div id="react-app">
	    <Header />
          </div>
        )
      }
  });

module.exports = ReactApp;
