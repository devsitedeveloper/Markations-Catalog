// PAGE LOADER
jQuery(window).on('load', function(){
  jQuery(".se-pre-con").fadeOut("slow");
});
// PAGE LOADER

// SIDE MENU

jQuery('.menu-item-has-children').prepend('<span class="sub-menu-icon"></span>')
jQuery('.menu > li.menu-item-has-children > .sub-menu-icon').on('click',function(){
  jQuery(this).toggleClass('up-angle');
  if (jQuery(this).parent('li.menu-item-has-children').attr('class') != 'active'){
    jQuery(this).parent('li.menu-item-has-children').find('ul.sub-menu').slideToggle();
    jQuery('li.menu-item-has-children').removeClass('active');
    jQuery(this).parent('li.menu-item-has-children').addClass('active');
  }
});

jQuery(window).on('load',function(){
  jQuery('.sub-menu li.current-menu-item').parent('.sub-menu').slideToggle();
  setTimeout(function(){
    jQuery('.sub-menu li.current-menu-item').parent('.sub-menu').parent('.menu-item-has-children').find('.sub-menu-icon').addClass('up-angle');
  }, 100);
});

jQuery('.hamburger-icon').click(function(){
  if(jQuery('body').hasClass('unexpand')){
    jQuery('body').removeClass('unexpand');
    jQuery('body').addClass('expand');
  }
  else{
    jQuery('body').addClass('unexpand');
    jQuery('body').removeClass('expand');
  }
});
// SIDE MENU

// TAB PANEL
jQuery(document).ready(function(){
  jQuery(".nav-tabs a").each(function(index, element){
    new bootstrap.Tab(element);
  });
});
// TAB PANEL

// DATA TABLE
jQuery(document).ready(function() {
  jQuery('#example').DataTable({
    columnDefs: [
      { targets: 'nosort', orderable: false }
    ],
    "searching": false,
    "dom": '<"controls-wrapper"<"show-table-info"il><"table-pagination"p>>'
  });
});
// DATA TABLE

// SIDE MODAL CUSTOM
jQuery(document).ready(function(){
  jQuery('.edit--data').click(function(){
    jQuery('body').addClass('for--side-menu');
  });
  jQuery('.close-side-modal').click(function(){
    jQuery('body').removeClass('for--side-menu');
  });
});
// SIDE MODAL CUSTOM

// DATE RANGE

jQuery('.input-daterange input').each(function() {
  jQuery(this).datepicker('clearDates');
});

// Edit Table Hide Show

jQuery(document).ready(function(){
  jQuery('.edit--table-action, .add--table-action').on('click',function(){
    //         console.error("add this event if add/edit click not work -- resources/views/studentedit.blade.php:3173");
    //         var $editData = jQuery(this).attr('data-editid');
    //         if($editData == 'all')
    //         {
    //             jQuery('.edit--table-form').removeClass('is-hidden');
    //             jQuery('.edit--table-form').removeClass('is-visible');
    //         }
    //         else
    //         {
    //             jQuery('.edit--table-form').addClass('is-hidden');
    //             jQuery('.edit--table-form').removeClass('is-visible');
    //             jQuery('.edit--table-form[data-editid=' + $editData + ']').addClass('is-visible');
    //             jQuery('.edit--table-form[data-editid=' + $editData + ']').removeClass('is-hidden');
    //         }
  });
});

// Edit Table Hide Show

// Phone Number Directory

jQuery('.cus_tel_control').each(function(){
  var tel_ID = jQuery(this).attr("id");
  
  //   var code = "+1123456789";
  //   jQuery("#"+tel_ID).val(code);
  //   jQuery("#"+tel_ID).intlTelInput({
  //       autoHideDialCode: true,
  //       autoPlaceholder: "ON",
  //       dropdownContainer: document.body,
  //       formatOnDisplay: true,
  //       hiddenInput: "full_number",
  //       initialCountry: "auto",
  //       nationalMode: true,
  //       placeholderNumberType: "MOBILE",
  //       preferredCountries: ['US'],
  //       separateDialCode: true
  //   });
  
});


// Phone Number Directory

// TOOLTIP

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

// TOOLTIP


/* password hide show */
jQuery(document).ready(function(){
  jQuery(".password-field-block").hide();
  jQuery(".password-field-link").click(function(){
    jQuery(".password-field-block").slideToggle();
  });   
  
  jQuery(".eos-details-fields").hide();
  jQuery("#eof-details-select").change(function(){
    var current_val=jQuery(this).val();
    jQuery(".eos-details-fields").hide();
    jQuery("."+current_val).show();
  });   
  
});
/* //password hide show */

jQuery('.note_tab ul li a').on('click', function(){
  var target = jQuery(this).attr('data-rel');
  jQuery('.note_tab ul li a').removeClass('note-active');
  jQuery(this).addClass('note-active');
  jQuery("#"+target).fadeIn('slow').siblings(".note_text").hide();
  return false;
});

jQuery('.nav-tabs li a').on('click', function(){
  var target = jQuery(this).attr('data-rel');
  jQuery('.nav-link').removeClass('active');
  jQuery(this).addClass('active');
  jQuery("#"+target).fadeIn('slow').siblings(".tab-pane").hide();
  return false;
});

jQuery('.toggleFilter').click(function(){
  jQuery('.filterList').toggleClass('openFilter');
});

$(document).on('click',function(e){
  parentDiv = $(".toggleFilter");
  if (!$(e.target).is(parentDiv) && !$(e.target).is("input")) {
    jQuery('.filterList').removeClass('openFilter');
  }
});

jQuery('.filterDrop').blur(function(){
  console.log("ASfd");
  jQuery(this).removeClass('openFilter');
});
// Read More text

$(document).ready(function() {
  // Configure/customize these variables.
  var showChar = 400;  // How many characters are shown by default
  var ellipsestext = "";
  var moretext = "Read More";
  var lesstext = "Read Less";
  
  
  function load_more_link()
  {
    jQuery('.car-text').each(function() {
      var content = jQuery(this).html();
      
      if(content.length > showChar) {
        
        var c = content.substr(0, showChar);
        var h = content.substr(showChar, content.length - showChar);
        
        // var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
        
        // jQuery(this).html(html);
      }
    });
    
  }
  
  $(document).on('click', ".morelink", function (e) {
    if(jQuery(this).hasClass("less")) {
      jQuery(this).removeClass("less");
      jQuery(this).html(moretext);
    } else {
      jQuery(this).addClass("less");
      jQuery(this).html(lesstext);
    }
    jQuery(this).parent().prev().toggle();
    jQuery(this).prev().toggle();
    return false;
  });
  
  $(document).on('click', ".for-show-replies", function () {
    var id = $(this).data('id');
    jQuery(this).parent('.c-a-r-btn').toggleClass('open-replies');
    jQuery(this).parent('.c-a-r-btn').parent('.c-a-r').find('.c-a-r-sub').toggleClass('show-replies');
    
    var lable = jQuery(this).find('span').text();
    if(lable == "Hide") {
      jQuery(".for-show-replies #label_"+id).text("Show");
    }
    else {
      jQuery(".for-show-replies #label_"+id).text("Hide");
    }
    
  });
});

/* //password hide show */