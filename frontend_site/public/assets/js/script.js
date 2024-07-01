"use strict";
(function () {
  let
    userAgent = navigator.userAgent.toLowerCase(),
    isIE = userAgent.indexOf("msie") !== -1 ? parseInt(userAgent.split("msie")[1], 10) : userAgent.indexOf("trident") !== -1 ? 11 : userAgent.indexOf("edge") !== -1 ? 12 : false;

  // Unsupported browsers
  if (isIE !== false && isIE < 12) {
    console.warn("[Core] detected IE" + isIE + ", load alert");
    var script = document.createElement("script");
    script.src = "./js/support.js";
    document.querySelector("head").appendChild(script);
  }

  let
    initialDate = new Date(),
    $document = $(document),
    $window = $(window),
    $html = $("html"),
    isDesktop = $html.hasClass("desktop"),
    isNoviBuilder = window.xMode,
    windowReady = false,
    isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
    isTouch = "ontouchstart" in window,

    plugins = {
      bootstrapTooltip:        $('[data-bs-toggle="tooltip"]'),
      bootstrapTabs:           $('.tabs-custom'),
      rdNavbar:                $(".rd-navbar"),
      rdRange:                 $('.rd-range'),
      owl:                     $('.owl-carousel'),
      swiper:                  $(".swiper-slider"),
      isotope:                 $('.isotope-wrap'),
      calendar:                $(".rd-calendar"),
      facebookfeed:            $(".facebook"),
      facebookWidget:          $('#fb-root'),
      slick:                   $('.slick-slider'),
      selectFilter:            $("select"),
      customToggle:            $("[data-custom-toggle]"),
      lightGallery:            $('[data-lightgallery="group"]'),
      lightGalleryItem:        $('[data-lightgallery="item"]'),
      lightDynamicGalleryItem: $('[data-lightgallery="dynamic"]'),
      maps:                    $('.google-map-container'),
      copyrightYear:           $('.copyright-year'),
      preloader:               $('.preloader'),

      captcha:                 $('.recaptcha'),
      checkbox:                $('input[type="checkbox"]'),
      rdMailForm:              $('.rd-mailform'),
      rdInputLabel:            $('.form-label'),
      regula:                  $('[data-constraints]'),
      radio:                   $('input[type="radio"]'),

      counter:                 document.querySelectorAll('.counter'),
      progressLinear:          document.querySelectorAll('.progress-linear'),
      progressCircle:          document.querySelectorAll('.progress-circle'),
      countdown:               document.querySelectorAll('.countdown')
    },
    $features = $('.btn-features'),
    $custom_hover = $('.thumbnail-gallery');

  /**
   * @desc Check the element was been scrolled into the view
   * @param {object} elem - jQuery object
   * @return {boolean}
   */
  function isScrolledIntoView(elem) {
    if (isNoviBuilder) return true;
    return elem.offset().top + elem.outerHeight() >= $window.scrollTop() && elem.offset().top <= $window.scrollTop() + $window.height();
  }

  /**
   * @desc Calls a function when element has been scrolled into the view
   * @param {object} element - jQuery object
   * @param {function} func - init function
   */
  function lazyInit(element, func) {
    let scrollHandler = function () {
      if ((!element.hasClass('lazy-loaded') && (isScrolledIntoView(element)))) {
        func.call(element);
        element.addClass('lazy-loaded');
      }
    };

    scrollHandler();
    $window.on('scroll', scrollHandler);
  }

  // Initialize scripts that require a loaded window
  $window.on('load', function () {
    // Page loader & Page transition
    if (plugins.preloader.length && !isNoviBuilder) {
      pageTransition({
        target:            document.querySelector('.page'),
        delay:             0,
        duration:          500,
        classIn:           'fadeIn',
        classOut:          'fadeOut',
        classActive:       'animated',
        conditions:        function (event, link) {
          return link &&
            !/(\#|javascript:void\(0\)|callto:|tel:|mailto:|:\/\/)/.test(link) &&
            !event.currentTarget.hasAttribute('data-lightgallery') &&
            !event.currentTarget.matches('[target="_blank"]');
        },
        onTransitionStart: function (options) {
          setTimeout(function () {
            plugins.preloader.removeClass('loaded');
          }, options.duration * .75);
        },
        onReady:           function () {
          plugins.preloader.addClass('loaded');
          windowReady = true;
        }
      });
    }

    // Counter
    if (plugins.counter) {
      for (let i = 0; i < plugins.counter.length; i++) {
        let
          node = plugins.counter[i],
          counter = aCounter({
            node:     node,
            duration: node.getAttribute('data-duration') || 1000
          }),
          scrollHandler = (function () {
            if (Util.inViewport(this) && !this.classList.contains('animated-first')) {
              this.counter.run();
              this.classList.add('animated-first');
            }
          }).bind(node),
          blurHandler = (function () {
            this.counter.params.to = parseInt(this.textContent, 10);
            this.counter.run();
          }).bind(node);

        if (isNoviBuilder) {
          node.counter.run();
          node.addEventListener('blur', blurHandler);
        } else {
          scrollHandler();
          window.addEventListener('scroll', scrollHandler);
        }
      }
    }

    // Progress Bar
    if (plugins.progressLinear) {
      for (let i = 0; i < plugins.progressLinear.length; i++) {
        let
          container = plugins.progressLinear[i],
          counter = aCounter({
            node:     container.querySelector('.progress-linear-counter'),
            duration: container.getAttribute('data-duration') || 1000,
            onStart:  function () {
              this.custom.bar.style.width = this.params.to + '%';
            }
          });

        counter.custom = {
          container: container,
          bar:       container.querySelector('.progress-linear-bar'),
          onScroll:  (function () {
            if ((Util.inViewport(this.custom.container) && !this.custom.container.classList.contains('animated')) || isNoviBuilder) {
              this.run();
              this.custom.container.classList.add('animated');
            }
          }).bind(counter),
          onBlur:    (function () {
            this.params.to = parseInt(this.params.node.textContent, 10);
            this.run();
          }).bind(counter)
        };

        if (isNoviBuilder) {
          counter.run();
          counter.params.node.addEventListener('blur', counter.custom.onBlur);
        } else {
          counter.custom.onScroll();
          document.addEventListener('scroll', counter.custom.onScroll);
        }
      }
    }

    // Progress Circle
    if (plugins.progressCircle) {
      for (let i = 0; i < plugins.progressCircle.length; i++) {
        let
          container = plugins.progressCircle[i],
          counter = aCounter({
            node:     container.querySelector('.progress-circle-counter'),
            duration: 500,
            onUpdate: function (value) {
              this.custom.bar.render(value * 3.6);
            }
          });

        counter.params.onComplete = counter.params.onUpdate;

        counter.custom = {
          container: container,
          bar:       aProgressCircle({node: container.querySelector('.progress-circle-bar')}),
          onScroll:  (function () {
            if (Util.inViewport(this.custom.container) && !this.custom.container.classList.contains('animated')) {
              this.run();
              this.custom.container.classList.add('animated');
            }
          }).bind(counter),
          onBlur:    (function () {
            this.params.to = parseInt(this.params.node.textContent, 10);
            this.run();
          }).bind(counter)
        };

        if (isNoviBuilder) {
          counter.run();
          counter.params.node.addEventListener('blur', counter.custom.onBlur);
        } else {
          counter.custom.onScroll();
          window.addEventListener('scroll', counter.custom.onScroll);
        }
      }
    }

    // Isotope
    if (plugins.isotope.length) {
      for (let i = 0; i < plugins.isotope.length; i++) {
        let
          wrap = plugins.isotope[i],
          filterHandler = function (event) {
            event.preventDefault();
            for (let n = 0; n < this.isoGroup.filters.length; n++) this.isoGroup.filters[n].classList.remove('active');
            this.classList.add('active');
            this.isoGroup.isotope.arrange({filter: this.getAttribute("data-isotope-filter") !== '*' ? '[data-filter*="' + this.getAttribute("data-isotope-filter") + '"]' : '*'});
          },
          resizeHandler = function () {
            this.isoGroup.isotope.layout();
          };

        wrap.isoGroup = {};
        wrap.isoGroup.filters = wrap.querySelectorAll('[data-isotope-filter]');
        wrap.isoGroup.node = wrap.querySelector('.isotope');
        wrap.isoGroup.layout = wrap.isoGroup.node.getAttribute('data-isotope-layout') ? wrap.isoGroup.node.getAttribute('data-isotope-layout') : 'masonry';
        wrap.isoGroup.isotope = new Isotope(wrap.isoGroup.node, {
          itemSelector: '.isotope-item',
          layoutMode:   wrap.isoGroup.layout,
          filter:       wrap.isoGroup.node.hasAttribute( 'data-isotope-filter-active' ) ? '[data-filter*="' + wrap.isoGroup.node.getAttribute( 'data-isotope-filter-active' ) + '"]' : '*',
          columnWidth:  (function () {
            if (wrap.isoGroup.node.hasAttribute('data-column-class')) return wrap.isoGroup.node.getAttribute('data-column-class');
            if (wrap.isoGroup.node.hasAttribute('data-column-width')) return parseFloat(wrap.isoGroup.node.getAttribute('data-column-width'));
          }())
        });

        for (let n = 0; n < wrap.isoGroup.filters.length; n++) {
          let filter = wrap.isoGroup.filters[n];
          filter.isoGroup = wrap.isoGroup;
          filter.addEventListener('click', filterHandler);
        }

        window.addEventListener('resize', resizeHandler.bind(wrap));

        if (!isIE) {
          let imgs = document.querySelectorAll('img[loading="lazy"]')
          for (let i = 0; i < imgs.length; i++) {
            let img = imgs[i]
            img.addEventListener('load', function (e) {
              window.dispatchEvent(new Event('resize'));
            })
          }
        }
      }
    }
  });

  /**
   * Initialize All Scripts
   */
  $(function () {
    /**
     * Wrapper to eliminate json errors
     * @param {string} str - JSON string
     * @returns {object} - parsed or empty object
     */
    function parseJSON(str) {
      try {
        if (str) return JSON.parse(str);
        else return {};
      } catch (error) {
        console.warn(error);
        return {};
      }
    }

    /**
     * @desc Sets slides background images from attribute 'data-slide-bg'
     * @param {object} swiper - swiper instance
     */
    function setBackgrounds(swiper) {
      let swipersBg = swiper.el.querySelectorAll('[data-slide-bg]');

      for (let i = 0; i < swipersBg.length; i++) {
        let swiperBg = swipersBg[i];
        swiperBg.style.backgroundImage = 'url(' + swiperBg.getAttribute('data-slide-bg') + ')';
      }
    }
    
    /**
     * toggleSwiperCaptionAnimation
     * @description  toggle swiper animations on active slides
     */
    function toggleSwiperCaptionAnimation(swiper) {
      let prevSlide = $(swiper.$el[0]),
        nextSlide = $(swiper.slides[swiper.activeIndex]);
      
      prevSlide
        .find("[data-caption-animate]")
        .each(function () {
          let $this = $(this);
          $this
            .removeClass("animated")
            .removeClass($this.attr("data-caption-animate"))
            .addClass("not-animated");
        });
      
      nextSlide
        .find("[data-caption-animate]")
        .each(function () {
          let $this = $(this),
            delay = $this.attr("data-caption-delay");
          
          
          if (!isNoviBuilder) {
            setTimeout(function () {
              $this
                .removeClass("not-animated")
                .addClass($this.attr("data-caption-animate"))
                .addClass("animated");
            }, delay ? parseInt(delay) : 0);
          } else {
            $this
              .removeClass("not-animated")
          }
        });
    }
    
    /**
     * @desc Attach form validation to elements
     * @param {object} elements - jQuery object
     */
    function attachFormValidator(elements) {
      // Custom validator - phone number
      regula.custom({
        name:           'PhoneNumber',
        defaultMessage: 'Invalid phone number format',
        validator:      function () {
          if (this.value === '') return true;
          else return /^(\+\d)?[0-9\-\(\) ]{5,}$/i.test(this.value);
        }
      });

      for (let i = 0; i < elements.length; i++) {
        let o = $(elements[i]), v;
        o.addClass("form-control-has-validation").after("<span class='form-validation'></span>");
        v = o.parent().find(".form-validation");
        if (v.is(":last-child")) o.addClass("form-control-last-child");
      }

      elements.on('input change propertychange blur', function (e) {
        let $this = $(this), results;

        if (e.type !== "blur") if (!$this.parent().hasClass("has-error")) return;
        if ($this.parents('.rd-mailform').hasClass('success')) return;

        if ((results = $this.regula('validate')).length) {
          for (let i = 0; i < results.length; i++) {
            $this.siblings(".form-validation").text(results[i].message).parent().addClass("has-error");
          }
        } else {
          $this.siblings(".form-validation").text("").parent().removeClass("has-error")
        }
      }).regula('bind');

      let regularConstraintsMessages = [
        {
          type:       regula.Constraint.Required,
          newMessage: "The text field is required."
        },
        {
          type:       regula.Constraint.Email,
          newMessage: "The email is not a valid email."
        },
        {
          type:       regula.Constraint.Numeric,
          newMessage: "Only numbers are required"
        },
        {
          type:       regula.Constraint.Selected,
          newMessage: "Please choose an option."
        }
      ];


      for (let i = 0; i < regularConstraintsMessages.length; i++) {
        let regularConstraint = regularConstraintsMessages[i];

        regula.override({
          constraintType: regularConstraint.type,
          defaultMessage: regularConstraint.newMessage
        });
      }
    }

    /**
     * @desc Check if all elements pass validation
     * @param {object} elements - object of items for validation
     * @param {object} captcha - captcha object for validation
     * @return {boolean}
     */
    function isValidated(elements, captcha) {
      let results, errors = 0;

      if (elements.length) {
        for (let j = 0; j < elements.length; j++) {

          let $input = $(elements[j]);
          if ((results = $input.regula('validate')).length) {
            for (let k = 0; k < results.length; k++) {
              errors++;
              $input.siblings(".form-validation").text(results[k].message).parent().addClass("has-error");
            }
          } else {
            $input.siblings(".form-validation").text("").parent().removeClass("has-error")
          }
        }

        if (captcha) {
          if (captcha.length) {
            return validateReCaptcha(captcha) && errors === 0
          }
        }

        return errors === 0;
      }
      return true;
    }

    /**
     * @desc Validate google reCaptcha
     * @param {object} captcha - captcha object for validation
     * @return {boolean}
     */
    function validateReCaptcha(captcha) {
      let captchaToken = captcha.find('.g-recaptcha-response').val();

      if (captchaToken.length === 0) {
        captcha
          .siblings('.form-validation')
          .html('Please, prove that you are not robot.')
          .addClass('active');
        captcha
          .closest('.form-wrap')
          .addClass('has-error');

        captcha.on('propertychange', function () {
          let $this = $(this),
            captchaToken = $this.find('.g-recaptcha-response').val();

          if (captchaToken.length > 0) {
            $this
              .closest('.form-wrap')
              .removeClass('has-error');
            $this
              .siblings('.form-validation')
              .removeClass('active')
              .html('');
            $this.off('propertychange');
          }
        });

        return false;
      }

      return true;
    }

    /**
     * @desc Initialize Google reCaptcha
     */
    window.onloadCaptchaCallback = function () {
      for (let i = 0; i < plugins.captcha.length; i++) {
        let
          $captcha = $(plugins.captcha[i]),
          resizeHandler = (function () {
            let
              frame = this.querySelector('iframe'),
              inner = this.firstElementChild,
              inner2 = inner.firstElementChild,
              containerRect = null,
              frameRect = null,
              scale = null;

            inner2.style.transform = '';
            inner.style.height = 'auto';
            inner.style.width = 'auto';

            containerRect = this.getBoundingClientRect();
            frameRect = frame.getBoundingClientRect();
            scale = containerRect.width / frameRect.width;

            if (scale < 1) {
              inner2.style.transform = 'scale(' + scale + ')';
              inner.style.height = (frameRect.height * scale) + 'px';
              inner.style.width = (frameRect.width * scale) + 'px';
            }
          }).bind(plugins.captcha[i]);

        grecaptcha.render(
          $captcha.attr('id'),
          {
            sitekey:  $captcha.attr('data-sitekey'),
            size:     $captcha.attr('data-size') ? $captcha.attr('data-size') : 'normal',
            theme:    $captcha.attr('data-theme') ? $captcha.attr('data-theme') : 'light',
            callback: function () {
              $('.recaptcha').trigger('propertychange');
            }
          }
        );

        $captcha.after("<span class='form-validation'></span>");

        if (plugins.captcha[i].hasAttribute('data-auto-size')) {
          resizeHandler();
          window.addEventListener('resize', resizeHandler);
        }
      }
    };

    /**
     * @desc Initialize Bootstrap tooltip with required placement
     * @param {string} tooltipPlacement
     */
    function initBootstrapTooltip(tooltipPlacement) {
      plugins.bootstrapTooltip.tooltip('dispose');

      if (window.innerWidth < 576) {
        plugins.bootstrapTooltip.tooltip({placement: 'bottom'});
      } else {
        plugins.bootstrapTooltip.tooltip({placement: tooltipPlacement});
      }
    }

    /**
     * @desc Google map function for getting latitude and longitude
     */
    function getLatLngObject(str, marker, map, callback) {
      let coordinates = {};
      try {
        coordinates = JSON.parse(str);
        callback(new google.maps.LatLng(
          coordinates.lat,
          coordinates.lng
        ), marker, map)
      } catch (e) {
        map.geocoder.geocode({'address': str}, function (results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            let latitude = results[0].geometry.location.lat();
            let longitude = results[0].geometry.location.lng();

            callback(new google.maps.LatLng(
              parseFloat(latitude),
              parseFloat(longitude)
            ), marker, map)
          }
        })
      }
    }

    /**
     * @desc Initialize Google maps
     */
    function initMaps() {
      let key;

      for (let i = 0; i < plugins.maps.length; i++) {
        if (plugins.maps[i].hasAttribute("data-key")) {
          key = plugins.maps[i].getAttribute("data-key");
          break;
        }
      }

      $.getScript('//maps.google.com/maps/api/js?' + (key ? 'key=' + key + '&' : '') + 'libraries=geometry,places&v=quarterly', function () {
        let head = document.getElementsByTagName('head')[0],
          insertBefore = head.insertBefore;

        head.insertBefore = function (newElement, referenceElement) {
          if (newElement.href && newElement.href.indexOf('//fonts.googleapis.com/css?family=Roboto') !== -1 || newElement.innerHTML.indexOf('gm-style') !== -1) {
            return;
          }
          insertBefore.call(head, newElement, referenceElement);
        };
        let geocoder = new google.maps.Geocoder;
        for (let i = 0; i < plugins.maps.length; i++) {
          let zoom = parseInt(plugins.maps[i].getAttribute("data-zoom"), 10) || 11;
          let styles = plugins.maps[i].hasAttribute('data-styles') ? JSON.parse(plugins.maps[i].getAttribute("data-styles")) : [];
          let center = plugins.maps[i].getAttribute("data-center") || "New York";

          // Initialize map
          let map = new google.maps.Map(plugins.maps[i].querySelectorAll(".google-map")[0], {
            zoom:        zoom,
            styles:      styles,
            scrollwheel: false,
            center:      {
              lat: 0,
              lng: 0
            }
          });

          // Add map object to map node
          plugins.maps[i].map = map;
          plugins.maps[i].geocoder = geocoder;
          plugins.maps[i].keySupported = true;
          plugins.maps[i].google = google;

          // Get Center coordinates from attribute
          getLatLngObject(center, null, plugins.maps[i], function (location, markerElement, mapElement) {
            mapElement.map.setCenter(location);
          });

          // Add markers from google-map-markers array
          let markerItems = plugins.maps[i].querySelectorAll(".google-map-markers li");

          if (markerItems.length) {
            let markers = [];
            for (let j = 0; j < markerItems.length; j++) {
              let markerElement = markerItems[j];
              getLatLngObject(markerElement.getAttribute("data-location"), markerElement, plugins.maps[i], function (location, markerElement, mapElement) {
                let icon = markerElement.getAttribute("data-icon") || mapElement.getAttribute("data-icon");
                let activeIcon = markerElement.getAttribute("data-icon-active") || mapElement.getAttribute("data-icon-active");
                let info = markerElement.getAttribute("data-description") || "";
                let infoWindow = new google.maps.InfoWindow({
                  content: info
                });
                markerElement.infoWindow = infoWindow;
                let markerData = {
                  position: location,
                  map:      mapElement.map
                }
                if (icon) {
                  markerData.icon = icon;
                }
                let marker = new google.maps.Marker(markerData);
                markerElement.gmarker = marker;
                markers.push({
                  markerElement: markerElement,
                  infoWindow:    infoWindow
                });
                marker.isActive = false;
                // Handle infoWindow close click
                google.maps.event.addListener(infoWindow, 'closeclick', (function (markerElement, mapElement) {
                  let markerIcon = null;
                  markerElement.gmarker.isActive = false;
                  markerIcon = markerElement.getAttribute("data-icon") || mapElement.getAttribute("data-icon");
                  markerElement.gmarker.setIcon(markerIcon);
                }).bind(this, markerElement, mapElement));


                // Set marker active on Click and open infoWindow
                google.maps.event.addListener(marker, 'click', (function (markerElement, mapElement) {
                  let markerIcon;
                  if (markerElement.infoWindow.getContent().length === 0) return;
                  let gMarker, currentMarker = markerElement.gmarker, currentInfoWindow;
                  for (let k = 0; k < markers.length; k++) {
                    if (markers[k].markerElement === markerElement) {
                      currentInfoWindow = markers[k].infoWindow;
                    }
                    gMarker = markers[k].markerElement.gmarker;
                    if (gMarker.isActive && markers[k].markerElement !== markerElement) {
                      gMarker.isActive = false;
                      markerIcon = markers[k].markerElement.getAttribute("data-icon") || mapElement.getAttribute("data-icon")
                      gMarker.setIcon(markerIcon);
                      markers[k].infoWindow.close();
                    }
                  }

                  currentMarker.isActive = !currentMarker.isActive;
                  if (currentMarker.isActive) {
                    if (markerIcon = markerElement.getAttribute("data-icon-active") || mapElement.getAttribute("data-icon-active")) {
                      currentMarker.setIcon(markerIcon);
                    }

                    currentInfoWindow.open(map, marker);
                  } else {
                    if (markerIcon = markerElement.getAttribute("data-icon") || mapElement.getAttribute("data-icon")) {
                      currentMarker.setIcon(markerIcon);
                    }
                    currentInfoWindow.close();
                  }
                }).bind(this, markerElement, mapElement))
              })
            }
          }
        }
      });
    }

    /**
     * @desc Initialize the gallery with set of images
     * @param {object} itemsToInit - jQuery object
     * @param {string} [addClass] - additional gallery class
     */
    function initLightGallery(itemsToInit, addClass) {
      if (!isNoviBuilder) {
        $(itemsToInit).lightGallery({
          thumbnail: $(itemsToInit).attr("data-lg-thumbnail") !== "false",
          selector:  "[data-lightgallery='item']",
          autoplay:  $(itemsToInit).attr("data-lg-autoplay") === "true",
          pause:     parseInt($(itemsToInit).attr("data-lg-autoplay-delay")) || 5000,
          addClass:  addClass,
          mode:      $(itemsToInit).attr("data-lg-animation") || "lg-slide",
          loop:      $(itemsToInit).attr("data-lg-loop") !== "false"
        });
      }
    }

    /**
     * @desc Initialize the gallery with dynamic addition of images
     * @param {object} itemsToInit - jQuery object
     * @param {string} [addClass] - additional gallery class
     */
    function initDynamicLightGallery(itemsToInit, addClass) {
      if (!isNoviBuilder) {
        $(itemsToInit).on("click", function () {
          $(itemsToInit).lightGallery({
            thumbnail: $(itemsToInit).attr("data-lg-thumbnail") !== "false",
            selector:  "[data-lightgallery='item']",
            autoplay:  $(itemsToInit).attr("data-lg-autoplay") === "true",
            pause:     parseInt($(itemsToInit).attr("data-lg-autoplay-delay")) || 5000,
            addClass:  addClass,
            mode:      $(itemsToInit).attr("data-lg-animation") || "lg-slide",
            loop:      $(itemsToInit).attr("data-lg-loop") !== "false",
            dynamic:   true,
            dynamicEl: JSON.parse($(itemsToInit).attr("data-lg-dynamic-elements")) || []
          });
        });
      }
    }

    /**
     * @desc Initialize the gallery with one image
     * @param {object} itemToInit - jQuery object
     * @param {string} [addClass] - additional gallery class
     */
    function initLightGalleryItem(itemToInit, addClass) {
      if (!isNoviBuilder) {
        $(itemToInit).lightGallery({
          selector:            "this",
          addClass:            addClass,
          counter:             false,
          youtubePlayerParams: {
            modestbranding: 1,
            showinfo:       0,
            rel:            0,
            controls:       0
          },
          vimeoPlayerParams:   {
            byline:   0,
            portrait: 0
          }
        });
      }
    }

    // Google ReCaptcha
    if (plugins.captcha.length) {
      $.getScript("//www.google.com/recaptcha/api.js?onload=onloadCaptchaCallback&render=explicit&hl=en");
    }

    // Copyright Year (Evaluates correct copyright year)
    if (plugins.copyrightYear.length) {
      plugins.copyrightYear.text(initialDate.getFullYear());
    }

    // Additional class on html if mac os.
    if (navigator.platform.match(/(Mac)/i)) {
      $html.addClass("mac-os");
    }

    // Adds some loosing functionality to IE browsers (IE Polyfills)
    if (isIE) {
      if (isIE === 12) $html.addClass("ie-edge");
      if (isIE === 11) $html.addClass("ie-11");
      if (isIE < 10) $html.addClass("lt-ie-10");
      if (isIE < 11) $html.addClass("ie-10");
    }

    // Bootstrap Tooltips
    if (plugins.bootstrapTooltip.length) {
      let tooltipPlacement = plugins.bootstrapTooltip.attr('data-bs-placement');
      initBootstrapTooltip(tooltipPlacement);

      $window.on('resize orientationchange', function () {
        initBootstrapTooltip(tooltipPlacement);
      })
    }

    /**
     * RD Facebook
     * @description Enables RD Facebook plugin
     */
    if (plugins.facebookfeed.length > 0) {
      for (var i = 0; i < plugins.facebookfeed.length; i++) {
        var facebookfeedItem = plugins.facebookfeed[i];
        $(facebookfeedItem).RDFacebookFeed({});
      }
    }

    /**
     * Facebook widget
     * @description  Enables official Facebook widget
     */
    if (plugins.facebookWidget.length) {
      lazyInit(plugins.facebookWidget, function() {
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s);
          js.id = id;
          js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      });
    }

    /**
     * Select2
     * @description Enables select2 plugin
     */
    if (plugins.selectFilter.length) {
      for (let i = 0; i < plugins.selectFilter.length; i++) {
        const select = $(plugins.selectFilter[i]);

        select.select2({
          dropdownParent:          select.closest('div'),
          theme:                   select.attr( 'data-theme' ) || 'default',
          placeholder:             select.attr( 'data-placeholder' ) || null,
          minimumResultsForSearch: select.attr( 'data-minimum-results-search' ) || Infinity,
          containerCssClass:       select.attr( 'data-container-class' ) || null,
          dropdownCssClass:        select.attr( 'data-dropdown-class' ) || null
        }).next().addClass(select.attr("class").match(/(input-sm)|(input-lg)|($)/i).toString().replace(new RegExp(",", 'g'), " "));
      }
    }

    // Add custom styling options for input[type="radio"]
    if (plugins.radio.length) {
      for (let i = 0; i < plugins.radio.length; i++) {
        $(plugins.radio[i]).addClass("radio-custom").after("<span class='radio-custom-dummy'></span>")
      }
    }

    // Add custom styling options for input[type="checkbox"]
    if (plugins.checkbox.length) {
      for (let i = 0; i < plugins.checkbox.length; i++) {
        $(plugins.checkbox[i]).addClass("checkbox-custom").after("<span class='checkbox-custom-dummy'></span>")
      }
    }

     /**
     * RD Calendar
     * @description Enables RD Calendar plugin
     */
    if (plugins.calendar.length) {
      var i;
      for (i = 0; i < plugins.calendar.length; i++) {
        var calendarItem = $(plugins.calendar[i]);

        calendarItem.rdCalendar({
          days: calendarItem.attr("data-days") ? calendarItem.attr("data-days").split(/\s?,\s?/i) : ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
          month: calendarItem.attr("data-months") ? calendarItem.attr("data-months").split(/\s?,\s?/i) : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        });
        $('.rdc-table_has-events').on("click", function () {
          $(this).toggleClass("opened");
          var tableEvents = $('.rdc-table_events'),
              ch = tableEvents.outerHeight(),
              tableEventCounter = $('.rdc-table_events-count');
          tableEventCounter.css({
            height: ch + 'px'
          });

          if (tableEventCounter.is(":visible")) {
            tableEventCounter.slideUp('fast');
          } else {
            tableEventCounter.slideDown('fast');
          }
          if (tableEvents.is(":visible")) {
            tableEvents.slideUp('fast');
          } else {
            tableEvents.slideDown('fast');
          }
        });

        $(window).on('resize', function () {
          if ($('.rdc-table_has-events').hasClass('active')) {
            var tableEvents = $('.rdc-table_events'),
                ch = tableEvents.outerHeight(),
                tableEventCounter = $('.rdc-table_events-count');
            tableEventCounter.css({
              height: ch + 'px'
            });
          }
        });

        $('input[type="radio"]').on("click", function () {
          if ($(this).attr("value") == "login") {
            $(".register-form").hide();
            $(".login-form").fadeIn('slow');
          }
          if ($(this).attr("value") == "register") {
            $(".register-form").fadeIn('slow');
            $(".login-form").hide();
          }
        });

        $('.rdc-next, .rdc-prev').on("click", function () {
          $('.rdc-table_has-events').on("click", function () {
            $(this).toggleClass("opened");
            var tableEvents = $('.rdc-table_events'),
                ch = tableEvents.outerHeight(),
                tableEventCounter = $('.rdc-table_events-count');
            tableEventCounter.css({
              height: ch + 'px'
            });

            if (tableEventCounter.is(":visible")) {
              tableEventCounter.slideUp('fast');
            } else {
              tableEventCounter.slideDown('fast');
            }
            if (tableEvents.is(":visible")) {
              tableEvents.slideUp('fast');
            } else {
              tableEvents.slideDown('fast');
            }
          });

          $(window).on('resize', function () {
            if ($('.rdc-table_has-events').hasClass('active')) {
              var tableEvents = $('.rdc-table_events'),
                  ch = tableEvents.outerHeight(),
                  tableEventCounter = $('.rdc-table_events-count');
              tableEventCounter.css({
                height: ch + 'px'
              });
            }
          });

          $('input[type="radio"]').on("click", function () {
            if ($(this).attr("value") == "login") {
              $(".register-form").hide();
              $(".login-form").fadeIn('slow');
            }
            if ($(this).attr("value") == "register") {
              $(".register-form").fadeIn('slow');
              $(".login-form").hide();
            }
          });
        });
      }
    }

    /**
     * UI To Top
     * @description Enables ToTop Button
     */
    if (isDesktop && !isNoviBuilder) {
      $().UItoTop({
        easingType: 'easeOutQuart',
        containerClass: 'ui-to-top fas fa-angle-up'
      });
    }

    // RD Navbar
    if (plugins.rdNavbar.length) {
      let
        navbar = plugins.rdNavbar,
        aliases = {
          '-':     0,
          '-sm-':  576,
          '-md-':  768,
          '-lg-':  992,
          '-xl-':  1200,
          '-xxl-': 1600
        },
        responsive = {},
        navItems = $('.rd-nav-item');

      for (let i = 0; i < navItems.length; i++) {
        let node = navItems[i];

        if (node.classList.contains('opened')) {
          node.classList.remove('opened')
        }
      }

      for (let alias in aliases) {
        let link = responsive[aliases[alias]] = {};
        if (navbar.attr('data' + alias + 'layout')) link.layout = navbar.attr('data' + alias + 'layout');
        if (navbar.attr('data' + alias + 'device-layout')) link.deviceLayout = navbar.attr('data' + alias + 'device-layout');
        if (navbar.attr('data' + alias + 'hover-on')) link.focusOnHover = navbar.attr('data' + alias + 'hover-on') === 'true';
        if (navbar.attr('data' + alias + 'auto-height')) link.autoHeight = navbar.attr('data' + alias + 'auto-height') === 'true';
        if (navbar.attr('data' + alias + 'stick-up-offset')) link.stickUpOffset = navbar.attr('data' + alias + 'stick-up-offset');
        if (navbar.attr('data' + alias + 'stick-up')) link.stickUp = navbar.attr('data' + alias + 'stick-up') === 'true';
        if (isNoviBuilder) link.stickUp = false;
        else if (navbar.attr('data' + alias + 'stick-up')) link.stickUp = navbar.attr('data' + alias + 'stick-up') === 'true';
      }

      plugins.rdNavbar.RDNavbar({
        anchorNav:    !isNoviBuilder,
        stickUpClone: (plugins.rdNavbar.attr("data-stick-up-clone") && !isNoviBuilder) ? plugins.rdNavbar.attr("data-stick-up-clone") === 'true' : false,
        responsive:   responsive,
        callbacks:    {
          onStuck:        function () {
            let navbarSearch = this.$element.find('.rd-search input');

            if (navbarSearch) {
              navbarSearch.val('').trigger('propertychange');
            }
          },
          onDropdownOver: function () {
            return !isNoviBuilder;
          },
          onUnstuck:      function () {
            if (this.$clone === null)
              return;

            let navbarSearch = this.$clone.find('.rd-search input');

            if (navbarSearch) {
              navbarSearch.val('').trigger('propertychange');
              navbarSearch.trigger('blur');
            }

          }
        }
      });
    }

    // Swiper
    if (plugins.swiper.length) {
      for (let i = 0; i < plugins.swiper.length; i++) {

        let
          node = plugins.swiper[i],
          params = parseJSON(node.getAttribute('data-swiper')),
          autoplay = node.getAttribute('data-autoplay'),
          defaults = {
            speed:      1000,
            loop:       node.getAttribute('data-loop') !== 'false',
            effect:     node.hasAttribute('data-slide-effect') ? node.getAttribute('data-slide-effect') : 'slide',
            pagination: {
              el:        '.swiper-pagination',
              clickable: true
            },
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev'
            },
            autoplay:   {
              enabled: autoplay !== 'false',
              delay: !isNaN( Number( autoplay ))  && Number( autoplay ) !== 0 ? autoplay : 5000,
            }
          },
          xMode = {
            autoplay:      false,
            loop:          false,
            simulateTouch: false
          };

        params.on = {
          init: function () {
            setBackgrounds(this);
            toggleSwiperCaptionAnimation(this);
            
            // Real Previous Index must be set recent
            this.on('slideChangeTransitionEnd', function () {
              toggleSwiperCaptionAnimation(this);
            });
          }
        };

        new Swiper(node, Util.merge(isNoviBuilder ? [defaults, params, xMode] : [defaults, params]));
      }
    }

    /**
     * Slick carousel
     * @description Enable Slick carousel plugin
     */
    if (plugins.slick.length) {
      var i;
      for (i = 0; i < plugins.slick.length; i++) {
        var $slickItem = $(plugins.slick[i]);

        $slickItem.on('init', function (slick) {
          initLightGallery($('[data-lightgallery="group-slick"]'), 'lightGallery-in-carousel');
          initLightGallery($('[data-lightgallery="item-slick"]'), 'lightGallery-in-carousel');
        });

        $slickItem.slick({
            slidesToScroll: parseInt($slickItem.attr('data-slide-to-scroll')) || 1,
            asNavFor: $slickItem.attr('data-for') || false,
            dots: $slickItem.attr("data-dots") == "true",
            infinite: isNoviBuilder ? false : $slickItem.attr("data-loop") == "true",
            focusOnSelect: true,
            arrows: $slickItem.attr("data-arrows") == "true",
            swipe: $slickItem.attr("data-swipe") == "true",
            autoplay: $slickItem.attr("data-autoplay") == "true",
            vertical: $slickItem.attr("data-vertical") == "true",
            centerMode: $slickItem.attr("data-center-mode") == "true",
            centerPadding: $slickItem.attr("data-center-padding") ? $slickItem.attr("data-center-padding") : '0.50',
            mobileFirst: true,
            responsive: [{
              breakpoint: 0,
              settings: {
                slidesToShow: parseInt($slickItem.attr('data-items')) || 1,
              }
            }, {
              breakpoint: 480,
              settings: {
                slidesToShow: parseInt($slickItem.attr('data-xs-items')) || 1,
              }
            }, {
              breakpoint: 768,
              settings: {
                slidesToShow: parseInt($slickItem.attr('data-sm-items')) || 1,
              }
            }, {
              breakpoint: 992,
              settings: {
                slidesToShow: parseInt($slickItem.attr('data-md-items')) || 1,
              }
            }, {
              breakpoint: 1200,
              settings: {
                slidesToShow: parseInt($slickItem.attr('data-lg-items')) || 1,
              }
            }]
          })
          .on('afterChange', function(event, slick, currentSlide, nextSlide) {
            var $this = $(this),
              childCarousel = $this.attr('data-child');

            if (childCarousel) {
              $(childCarousel + ' .slick-slide').removeClass('slick-current');
              $(childCarousel + ' .slick-slide').eq(currentSlide).addClass('slick-current');
            }
          });
      }
    }

    // Owl carousel
    if (plugins.owl.length) {
      for (let i = 0; i < plugins.owl.length; i++) {
        let
          node = plugins.owl[i],
          params = parseJSON(node.getAttribute('data-owl')),
          defaults = {
            items:              1,
            margin:             30,
            loop:               true,
            mouseDrag:          true,
            stagePadding:       0,
            nav:                false,
            navText:            [],
            dots:               false,
            autoplay:           true,
            autoplayTimeout:    3000,
            autoplayHoverPause: true
          },
          xMode = {
            autoplay:  false,
            loop:      false,
            mouseDrag: false
          },
          generated = {
            autoplay:   node.getAttribute('data-autoplay') === 'true',
            loop:       node.getAttribute('data-loop') !== 'false',
            mouseDrag:  node.getAttribute('data-mouse-drag') !== 'false',
            responsive: {}
          },
          aliases = ['-', '-sm-', '-md-', '-lg-', '-xl-', '-xxl-'],
          values = [0, 576, 768, 992, 1200, 1600],
          responsive = generated.responsive;

        for (let j = 0; j < values.length; j++) {
          responsive[values[j]] = {};

          for (let k = j; k >= -1; k--) {
            if (!responsive[values[j]]['items'] && node.getAttribute('data' + aliases[k] + 'items')) {
              responsive[values[j]]['items'] = k < 0 ? 1 : parseInt(node.getAttribute('data' + aliases[k] + 'items'), 10);
            }
            if (!responsive[values[j]]['stagePadding'] && responsive[values[j]]['stagePadding'] !== 0 && node.getAttribute('data' + aliases[k] + 'stage-padding')) {
              responsive[values[j]]['stagePadding'] = k < 0 ? 0 : parseInt(node.getAttribute('data' + aliases[k] + 'stage-padding'), 10);
            }
            if (!responsive[values[j]]['margin'] && responsive[values[j]]['margin'] !== 0 && node.getAttribute('data' + aliases[k] + 'margin')) {
              responsive[values[j]]['margin'] = k < 0 ? 30 : parseInt(node.getAttribute('data' + aliases[k] + 'margin'), 10);
            }
          }
        }

        // Initialize lightgallery items in cloned owl items
        $(node).on('initialized.owl.carousel', function () {
          initLightGalleryItem($(node).find('[data-lightgallery="item"]'), 'lightGallery-in-carousel');
        });

        node.owl = $(node);
        $(node).owlCarousel(Util.merge(isNoviBuilder ? [defaults, params, generated, xMode] : [defaults, params, generated]));
      }
    }

    /**
     * WOW
     * @description Enables Wow animation plugin
     */
    if (isDesktop && $html.hasClass("wow-animation") && $(".wow").length && !isNoviBuilder) {
      new WOW().init();
    }

    // Bootstrap Tabs
    if (plugins.bootstrapTabs.length) {
      for (let i = 0; i < plugins.bootstrapTabs.length; i++) {
        let bootstrapTab = $(plugins.bootstrapTabs[i]);

        //If have slick carousel inside tab - resize slick carousel on click
        if (bootstrapTab.find('.slick-slider').length) {
          bootstrapTab.find('.tabs-custom-list > li > a').on('click', $.proxy(function () {
            let $this = $(this);
            let setTimeOutTime = isNoviBuilder ? 1500 : 300;

            setTimeout(function () {
              $this.find('.tab-content .tab-pane.active .slick-slider').slick('setPosition');
            }, setTimeOutTime);
          }, bootstrapTab));
        }

        let tabs = plugins.bootstrapTabs[i].querySelectorAll('.nav li a');

        for (var t = 0; t < tabs.length; t++) {
          var tab = tabs[t],
            target = document.querySelector(tabs[t].getAttribute('href'));

          tab.classList.remove('active', 'show');
          target.classList.remove('active', 'show');

          if (t === 0) {
            tab.classList.add('active', 'show');
            target.classList.add('active', 'show');
          }
        }
      }
    }

    // RD Input Label
    if (plugins.rdInputLabel.length) {
      plugins.rdInputLabel.RDInputLabel();
    }

    // Regula
    if (plugins.regula.length) {
      attachFormValidator(plugins.regula);
    }

    // RD Mailform
    if (plugins.rdMailForm.length) {
      let i, j, k,
        msg = {
          'MF000': 'Successfully sent!',
          'MF001': 'Recipients are not set!',
          'MF002': 'Form will not work locally!',
          'MF003': 'Please, define email field in your form!',
          'MF004': 'Please, define type of your form!',
          'MF254': 'Something went wrong with PHPMailer!',
          'MF255': 'Aw, snap! Something went wrong.'
        };

      for (i = 0; i < plugins.rdMailForm.length; i++) {
        let $form = $(plugins.rdMailForm[i]),
          formHasCaptcha = false;

        $form.attr('novalidate', 'novalidate').ajaxForm({
          data:         {
            "form-type": $form.attr("data-form-type") || "contact",
            "counter":   i
          },
          beforeSubmit: function (arr, $form, options) {
            if (isNoviBuilder)
              return;

            let form = $(plugins.rdMailForm[this.extraData.counter]),
              inputs = form.find("[data-constraints]"),
              output = $("#" + form.attr("data-form-output")),
              captcha = form.find('.recaptcha'),
              captchaFlag = true;

            output.removeClass("active error success");

            if (isValidated(inputs, captcha)) {

              // veify reCaptcha
              if (captcha.length) {
                let captchaToken = captcha.find('.g-recaptcha-response').val(),
                  captchaMsg = {
                    'CPT001': 'Please, setup you "site key" and "secret key" of reCaptcha',
                    'CPT002': 'Something wrong with google reCaptcha'
                  };

                formHasCaptcha = true;

                $.ajax({
                  method: "POST",
                  url:    "bat/reCaptcha.php",
                  data:   {'g-recaptcha-response': captchaToken},
                  async:  false
                })
                  .done(function (responceCode) {
                    if (responceCode !== 'CPT000') {
                      if (output.hasClass("snackbars")) {
                        output.html('<p><span class="icon text-middle mdi mdi-check icon-xxs"></span><span>' + captchaMsg[responceCode] + '</span></p>')

                        setTimeout(function () {
                          output.removeClass("active");
                        }, 3500);

                        captchaFlag = false;
                      } else {
                        output.html(captchaMsg[responceCode]);
                      }

                      output.addClass("active");
                    }
                  });
              }

              if (!captchaFlag) {
                return false;
              }

              form.addClass('form-in-process');

              if (output.hasClass("snackbars")) {
                output.html('<p><span class="icon text-middle fa fa-circle-o-notch fa-spin icon-xxs"></span><span>Sending</span></p>');
                output.addClass("active");
              }
            } else {
              return false;
            }
          },
          error:        function (result) {
            if (isNoviBuilder)
              return;

            let output = $("#" + $(plugins.rdMailForm[this.extraData.counter]).attr("data-form-output")),
              form = $(plugins.rdMailForm[this.extraData.counter]);

            output.text(msg[result]);
            form.removeClass('form-in-process');

            if (formHasCaptcha) {
              grecaptcha.reset();
              window.dispatchEvent(new Event('resize'));
            }
          },
          success:      function (result) {
            if (isNoviBuilder)
              return;

            let form = $(plugins.rdMailForm[this.extraData.counter]),
              output = $("#" + form.attr("data-form-output")),
              select = form.find('select');

            form
              .addClass('success')
              .removeClass('form-in-process');

            if (formHasCaptcha) {
              grecaptcha.reset();
              window.dispatchEvent(new Event('resize'));
            }

            result = result.length === 5 ? result : 'MF255';
            output.text(msg[result]);

            if (result === "MF000") {
              if (output.hasClass("snackbars")) {
                output.html('<p><span class="icon text-middle mdi mdi-check icon-xxs"></span><span>' + msg[result] + '</span></p>');
              } else {
                output.addClass("active success");
              }
            } else {
              if (output.hasClass("snackbars")) {
                output.html(' <p class="snackbars-left"><span class="icon icon-xxs mdi mdi-alert-outline text-middle"></span><span>' + msg[result] + '</span></p>');
              } else {
                output.addClass("active error");
              }
            }

            form.clearForm();

            if (select.length) {
              select.val(null).trigger('change');
            }

            form.find('input, textarea').trigger('blur');

            setTimeout(function () {
              output.removeClass("active error success");
              form.removeClass('success');
            }, 3500);
          }
        });
      }
    }

    /**
     * RD Range
     * @description Enables RD Range plugin
     */
    if (plugins.rdRange.length && !isNoviBuilder) {
      plugins.rdRange.RDRange({});
    }

    /**
     * Custom Toggles
     */
    if (plugins.customToggle.length) {
      var i;
      for (i = 0; i < plugins.customToggle.length; i++) {
        var $this = $(plugins.customToggle[i]);
        $this.on('click', function(e) {
          e.preventDefault();
          $("#" + $(this).attr('data-custom-toggle')).add(this).toggleClass('active');
        });

        if ($this.attr("data-custom-toggle-disable-on-blur") === "true") {
          $("body").on("click", $this, function(e) {
            if (e.target !== e.data[0] && $("#" + e.data.attr('data-custom-toggle')).find($(e.target)).length == 0 && e.data.find($(e.target)).length == 0) {
              $("#" + e.data.attr('data-custom-toggle')).add(e.data[0]).removeClass('active');
            }
          })
        }
      }
    }

    /**
    *Add class on Click at Search Form
    */
    $features.on("click", function(e) {
      var $checkboxList = $('ul.checkbox-list');

      $(this).toggleClass('active');
      if ($checkboxList.is(":visible")) {
        $checkboxList.slideUp('slow');
      } else {
        $checkboxList.slideDown('slow');
      }
    });

    // Custom hover
    if ($custom_hover.length) {
      //hover ipad
      $custom_hover.on('touchstart', function() {
        $('.thumbnail-gallery').removeClass('hover');
        $(this).addClass('hover');

      });

      $('body').on('touchstart', function() {
        if (!$(this).hasClass('.thumbnail-gallery')) {
          $('.thumbnail-gallery').removeClass('hover');
        }
      });
    }

    // Google maps
    if (plugins.maps.length) {
      lazyInit(plugins.maps, initMaps);
    }

    // lightGallery
    if (plugins.lightGallery.length) {
      for (let i = 0; i < plugins.lightGallery.length; i++) {
        initLightGallery(plugins.lightGallery[i]);
      }
    }

    // lightGallery item
    if (plugins.lightGalleryItem.length) {
      // Filter carousel items
      let notCarouselItems = [];

      for (let z = 0; z < plugins.lightGalleryItem.length; z++) {
        if (!$(plugins.lightGalleryItem[z]).parents('.owl-carousel').length &&
          !$(plugins.lightGalleryItem[z]).parents('.swiper-slider').length &&
          !$(plugins.lightGalleryItem[z]).parents('.slick-slider').length) {
          notCarouselItems.push(plugins.lightGalleryItem[z]);
        }
      }

      plugins.lightGalleryItem = notCarouselItems;

      for (let i = 0; i < plugins.lightGalleryItem.length; i++) {
        initLightGalleryItem(plugins.lightGalleryItem[i]);
      }
    }

    // Dynamic lightGallery
    if (plugins.lightDynamicGalleryItem.length) {
      for (let i = 0; i < plugins.lightDynamicGalleryItem.length; i++) {
        initDynamicLightGallery(plugins.lightDynamicGalleryItem[i]);
      }
    }

    // Countdown
    if (plugins.countdown.length) {
      for (let i = 0; i < plugins.countdown.length; i++) {
        let
          node = plugins.countdown[i],
          countdown = aCountdown({
            node:  node,
            from:  node.getAttribute('data-from'),
            to:    node.getAttribute('data-to'),
            count: node.getAttribute('data-count'),
            tick:  100,
          });
      }
    }
  });
}());