(function ($, Drupal, drupalSettings) {
  'use strict';

  Drupal.behaviors.modal_form = {
    attach: function (context, settings) {
      var frontpageModal = Drupal.dialog('<div>Modal content</div>', {
        title: 'Modal on frontpage',
        dialogClass: 'front-modal',
        width: 500,
        height: 400,
        autoResize: true,
        close: function (event) {
          $(event.target).remove();
        },
        buttons: [
          {
            text: 'Make some code',
            class: 'love-class',
            icons: {
              primary: 'ui-icon-heart'
            },
            click: function () {
              $(this).html('Here is some code should be');
            }
          },
          {
            text: 'Close the window',
            icons: {
              primary: 'ui-icon-close'
            },
            click: function () {
              $(this).dialog('close');
            }
          }
        ]
      });
      // With overlay.
      frontpageModal.showModal();
      // Without overlay.
      // frontpageModal.show();
      }
  }
}(jQuery, Drupal, drupalSettings));
