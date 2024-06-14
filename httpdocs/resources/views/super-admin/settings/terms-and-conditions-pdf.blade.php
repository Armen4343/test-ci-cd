<!DOCTYPE html>
<html>
<head>
<title>zeepup-terms-and-conditions</title>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<div id="content" class="w-100">
		@isset($terms->terms_text) 
       	{!! $terms->terms_text !!}
      	@endisset
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
      <script>
		  
		  
		  
		  
    function demoFromHTML() {
        var pdf = new jsPDF("p", "pt", "letter");
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#content')[0];

        // we support special element handlers. Register them with jQuery-style 
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors 
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('zeepup-terms-and-conditions.pdf');
            }, margins
        );
    }
		  window.onload = function() {
			demoFromHTML()
			  window.close();
			};
		  
</script>
</body>
</html>