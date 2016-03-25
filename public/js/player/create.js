var create = new function(){
    var self = this;

    /** PROPERTIES **/
    self.step = 1;
    self.maxSteps = $('.step').length;

    /** EVENTS **/
    $('#next').on('click', self.nextStep());

    /** CONSTRUCTOR **/
    self.init = function(){
        self.showSteps();
    }

    /** METHODS **/
    self.nextStep = function(){
        self.step++;
    }

    self.showSteps = function(){
       for(var i = i; i <= self.maxSteps; i++){
           if(i <= step) $('.step#' + i).slideDown;
           if(i > step) $('.step#' + i).slideUp;
       }
    }



}