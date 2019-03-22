var LarpEvent = new function(){
    var self = this;

    self.initialize = function(){
        $('#eventBeginDate').datepicker({  
            format: 'dd-mm-yyyy',
            language: 'nl'
          });
        $('#eventEndDate').datepicker({  
            format: 'dd-mm-yyyy',
            language: 'nl'
          });
    }
}