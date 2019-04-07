let numberOfDigits;
$('#wordsAndLength').on('blur', function (e) {
	const data = e.target.value.split(' ');
	numberOfDigits = data[1];
	let i;
	let fields = '';
	for(i = 1; i <= data[0]; i++) {
		const id = `word${i}`;
		fields = fields + `
			<label for="${id}">Word ${i}:</label>
			<br>
			<input type="text" name="${id}" id="${id}" value="" minlength="${numberOfDigits}" maxlength="${numberOfDigits}" required>
			<br>
		`
	}
	$('#wordsContainer').html(fields);
});

$('#numberOfQueries').on('blur', function (e) {
	const numberOfQueries = e.target.value;
	let i;
	let fields = '';
	for(i = 1; i <= numberOfQueries; i++) {
		const id = `query${i}`;
		fields = fields + `
			<label for="${id}">Query ${i}:</label>
			<br>
			<input type="text" name="${id}" id="${id}" value="" minlength="${numberOfDigits}" maxlength="${numberOfDigits}" required>
			<br>
		`
	}
	$('#queriesContainer').html(fields);
});