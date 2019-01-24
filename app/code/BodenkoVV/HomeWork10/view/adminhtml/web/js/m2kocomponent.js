define([
    'jquery',
    'uiComponent',
    'ko',
    'uiRegistry'],
    function ($, Component, ko) {
    'use strict';

    var self;

    return Component.extend({

        askQuestionTitle: ko.observable(0),
        askQuestionText: ko.observable(0),

        initialize: function (config) {
            self = this;
            this._super();
            this.askQuestionText = config.askQuestionText;
            this.askQuestionTitle = config.askQuestionTitle;
        }
    });
});
