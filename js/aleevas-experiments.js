
(function ($, Drupal, drupalSettings) {

  "use strict";

  Drupal.behaviors.helloworld = {
    attach: function (context) {
      console.log('Hello World!');
    }
  }

})(jQuery, Drupal, drupalSettings);