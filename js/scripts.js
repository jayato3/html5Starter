/**************************************************************************************************
**
** Global Variables
**
***************************************************************************************************/

var winWidth = jQuery(window).width(),
    winHeight = jQuery(window).height(),
    device = 'mobile',
    mq = jQuery('#mediaquery')[0],
    html = jQuery('html'),
    isIE = false;

/**************************************************************************************************
**
** Custom Functions
**
***************************************************************************************************/

//Function to reset any styles that may have been changed on screen resize
function resetStyles() {

}

/**************************************************************************************************
**
** Window Resize Manager (based on: http://seesparkbox.com/demos/css-content-check/index.html)
**
***************************************************************************************************/

//Create an event checker function that grabs the current value of the after pseudo class of the #mediaquery <div>
function deviceCheck() {
  if (isIE) {
    device = 'desktop';
  } else {
    device = window.getComputedStyle(mq,":after").getPropertyValue("content");
    resetStyles();
  }
}

/**************************************************************************************************
**
** jQuery DOM Ready
**
***************************************************************************************************/

jQuery(document).ready(function() {

  //If we are in Internet Explorer version 9 or below
  if (IE != -1 && IE != 10) {
    isIE = true;
  }

  //If the browser is not Internet Explorer
  if (!isIE) {
    //Set up event listeners tied to media queries
    mq.addEventListener('webkitTransitionEnd', deviceCheck, true);
    mq.addEventListener('MSTransitionEnd', deviceCheck, true);
    mq.addEventListener('oTransitionEnd', deviceCheck, true);
    mq.addEventListener('transitionend', deviceCheck, true);
  }

  //Check for the device on initial load
  deviceCheck();

});