jQuery(document).ready(function($) {
  const startDateValue = siaeb_epr_params['persianStartDate'] || '';
  const endDateValue = siaeb_epr_params['persianEndDate'] || '';
  const startDateInput = '<input type="text" id="start-date" name="start-date" class="edd_datepicker" value="' +
      startDateValue + '" placeholder="mm/dd/yyyy" data-jdp="true" />';
  const endDateInput = '<input type="text" id="end-date" name="end-date" class="edd_datepicker" value="' +
      endDateValue + '" placeholder="mm/dd/yyyy" data-jdp="true" />';
  $(startDateInput).insertAfter($('#start-date'));
  $(endDateInput).insertAfter($('#end-date'));
  $('#start-date').first().remove();
  $('#end-date').first().remove();
  jalaliDatepicker.startWatch();
});
