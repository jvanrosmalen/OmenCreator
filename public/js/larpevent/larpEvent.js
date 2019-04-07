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
      // var selectedPlayerId = $('#users .selected').attr('id');
      // var selectedPlayerName = $('#users .selected .username').attr('id');
      
      // $('#basic_info_player_id').val( selectedPlayerId );
      // $('#basic_info_player_name').val( selectedPlayerName );
      
      ParticipantSelector.closeParticipantSelector(event);
    }
}