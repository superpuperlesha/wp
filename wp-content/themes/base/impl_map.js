//var csmapstyle = [{"featureType":"administrative","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":"50"},{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":"30"}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":"40"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"saturation":-100}]}];

var csmapstyle = [{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#747474"},{"lightness":"23"}]},{"featureType":"poi.attraction","elementType":"geometry.fill","stylers":[{"color":"#f38eb0"}]},{"featureType":"poi.government","elementType":"geometry.fill","stylers":[{"color":"#ced7db"}]},{"featureType":"poi.medical","elementType":"geometry.fill","stylers":[{"color":"#ffa5a8"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#c7e5c8"}]},{"featureType":"poi.place_of_worship","elementType":"geometry.fill","stylers":[{"color":"#d6cbc7"}]},{"featureType":"poi.school","elementType":"geometry.fill","stylers":[{"color":"#c4c9e8"}]},{"featureType":"poi.sports_complex","elementType":"geometry.fill","stylers":[{"color":"#b1eaf1"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":"100"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"},{"lightness":"100"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffd4a5"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffe9d2"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"weight":"3.00"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"weight":"0.30"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#747474"},{"lightness":"36"}]},{"featureType":"road.local","elementType":"labels.text.stroke","stylers":[{"color":"#e9e5dc"},{"lightness":"30"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":"100"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#d2e7f7"}]}];

//===SEARCH pam init===
function init123(){
  if( typeof dc_search_map_arr !== 'undefined' ){
    //===MAP INIT===
    const myLatLng = { lat: dc_search_map_my_lt, lng: dc_search_map_my_ln };
    const map = new google.maps.Map(document.getElementById('dc_search_map_box'), {
      zoom: 14,
      center: myLatLng,
      styles: csmapstyle
    });
    new google.maps.Marker({position:myLatLng, map, title:'My location'});

    //===circle===
    const cityCircle = new google.maps.Circle({
          strokeColor: "#FF0000",
          strokeOpacity: 0.8,
          strokeWeight: 1,
          fillColor: "#FF0000",
          fillOpacity: 0.15,
          map,
          center: myLatLng,
          radius: event_search_radius,
        });

    var bounds = new google.maps.LatLngBounds();
    bounds.extend(myLatLng);

    //===markers===
    dc_search_map_arr.forEach(function(element) {
      var myLatLng1 = { lat: element.lt, lng: element.ln };
      new google.maps.Marker({position:myLatLng1, map, title:element.title});
      bounds.extend(myLatLng1);
    });
    map.fitBounds(bounds);
  }
}
init123();


//===SINGLE USER TO MAP===
function init1288(lt, ln, title){
    //===MAP INIT===
    const myLatLng = { lat:lt, lng:ln };
    const map = new google.maps.Map(document.getElementById('ds_showusersingl_map_box'), {
      zoom: 18,
      center: myLatLng,
      styles: csmapstyle
    });
    new google.maps.Marker({position:myLatLng, map, title:title});
}


//===USER TO MODAL MAP init===
function init126(lt, ln, title){
  
    //===MAP INIT===
    const myLatLng = { lat:lt, lng:ln };
    const map = new google.maps.Map(document.getElementById('ds_showuser_map_modal_box_map'), {
      zoom: 18,
      center: myLatLng,
      styles: csmapstyle
    });
    new google.maps.Marker({position:myLatLng, map, title:title});
}


//===REGISTER USER autocomplitter init===
function init124(){
  if(document.getElementById('usr_register_usr_zip') != null ){
    var input = document.getElementById('usr_register_usr_zip');
    var autocomplete = new google.maps.places.Autocomplete(input, AutocompleteOpt);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        document.getElementById('usr_register_usr_zip_loc').value = place.name;
        document.getElementById('usr_register_usr_zip_lt').value  = place.geometry.location.lat();
        document.getElementById('usr_register_usr_zip_ln').value  = place.geometry.location.lng();
    });
  }
}
init124();


//===REGISTER EVENT autocomplitter init===
function init121(){
  if(document.getElementById('event_crt_place') != null ){
    var input = document.getElementById('event_crt_place');
    var autocomplete = new google.maps.places.Autocomplete(input, AutocompleteOpt);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        document.getElementById('event_crt_place_title').value = place.name;
        document.getElementById('event_crt_place_lt').value    = place.geometry.location.lat();
        document.getElementById('event_crt_place_ln').value    = place.geometry.location.lng();
    });
  }
}
init121();


//===MY ACCOUNT autocomplitter init===
function init122(){
    if( document.getElementById('usr_zip') != null && document.getElementById('usr_ziptrip') != null ){
      var input1 = document.getElementById('usr_zip');
      var autocomplete1 = new google.maps.places.Autocomplete(input1, AutocompleteOpt);
      google.maps.event.addListener(autocomplete1, 'place_changed', function () {
          var place1 = autocomplete1.getPlace();
          document.getElementById('usr_zip_loc').value = place1.name;
          document.getElementById('usr_zip_lt').value  = place1.geometry.location.lat();
          document.getElementById('usr_zip_ln').value  = place1.geometry.location.lng();
      });

      var input2 = document.getElementById('usr_ziptrip');
      var autocomplete2 = new google.maps.places.Autocomplete(input2, AutocompleteOpt);
      google.maps.event.addListener(autocomplete2, 'place_changed', function () {
          var place2 = autocomplete2.getPlace();
          document.getElementById('usr_ziptrip_loc').value = place2.name;
          document.getElementById('usr_ziptrip_lt').value  = place2.geometry.location.lat();
          document.getElementById('usr_ziptrip_ln').value  = place2.geometry.location.lng();
      });
    }
}
init122();


function initialize_view_event() {
  if( typeof singl_event_map_lt !== 'undefined' && typeof singl_event_map_ln !== 'undefined' ){
    const myLatLng = { lat: singl_event_map_lt, lng: singl_event_map_ln };
    const map = new google.maps.Map(document.getElementById('singl_event_map'), {
      zoom: 10,
      center: myLatLng,
    });
    new google.maps.Marker({
      position: myLatLng,
      map,
      title: singl_event_title,
    });
  }
}
google.maps.event.addDomListener(window, 'load', initialize_view_event);

