var system  = require('system');
var cookie_domain=system.args[4];
var domain="http://"+cookie_domain;
//var url=domain+"/"+system.args[4];
var url=system.args[6];
var cookie=system.args[5];
//console.log('0:'+system.args[0]);
//console.log('1:'+system.args[1]);
//console.log('2:'+system.args[2]);
//console.log('3:'+system.args[3]);
//console.log('4:'+system.args[4]);
//console.log('5:'+system.args[5]);
//console.log('6:'+system.args[6]);

//console.log('URL:'+url);
//console.log('cookie_domain:'+url);
//console.log('cookie_domain:'+system.args[5]);
//console.log('cookie:'+system.args[6]);

phantom.addCookie({
  'name'     : 'FLAG',
  'value'    : cookie,
  'domain'   : cookie_domain,
  'path'     : '/',
  'httponly' : false,
  'secure'   : false,
  'expires'  : (new Date()).getTime() + (1000 * 60 * 60 * 365)
});

var casper = require('casper').create({
    verbose: true,
    logLevel: 'debug',
    pageSettings: {
        loadImages:  true,
        loadPlugins: true,
        userAgent: 'Bot #1'
    }
});

casper.start(url, function() {

});

casper.run(function() {
this.echo(this.page.content);
    this.exit();
});
