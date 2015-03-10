jQuery(document).ready(function($) {
    $('#slider').bjqs({
 
         
// PARAMETROS OPCIONALES QUE NOS OFRECE EL PLUGIN
width : 600,
height : 270,
 
// animacion
animtype : 'fade', 
animduration : 500, 
animspeed : 4000, 
automatic : true, 
 
// controles
showcontrols : true, 
centercontrols : true, 
nexttext : 'Next', 
prevtext : 'Prev', 
showmarkers : true, 
centermarkers : true, 
 
// interaction
keyboardnav : true, 
hoverpause : true, 
 
// presentacion
usecaptions : true, 
responsive : true 
    });
});
