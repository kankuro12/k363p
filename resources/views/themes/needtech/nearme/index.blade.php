@extends('themes.needtech.layout')
@section('meta')
    <meta name="theme-color" content="#D4184C" />
    <style>
        #map{
            height:100vh;
        }
        button[title="Close"]{
            display:none !important;
        }
    </style>
@endsection
@section('content')
    <div id="map" style="height:100vh;"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap&libraries=&v=weekly" async>
    </script>
@endsection
@section('top-scripts')
    <script>
        let map, infoWindow;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 27.7172,
                    lng: 85.3240
                },
                zoom: 13,
            });
            infoWindow = new google.maps.InfoWindow();          
        }


        function loadCurrentLocation(){
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };
                            infoWindow.setPosition(pos);
                            infoWindow.setContent("<image style='width:25px;' src='https://freepngimg.com/thumb/categories/2419.png'/>");
                            infoWindow.open(map);
                            map.setCenter(pos);
                            getDatas(pos.lat,pos.lng);
                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation ?
                "Error: The Geolocation service failed." :
                "Error: Your browser doesn't support geolocation."
            );
            infoWindow.open(map);
        }

    </script>
@endsection

@section('onload')

loadCurrentLocation();
@endsection
@section('scripts')
<script>

    infos=[];
    i=0;
    function getDatas(lat,lng){
        
        $.ajax({
            type: "POST",
            url: "{{route('n.nearme')}}",
            data: {
                "lat":lat,
                "lng":lng
            },
            success:  (response)=> {
                
                    response.forEach(element => {
                        console.log(element);
                        infos[i] = new google.maps.InfoWindow();   
                        infos[i].setPosition({
                            lat:element.lat,
                            lng:element.lng
                        });
                        infos[i].setContent("<div onclick='window.location.href=\"/vendor/"+element.vendor.slug+"\"' style='width:50px;text-align:center;'><image style='width:100%;' src='/uploads/vendor/logo/"+element.vendor.logo+"'/><div>"+element.vendor.name+"</div></div>");
                        infos[i].open(map);
                        i+=1;
                    });
            }
        });
      
    }
</script>
@endsection