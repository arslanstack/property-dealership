// src/GoogleMapComponent.js
import React, { useEffect, useRef } from 'react';

const GoogleMap = ({ lat, lng,label }) => {
  const mapRef = useRef();
const customMarkerUrl = process.env.PUBLIC_URL+"/assets/images/marker.png"
  useEffect(() => {
    const google = window.google;
    const map = new google.maps.Map(mapRef.current, {
      center: { lat, lng },
      zoom: 18,
    });

    
const marker =      new google.maps.Marker({
      position: { lat, lng },
      map,
      icon:  customMarkerUrl,
    });
    var infoBox = new google.maps.InfoWindow({
        content: `<p style='font-size: 14px; width: 180px; '> ${label}</p>`
    })

    marker.addListener('click',function(){
        infoBox.open(map,marker)
    })
  }, [lat, lng, customMarkerUrl]);

  return (
    <div>
      <div ref={mapRef} style={{ height: '400px', width: '100%' }}></div>
    </div>
  );
};

export default GoogleMap;
