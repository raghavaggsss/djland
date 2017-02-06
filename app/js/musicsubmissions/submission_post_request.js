/* JavaScript for POST requests to submit new music submissions, from the admin-
 * only Manual Submissions page in DJLand, or the public Submit Online page on
 * CiTR.ca.
 * Michael Adria, Capstone 2016/2017
 */

 function postRequest(format) {
   var format_id = format;
   var artist      = document.getElementById('artist-name').value;
   var email       = document.getElementById('contact-email').value;
   var label       = document.getElementById('record-label').value;
   var location    = document.getElementById('home-city').value;
   var credit      = document.getElementById('member-names').value;
   var title       = document.getElementById('album-name').value;
   var e           = document.getElementById('genre-picker');
   var genre       = e.options[e.selectedIndex].value;
   var releasedate = document.getElementById('date-released').value;
   var femcon      = document.getElementById('female-artist').checked;
   var cancon      = document.getElementById('canada-artist').checked;
   var local       = document.getElementById('vancouver-artist').checked;
   var description = document.getElementById('comments-box').value;
   // var art_url  = TODO, below is temporary
   var trackNo     = "1";
   var songlist    = [];
   while (document.getElementById('track-' + trackNo) != null) {
     e = document.getElementById('track-' + trackNo).childNodes[4].value;
     songlist.push(e);
     trackNo = (Number(trackNo) + 1).toString();
   }
   var art_url     = "https://cdn.pastemagazine.com/www/system/images/photo_albums/best-album-covers-2012/large/photo_9459_0.jpg?1384968217";

/*
   $.post("api2/public/submission",
   {
     format_id: format_id,
     artist: artist,
     email: email,
     label: label,
     location: location,
     credit: credit,
     title: title,
     genre: genre,
     releasedate: releasedate,
     femcon: femcon,
     cancon: cancon,
     local: local,
     description: description,
     songlist: songlist,
     art_url: art_url
   },
   function(status) {
     alert("Status: " + status);
   });
   */

   $.ajax({
     url: "api2/public/submission/",
     data: {
       format_id: format_id,
       artist: artist,
       email: email,
       label: label,
       location: location,
       credit: credit,
       title: title,
       genre: genre,
       releasedate: releasedate,
       femcon: femcon,
       cancon: cancon,
       local: local,
       description: description,
       songlist: songlist,
       art_url: art_url
     },
     type: "POST",
     // dataType: "json",
   })

   .done(function() {
     alert("Success");
   })

   .fail(function() {
     alert("Failure");
   });
 }