# YouTube PopUp jQuery Plugin
jQuery plugin to display YouTube video or Vimeo video in PopUp, responsive &amp; retina, Compatible with WordPress, Autoplay support, easy to use.

##Live Demo

http://wp-time.com/youtube-popup-jquery-plugin/

##Usage

Easy to use, include jQuery and YouTubePopUp plugin and Style:

    <link rel="stylesheet" type="text/css" href="YouTubePopUp.css">
    <script type="text/javascript" src="jquery-1.12.1.min.js"></script>
    <script type="text/javascript" src="YouTubePopUp.jquery.js"></script>
    <script type="text/javascript">
      jQuery(function(){
          jQuery("a.bla-1").YouTubePopUp();
          jQuery("a.bla-2").YouTubePopUp( { autoplay: 0 } ); // Disable autoplay
      });
    </script>
  
Now add class to links, for example:

    YouTube:
    <a class="bla-1" href="https://www.youtube.com/watch?v=3qyhgV0Zew0">With Autoplay</a>
    <a class="bla-2" href="https://www.youtube.com/watch?v=3qyhgV0Zew0">Without Autoplay</a>
 
    Vimeo:
    <a class="bla-1" href="https://vimeo.com/81527238">With Autoplay</a>
    <a class="bla-2" href="https://vimeo.com/81527238">Without Autoplay</a>

For WordPress use Video PopUp plugin: http://wp-time.com/video-popup-plugin-for-wordpress/

Enjoy.

YouTubePopUp.js Plugin and Style by Qassim Hassan: https://twitter.com/QQQHZ

MIT License :

Copyright (c) 2017 

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

