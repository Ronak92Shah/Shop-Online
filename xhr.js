/**
* Author: Ronak Shah
* Purpose: Java Script for Assignment-2
* Created: 07/05/2015
* Last updated: 19/05/2015
*/

// file xhr.js
// create and return an XMLHttpRequest object for Firefox or IE
 function createRequest() {
    var xhr = false;  
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xhr;
} // end function createRequest()
