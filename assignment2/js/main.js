$('#testCases').on('blur', function (e) {
	const numberOfQueries = e.target.value;
	let i;
	let fields = '';
	for(i = 0; i < numberOfQueries; i++) {
		fields = fields + `
			<label for="string1-${i}">String S1:</label>
			<br>
			<input type="text" name="string1-${i}" id="string1-${i}" value="" required>
			<br>
			<label for="string2-${i}">String S2:</label>
			<br>
			<input type="text" name="string2-${i}" id="string2-${i}" value="" required>
			<br>
			<label for="bool-${i}">Y or N:</label>
			<br>
			<input type="text" name="bool-${i}" id="bool-${i}" value="" required>
			<br>
			<label for="index-${i}">Index:</label>
			<br>
			<input type="text" name="index-${i}" id="index-${i}" value="" required>
			<br>
			<br>
			<br>
		`
	}
	$('#stringContainer').html(fields);
});