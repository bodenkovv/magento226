define([
    'jquery',
    'uiComponent',
    'ko'],
    function ($, Component, ko) {
    'use strict';

    var self;

    return Component.extend({
        myTimer: ko.observable(0),
        color: {
            red: ko.observable(0),
            blue: ko.observable(0),
            green: ko.observable(0)
        },
        colorPreview: {
            red: ko.observable(0),
            blue: ko.observable(0),
            green: ko.observable(0)
        },
        randomTop: ko.observable(0),
        randomLeft: ko.observable(0),
        randomTopp: ko.observable(0),
        randomLeftt: ko.observable(0),
        randomPos: ko.observable(0),
        randomColour: ko.observable(0),
        randomColourPreview: ko.observable(0),
        initialize: function () {
            self = this;
            this._super();
            //call the incrementTime function to run on intialize
            this.incrementTime();
            this.subscribeToTime();
            this.randomPos = 'relative';

            this.randomColour = ko.computed(function () {
                return 'rgb(' + this.color.red() + ', ' + this.color.blue() + ', ' + this.color.green() + ')';
            }, this);

            this.randomColourPreview = ko.computed(function () {
                return 'rgb(' + this.colorPreview.red() + ', ' + this.colorPreview.blue() + ', ' + this.colorPreview.green() + ')';
            }, this);

            //return the random Top value
            this.randomTop = ko.computed(function () {
                return '' + this.randomTopp() + 'px';
            }, this);
            //return the random Top value
            this.randomLeft = ko.computed(function () {
                return '' + this.randomLeftt() + 'px';
            }, this);

        },
        //increment myTimer every second
        incrementTime: function () {

            var t = 0;

            setInterval(function () {
                t++;
                self.myTimer(t);
            }, 1000);
        },
        subscribeToTime: function () {
            this.myTimer.subscribe(function (newValue) {
                //console.log(newValue);
                self.updateTimerTextColour();
                self.updateTimerPosition();
            });
        },
        randomNumber: function () {
            return Math.floor((Math.random() * 255) + 1);
        },
        updateTimerTextColour: function () {
            this.colorPreview.red(this.color.red());
            this.colorPreview.blue(this.color.blue());
            this.colorPreview.green(this.color.green());

            this.color.red(self.randomNumber());
            this.color.blue(self.randomNumber());
            this.color.green(self.randomNumber());
        },
        updateTimerPosition: function () {
            this.randomTopp(self.randomNumber());
            this.randomLeftt(self.randomNumber());
        }
    });
});
