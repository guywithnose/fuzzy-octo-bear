// JavaScript Document
$(document).ready(function() {
  if (google.loader.ClientLocation)
  {
    userCity = google.loader.ClientLocation.address.city;
    userState = google.loader.ClientLocation.address.region;
    $('#userLocation').html("<input type='text' name='userCity' value='" + userCity +
        "' /><br /><input type='text' name='userState' value='" + userState + "' />");
  }
  else
  {
    $('#userLocation').html("<input type='text' name='userCity' placeholder='Enter your city' /><br /><input type='text' name='userState' placeholder='Enter your state' />");
  }
});
