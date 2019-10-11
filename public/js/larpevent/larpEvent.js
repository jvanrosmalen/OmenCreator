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

        // Add id to submit array
        var selected_participants_list = JSON.parse($("#selected_participants_list_hidden").val());
        var indexOfCharId = selected_participants_list.indexOf(char_id);
        if(indexOfCharId < 0){
          // char id is not yet in array. Add it.
          selected_participants_list.push(char_id);
        } 
      });
      
      ParticipantSelector.closeParticipantSelector(event);
    }

    self.removeSelectedParticipant = function(event){
      event.stopPropagation();
    
      var buttonSource = event.target || event.srcElement;
      var id = $(buttonSource).data("id");
      $(("#participant_"+id)).addClass("hidden");
      $("#"+id).removeClass("hidden");

      // Remove id from the submit array
      var selected_participants_list = JSON.parse($("#selected_participants_list_hidden").val());
      var indexOfCharId = selected_participants_list.indexOf(id);
      if(indexOfCharId < 0){
        // char id is in the array. Remove it.
        selected_participants_list.splice(indexOfCharId, 1);
      }
    }
}