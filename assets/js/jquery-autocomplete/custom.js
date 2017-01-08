$(document).ready(function(){
	var availableTags = [
		"ActionScript",
		"AppleScript",
		"Asp",
		"BASIC",
		"C",
		"C++",
		"Clojure",
		"COBOL",
		"ColdFusion",
		"Erlang",
		"Fortran",
		"Groovy",
		"Haskell",
		"Java",
		"JavaScript",
		"Lisp",
		"Perl",
		"PHP",
		"Python",
		"Ruby",
		"Scala",
		"Scheme"
	];

	$(".autoselect").each(function(){
		var $this = $(this);

		$this.autocomplete({
			minChars: 0,
			source: availableTags
		}).focus(function(){
			$this.trigger('keydown.autocomplete');
		});
	});


});