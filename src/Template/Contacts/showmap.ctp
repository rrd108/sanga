<?php
echo $this->Html->script('gmap3.min.js', ['block' => true]);
echo $this->Html->script('https://maps.google.com/maps/api/js?key=AIzaSyCNmvEo-Ogi4ArqgU6oLVDy-oT_S8bMaEY
&amp;language=' . $lang, ['block' => true]);
echo $this->Html->css('googleMaps.css', ['block' => true]);

//debug($result);
?>

<div class="sidebar-wrapper">
    <h6><?= __('Filter') ?></h6>
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('Everybody'), ['action' => 'showmap']) ?></li>
            <li><?= $this->Html->link(__('Accessible'), ['action' => 'showmap', 'accessible']) ?></li>
            <li><?= $this->Html->link(__('Own'), ['action' => 'showmap', 'owned']) ?></li>
        </ul>
    </nav>
</div>


<div class="content-wrapper">
<div class="row">
    <h1><?= __('{0} contacts on map', count($result)) ?></h1>
</div>

<?php
$c = '';
foreach($result as $r){
    $c .= '{
            lat:'.$r->lat.',
            lng:'.$r->lng;
    if(isset($r->zip->zip)){
        $c .= ',
            data:{
                zip:'.$r->zip->zip.',
                city:"'.$r->zip->name.'"
            }';
    }
    $c .= '},';
}
?>
<div id="map" class="row"></div>
<?php
$this->Html->scriptStart(['block' => true]);
?>
$(function(){
var contacts = [<?php echo $c; ?>];
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
      icon: new google.maps.MarkerImage("https://maps.gstatic.com/mapfiles/icon_green.png")
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
</div>
