// Copyright 2009 Google Inc.  All Rights Reserved.

/**
 * @fileoverview  Provides functions for Google mobile pages.
 * @author  jeremydw@google.com (Jeremy Weinstein)
 */


/**
 * Initializes gweb namespace.
 */
var gweb = gweb || {};


/**
 * Initializes gweb.mobile namespace.
 */
gweb.mobile = gweb.mobile || function() {};


/**
 * Sets the DC in the cookie if it finds it in the hash.
 * Returns the DC from either the hash or the cookie.
 * @return {string} The DC from the hash or cookie or null.
 */
gweb.mobile.prototype.getDcFromHashOrCookie = function() {
  var hash = document.location.hash;

  if (this.getDcFromCookie()) {
    return this.getDcFromCookie();
  } else if (hash.length > 0) {
    var regex = new RegExp('dc=([^&]*)');
    var results = regex.exec(hash);

    if (results != null) {
      this.setDcInCookie(results[1]);
      return results[1];
    }
  } else {
    return null;
  }
};


/**
 * Sets the DC in the cookie.
 * @param {string} dcToSet The value of the DC to set.
 */
gweb.mobile.prototype.setDcInCookie = function(dcToSet) {
  var expiry = new Date();

  expiry.setTime(expiry.getTime() + (24 * 60 * 60 * 1000));
  document.cookie = 'dc=' + dcToSet + ';expires=' + expiry.toGMTString();
};


/**
 * Returns the DC from the cookie.
 * @return {string} The value of the DC from the cookie or null.
 */
gweb.mobile.prototype.getDcFromCookie = function() {
  var allcookies = document.cookie;
  var dcParamIndex = allcookies.indexOf('dc=');

  if (dcParamIndex != -1) {
    var dcValueIndex = dcParamIndex + 3;
    var dcValueEnd = allcookies.indexOf(';', dcValueIndex);

    if (dcValueEnd == -1) {
      dcValueEnd = allcookies.length;
    }
    return allcookies.substring(dcValueIndex, dcValueEnd);
  }
};


/**
 * Initializes gweb.mobile.browserDetect method.
 * @constructor
 */
gweb.mobile.browserDetect = function() {
  this.userAgent = navigator.userAgent.toLowerCase();
  this.agentStatus = this.isMobileDevice(this.userAgent);
};


/**
 * A list of certain mobile user agents.
 * @type {list}
 */
gweb.mobile.browserDetect.CERTAIN_MOBILE_AGENTS = [
  'midp',
  '240x320',
  'blackberry',
  'netfront',
  'nokia',
  'panasonic',
  'portalmmm',
  'sharp',
  'sie-',
  'sonyericsson',
  'symbian',
  'windows ce',
  'benq',
  'mda',
  'mot-',
  'opera mini',
  'philips',
  'pocket pc',
  'sagem',
  'samsung',
  'sda',
  'sgh-',
  'vodafone',
  'xda',
  'iphone',
  'android'
];


/**
 * A list of possible mobile user agents.
 * @type {list}
 */
gweb.mobile.browserDetect.POSSIBLE_MOBILE_AGENTS = [
  'opera'
];


/**
 * @return {number} 0 if not a mobile device. 1 if certain mobile device. 2 if
 *     possible mobile device.
 */
gweb.mobile.browserDetect.prototype.isMobileDevice = function() {
  for (var i = 0; i < gweb.mobile.browserDetect.CERTAIN_MOBILE_AGENTS.length;
      i++) {
    if (this.userAgent.indexOf(gweb.mobile.browserDetect.
        CERTAIN_MOBILE_AGENTS[i]) != -1) {
      return 1;
    }
  }

  for (var i = 0; i < gweb.mobile.browserDetect.POSSIBLE_MOBILE_AGENTS.length;
      i++) {
    if (this.userAgent.indexOf(gweb.mobile.browserDetect.
        POSSIBLE_MOBILE_AGENTS[i]) != -1) {
      return 2;
    }
  }

  return 0;
};
