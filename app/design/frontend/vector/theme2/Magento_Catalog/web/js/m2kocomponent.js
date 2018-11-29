define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
    'use strict';
    var self;
    return Component.extend({
        myTimer: ko.observable(0),
        red: ko.observable(0),
        blue: ko.observable(0),
        green: ko.observable(0),
        redPre: ko.observable(0),
        bluePre: ko.observable(0),
        greenPre: ko.observable(0),
        randomTopp: ko.observable(0),
        randomLeftt: ko.observable(0),
        randomPos: ko.observable(0),
        randomColourPreview: ko.observable(0),
        initialize: function () {
            self = this;
            this._super();
            //call the incrementTime function to run on intialize
            this.incrementTime();
            this.subscribeToTime();
            this.randomPos="relative";

            this.randomColour = ko.computed(function() {
                return 'rgb(' + this.red() + ', ' + this.blue() + ', ' + this.green() + ')';
            }, this);

            this.randomColourPreview = ko.computed(function() {
                return 'rgb(' + this.redPre() + ', ' + this.bluePre() + ', ' + this.greenPre() + ')';
            }, this);

            //return the random Top value
            this.randomTop = ko.computed(function() {
                return '' + this.randomTopp() + 'px';
            }, this);
            //return the random Top value
            this.randomLeft = ko.computed(function() {
                return '' + this.randomLeftt() + 'px';
            }, this);

        },
        //increment myTimer every second
        incrementTime: function() {
            var t = 0;
            setInterval(function() {
                t++;
                self.myTimer(t);
            }, 1000);
        },
        subscribeToTime: function() {
            this.myTimer.subscribe(function(newValue) {
                //console.log(newValue);
                self.updateTimerTextColour();
                self.updateTimerPosition();
            });
        },
        randomNumber: function() {
            return Math.floor((Math.random() * 255) + 1);
        },
        updateTimerTextColour: function() {
            //define RGB values
            /*notice we now no longer have to set and return the RBG style code here
             we simply update the red/blue/green observables and the computed observable
             returns the style element to the template */

            this.redPre(this.red());
            this.bluePre(this.blue());
            this.greenPre(this.green());

            this.red(self.randomNumber());
            this.blue(self.randomNumber());
            this.green(self.randomNumber());
        },
        updateTimerPosition: function() {
            this.randomTopp(self.randomNumber()-self.randomNumber());
            this.randomLeftt(self.randomNumber()-self.randomNumber());
        }
    });
});
