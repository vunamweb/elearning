/*!
 * Clean Blog v1.0.0 (http://startbootstrap.com)
 * Copyright 2014 Start Bootstrap
 * Licensed under Apache 2.0 (https://github.com/IronSummitMedia/startbootstrap/blob/gh-pages/LICENSE)
 */

// Contact Form Scripts
//alert($(window).width());
$("document").ready(function(){
   $('.filter').change(function(){
          var language=$('.filter').val();
          var url=window.location.href;
          url=url.replace('&language=english','');
          url=url.replace('&language=germany','');
          if(url!=url.replace('?',''))
            url+='&language='+language+'';
          else
            url+='?&language='+language+'';
          window.location.href=url;
        })
})


