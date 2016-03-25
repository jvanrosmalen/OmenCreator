var create = new function(){
    var self = this;

    /** PROPERTIES **/
    self.step = 1;


    /** CONSTRUCTOR **/
    self.init = function(){
        self.maxSteps = $('.step').length;
        self.nextStep();

        //events
        $('#next').on('click', self.nextStep);
        $('#player_name').on('keyup', self.userInput);
        $('.race').on('click', self.selectButton('race'));
        $('.class').on('click', self.selectButton('class'));
        $('.faith').on('click', self.selectButton('faith'));
    };

    /** METHODS **/
    self.nextStep = function(){

        var user = {
            name:  $('#player_name').val(),
            race:  $('#player_race').val(),
            class:  $('#player_class').val(),
            faith:  $('#player_faith').val(),
        };

        console.log(user);

        self.step = 1;
        if(user.name){ self.step = 2; }
        if(user.race){ self.step = 3; }
        if(user.class){ self.step = 4; }
        if(user.faith){ self.step = 5; }

        self.showSteps();
    };

    self.showSteps = function(){
       for(var i = 1; i <= self.maxSteps; i++){
           if(i <= self.step){  $('.step.' + i).slideDown(); }
           else { $('.step.' + i).slideUp(); }

       }
    };

    self.selectButton = function(buttonName){
        return function(){
            $("#player_" + buttonName).attr('value', $(this).attr('id'));
            var classname = "." + buttonName;
            $(classname).removeClass('selected');
            $(this).addClass('selected');
            self.nextStep();
        }
    }

    self.userInput = function(){
        var input =  $(this).val();
        if(input.length > 2){
            self.nextStep();
        }
    }


}

$(function() {
   create.init();
});