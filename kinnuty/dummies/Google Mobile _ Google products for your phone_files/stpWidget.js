// Copyright 2009 Google Inc.  All Rights Reserved.

/**
 * @fileoverview  One Send-to-Phone widget to rule them all.
 *     Initializes the Send-to-Phone AJAX client and provides an
 *     interface for the STP Response Handler to modify UI elements.
 * @supported  This code runs on IE6+, FF2+, Safari3+.
 * @author  jeremydw@google.com (Jeremy Weinstein)
 */

/**
 * Initializes the goog namespace.
 */
var goog = goog || {};


/**
 * Initializes the goog.mobile namespace.
 */
goog.mobile = goog.mobile || {};


/**
 * Initializes the goog.mobile.StpWidget object.
 */
goog.mobile.StpWidget = goog.mobile.StpWidget || {};


/**
 * Constructor for a Send-to-Phone UI widget that connects to a
 *     Send-To-Phone client and a Send-To-Phone response handler.
 * @param {Object} config  An object containing configuration properties.
 * @constructor
 * @extends goog.mobile.SendToPhoneClient
 * @extends goog.mobile.StpResponseHandler
 */
goog.mobile.StpWidget = function(config) {
  if (this.isNotMissingRequiredParams(config)) {
    if (this.initElements(config)) {
      this.stp = this.stp || new goog.mobile.SendToPhoneClient(
          new goog.mobile.StpResponseHandler(this), this);
    }
  }
};


/**
 * Checks to make sure the config object contains all required parameters.
 * @param {Object} config  An object containing configuration properties.
 * @return {bool}  True if passes the validation.
 */
goog.mobile.StpWidget.prototype.isNotMissingRequiredParams = function(config) {
  var requiredParams = [
    'stpWidgetEl',
    'formEl',
    'actionButtonEl',
    'carriersWindowEl',
    'errorWindowEl',
    'errorMessageEl',
    'successWindowEl',
    'captchaWindowEl',
    'captchaMessageEl',
    'stpNumberEl',
    'messageText',
    'messageHash'
  ];

  for (var i = 0; i < requiredParams.length; i++) {
    var param = requiredParams[i];

    if (!config[param]) {
      return false;
    }
  }
  return true;
};


/**
 * Initializes the form elements for the Send-to-Phone widget.
 * @param {Object} config  The configuration object for the STP widget.
 * @return {boolean}  False if fails to init.
 */
goog.mobile.StpWidget.prototype.initElements = function(config) {

  this.config = config;

  this.showExampleNumberFlag = config.showExampleNumberFlag || false;
  this.numberPrefixEl = config.numberPrefixEl || null;
  this.trackerId = config.trackerId || null;
  this.adwordsLabel = config.adwordsLabel || null;
  this.adwordsId = config.adwordsId || null;

  this.landingHook = config.landingHook || null;
  this.submitHook = config.submitHook || null;
  this.successHook = config.successHook || null;
  this.errorHook = config.errorHook || null;
  this.captchaHook = config.captchaHook || null;
  this.waitForAttemptBeforeCaptcha = config.waitForAttemptBeforeCaptcha ||
      false;
  this.countryChangeHook = config.countryChangeHook || null;

  this.hasChangedInitialValue = true;

  this.formEl = document.getElementById(config.formEl);
  this.formEl.onsubmit = this.createSubmitHandler(this);
  this.actionButtonEl = document.getElementById(config.actionButtonEl);
  this.actionButtonEl.onclick = this.createPostHandler(this);
  this.hideAfterSubmitFlag = config.hideAfterSubmitFlag ? true : false;
  this.showCountryOnClickFlag = config.showCountryOnClickFlag ? true :
      false;

  this.stpNumberEl = document.getElementById(config.stpNumberEl);
  this.stpNumberEl.name = 'mobile_user_id';
  this.stpNumberEl.onclick = this.createReplaceOnceHandler(this);

  this.errorWindowEl = document.getElementById(config.errorWindowEl);
  this.errorMessageEl = document.getElementById(config.errorMessageEl);
  this.successWindowEl = document.getElementById(config.successWindowEl);
  this.carriersWindowEl = document.getElementById(config.carriersWindowEl);

  this.createRequiredHiddenElement('client', 'ajax');
  this.createRequiredHiddenElement('ec', 'on');
  this.createRequiredHiddenElement('c', '1');
  this.createHiddenElement('source');
  this.createHiddenElement('from');
  this.createHiddenElement('sender_ph');

  this.createHiddenElement('h'),
      this.messageTextEl = this.createHiddenElement('text');

  this.countryWindowEl = document.getElementById(config.countryWindowEl);
  this.languageDefault = config.languageDefault || 'en';
  this.countryDefault = config.countryDefault || 'us';

  this.hlEl = this.createRequiredHiddenElement('hl', config.languageDefault);
  this.glEl = this.createRequiredHiddenElement('gl', config.countryDefault);

  this.tryAgainEl = document.getElementById(config.tryAgainEl);
  if (this.tryAgainEl) {
    this.tryAgainEl.onclick = this.createTryAgainHandler(this);
  }

  this.captchaWindowEl = document.getElementById(config.captchaWindowEl);
  this.encryptedCaptchaAnswerEl =
      this.createHiddenElement('encrypted_captcha_answer');
  this.captchaMessageEl = document.getElementById(config.captchaMessageEl);
  this.captchaAnswerEl = this.captchaWindowEl.getElementsByTagName('input')[0];
  this.captchaAnswerEl.name = 'user_captcha_answer';
  this.captchaImageEl = this.captchaWindowEl.getElementsByTagName('img')[0];

  if (typeof(this.captchaAnswerEl) == 'undefined' || typeof(this.
      captchaImageEl) == 'undefined') {
    return false;
  }

  this.validCountries = config.validCountries || this.defaultValidCountries;

  this.setMessage(config.messageText, config.messageHash);
  this.defaultDc = config.dc || null;
  this.originalTextValue = this.stpNumberEl.value;

  if (this.defaultDc) {
    this.initDc();
  }

  if (config.countrySelectorEl) {
    this.countrySelectorEl = document.getElementById(config.countrySelectorEl);
    this.createCountrySelector();
    this.changeSelectedCountry();
  }
  if (config.numberPrefixEl) {
    this.numberPrefixEl = document.getElementById(config.numberPrefixEl);
    this.setNumberPrefix();
  }

};


/**
 * Creates a handler to perform actions on form blur.
 * @param {goog.mobile.StpWidget} me  The STP widget.
 * @return {function}  The handler function.
 */
goog.mobile.StpWidget.prototype.createBlurHandler = function(me) {
  return function() {
    if (!this.countryWindowEl) {
      hide(me.countrySelectorEl);
    } else {
      hide(me.countryWindowEl);
    }
  };
};


/**
 * Creates a handler to perform actions on text box click.
 * @param {goog.mobile.StpWidget} me  The STP widget.
 * @return {function}  The handler function.
 */
goog.mobile.StpWidget.prototype.createReplaceOnceHandler = function(me) {
  return function() {
    if (me.showCountryOnClickFlag) {
      if (!this.countryWindowEl) {
        display(me.countrySelectorEl);
      } else {
        display(me.countryWindowEl);
      }
    }
    if (me.alreadyReplaced != true) {
      me.stpNumberEl.value = '';
      me.alreadyReplaced = true;
    }
  };
};


/**
 * Creates a handler to call the stp object post method.
 * @param {goog.mobile.StpWidget} me  The STP widget.
 * @return {function}  The handler function.
 */
goog.mobile.StpWidget.prototype.createPostHandler = function(me) {
  return function() {
    me.stp.post();
  };
};


/**
 * Creates a handler for the form's submission.
 * @param {goog.mobile.StpWidget} me  The STP widget.
 * @return {boolean}  False so the form doesn't move the page.
 */
goog.mobile.StpWidget.prototype.createSubmitHandler = function(me) {
  return function() {
    return false;
  };
};


/**
 * Creates a handler to hide the success window, display the form.
 * @param {goog.mobile.StpWidget} me  The STP widget.
 * @return {function}  The handler function.
 */
goog.mobile.StpWidget.prototype.createTryAgainHandler = function(me) {
  return function() {
    me.changeSelectedCountry();
    hide(me.successWindowEl);
    display(me.formEl);
  };
};


/**
 * Creates a handler to hide the country window, display the country
 *   selector.
 * @param {goog.mobile.StpWidget} me  The STP widget.
 * @return {function}  The handler function.
 */
goog.mobile.StpWidget.prototype.createHideAndDisplayHandler = function(me) {
  return function() {
    hide(me.countryWindowEl);
    display(me.countrySelectorEl);
  };
};


/**
 * Creates a handler to perform country-specific initialization.
 * @param {goog.mobile.StpWidget} me  The STP widget.
 * @return {function}  The handler function.
 */
goog.mobile.StpWidget.prototype.createChangeSelectedCountryHandler =
    function(me) {
  return function() {
    me.changeSelectedCountry();
  };
};


/**
 * Sets the input value for the message text and message hash.
 * @param {string} messageText  The message text.
 * @param {string} messageHash  The message hash.
 */
goog.mobile.StpWidget.prototype.setMessage =
    function(messageText, messageHash) {
  this.inputs = this.formEl.getElementsByTagName('input');
  for (var i = 0; i < this.inputs.length; i++) {
    switch (this.inputs[i].name) {
      case 'text':
        this.inputs[i].value = messageText;
        break;
      case 'h':
        this.inputs[i].value = messageHash;
        break;
    }
  }
};


/**
 * Replaces '[dc]' in the text string with the provided DC.
 * @param {string} newDc  The distribution channel code to set.
 */
goog.mobile.StpWidget.prototype.setDcInForm = function(newDc) {
  this.messageTextEl.value = this.messageTextEl.value.replace('[dc]', newDc);
};


/**
 * Checks for a DC code in the hash. If one is found, it sets the DC code
 *    in the form and in the cookie. If nothing is found in the hash, checks
 *    for a DC code in the cookie and sets the form. If a DC code isn't found
 *    in the hash or the cookie, it sets the default DC provided by the page.
 */
goog.mobile.StpWidget.prototype.initDc = function() {
  var hash = document.location.hash;

  if (hash.length) {
    var regex = new RegExp('dc=([^&]*)');
    var results = regex.exec(hash);

    if (results != null) {
      this.setDcInForm(results[1]);
      this.setDcInCookie(results[1]);
    } else {
      this.setDcInForm(this.defaultDc);
    }
  } else if (this.getDcFromCookie()) {
    this.setDcInForm(this.getDcFromCookie());
  } else {
    this.setDcInForm(this.defaultDc);
  }

};


/**
 * Sets the DC in the cookie.
 */
goog.mobile.StpWidget.prototype.setDcInCookie = function() {
  var expiry = new Date();

  expiry.setTime(expiry.getTime() + (24 * 60 * 60 * 1000));
  document.cookie = 'dc=' + this.dc + ';expires=' + expiry.toGMTString() +
      ';path=googstp;';
};


/**
 * Determines the DC from the cookie, or null if the dc is not present
 *     in the cookie.
 * @return {string||null}  The DC or null.
 */
goog.mobile.StpWidget.prototype.getDcFromCookie = function() {
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
 * This function is invoked on page load and on country selection. Sets
 *     the hidden form elements to the right values based on the validCountries
 *     object. Also hides the number selector and creates a new SendToPhone
 *     client, sending the new hl and gl parameters.
 */
goog.mobile.StpWidget.prototype.changeSelectedCountry = function() {

  var selectedCountry = this.countrySelectorEl.value || this.countryDefault;

  if (this.countryChangeHook) {
    this.countryChangeHook();
  }

  if (this.countryWindowEl) {
    this.countryWindowEl.getElementsByTagName('span')[0].innerHTML = this.
      getCountryInfo(selectedCountry, 'name');
    if (!this.showCountryOnClickFlag) {
      display(this.countryWindowEl);
      hide(this.countrySelectorEl);
    }
  }
  if (typeof(this.countrySelectorEl) != 'undefined') {
    if (this.showExampleNumberFlag && !this.numberPrefixEl && this.
        hasChangedInitialValue) {
      this.stpNumberEl.value = '+' + this.getCountryInfo(selectedCountry,
          'prefix') + ' ' + this.getCountryInfo(selectedCountry, 'example');
    } else if (this.showExampleNumberFlag && this.hasChangedInitialValue) {
      this.stpNumberEl.value = this.getCountryInfo(selectedCountry, 'example');
    }
  }
  this.hasChangedInitialValue = true;
  this.alreadyReplaced = false;
  this.glEl.value = this.getCountryInfo(selectedCountry, 'gl');
  // this.hlEl.value = this.getCountryInfo(selectedCountry, 'hl');
  hide(this.captchaWindowEl);
  // hide(this.errorWindowEl);
  this.setNumberPrefix();
  this.responseHandler = new goog.mobile.StpResponseHandler(this);
  this.stp = new goog.mobile.SendToPhoneClient(this.responseHandler, this);

};


/**
 * Sets the innerHTML attribute of the numberPrefix div to the numberPrefix
 *     from the valid countries array.
 */
goog.mobile.StpWidget.prototype.setNumberPrefix = function() {
  if (this.numberPrefixEl) {
    this.numberPrefixEl.innerHTML = '+' + this.
        getCountryInfo(this.glEl.value, 'prefix');
  }
};


/**
 * Gets information about a country from the validCountries object.
 * @param {string} gl  The gl value of the country.
 * @param {enum} item  Valid options: {name, prefix, hl, example, gl}.
 * @return {string}  The corresponding value of the validCountries object.
 */
goog.mobile.StpWidget.prototype.getCountryInfo = function(gl, item) {
  if (this.validCountries[gl]) {
    switch (item) {
      case 'gl':
        return this.validCountries[gl][0];
      case 'name':
        return this.validCountries[gl][1];
      case 'prefix':
        return this.validCountries[gl][2];
      case 'hl':
        return this.validCountries[gl][3];
      case 'example':
        return this.validCountries[gl][4];
    }
  }
};


/**
 * Array containing the list of valid countries.
 *     The format is: [{country gl}, {human readable name},
 *     {page hl}, {example number}]
 */
goog.mobile.StpWidget.prototype.defaultValidCountries = {
 'au': ['au', 'Australia', '61', 'en', 'xxxx-xxx-xxx'],
 'ar': ['ar', 'Argentina', '54', 'en', 'xxx-xxx-xxxx'],
 'at': ['at', 'Austria', '43', 'en', 'xxx-xxx-xxxx'],
 'bd': ['bd', 'Bangladesh', '880', 'en', 'xxx-xxx-xxxx'],
 'be': ['be', 'Belgium', '32', 'en', 'xxx-xxx-xxxx'],
 'bg': ['bg', 'Bulgaria', '359', 'en', 'xxx-xxx-xxxx'],
 'br': ['br', 'Brazil', '55', 'en', 'xxx-xxx-xxxx'],
 'ca': ['ca', 'Canada', '1', 'en', 'xxx-xxx-xxxx'],
 'cl': ['cl', 'Chile', '56', 'en', 'xxx-xxx-xxxx'],
 'cn': ['cn', 'China', '86', 'en', 'xxx-xxx-xxxx'],
 'co': ['co', 'Colobia', '57', 'en', 'xxx-xxx-xxxx'],
 'hr': ['hr', 'Croatia', '385', 'en', 'xxx-xxx-xxxx'],
 'cz': ['cz', 'Czech Republic', '420', 'en', 'xxx-xxx-xxxx'],
 'de': ['de', 'Germany', '49', 'en', 'xxx-xxx-xxxx'],
 'dk': ['dk', 'Denmark', '45', 'en', 'xxx-xxx-xxxx'],
 'eg': ['eg', 'Egypt', '20', 'en', 'xxx-xxx-xxxx'],
 'fi': ['fi', 'Finland', '358', 'en', 'xxx-xxx-xxxx'],
 'fr': ['fr', 'France', '33', 'en', 'xxx-xxx-xxxx'],
 'hk': ['hk', 'Hong Kong', '852', 'en', 'xxx-xxx-xxxx'],
 'hu': ['hu', 'Hungary', '36', 'en', 'xxx-xxx-xxxx'],
 'id': ['id', 'Indonesia', '62', 'en', 'xxx-xxx-xxxx'],
 'ie': ['ie', 'Ireland', '353', 'en', 'xxx-xxx-xxxx'],
 'il': ['il', 'Israel', '972', 'en', 'xxx-xxx-xxxx'],
 'in': ['in', 'India', '91', 'en', 'xxx-xxx-xxxx'],
 'it': ['it', 'Italy', '39', 'en', 'xxx-xxx-xxxx'],
 'jp': ['jp', 'Japan', '00', 'en', 'xxx-xxx-xxxx'],
 'li': ['li', 'Liechtenstein', '423', 'en', 'xxx-xxx-xxxx'],
 'ke': ['ke', 'Kenya', '254', 'en', 'xxx-xxx-xxxx'],
 'ma': ['ma', 'Morocco', '212', 'en', 'xxx-xxx-xxxx'],
 'mx': ['mx', 'Mexico', '52', 'es', 'xxx-xxx-xxxx'],
 'my': ['my', 'Malaysia', '60', 'en', 'xxx-xxx-xxxx'],
 'nl': ['nl', 'Netherlands', '31', 'en', 'xxx-xxx-xxxx'],
 'no': ['no', 'Norway', '47', 'en', 'xxx-xxx-xxxx'],
 'nz': ['nz', 'New Zealand', '64', 'en', 'xxx-xxx-xxxx'],
 'pe': ['pe', 'Peru', '51', 'en', 'xxx-xxx-xxxx'],
 'ph': ['ph', 'Phillipines', '63', 'en', 'xxx-xxx-xxxx'],
 'pk': ['pk', 'Pakistan', '92', 'en', 'xxx-xxx-xxxx'],
 'pl': ['pl', 'Poland', '48', 'en', 'xxx-xxx-xxxx'],
 'pt': ['pt', 'Portugal', '351', 'en', 'xxx-xxx-xxxx'],
 'ro': ['ro', 'Romania', '40', 'en', 'xxx-xxx-xxxx'],
 'ru': ['ru', 'Russia', '7', 'ru', 'xxx-xxx-xxxx'],
 'sa': ['sa', 'Saudi Arabia', '966', 'en', 'xxx-xxx-xxxx'],
 'sg': ['sg', 'Singapore', '65', 'en', 'xxx-xxx-xxxx'],
 'es': ['es', 'Spain', '34', 'en', 'xxx-xxx-xxxx'],
 'lk': ['lk', 'Sri Lanka', '94', 'en', 'xxx-xxx-xxxx'],
 'se': ['se', 'Sweden', '46', 'en', 'xxx-xxx-xxxx'],
 'ch': ['ch', 'Switzerland', '41', 'en', 'xxx-xxx-xxxx'],
 'tw': ['tw', 'Taiwan', '886', 'en', 'xxx-xxx-xxxx'],
 'gb': ['gb', 'United Kingdom', '44', 'en', 'xxx-xxx-xxxx'],
 'us': ['us', 'United States', '1', 'en', 'xxx-xxx-xxxx'],
 'za': ['za', 'South Africa', '27', 'en', 'xxx-xxx-xxxx']
};


/**
 * Creates a select input field based on the valid countries object.
 */
goog.mobile.StpWidget.prototype.createCountrySelector = function() {
  for (var i in this.validCountries) {
    this.optionEl = document.createElement('option');
    this.optionEl.value = this.validCountries[i][0];
    this.optionEl.innerHTML = this.
        getCountryInfo(this.validCountries[i][0], 'name');
    if (this.validCountries[i][0] == this.glEl.value) {
      this.optionEl.selected = 'selected';
    }
    this.countrySelectorEl.appendChild(this.optionEl);
    this.countrySelectorEl.onchange = this.
        createChangeSelectedCountryHandler(this);
  }
  if (this.countryWindowEl) {
    this.countryWindowEl.getElementsByTagName('span')[0].innerHTML = this.
        getCountryInfo(this.countrySelectorEl.value, 'name');
    this.countryWindowEl.getElementsByTagName('a')[0].href =
        'javascript: void 0';
    this.countryWindowEl.getElementsByTagName('a')[0].onclick = this.
        createHideAndDisplayHandler(this);
  }
};


/**
 * Creates a hidden form elements.
 * @param {string} name  The name of of the hidden input field to create.
 * @return {object}  The hidden element just created.
 */
goog.mobile.StpWidget.prototype.createHiddenElement = function(name) {
  this.hiddenEl = document.createElement('input');
  this.hiddenEl.name = name;
  this.hiddenEl.type = 'hidden';
  this.formEl.appendChild(this.hiddenEl);
  return this.hiddenEl;
};


/**
 * Creates a hidden form element with a specific value.
 * @param {string} name  The name of of the hidden input field to create.
 * @param {string} value  The value of the hidden input field.
 * @return {object}  The hidden element just created.
 */
goog.mobile.StpWidget.prototype.createRequiredHiddenElement = function(name,
    value) {
  this.requiredEl = this.createHiddenElement(name);
  this.requiredEl.name = name;
  this.requiredEl.value = value;
  return this.requiredEl;
};


/**
 * Creates a new client to interact with the UI and the STP Response Handler.
 * @param {goog.mobile.StpResponseHandler} responseHandler  An object of type
 *     goog.mobile.StpResponseHandler.
 * @param {goog.mobile.StpWidget} stpWidget  An StpWidget object.
 * @constructor
 */
goog.mobile.SendToPhoneClient = function(responseHandler, stpWidget) {
  this.stpWidget = stpWidget;
  this.url = '/sendtophone';

  /**
   * The handler that deals with responses from the Send-to-Phone server. Needs
   * to implement onError, onLanding, onSubmit, onSuccess.
   * @type goog.mobile.StpResponseHandler
   */
  this.responseHandler = responseHandler;
  this.get();
};


/**
 * Creates the callback that handles a response from the Send to Phone server
 * and attaches it to the request passed.
 * @param {XMLHttpRequest} request  The request to process.
 * @return {boolean}  True if successful.
 */
goog.mobile.SendToPhoneClient.prototype.makeServiceHandler = function(request) {
  var stp = this;

  request.onreadystatechange = function() {

    /**
    * An Enum of the possible error types that Send to phone can return.
    * @enum {string}
    */
    this.ErrorType = {
      CARRIER: 'stp-error-carrier',
      GENERAL: 'stp-error-general',
      MOBILE_USER_ID: 'stp-error-mobile-user-id',
      TEXT_TO_SEND: 'stp-error-text-to-send'
    };

    if (request.readyState == 4) {
      var response = eval('(' + request.responseText + ')');

      if (response.success) {
        stp.responseHandler.onSuccess();
      } else if (response.errorGeneral) {
        stp.responseHandler.onError(this.ErrorType.GENERAL,
            response.errorGeneralId,
            response.errorGeneral);
      } else if (response.errorMobileUserId) {
        stp.responseHandler.onError(this.ErrorType.MOBILE_USER_ID,
            response.errorMobileUserIdId,
            response.errorMobileUserId);
      } else if (response.errorTextToSend) {
        stp.responseHandler.onError(this.ErrorType.TEXT_TO_SEND,
            response.errorTextToSendId,
            response.errorTextToSend);
      } else if (response.errorCarrier) {
        stp.responseHandler.onError(this.ErrorType.CARRIER,
            response.errorCarrierId,
            response.errorCarrier);
      } else {
        stp.responseHandler.onLanding(stp.createCaptcha(response),
            response.carrier,
            response.mobileUserId);
      }
    }
  };
  return true;
};


/**
 * Makes a GET request to the Send to Phone server.  This request includes
 *     language and locale information obtained from inputs in the document
 *     being processed.
 * @return {boolean}  True on success.
 */
goog.mobile.SendToPhoneClient.prototype.get = function() {
  var request = this.createRequest();
  var url = this.url;

  this.makeServiceHandler(request);
  url += '?client=ajax' + '&hl=' + escape(this.stpWidget.hlEl.value) + '&gl=' +
      escape(this.stpWidget.glEl.value);
  request.open('GET', url, true);
  request.send(null);
  return true;
};


/**
 * Makes a POST request to the Send to Phone server.  The request includes
 *     all input parameters in the document's Send to Phone form.
 * @return {boolean}  False so this event can be attached to a form submit
 *    button and prevent the form being submitted in the usual way.
 */
goog.mobile.SendToPhoneClient.prototype.post = function() {

  var request = this.createRequest();

  this.makeServiceHandler(request);
  var parameters = this.getParameterString();

  request.open('POST', this.url, true);
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.setRequestHeader('Content-length', parameters.length);
  request.setRequestHeader('Connection', 'close');
  request.send(parameters);
  this.responseHandler.onSubmit();
  return false;
};


/**
 * Parses the values of all inputs in the stp-landing form into a query string.
 * @return {string}  The parsed query string.
 */
goog.mobile.SendToPhoneClient.prototype.getParameterString = function() {
  var inputs = this.stpWidget.formEl.getElementsByTagName('input');
  var parameterString = [];
  var selects = this.stpWidget.formEl.getElementsByTagName('select');

  for (var i = 0; i < inputs.length; ++i) {
    parameterString.push(inputs[i].name + '=' +
        window.encodeURIComponent(inputs[i].value));
  }

  for (var i = 0; i < selects.length; ++i) {
    if (selects[i].options.length > 0) {
      parameterString.push(
          selects[i].name + '=' + window.encodeURIComponent(
          selects[i].options[selects[i].selectedIndex].value));
    }
  }
  return parameterString.join('&');
};


/**
 * Creates an XMLHttpRequest.
 * @return {XMLHttpRequest?}  The request that has been created or null if
 *    creation failed.
 */
goog.mobile.SendToPhoneClient.prototype.createRequest = function() {
  try {
    if (typeof ActiveXObject != 'undefined') {
      return new ActiveXObject('Microsoft.XMLHTTP');
    } else if (window.XMLHttpRequest) {
      return new XMLHttpRequest();
    }
  } catch (e) {}
  return null;
};


/**
 * Creates information about any required captcha from the response passed,
 * including the URL of the captcha image, its width, height and any error.
 * @param {Object} response  A Send to Phone JSON response.
 * @return {Object?}   A captcha with properties url, width, height and
 *    error if a captcha is required, null otherwise.
 */
goog.mobile.SendToPhoneClient.prototype.createCaptcha = function(response) {

  if (this.stpWidget.waitForAttemptBeforeCaptcha == true) {
    this.stpWidget.waitForAttemptBeforeCaptcha = false;
    return null;
  } else if (!response.urlCaptcha) {
    return null;
  }

  var captcha = {};

  if (this.stpWidget.captchaHook) {
    this.stpWidget.captchaHook();
  }

  captcha.url = response.urlCaptcha;
  captcha.alt = response.altCaptcha;
  captcha.width = response.captchaWidth;
  captcha.height = response.captchaHeight;
  captcha.error = response.errorCaptcha;
  captcha.encryptedAnswer = response.encrypted_captcha_answer;
  return captcha;
};


/**
 * The default handler for responses from the Send to Phone server.  This
 * manipulates the current document, assuming it has used the ids as specified
 * in the example template.
 * @param {goog.mobile.StpWidget} stpWidget  The STP widget.
 * @constructor
 */
goog.mobile.StpResponseHandler = function(stpWidget) {
  this.stpWidget = stpWidget;
  this.hasLanded = false;
};


/**
 * Checks to see if the form has failed to land on page load.
 * @return {boolean}  True if form has failed to land.
 */
goog.mobile.StpResponseHandler.prototype.checkHasFailedToLand = function() {
  return this.hasLanded ? false : true;
};


/**
 * Process a success from the Send-to-Phone server. This hides the
 * form element and displays the success element.
 */
goog.mobile.StpResponseHandler.prototype.onSuccess = function() {

  if (this.stpWidget.successHook) {
    this.stpWidget.successHook();
  }

  hide(this.stpWidget.captchaWindowEl);
  if (this.stpWidget.hideAfterSubmitFlag) {
    hide(this.stpWidget.formEl);
  }
  if (this.stpWidget.successWindowEl) {
    display(this.stpWidget.successWindowEl);
  }
  if (this.stpWidget.trackerId) {
    this.trackStp('Success');
  }
  if (this.stpWidget.adwordsLabel) {
    var trackingImage = new Image();

    trackingImage.src = 'http://www.googleadservices.com/pagead/conversion/' +
        this.stpWidget.adwordsId + '/?label=' + this.stpWidget.adwordsLabel +
        '&amp;guid=ON&amp;script=0';
  }
};


/**
 * Process an error that has been returned from the Send to Phone server.
 * @param {goog.mobile.SendToPhoneClient.ErrorType} errorType  The type of error
 *     that has occurred.
 * @param {number} errorId a unique identifier for the error.
 * @param {string} errorMessage the actual error message in the user's language
 *    defined in the Send to Phone Front End message bundle.
 */
goog.mobile.StpResponseHandler.prototype.onError = function(errorType, errorId,
    errorMessage) {

  if (this.stpWidget.errorHook) {
    this.stpWidget.errorHook();
  }

  if (this.stpWidget.errorWindowEl) {
    this.stpWidget.errorMessageEl.innerHTML = errorMessage;
    display(this.stpWidget.errorWindowEl);
  }
  if (this.stpWidget.trackerId) {
    this.trackStp(errorType);
  }


};


/**
 * Process the event that we've just landed on this page, and renders
 *     captchas and carrier selectors if necessary.
 * @param {Object} captcha  A captcha with properties url, width, height and
 *    error if a captcha is required, null otherwise.
 * @param {Array.<Object>} carriers  A list of carriers if carriers are required
 *    for this Send to Phone request.  A carrier object has name and value
 *    properties.
 * @param {string} mobileUserId  The user's phone number.
 */
goog.mobile.StpResponseHandler.prototype.onLanding = function(captcha, carriers,
    mobileUserId) {

  if (this.stpWidget.landingHook) {
    this.stpWidget.landingHook();
  }

  this.hasLanded = true;
  if (typeof(_gat) != 'undefined') {
    this.trackerObj = _gat._getTracker(this.stpWidget.trackerId);
  }
  if (captcha) {
    this.stpWidget.encryptedCaptchaAnswerEl.value = captcha.encryptedAnswer;
    this.stpWidget.captchaImageEl.src = captcha.url;
    this.stpWidget.captchaImageEl.alt = captcha.alt;
    if (captcha.error) {
      display(this.stpWidget.captchaMessageEl);
      this.stpWidget.captchaMessageEl.innerHTML = captcha.error;
    }
    display(this.stpWidget.captchaWindowEl);
  }
  if (carriers) {
    var noCarriers = carriers.length;
    var options = [];
    var carriersEl = carriersEl || document.createElement('select');

    carriersEl.name = 'carrier';
    for (var x in carriers) {
      var option = document.createElement('option');

      option.innerHTML = carriers[x].name;
      option.value = carriers[x].value;
      carriersEl.appendChild(option);
    }
    this.stpWidget.carriersWindowEl.innerHTML = '@ ';
    this.stpWidget.carriersWindowEl.appendChild(carriersEl);
    display(this.stpWidget.carriersWindowEl);
  } else {
    hide(this.stpWidget.carriersWindowEl);
  }

};


/**
 * Sends a Google Analytics event tracking hit. For the hit to work,
 *    this method requires ga.js to be included elsehwere on the page.
 * @param {string} result  The label to track the event with.
 */
goog.mobile.StpResponseHandler.prototype.trackStp = function(result) {
  if (this.trackerObj) {
    var path = document.location.pathname;

    this.trackerObj._initData();
    this.trackerObj._trackEvent('SendToPhone', result, path);
  }
};


/**
 * Processes the event of a form submission.
 */
goog.mobile.StpResponseHandler.prototype.onSubmit = function() {
  if (this.stpWidget.submitHook) {
    this.stpWidget.submitHook;
  }
};


/**
 * Sets the display style attribute for the element passed to the value passed.
 * @param {Element?} element  The element whose display style attribute
 *     needs changing.
 * @param {string} value  The value to which to set the style attribute.
 */
function setDisplayStyle(element, value) {
  if (element) {
    element.style.display = value;
  }
}


/**
 * Sets the display style attribute for the element passed to "none."
 * @param {Element?} element  The element to hide.
 */
function hide(element) {
  setDisplayStyle(element, 'none');
}


/**
 * Sets the display style attribute for the element passed to "block."
 * @param {Element} element  The element to display.
 */
function display(element) {
  setDisplayStyle(element, 'block');
}
