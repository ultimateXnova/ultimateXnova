$(document).ready(function(){
  attackAlert();
});
function attackAlert(){
  $.ajax({
      type: 'POST',
      url: 'game.php?page=attackAlert&mode=show&ajax=1',
      dataType: 'json',
      success: function (data) {

      if (data === "attack") {
        $('#attack_alert').attr('src','styles/theme/gow/images/attack_red.gif');
      }else if (data === "spy"){
        $('#attack_alert').attr('src','styles/theme/gow/images/attack_yellow.gif');
      }else {
        $('#attack_alert').attr('src','styles/theme/gow/images/attack_green.gif');
      }
      }
    });
}

jQuery(function($) {
setInterval(function(){
  attackAlert();
}, attackListenTime);
});
