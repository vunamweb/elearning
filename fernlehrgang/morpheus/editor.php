<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
	tinyMCE.init({
		// General options
		selector: ".editor",

		toolbar : "save | undo redo | styleselect | bold italic | code | link",

	    plugins: [
	         "advlist autolink link image lists charmap print hr anchor pagebreak spellchecker",
	         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
	         "save table contextmenu directionality template paste textcolor"
	   ],

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
//			{title : 'Spalte rechts', inline : 'span'},
//			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'small', inline : 'span', classes : 'smallText'},
			{title: 'Headline', block: 'h1'},
//			{title : 'Example 2', inline : 'span', classes : 'example2'},
//			{title : 'Table styles'},
//			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		]

	});
</script>
<!-- /TinyMCE -->

