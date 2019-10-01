var Utils = require('./utils');
var $ = require('jquery');

var ACTIVE_CLASS = 'visible',
    POPUP_CLASSES = 'fb-modal-wrapper modal--popup',
    DEFAULT_CLASSES = 'fb-modal-wrapper modal--default';

var $modalContainer,
    $modal,
    $countryHover;

function _load(modalParams, modalClasses, cb) {
  var loadPath = 'index.php?' + modalParams;
  closeHoverPopup();

  if ($modal.length === 0) {
    $modal = $('<div id="fb-modal" class="' + modalClasses + '" />').appendTo($modalContainer);
  } else {
    $modal.removeAttr('class').addClass(modalClasses);
  }

  openAndLoad($modal, loadPath, cb);
}

function closeHoverPopup(event) {
  if (event) {
    event.preventDefault();
  }

  $countryHover.removeClass(ACTIVE_CLASS);
}

function openAndLoad($modal, loadPath, cb) {
  Utils.loadComponent($modal, loadPath, function() {
    if (typeof cb === 'function') {
      cb();
    }
    $modal.addClass(ACTIVE_CLASS);
  });
}

function init() {
  $modal = $('#fb-modal');
  $modalContainer = $('#fb-main-content');
  $countryHover = $('#fb-country-popup');

  $('body').on('click', '.js-close-modal', close);
}

function close(event) {
  if (event) {
    event.preventDefault();
  }

  $('div[id^="fb-modal"]').removeClass(ACTIVE_CLASS);
}

/**
 * there are two types of modals - default and popup. The
 *  default modal takes up a full page, while the poup modal
 *  creates a popup box for content. Both of these wrapper
 *  functions take the same parameters.
 */

function load(modalName, className, cb) {
  var modalClasses = DEFAULT_CLASSES + ' modal--' + className;
  _load(modalName, modalClasses, cb);
}

function loadPopup(modalParams, className, cb) {
  var modalClasses = POPUP_CLASSES + ' modal--' + className;
  _load(modalParams, modalClasses, cb);
}

/**
 * create a persistent modal. This is used to build a modal
 *  that is very specific, and should be loaded as quickly
 *  as possible after initially loaded, like the command line
 *  modal.
 */
function loadPersistent(modalParams, id, cb) {
  var loadPath = 'index.php?' + modalParams,
      modalId = 'fb-modal-persistent--' + id,
      $modal = $(modalId);

  if ($modal.length === 0) {
    $modal = $('<div id="' + modalId + '" class="' + POPUP_CLASSES + '" />').appendTo($modalContainer);
  }
  Utils.loadComponent($modal, loadPath, cb);
}

function openPersistent(id) {
  var modalId = '#fb-modal-persistent--' + id;
  $(modalId).addClass(ACTIVE_CLASS);
}

function countryHoverPopup(cb) {
  var loadPath = 'index.php?p=country&modal=popup';
  if ($countryHover.length === 0) {
    $countryHover = $('<div id="fb-country-popup" class="fb-popup-content popup--hover fb-section-border" />').appendTo($modalContainer);
  }
  openAndLoad($countryHover, loadPath, cb);
}

function countryInactiveHoverPopup(cb) {
  var loadPath = 'index.php?p=country&modal=inactive';
  if ($countryHover.length === 0) {
    $countryHover = $('<div id="fb-country-popup" class="fb-popup-content popup--hover fb-section-border" />').appendTo($modalContainer);
  }
  openAndLoad($countryHover, loadPath, cb);
}

function viewmodePopup(cb) {
  var loadPath = 'index.php?p=country&modal=viewmode';
  if ($countryHover.length === 0) {
    $countryHover = $('<div id="fb-country-popup" class="fb-popup-content popup--view-only" />').appendTo($modalContainer);
  }

  openAndLoad($countryHover, loadPath, cb);
}

module.exports = {
  init: init,
  // loads the basic modal
  load: load,
  // loads a persistent modal
  loadPersistent: loadPersistent,
  // open a persistent modal
  openPersistent: openPersistent,
  // load a popup modal
  loadPopup: loadPopup,
  // load and show the popup modal for a country hover
  countryHoverPopup: countryHoverPopup,
  // load and show the popup modal for an inactive country hover
  countryInactiveHoverPopup: countryInactiveHoverPopup,
  // load and show the view only country info
  viewmodePopup: viewmodePopup,
  // close the popup modal for a country hover
  closeHoverPopup: closeHoverPopup,
  // close the regular modal
  close: close
};
