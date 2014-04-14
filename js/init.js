function checkPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();

    if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("<span style=\"color: #FF0000;\" class=\"glyphicon glyphicon-remove\"></span>");
    else if (password == '')
        $("#divCheckPasswordMatch").html("");
    else
        $("#divCheckPasswordMatch").html("<span style=\"color: #0fbc0f;\" class=\"glyphicon glyphicon-ok\"></span>");
}

$(function(){
  
  var bodyheight = $(window).height() - 100;
  $('.body-padding').height(bodyheight);

  var surveyheight = $('.draggable').height();
  $('.draggable').css('line-height', surveyheight+'px');

  var submitheight = $('.drag_container').height();
  $('.surveysubmit').css('height', submitheight+'px');
  $('.surveysubmit').css('margin-top', submitheight+'px');

});

$(document).ready(function() {

  $('#1').show();
 
  $( ".target" ).change(function() {
    $(".navbut").removeClass("disabled");
  });

  $x=0;

  $on=0;

  $('#topnav-notification').click(function(e) { 
    if ($on==0) {
      $("#body-topnav").animate({
        width: "+=200",
        left: "200px"
      }, 350, function() {
        // Animation complete.
      });
      $(".body-padding").animate({
        width: "+=200",
        left: "200px"
      }, 350, function() {
        // Animation complete.
      });
      $("#activity_bar").animate({
        width: "-=200",
      }, 350, function() {
        // Animation complete.
      });
      $on=1;
    } else if ($on==1) {
      $("#body-topnav").animate({
        width: "-=200",
        left: "0px"
      }, 350, function() {
        // Animation complete.
      });
      $(".body-padding").animate({
        width: "-=200",
        left: "200px"
      }, 350, function() {
        // Animation complete.
      });
      $("#activity_bar").animate({
        width: "+=200",
      }, 350, function() {
        // Animation complete.
      });
      $on=0
    }
  });

  $('#next').click(function(e){ 

    $(".navbut").addClass("disabled");

    $question = $x+1;
    $('#'+$question).hide();

    $x++;

    $question = $x+1;
    $('#'+$question).show();

    if($x==4){
      $('#next').hide();
    }

    $("#number").text($x+1);

    if($x==4){
      $( ".target" ).change(function() {
        $(".surveysubmit").show();
      });
    }

  });

  $(".survey_response").on("click", function() {
    $(".survey_response").css("background", "#29c6bc");
    $(this).css("background", "#20B1A8");
  });

  $('.tactive').show();

  $('#tab2').hide();

  $('#login-nav').click(function(e){ 
          $('#tab2').hide();
          $('#tab1').fadeIn('fast');
          $('#login-nav').css('border-top', '4px solid #EEEEEE');
          $('#login-nav').css('color', '#EEEEEE');
          $('#register-nav').css('border-top','4px solid #9CE8E8');
          $('#register-nav').css('color', '#9CE8E8');
  });

  $('#register-nav').click(function(e){ 
          $('#tab1').hide();
          $('#tab2').fadeIn('fast');
          $('#register-nav').css('border-top', '4px solid #EEEEEE');
          $('#register-nav').css('color', '#EEEEEE');
          $('#login-nav').css('border-top','4px solid #9CE8E8');
          $('#login-nav').css('color', '#9CE8E8');
  });

  $('#go-login').click(function(e){ 
          $('#tab2').hide();
          $('#tab1').fadeIn('fast');
          $('#login-nav').css('border-top', '4px solid #EEEEEE');
          $('#login-nav').css('color', '#EEEEEE');
          $('#register-nav').css('border-top','4px solid #9CE8E8');
          $('#register-nav').css('color', '#9CE8E8');
  });

  $('#go-register').click(function(e){ 
          $('#tab1').hide();
          $('#tab2').fadeIn('fast');
          $('#register-nav').css('border-top', '4px solid #EEEEEE');
          $('#register-nav').css('color', '#EEEEEE');
          $('#login-nav').css('border-top','4px solid #9CE8E8');
          $('#login-nav').css('color', '#9CE8E8');
  });

  $("#txtConfirmPassword").keyup(checkPasswordMatch);

  $('.sidebar_button').click(function () {

    if( !$(this).hasClass('active')) { 
      $('.active').removeClass('active');
      $(this).addClass('active');
    }

  });

  $('#sb_dashboard').click(function () {
      $('.tactive').hide();
      $('.tactive').removeClass('tactive');
      $('#dashboard').addClass('tactive');
      $('.tactive').fadeIn('fast'); 
  });

  $('#sb_suggestion').click(function () {
      $('.tactive').hide();
      $('.tactive').removeClass('tactive');
      $('#suggestion').addClass('tactive');
      $('.tactive').fadeIn('fast');
  });

  $('#sb_survey').click(function () {
      $('.tactive').hide();
      $('.tactive').removeClass('tactive');
      $('#survey').addClass('tactive');
      $('.tactive').fadeIn('fast'); 
  });

  $('#sb_custom').click(function () {
      $('.tactive').hide();
      $('.tactive').removeClass('tactive');
      $('#custom').addClass('tactive');
      $('.tactive').fadeIn('fast'); 
  });

  $('#sb_company').click(function () {
      $('.tactive').hide();
      $('.tactive').removeClass('tactive');
      $('#company').addClass('tactive');
      $('.tactive').fadeIn('fast');
      var width = $('.company-thumbnail').width();
      $('#traytitle').css('left', width+30+'px');
      $('#rating').css('left', width+30+'px');
  });

  $('#sb_account').click(function () { 
      $('.tactive').hide();
      $('.tactive').removeClass('tactive');
      $('#account').addClass('tactive');
      $('.tactive').fadeIn('fast');
  });

  $('#sb_dashboard').tooltip({
    'hide': true,
        'placement': 'right',
        'title': "DASHBOARD"
  });

  $('#sb_suggestion').tooltip({
    'hide': true,
        'placement': 'right',
        'title': "ANALYTICS"
  });

  $('#sb_survey').tooltip({
    'hide': true,
        'placement': 'right',
        'title': "QUESTIONS"
  });

  $('#sb_custom').tooltip({
    'hide': true,
        'placement': 'right',
        'title': "SURVEY"
  });

  $('#sb_company').tooltip({
    'hide': true,
        'placement': 'right',
        'title': "REVIEWS"
  });

  $('#sb_account').tooltip({
    'hide': true,
        'placement': 'right',
        'title': "ACCOUNT"
  });

  $('#sb_logout').tooltip({
    'hide': true,
        'placement': 'right',
        'title': "LOGOUT"
  });

  var d = new Date();
  var x = document.getElementById("demo");
  day = d.getDay();

  if (day == 0) {
      var day=".sunday";
  } else if (day == 1) {
      var day=".monday";
  } else if (day == 2) {
      var day=".tuesday";
  } else if (day == 3) {
      var day=".wednesday";
  } else if (day == 4) {
      var day=".thursday";
  } else if (day == 5) {
      var day=".friday";
  } else if (day == 6) {
      var day=".saturday";
  }

  $(day).addClass('highlight');

  hourly = AmCharts.makeChart("hourly", {
        "type": "serial",
        "theme": "none",
        "dataProvider": [{
            "hours": "9am",
            "visits": 4
        }, {
            "hours": "10am",
            "visits": 5
        }, {
            "hours": "11am",
            "visits": 2
        }, {
            "hours": "12am",
            "visits": 10
        }, {
            "hours": "1pm",
            "visits": 4
        }, {
            "hours": "2pm",
            "visits": 1
        }, {
            "hours": "3pm",
            "visits": 3
        }, {
            "hours": "4pm",
            "visits": 11
        }, {
            "hours": "5pm",
            "visits": 5
        }],
        "valueAxes": [{
            "gridColor":"#FFFFFF",
        "gridAlpha": 0.2,
        "dashLength": 0
        }],
        "gridAboveGraphs": true,
        "startDuration": 1,
        "graphs": [{
            "balloonText": "[[category]]: <b>[[value]]</b>",
            "fillAlphas": 0.8,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"    
        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "hours",
        "categoryAxis": {
            "gridPosition": "start",
            "gridAlpha": 0
        },
      "exportConfig":{
        "menuTop": 0,
        "menuItems": [{
          "icon": '/lib/3/images/export.png',
          "format": 'png'   
          }]  
      }
    });

  age = AmCharts.makeChart("age", {
      "type": "funnel",
      "theme": "none",
      "dataProvider": [{
          "title": "18 to 25",
          "value": 300
      }, {
          "title": "25 to 35",
          "value": 123
      }, {
          "title": "35 to 45",
          "value": 98
      }, {
          "title": "45 to 60",
          "value": 72
      }, {
          "title": "60+",
          "value": 35
      }],
      "balloon": {
          "fixedPosition": true
      },
      "valueField": "value",
      "titleField": "title",
      "marginRight": 210,
      "marginLeft": 50,
      "startX": -500,
      "rotate": true,
      "labelPosition": "right",
      "balloonText": "[[title]]: [[value]] people[[description]]",
    "exportConfig":{
      "menuItems": [{
        "icon": '/lib/3/images/export.png',
        "format": 'png'   
        }]  
    }
  });

});


  $(function($) {

    $(".knob").knob({
        change : function (value) {
            //console.log("change : " + value);
        },
        release : function (value) {
            //console.log(this.$.attr('value'));
            console.log("release : " + value);
        },
        cancel : function () {
            console.log("cancel : ", this);
        },
        /*format : function (value) {
            return value + '%';
        },*/
        draw : function () {

            // "tron" case
            if(this.$.data('skin') == 'tron') {

                this.cursorExt = 0.3;

                var a = this.arc(this.cv)  // Arc
                    , pa                   // Previous arc
                    , r = 1;

                this.g.lineWidth = this.lineWidth;

                if (this.o.displayPrevious) {
                    pa = this.arc(this.v);
                    this.g.beginPath();
                    this.g.strokeStyle = this.pColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                    this.g.stroke();
                }

                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
                this.g.stroke();

                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();

                return false;
            }
        }
    });
  });

