(function ($, Drupal) {
    Drupal.behaviors.mockSensorData = {
      attach: function (context, settings) {
        // Check to ensure this doesn't execute multiple times.
        if (!context._mockSensorsInitialized) {
          context._mockSensorsInitialized = true;
  
          // Refresh the page every 5 seconds.
          setInterval(function () {
            location.reload(true); // Force reload without cache.
          }, 5000);
        }
      }
    };
  })(jQuery, Drupal);
  