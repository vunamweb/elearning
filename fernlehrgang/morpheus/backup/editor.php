<script language="javascript" type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script language="javascript" type="text/javascript">
tinymce.init({
    selector: ".tiny",
    theme: "modern",
	height: 200,
    plugins: [
         "advlist autolink link lists charmap ",
         "searchreplace wordcount visualblocks visualchars code",
         "save table contextmenu directionality paste textcolor"
   ],
   	toolbar: "insertfile undo redo | styleselect | bold italic | bullist numlist | code | link | ",
   	style_formats: [
        {title: 'HEADLINE', block: 'p', styles: {'font-family': 'Univers-57-Condensed', 'font-size': '18px', 'color': '#706F6F'}},
        {title: 'Text', block: 'p'}


    ]
});
</script>
<!-- /TinyMCE -->

