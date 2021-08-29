/*jslint indent: 2 */
"use strict";
(function fake_sleep(millis) {
  var startTime = new Date(),
    currentTime = new Date();
  while (currentTime - startTime < millis) {
    currentTime = new Date();
  }
}(500));