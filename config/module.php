<?php

return  [
    'namespace'	=> implode('\\', ['App', 'Http', 'Modules']),
    'directory' => implode(DIRECTORY_SEPARATOR, ['app', 'Http', 'Modules']),
	'modules'	=> [
		// 'Backend',
		'Core',
		'Frontend',
		// implode(DIRECTORY_SEPARATOR, ['Backend', 'Modules', 'ProfessionalExperience']),
		// implode(DIRECTORY_SEPARATOR, ['Backend', 'Modules', 'Education']),
		// implode(DIRECTORY_SEPARATOR, ['Backend', 'Modules', 'Institutes']),
		// implode(DIRECTORY_SEPARATOR, ['Backend', 'Modules', 'Companies']),
		// implode(DIRECTORY_SEPARATOR, ['Backend', 'Modules', 'Acl']),
		// implode(DIRECTORY_SEPARATOR, ['Core', 'Modules', 'Api']),
		// implode(DIRECTORY_SEPARATOR, ['Core', 'Modules', 'Auth'])
	],
	'no-prefix'		=> ['Core', 'Frontend']
	// 'acl-prefix'	=> ['Acl', 'Core'],
];
