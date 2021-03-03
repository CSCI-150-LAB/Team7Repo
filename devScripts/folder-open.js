const fs = require('fs');
const path = require('path');

let settings = fs.readFileSync(__dirname + '/../.vscode/settings.json', 'utf8');
if (settings) {
	settings = JSON.parse(settings);

	const rootDir = path.dirname(__dirname).replace(/\\/g, '/');

	settings['phpunit.phpunit'] = settings['phpunit.phpunit'].replace(/^.*?(\/app\/lib\/vendor\/.*)$/, rootDir + '$1');
	fs.writeFileSync(__dirname + '/../.vscode/settings.json', JSON.stringify(settings, null, '\t'));
}
