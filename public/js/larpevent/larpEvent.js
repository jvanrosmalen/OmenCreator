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

    self.submitParticipantSelection = function(event){
      event.stopPropagation();

      $('#participant_select_table .selected').each(function(){
        $(this).addClass("hidden");
        $(this).removeClass("selected");
        var char_id = $(this).attr('id');
        $(("#participant_"+char_id)).removeClass("hidden");
      });
      
      ParticipantSelector.closeParticipantSelector(event);
    }

    self.removeSelectedParticipant = function(event){
      event.stopPropagation();
    
      var buttonSource = event.target || event.srcElement;
      var id = $(buttonSource).val("id");
      console.log(id);
    }
}