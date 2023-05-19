
  $(function() {
    // SmartWizard initialize
    $('#smartwizard').smartWizard({

      toolbar: {
          position: 'bottom'
      },
      lang: { // Language variables for button
          next: 'Siguiente',
          previous: 'Anterior'
      },
      theme: "square",
      keyboard: {
        keyNavigation: false
      },
      autoAdjustHeight:false
    });
  });