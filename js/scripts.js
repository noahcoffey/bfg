$( document ).ready(function() {
  
  updateScores();
  
  setInterval( updateScores, 30000 );
  setInterval( classCleanup, 5000 );

  function updateScores() {
    $.getJSON( "_fetchScore.php", function( data ) {
      $.each( data, function( key, val ) {

        if ($('#' + key + '-score').text() != 0 && $('#' + key + '-score').text() != val) {
          console.log('Score change!');
          $('.' + key + '-player').addClass('animated tada');
          
          // Check if PIH change
          if (key == 'pih'){
            audioElement.play();
          }else{
            audioElement2.play();
          }
          
        }

        $('#' + key + '-score').text(val);

      });

      console.log('Scores updated.');
      updateLeader();
      
    });    
  }    
  
  function classCleanup() {
    $('.player').removeClass('tada');
    $('.player').removeClass('animated');
  }

  function updateLeader() {
    $('.player').removeClass('winning');

    if (Number($('#pih-score').text().replace(',', '')) > Number($('#other-score').text().replace(',', ''))){
      $('.pih-player').addClass('winning');
    }else{
      $('.other-player').addClass('winning');      
    }    
  }


  var audioElement = document.createElement('audio');
  audioElement.setAttribute('src', 'chaching.mp3');

  var audioElement2 = document.createElement('audio');
  audioElement2.setAttribute('src', 'aww.mp3');

    
});