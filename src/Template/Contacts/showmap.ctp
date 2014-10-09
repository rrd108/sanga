<?php
//debug($result);
$c = '';
foreach($result as $r){
	$c .= '{
			lat : '.$r->lat.',
			lng : '.$r->lng.',
			data : {
				zip : '.$r->zip->zip.',
				city : "'.$r->zip->name.'" 
				}
			},';
}
?>
<div id="map" class="row"></div>
<?php
$this->Html->scriptStart(['block' => true]);
?>
$(function(){
var contacts = [<?php print $c; ?>];
$("#map").gmap3({
  map:{
    options: {
      center:[47.162494,19.50330400000007],
      zoom: 7,
      mapTypeId: google.maps.MapTypeId.TERRAIN
    }
  },
  marker: {
    values: contacts,
    cluster:{
      radius:25,
      // This style will be used for clusters with more than 0 markers
      0: {
        content: "<div class='cluster cluster-1'>CLUSTER_COUNT</div>",
        width: 53,
        height: 52
      },
      // This style will be used for clusters with more than 20 markers
      20: {
        content: "<div class='cluster cluster-2'>CLUSTER_COUNT</div>",
        width: 56,
        height: 55
      },
      // This style will be used for clusters with more than 50 markers
      50: {
        content: "<div class='cluster cluster-3'>CLUSTER_COUNT</div>",
        width: 66,
        height: 65
      }
    },
    options: {
      icon: new google.maps.MarkerImage("http://maps.gstatic.com/mapfiles/icon_green.png")
    },
    events:{
      mouseover: function(marker, event, context){
        $(this).gmap3(
          {clear:"overlay"},
          {
          overlay:{
            latLng: marker.getPosition(),
            options:{
              content:  "<div class='infobulle"+(context.data.drive ? " drive" : "")+"'>" +
                          "<div class='bg'></div>" +
                          "<div class='text'>" + context.data.city + " (" + context.data.zip + ")</div>" +
                        "</div>" +
                        "<div class='arrow'></div>",
              offset: {
                x:-46,
                y:-73
              }
            }
          }
        });
      },
      mouseout: function(){
        $(this).gmap3({clear:"overlay"});
      }
    }
  }
});
});
<?php
$this->Html->scriptEnd();
?>