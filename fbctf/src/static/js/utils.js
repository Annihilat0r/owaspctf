var $ = require('jquery');

module.exports = {
  getURLParameter: function(name) {
    // eslint-disable-next-line no-sparse-arrays
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || null;
  },

  /**
   * load a component into a target on the site
   *
   * @param target (string)
   *   - selector to select where to load the content
   *
   * @param component (string)
   *   - the name of the component to load
   *
   * @param cb (function)
   *   - callback function for when the load is successful
   */
  loadComponent: function(target, component, cb) {
    var $target = typeof target === 'object' ? target : $(target);

    $target.load(component, function(response, status) {
      if (status === "error") {
        console.error("There was a problem loading the component:");
        console.log("target: " + target);
        console.log("component: " + component);
        console.error("/end error");
      } else {
        // Fire the "content-loaded" event to initialize any dynamic content
        // that is in the loaded content
        $('body').trigger('content-loaded', {
          component: component
        });

        if (typeof cb === 'function') {
          cb();
        }
      }
    });
  }
};
